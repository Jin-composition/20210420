<?php
//echo var_dump($_POST);
    include_once $_SERVER['DOCUMENT_ROOT']."/jhytest/20210420/db/db_connect.php";
    include_once $_SERVER['DOCUMENT_ROOT']."/jhytest/20210420/db/create_table.php";
    // create_table.php에 이 함수가 있음
    create_table($con,'members'); //회원가입 테이블
    create_table($con,'delete_members'); //회원 탈퇴 트리거 테이블


    //POST 방식으로 온 외부에서 온 데이터 체크
    $id = input_set($_POST["id"]);
    $pass = input_set($_POST["pass"]);
    $name = input_set($_POST["name"]);
    $phoneNumber = input_set($_POST["phoneNumber"]);
    $email1 = input_set($_POST["email1"]);
    $email2 = input_set($_POST["email2"]);

    $email = $email1 . "@" . $email2;
    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    //입력된 데이터 패턴 체크(이름, 이메일)
    $pattern = "/[가-힣]+/"; //한글 소리 마디

    if (!preg_match($pattern, $name)) {

        alert_back($name. "형식에 맞지 않는 이름입니다. 한글로 입력해주세요");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        alert_back($email. "형식에 맞지 않는 이메일입니다.");
        exit;
        
    } 

    //transaction 처리
    $success = true; //트랜잭션 플래그 선정
    $result = mysqli_query($con, "SET AUTOCOMMIT=0"); //반드시 자동 커밋을 0으로 설정
    $result = mysqli_query($con, "START TRANSACTION"); //트랜잭션 시작

    //*******************************
    $sql = "insert into members(id, pass, name, phoneNumber, email, regist_day, level, point) ";
    $sql .= "values('$id', '$pass', '$name', '$phoneNumber', '$email', '$regist_day', 9, 0)";

    $result = mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    //******************************* 


    if(!$result) $success = false; //오류 발생으로 플래그 값을 false로 선정



    if($success == false) {
        $result = mysqli_query($con, "ROLLBACK");
        alert_back('삽입중에 문제 발셍으로 ROLLBACK처리');
    }else {
        $result = mysqli_query($con, "COMMIT");
    }

    $result = mysqli_query($con, "SET AUTOCOMMIT=1"); //반드시 자동커밋을 1로 설정 트랜잭션 처리 완료

    //데이터베이스 close
    mysqli_close($con);

    echo "
        <script>
            location.href = 'http://{$_SERVER['HTTP_HOST']}/jhytest/20210420/index.php';
        </script>
    ";
   
?>


