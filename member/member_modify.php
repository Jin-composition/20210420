<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/jhytest/20210420/db/db_connect.php";
    $id = $_POST["id"];

    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $phoneNumber = $_POST["phoneNumber"];
    $email1 = $_POST["email1"];
    $email2 = $_POST["email2"];

    $email = $email1 . "@" . $email2;

    //멤버테이블에서 id를 찾아서 해당되는 pass, name, 핸드폰번호, 이메일을 가져와라
    $sql = "update members set pass='$pass', name='$name' , phoneNumber='$phoneNumber',  email='$email'";
    $sql .= " where id='$id'";
    //위에 적혀진 쿼리문 실행, 에러가 나면 에러라는 메세지를 주고 죽어라
    //select -> record set, update, insert, delete -> true, false 
    $value = mysqli_query($con, $sql) or die('error : ' . mysqli_error($con));
    if ($value) {
        session_start();
        $_SESSION["username"] = $name;
    } else {
        alert_back('정보 수정 실패');
    }

    mysqli_close($con);


    echo "
	    <script>
	        alert('수정 완료');
	        location.href = 'http://{$_SERVER['HTTP_HOST']}/jhytest/20210420/index.php';
	    </script>
	  ";
?>

   
