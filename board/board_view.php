<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8"><script src="https://kit.fontawesome.com/1513a75356.js" crossorigin="anonymous"></script>
    	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">	
		<title>Jin's Academy</title>
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/css/common.css?">
		<link rel="stylesheet" type="text/css"href="http://<?= $_SERVER['HTTP_HOST'] ?>/jhytest/20210420/board/css/board.css?">
        <!-- 밑에 있는 html 작업이 다 로드 된 후에 실행되라 -->
		<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/jhytest/20210420/board/js/board.js" defer></script>
		<script src="http://<?= $_SERVER["HTTP_HOST"] ?>/jhytest/20210420/js/common.js" defer></script>
		<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	</head>
	<body>
		<header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/header.php"; ?>
		</header>
		<section>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/main_img_bar.php"; ?>
			<div id="board_box">
				<h3 class="title">
					게시판 > 내용보기
				</h3>
                <?php
                    if (!$userid) {
						alert_back('로그인 후 이용해주세요!');
                    }

                    include_once $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/db/db_connect.php";
                    $num = $_GET["num"];
                    $page = $_GET["page"];

					//board 라는 테이블에서 num 의 컬럼을 찾아 해당되는 레코드 셋을 보여줘라
                    $sql = "select * from board where num=$num";
                    $result = mysqli_query($con, $sql);

                    $row = mysqli_fetch_array($result);
                    $id = $row["id"];
                    $name = $row["name"];
                    $regist_day = $row["regist_day"];
                    $subject = $row["subject"];
                    $content = $row["content"];
                    $file_name = $row["file_name"];
                    $file_type = $row["file_type"];
                    $file_copied = $row["file_copied"];
                    $hit = $row["hit"];

					//공백으로 된건 "&nbsp;" 로 바꿔라 / 줄 바꿈 한건 "<br>" 로 바꿔라
                    $content = str_replace(" ", "&nbsp;", $content);
                    $content = str_replace("\n", "<br>", $content);
					//userid(로그인한 사람) 랑 $id(글 쓴 사람) 가 같냐고 물어보는 거 -> 내가 다른사람 글 보는거 
                    if ($userid !== $id) {
                        $new_hit = $hit + 1;
						//board 라는 테이블에서 num 라는 레코드를  찾아서 hit 값을 수정하시오 
                        $sql = "update board set hit=$new_hit where num=$num";
                        mysqli_query($con, $sql);
                    }
                ?>
				<ul id="view_content">
					<li>
						<span class="col1"><b>제목 :</b> <?= $subject ?></span>
						<span class="col2"><?= $name ?> | <?= $regist_day ?></span>
					</li>
					<li>
                        <?php
                            if ($file_name) {
                                $real_name = $file_copied;
                                $file_path = "./data/" . $real_name;
                                $file_size = filesize($file_path);  //파일사이즈를 구해주는 함수

                                echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
                            }
                        ?>
                        <?= $content ?>
					</li>
				</ul>
				<ul class="buttons">
					<li>
						<button onclick="location.href='board_list.php?page=<?= $page ?>'">목록</button>
					</li>
					<li>
						<form action="board_form.php" method="post">
							<button>수정</button>
							<input type="hidden" name="num" value=<?= $num ?>>
							<input type="hidden" name="page" value=<?= $page ?>>
							<input type="hidden" name="mode" value="modify">
						</form>
					</li>
					<li>
						<form action="dmi_board.php" method="post">
							<button>삭제</button>
							<input type="hidden" name="num" value=<?= $num ?>>
							<input type="hidden" name="page" value=<?= $page ?>>
							<input type="hidden" name="mode" value="delete">
						</form>
					</li>
					<li>
						<button onclick="location.href='board_form.php'">글쓰기</button>
					</li>
				</ul>
			</div> <!-- board_box -->
		</section>
		<footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/footer.php"; ?>
		</footer>
	</body>
</html>
