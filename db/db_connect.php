<?php
    date_default_timezone_set("Asia/Seoul");
    $server_name = "localhost";
    $user_name = "root";
    //보안처리 해야함
    $pass = "math63041012!";
    $db_name = "sample";

    //  con->connect 
    $con = mysqli_connect($server_name, $user_name, $pass);
    $query = "create database if not exists sample";
    //$result = $con ->query($query): 쿼리문 실행
    //쿼리문을 실행하고 결과값이 오류가 나오면 프로그램을 멈춤, 에러메시지 출력
    $result = $con->query($query) or die($con->error);

    // 실행하다가 접속해서 안 되면 에러메세지를 주고 죽음
    $con->select_db($db_name) or die($con->error);

    //결과가 잘못 되었을 때 경고하고 백 함
    function alert_back($message){
        echo("
			<script>
			alert('$message');
			history.go(-1)
			</script>
			");
    }

    //사용자가 장난으로 입력하는 걸 방지하는 함수
    function input_set($data){
        // 양쪽 공백
        $data = trim($data);
        // slash 역할을 방어 (/ 하나만 붙이면 / 하나 더 붙임)
        $data = stripslashes($data);
        // html 태그 <> 를 변환시키는거
        $data = htmlspecialchars($data);
        return $data;
    }
?>