<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/db/db_connect.php";

    // session start -> CURD 를 하겠다 
    session_start();

    
    if (isset($_SESSION["userlevel"])&& $_SESSION["userlevel"] != 1 ){
        alert_back('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
    }

    $num   = $_POST["num"];
    $level = $_POST["level"];
    $point = $_POST["point"];

    //멤버테이블에서 해당 num를 찾아서 level값과 point값을 수정해라
    $sql = "update members set level=$level, point=$point where num=$num";
    //위에 쿼리를 실행하는 거
    $result = mysqli_query($con, $sql);

    mysqli_close($con);

    if(!$result){
        alert_back('수정실패');
    }else{
        echo "
        <script>
            alert('수정완료');
            location.href = 'http://{$_SERVER["HTTP_HOST"]}/jhytest/20210420/admin/admin.php';
        </script>
      ";
    }

    
?>

