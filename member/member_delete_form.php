<!DOCTYPE html>
<html>
	<head>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">	
		<title>Jin's Academy</title>
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/css/common.css">
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/member/css/member.css?after">
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/member/css/member_modify.css">
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/login/css/login.css?after1">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/member/js/member.js" defer></script>
		<script src="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/js/common.js" defer></script>
		<script src="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/login/js/login.js" defer></script>
	</head>
	<body>
		<header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/header.php"; ?>
		</header>
		<section>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/main_img_bar.php"; ?>
			<div id="main_content">
				<div id="join_box">
					<h2>정말로 회원탈퇴를 하시겠습니까?</h2>
					<form name="member_form" method="post" action="member_delete.php">
						<input type="hidden" name="id" value="<?=$userid?>">
						<br><br>
						<div>
							<input type="submit" value="확인">
						</div>
					</form>
				</div> <!-- join_box -->
			</div> <!-- main_content -->
		</section>
		<footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/footer.php"; ?>
		</footer>
	</body>
</html>

