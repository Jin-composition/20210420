<?php
    include_once $_SERVER["DOCUMENT_ROOT"]."/jhytest/20210420/db/db_connect.php";
    $id = $_POST["id"];

    $sql = "delete from members  where id='$id'";
    $value = mysqli_query($con, $sql) or die('error : ' . mysqli_error($con));
    if ($value) {
        echo "<script>
                    alert('탈퇴가 성공적으로 이뤄졌습니다');
              </script>";
    } else {
        alert_back('탈퇴 실패 관리자에게 문의바람');
    }
    include_once $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/login/logout.php";
?>






