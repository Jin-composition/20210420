<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
		<script src="https://kit.fontawesome.com/1513a75356.js" crossorigin="anonymous"></script>
    	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">	
		<title>Jin's Academy</title>
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/css/common.css">
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/member/css/member.css?after">
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/member/css/member_modify.css">
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<script src="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/member/js/member.js" defer></script>
		<script src="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/js/common.js" defer></script>
	</head>
	<body>
		<header>
			<!-- include 는 계속 포함시켜라 include_once 의 차이점은 한번만 포함시킴 -->
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/header.php"; ?>
		</header>
        <?php
            include_once $_SERVER['DOCUMENT_ROOT']."/jhytest/20210420/db/db_connect.php";
            $sql = "select * from members where id='$userid'";
			// 쿼리문 실행 -> result 에는 쿼리문을 실행한 결과가 들어있음
            $result = mysqli_query($con, $sql);
			//fetch_array -> 레코드셋 에서 연관된 배열을 키 값으로 가져옴
            $row = mysqli_fetch_array($result);

            $pass = $row["pass"];
            $name = $row["name"];
            $phoneNumber = $row["phoneNumber"];

			//explode 는 jinhy921207@naver.com 을 $email[0]="jinhy921207", $email[1]="naver.com"
            $email = explode("@", $row["email"]);
            $email1 = $email[0];
            $email2 = $email[1];

            mysqli_close($con);
        ?>
		<section>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/main_img_bar.php"; ?>
			<div id="main_content">
				<div id="join_box">

					<h2>회원 정보 수정</h2>
					<form name="member_form" method="post" action="member_modify.php">
						<table>
							<tr>
								<th>사용자 ID</th>
								<!-- 사용자 아이디를 세션 아이디로 적어줌 ($userid) -->
								<td><?= $userid ?>	<input type="hidden" name="id" value="<?=$userid?>" id="id">
							</tr>
							<tr>
								<th>비밀번호</th>
								<td><input type="password" name="pass" value="<?= $pass ?>">
									<!--4~12자리의 영문,숫자,특수문자(!, @, $, %, ^,&,*)만 가능-->
								</td>
							</tr>
							<tr>
								<th>비밀번호 확인</th>
								<td colspan="2"><input type="password" name="pass_confirm" value="<?= $pass ?>"></td>
							</tr>
							<tr>
								<th>성명</th>
								<td><input type="text" name="name" value="<?= $name ?>">
								</td>
							</tr>
							<tr>
								<th>핸드폰번호</th>
								<td><input type="text" name="phoneNumber">
								</td>
							</tr>
							<tr>
								<th>E-mail</th>
								<td><input type="text" name="email1" value="<?= $email1 ?>">@<input type="text" name="email2" value="<?= $email2 ?>">
								</td>
							</tr>
						</table>
						<br>
						<div>
							<!-- type 을 submit 을 하면 무조건 다음으로 넘어감 뒤에 onclick="check_data() 함수가 쓰여져 있어도 확인하지 않음 -->
							<input type="button" value="수정" onclick="check_input()">
							<input type="button" value="취소" onclick="location.href='http://<?=$_SERVER['HTTP_HOST']?>/jhytest/20210420/index.php'">
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

