<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"><script src="https://kit.fontawesome.com/1513a75356.js" crossorigin="anonymous"></script>
    	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">	
		<title>Jin's Academy</title>
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/css/common.css?after">
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/member/css/member.css?after1">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/member/js/member.js"></script>
		<script src="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/js/common.js" defer></script>
	</head>
	<body>
		<header>
            <?php include $_SERVER['DOCUMENT_ROOT']."/jhytest/20210420/header.php"; ?>
		</header>
		<section>
            <?php include $_SERVER['DOCUMENT_ROOT']."/jhytest/20210420/main_img_bar.php"; ?>
			<!-- 회원가입 폼 -->
			<div id="main_content">
				<div id="join_box">
					<h2>회원 가입</h2><br/>
					<form name="member_form" method="post" action="./member_insert.php">
						<table id="join_table">
							<tr>
								<th>사용자 ID</th>
								<td><input type="text" name="id">
									<input type="button" value="중복 확인" onclick="check_id()"></td>
							</tr>
							<tr>
								<th>비밀번호</th>
								<td><input type="password" name="pass">
								</td>
							</tr>
							<tr>
								<th>비밀번호 확인</th>
								<td colspan="2"><input type="password" name="pass_confirm"></td>
							</tr>
							<tr>
								<th>이름</th>
								<td><input type="text" name="name">
								</td>
							</tr>
							<tr>
								<th>핸드폰번호</th>
								<td><input type="text" name="phoneNumber">
								</td>
							</tr>
							<tr>
								<th>E-mail</th>
								<td><input type="text" name="email1">@<input type="text" name="email2">
								</td>
							</tr>
						</table>
						<br>
						<div>
							<input type="button" value="회원가입" onclick="check_input()">
							<input type="button" value="초기화" onclick="reset_form()">
						</div>
					</form>
				</div> <!-- join_box -->
			</div> <!-- main_content -->
		</section>
		<footer>
            <?php include $_SERVER['DOCUMENT_ROOT']. "/jhytest/20210420/footer.php"; ?>
		</footer>
	</body>
</html>

