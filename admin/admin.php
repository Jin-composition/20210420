<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
		<script src="https://kit.fontawesome.com/1513a75356.js" crossorigin="anonymous"></script>
    	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">	
		<title>Jin's Academy</title>
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/css/common.css">
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/admin/css/admin.css">
	
	</head>
	<body>
		<header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/header.php"; ?>
		</header>
		<section>
			<div id="admin_box">
				<h3 id="member_title">
					관리자 모드 > 회원 관리
				</h3>
				<ul id="member_list">
					<li>
						<span class="col1">번호</span>
						<span class="col2">아이디</span>
						<span class="col3">이름</span>
						<span class="col4">레벨</span>
						<span class="col5">포인트</span>
						<span class="col6">가입일</span>
						<span class="col7">수정</span>
						<span class="col8">삭제</span>
					</li>
                    <?php
					// 데이터베이스를 가져와서 쿼리문 실행하고 다 썼으면 반납 하기
                        include_once $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/db/db_connect.php";

                        if (!isset($_SESSION['userid']) && $_SESSION['userlevel']!=='1' ) {
                            alert_back('관리자만 접근가능합니다');
                        }

						//멤버테이블을 내림차순을 정렬해서 모든 레코드를 보여줘라
                        $sql = "select * from members order by num desc";
						//쿼리문을 실행해서 결과값을 result에 레코드셋(레코드들의 집합)을 저장해라
                        $result = mysqli_query($con, $sql);
						//레코드셋 에서 해당되는 레코드 갯수
                        $total_record = mysqli_num_rows($result); // 전체 회원 수

                        $number = $total_record;

						//fetch_array -> 레코드셋 에서 첫번째를 지정하고 다음위치로 포인터를 줘서 연관된 배열을 키 값으로 가져옴
						//포인터위치는 mysqli_fetch_array를 부를 때 마다 한칸씩 내려간다(다음 레코드를 가리키고 있다)
						//마지막 행을 가리킨 후에는 (가르킬 레코드 위치가 없으면 null 을 리턴한다 -> false)
                        while ($row = mysqli_fetch_array($result)) {
                            $num = $row["num"];
                            $id = $row["id"];
                            $name = $row["name"];
                            $level = $row["level"];
                            $point = $row["point"];
                            $regist_day = $row["regist_day"];
					?>

						<li>
							<!-- action 은 뭘 누르면 해당된 페이지로 가라 -->
							<form method="post" action="./admin_member_update.php">
							<!-- input type = "hidden 은 mysql 에 있는 회원 auto_increment 를 감추는것" -->
								<input type="hidden" name="num" value="<?= $num ?>">
								<span class="col1"><?= $number ?></span>
								<span class="col2"><?= $id ?></a></span>
								<span class="col3"><?= $name ?></span>
								<span class="col4"><input type="text" name="level" value="<?= $level ?>"></span>
								<span class="col5"><input type="text" name="point" value="<?= $point ?>"></span>
								<span class="col6"><?= $regist_day ?></span>
								<!-- button type 을 submit 으로 하면 안되지 않나 -->
								<span class="col7"><button type="submit">수정</button></span>
								<!-- php? 뒤에 num=<?= $num ?> 이게 GET 방식 이라는 거-->
								<span class="col8"><button type="button"
															onclick="location.href='admin_member_delete.php?num=<?= $num ?>'">삭제</button></span>
							</form>
						</li>

					<?php
                            $number--;
							
                        }
                    ?>
				</ul>
				<h3 id="member_title">
					관리자 모드 > 게시판 관리
				</h3>
				<ul id="board_list">
					<li class="title">
						<span class="col1">선택</span>
						<span class="col2">번호</span>
						<span class="col3">이름</span>
						<span class="col4">제목</span>
						<span class="col5">첨부파일명</span>
						<span class="col6">작성일</span>
					</li>
					<form method="post" action="admin_board_delete.php">
                        <?php
                            $sql = "select * from board order by num desc";
                            $result = mysqli_query($con, $sql);
                            $total_record = mysqli_num_rows($result); // 전체 글의 수

                            $number = $total_record;

                            while ($row = mysqli_fetch_array($result)) {
                                $num = $row["num"];
                                $name = $row["name"];
                                $subject = $row["subject"];
                                $file_name = $row["file_name"];
                                $regist_day = $row["regist_day"];
                                $regist_day = substr($regist_day, 0, 10)
						?>
								<li>
									<span class="col1"><input type="checkbox" name="item[]" value="<?= $num ?>"></span>
									<span class="col2"><?= $number ?></span>
									<span class="col3"><?= $name ?></span>
									<span class="col4"><?= $subject ?></span>
									<span class="col5"><?= $file_name ?></span>
									<span class="col6"><?= $regist_day ?></span>
								</li>
						<?php
                                $number--;
                            }
                            
                        ?>
						<button type="submit">선택된 글 삭제</button>
					</form>
				</ul>

				<h3 id="member_title">
					관리자 모드 > 자유 게시판 관리
				</h3>
				<ul id="board_list">
					<li class="title">
						<span class="col1">선택</span>
						<span class="col2">번호</span>
						<span class="col3">이름</span>
						<span class="col4">제목</span>
						<span class="col5">첨부파일명</span>
						<span class="col6">작성일</span>
					</li>
					<form method="post" action="admin_free_delete.php">
                        <?php
                            $sql = "select * from free order by num desc";
                            $result = mysqli_query($con, $sql);
                            $total_record = mysqli_num_rows($result); // 전체 글의 수

                            $number = $total_record;

                            while ($row = mysqli_fetch_array($result)) {
                                $num = $row["num"];
                                $name = $row["name"];
                                $subject = $row["subject"];
                                $file_name = $row["file_name_0"];
                                $regist_day = $row["regist_day"];
                                $regist_day = substr($regist_day, 0, 10)
						?>
								<li>
									<span class="col1"><input type="checkbox" name="item[]" value="<?= $num ?>"></span>
									<span class="col2"><?= $number ?></span>
									<span class="col3"><?= $name ?></span>
									<span class="col4"><?= $subject ?></span>
									<span class="col5"><?= $file_name ?></span>
									<span class="col6"><?= $regist_day ?></span>
								</li>
						<?php
                                $number--;
                            }
                           
                        ?>
						<button type="submit">선택된 글 삭제</button>
					</form>
				</ul>

				<h3 id="member_title">
					관리자 모드 > 이미지 게시판 관리
				</h3>
				<ul id="board_list">
					<li class="title">
						<span class="col1">선택</span>
						<span class="col2">번호</span>
						<span class="col3">이름</span>
						<span class="col4">제목</span>
						<span class="col5">첨부파일명</span>
						<span class="col6">작성일</span>
					</li>
					<form method="post" action="admin_image_board_delete.php">
                        <?php
                            $sql = "select * from image_board order by num desc";
                            $result = mysqli_query($con, $sql);
                            $total_record = mysqli_num_rows($result); // 전체 글의 수

                            $number = $total_record;

                            while ($row = mysqli_fetch_array($result)) {
                                $num = $row["num"];
                                $name = $row["name"];
                                $subject = $row["subject"];
                                $file_name = $row["file_name"];
                                $regist_day = $row["regist_day"];
                                $regist_day = substr($regist_day, 0, 10)
						?>
								<li>
									<span class="col1"><input type="checkbox" name="item[]" value="<?= $num ?>"></span>
									<span class="col2"><?= $number ?></span>
									<span class="col3"><?= $name ?></span>
									<span class="col4"><?= $subject ?></span>
									<span class="col5"><?= $file_name ?></span>
									<span class="col6"><?= $regist_day ?></span>
								</li>
						<?php
                                $number--;
                            }
                            mysqli_close($con);
                        ?>
						<button type="submit">선택된 글 삭제</button>
					</form>
				</ul>

				
			</div> <!-- admin_box -->
			
		</section>
		<footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/footer.php"; ?>
		</footer>
	</body>
</html>
