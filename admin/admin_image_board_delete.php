<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/db/db_connect.php";

    session_start();
    if (isset($_SESSION["userlevel"]) && $_SESSION["userlevel"] != 1) {
        alert_back('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
    }

    if (!isset($_POST["item"])) {
        alert_back('삭제할 게시글을 선택해주세요!');
    } else {
        $num_item = count($_POST["item"]);



    for ($i = 0; $i < count($_POST["item"]); $i++) {
        $num = $_POST["item"][$i];

        $sql = "select * from image_board where num = $num";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        $copied_name = $row["file_copied"];

        if ($copied_name) {
            $file_path = $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/image_board/data/" . $copied_name;
            unlink($file_path);
        }

        $sql = "delete from image_board where num = $num";
        mysqli_query($con, $sql);
    }
    }
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
?>

