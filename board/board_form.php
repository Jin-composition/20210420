<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8"><script src="https://kit.fontawesome.com/1513a75356.js" crossorigin="anonymous"></script>
    	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">	
		<title>Jin's Academy</title>
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/css/common.css">
		<link rel="stylesheet" type="text/css"href="http://<?= $_SERVER['HTTP_HOST'] ?>/jhytest/20210420/board/css/board.css">
		<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/jhytest/20210420/board/js/board.js" defer></script>
		<script src="http://<?= $_SERVER["HTTP_HOST"] ?>/js/common.js" defer></script>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	</head>

	<body>
		<header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/header.php"; ?>
		</header>
		<?php
            if (!$userid) {
				alert_back('로그인 후 이용해주세요!');
            }
        ?>
		<section>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/main_img_bar.php";
                include_once $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/db/db_connect.php";
				//$_POST["mode"] 값이 세팅이 되어있지 않으면 삽입(insert) 해당 폼을 이용하겠다.
				//$mode = "insert" 기본값으로 세팅 됨
                $mode = isset($_POST["mode"])?$_POST["mode"]:"insert";
                $subject = ""; 
                $content = "";
                $file_name = "";

				//수정하기 모드인지를 물어봄
                if (isset($_POST["mode"]) && $_POST["mode"] === "modify") {
                    $num = $_POST["num"];
                    $page = $_POST["page"];

                    $sql = "select * from board where num=$num";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($result);
                    $writer = $row["id"];
                    if (!isset($userid) || ($userid !== $writer && $userlevel !== '1')) {
                        alert_back('수정권한이 없습니다.');
                        exit;
                    }
                    $name = $row["name"];
                    $subject = $row["subject"];
                    $content = $row["content"];
                    $file_name = $row["file_name"];
                    if (empty($file_name)) $file_name = "없음";
                }
            ?>

			<div id="board_box">
				<h3 id="board_title">
                    <?php if ($mode === "modify"): ?>
						게시판 > 수정 하기
                    <?php else: ?>
						게시판 > 글 쓰기
                    <?php endif; ?>
				</h3>
				<!-- enctype => 파일을 첨부할 땐 반드시 이거 쓰기 엔코드 타입 -->
				<form name="board_form" method="post" action="dmi_board.php" enctype="multipart/form-data">
				<!-- $mode === "modify" 수정모드이면 num, page를 히든으로 전송하겠다.-->
				<!-- $mode === "insert" 이면 이 문장을 실행하지 않겠다. -->
                    <?php if ($mode === "modify"): ?>
	                    <input type="hidden" name="num" value=<?= $num ?>>
	                    <input type="hidden" name="page" value=<?= $page ?>>
                    <?php endif; ?>

				
					<input type="hidden" name="mode" value=<?= $mode ?>>
					<ul id="board_form">
						<li>
							<span class="col1">이름 : </span>
							<span class="col2"><?= $username ?></span>
						</li>
						<li>
							<span class="col1">제목 : </span>
							<span class="col2"><input name="subject" type="text" value=<?= $subject ?>></span>
						</li>
						<li id="text_area">
							<span class="col1">내용 : </span>
							<span class="col2">
							<textarea name="content"><?= $content ?></textarea>
						</span>
						</li>
						<li>
							<span class="col1"> 첨부 파일 : </span>
							<span class="col2"><input type="file" name="upfile">
							<?php if ($mode === "modify"): ?>
								<input type="checkbox" value="yes"
								       name="file_delete">&nbsp;파일 삭제하기
								<br>현재 파일 : <?= $file_name ?>
                            <?php endif; ?>
							 </span>
						</li>
					</ul>
					<ul class="buttons">
						<li>
							<button type="button" onclick="check_input()">완료</button>
						</li>
						<li>
							<button type="button" onclick="location.href='board_list.php'">목록</button>
						</li>
					</ul>
				</form>
			</div> <!-- board_box -->
		</section>
		<footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/footer.php"; ?>
		</footer>
	</body>

</html>