<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://kit.fontawesome.com/1513a75356.js" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>    
		<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/jhytest/20210420/css/common.css">
		<link rel="stylesheet" type="text/css" href="http://<?= $_SERVER['HTTP_HOST'] ?>/jhytest/20210420/memo/css/message.css">
		<script src="http://<?=$_SERVER['HTTP_HOST'];?>/jhytest/20210420/memo/js/message.js" defer></script>
		<title>Jin's Academy</title>
	</head>
	<body>
		<header>
            <?php include $_SERVER['DOCUMENT_ROOT']."/jhytest/20210420/header.php"; ?>
		</header>
        <?php
            include_once $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/db/db_connect.php";
            include_once $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/db/create_table.php";
            create_table($con, 'message');
            if (!$userid) {
				alert_back('로그인 후 이용해주세요!');
            }
        ?>
		<section>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/main_img_bar.php"; ?>
			<div id="message_box">
				<h3 id="write_title">
					쪽지 보내기
				</h3>
				<ul class="top_buttons">
					<li><span><a href="message_box.php?mode=rv">수신 쪽지함 </a></span></li>
					<li><span><a href="message_box.php?mode=send">송신 쪽지함</a></span></li>
				</ul>
				<form name="message_form" method="post" action="message_insert.php">
					<div id="write_msg">
						<ul>
							<li>
								<span class="col1">보내는 사람 : </span>
								<span class="col2"><?= $userid ?></span>
								<input type="hidden" value=<?=$userid?> name="send_id">
							</li>
							<li>
								<span class="col1">수신 아이디 : </span>
								<span class="col2"><input name="rv_id" type="text"></span>
							</li>
							<li>
								<span class="col1">제목 : </span>
								<span class="col2"><input name="subject" type="text"></span>
							</li>
							<li id="text_area">
								<span class="col1">내용 : </span>
								<span class="col2">
	    				<textarea name="content"></textarea>
	    			</span>
							</li>
						</ul>
						<button type="button" onclick="check_input()">보내기</button>
					</div>
				</form>
			</div> <!-- message_box -->
		</section>
		<footer>
            <?php include $_SERVER['DOCUMENT_ROOT']."/jhytest/20210420/footer.php"; ?>
		</footer>
	</body>
</html>
