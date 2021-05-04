<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/db/db_connect.php";
    session_start();
    //관리자가 맞냐고 물어봄
    if (isset($_SESSION["userlevel"])&& $_SESSION["userlevel"] != 1 )
    {
        alert_back('관리자가 아닙니다! 회원정보 삭제는 관리자만 가능합니다!');
    }

    // update 에선POST 였는데 GET 으로 바뀐거
    $num   = $_GET["num"];

    //멤버라는 테이블에서 해당되는 num을 찾아서 삭제 
    $sql = "delete from members where num = $num";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'admin.php';
	     </script>
	   ";
?>

