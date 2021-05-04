<meta charset='utf-8'>

<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/jhytest/20210420/db/db_connect.php';

    $num = $_GET["num"];
    $mode = $_GET["mode"];

    $sql = "delete from message where num=$num";

    mysqli_query($con, $sql);
    mysqli_close($con);                // DB 연결 끊기

    echo "
		<script>
			location.href = 'message_box.php?mode={$mode}';
		</script>
	";

?>

  
