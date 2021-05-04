<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    include_once $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/db/db_connect.php";

    if (isset($_POST["mode"]) && $_POST["mode"] === "delete") {
        $num = $_POST["num"];
        $page = $_POST["page"];
        $sql = "select * from image_board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $writer = $row["id"];
        if (!isset($userid) || ($userid !== $writer && $userlevel !== '1')) {
            alert_back('수정권한이 없습니다.');
            exit;
        }
        $copied_name = $row["file_copied"];

        if ($copied_name) {
            $file_path = "./data/" . $copied_name;
            unlink($file_path);
        }

        $sql = "delete from image_board where num = $num";
        mysqli_query($con, $sql);
        mysqli_close($con);

        echo "
	     <script>
	         location.href = 'board_list.php?page=$page';
	     </script>
	   ";
    } else if (isset($_POST["mode"]) && $_POST["mode"] === "insert") {

        include_once $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/db/db_connect.php";


        //세션값확인
        if (!$userid) {
            alert_back('게시판 글쓰기는 로그인 후 이용해 주세요!');
        }

        $subject = $_POST["subject"];
        $content = $_POST["content"];

        //input_set 은 보안
        $subject = input_set($subject);
        $content = input_set($content);

        $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

        $upload_dir = "./data/";

        $upfile_name = $_FILES["upfile"]["name"];
        $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
        $upfile_type = $_FILES["upfile"]["type"];
        $upfile_size = $_FILES["upfile"]["size"];  // 안되면 php init 에서 최대 크기 수정!
        $upfile_error = $_FILES["upfile"]["error"];

        if ($upfile_name && !$upfile_error) { // 업로드가 잘되었는지 판단
            $file = explode(".", $upfile_name); // trim과 같다. (memo.sql)
            $file_name = $file[0]; //(memo)
            $file_ext = $file[1]; //(sql)

            $new_file_name = date("Y_m_d_H_i_s");
            $new_file_name = $new_file_name . "_" . $file_name;
            $copied_file_name = $new_file_name . "." . $file_ext; // 2020_09_23_11_10_20_memo.sql
            $uploaded_file = $upload_dir . $copied_file_name; // ./data/2020_09_23_11_10_20_memo.sql 다 합친것

            if ($upfile_size > 1000000) {
                alert_back('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요!');
            }

            if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
                alert_back('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
            }
        } else {
            $upfile_name = "";
            $upfile_type = "";
            $copied_file_name = "";
        }

        //    $con = mysqli_connect("localhost", "user1", "12345", "sample");

        $sql = "insert into image_board (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
        $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
        $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
        mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

        // 포인트 부여하기
        $point_up = 100;

        $sql = "select point from members where id='$userid'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);
        $new_point = $row["point"] + $point_up;

        $sql = "update members set point=$new_point where id='$userid'";
        $result = mysqli_query($con, $sql);


        mysqli_close($con);                // DB 연결 끊기

        echo "
	   <script>
	    location.href = 'board_list.php';
	   </script>
	";

    } else if (isset($_POST["mode"]) && $_POST["mode"] === "modify") {
        $num = $_POST["num"];
        $page = $_POST["page"];

        $subject = $_POST["subject"];
        $content = $_POST["content"];
        $file_delete = (isset($_POST["file_delete"])) ? $_POST["file_delete"] : 'no';

        $sql = "select * from image_board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $copied_name = $row["file_copied"];

        $upfile_name = $row["file_name"];
        $upfile_type = $row["file_type"];
        $copied_file_name = $row["file_copied"];
        if ($file_delete === "yes") {
            if ($copied_name) {
                $file_path = "./data/" . $copied_name;
                unlink($file_path);
            }
            $upfile_name = "";
            $upfile_type = "";
            $copied_file_name = "";

        } else {
            if (isset($_FILES["upfile"])) {
                if ($copied_name) {
                    $file_path = "./data/" . $copied_name;
                    unlink($file_path);
                }

                $upload_dir = "./data/";

                $upfile_name = $_FILES["upfile"]["name"];
                $upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
                $upfile_type = $_FILES["upfile"]["type"];
                $upfile_size = $_FILES["upfile"]["size"];  // 안되면 php init 에서 최대 크기 수정!
                $upfile_error = $_FILES["upfile"]["error"];
                if ($upfile_name && !$upfile_error) { // 업로드가 잘되었는지 판단
                    $file = explode(".", $upfile_name); // trim과 같다. (memo.sql)
                    $file_name = $file[0]; //(memo)
                    $file_ext = $file[1]; //(sql)

                    $new_file_name = date("Y_m_d_H_i_s");
                    $new_file_name = $new_file_name . "_" . $file_name;
                    $copied_file_name = $new_file_name . "." . $file_ext; // 2020_09_23_11_10_20_memo.sql
                    $uploaded_file = $upload_dir . $copied_file_name; // ./data/2020_09_23_11_10_20_memo.sql 다 합친것

                    if ($upfile_size > 1000000) {
                        alert_back('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요!');
                    }

                    if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
                        alert_back('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                    }
                } else {
                    $upfile_name = $row["file_name"];
                    $upfile_type = $row["file_type"];
                    $copied_file_name = $row["file_copied"];
                }
            }

        }
        $sql = "update image_board set subject='$subject', content='$content',  file_name='$upfile_name', file_type='$upfile_type', file_copied= '$copied_file_name'";
        $sql .= " where num=$num";
        mysqli_query($con, $sql);

        mysqli_close($con);
        echo "
	      <script>
	          location.href = 'board_list.php?page=$page';
	      </script>
	  ";
    } else if (isset($_POST["mode"]) && $_POST["mode"] == "insert_ripple") {
        if (empty($_POST["ripple_content"])) {
            alert_back('내용입력요망!');
        }
        //"덧글을 다는사람은 로그인을 해야한다." 말한것이다.
        $userid = $_SESSION['userid'];
        //보안 강화
        $q_userid = mysqli_real_escape_string($con, $userid);
        $sql = "select * from members where id = '$q_userid'";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }
        $rowcount = mysqli_num_rows($result);

        if (!$rowcount) {
            alert_back('없는 아이디!!');
        } else {
            $content = input_set($_POST["ripple_content"]);
            $page = input_set($_POST["page"]);
            $parent = input_set($_POST["parent"]);
            $hit = input_set($_POST["hit"]);
            $q_usernick = isset($_SESSION['usernick']) ? mysqli_real_escape_string($con, $_SESSION['usernick']) : null;
            $q_username = mysqli_real_escape_string($con, $_SESSION['username']);
            $q_content = mysqli_real_escape_string($con, $content);
            $q_parent = mysqli_real_escape_string($con, $parent);
            $regist_day = date("Y-m-d (H:i)");

            $sql = "INSERT INTO `image_board_ripple` VALUES (null,'$q_parent','$q_userid','$q_username', '$q_usernick','$q_content','$regist_day')";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                die('Error: ' . mysqli_error($con));
            }
            mysqli_close($con);
            echo "<script>location.href='./board_view.php?num=$parent&page=$page&hit=$hit';</script>";
        }//end of if rowcount
    } else if (isset($_POST["mode"]) && $_POST["mode"] == "delete_ripple") {
        $page = input_set($_POST["page"]);
        $hit = input_set($_POST["hit"]);
        $num = input_set($_POST["num"]);
        $parent = input_set($_POST["parent"]);
        $q_num = mysqli_real_escape_string($con, $num);

        $sql = "DELETE FROM `image_board_ripple` WHERE num=$q_num";
        $result = mysqli_query($con, $sql) or  die('Error: ' . mysqli_error($con));
        
        mysqli_close($con);
        echo "<script>location.href='./board_view.php?num=$parent&page=$page&hit=$hit';</script>";

    }

?>

