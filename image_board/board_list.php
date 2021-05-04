<!DOCTYPE html>
<html>
	<head>
    <meta charset="utf-8"><script src="https://kit.fontawesome.com/1513a75356.js" crossorigin="anonymous"></script>
    	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">	
		<title>Jin's Academy</title>
		<link rel="stylesheet" href="http://<?=$_SERVER["HTTP_HOST"]?>/jhytest/20210420/css/common.css?after">
		<link rel="stylesheet" type="text/css"href="http://<?= $_SERVER['HTTP_HOST'] ?>/jhytest/20210420/image_board/css/board.css">
        <!-- 밑에 있는 html 작업이 다 로드 된 후에 실행되라 -->
        <!-- defer 사용하는 원인 : 웹 브라우저 엔진 실행순서에 문제가 발생이 됨 -->
        <!-- document 객체, body 안에 있는 모든 element 객체 가 메모리에 로드 된 후 에 자바스크립트를 실행시켜라 -->
		<script src="http://<?= $_SERVER['HTTP_HOST'] ?>/jhytest/20210420/image_board/js/board.js" defer></script>
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
				<h3>
					이미지 게시판 > 목록보기
				</h3>
				<ul id="board_list">
                    <?php

                        // mysql 에 접속 요청을 해서 핸들값을 가져오는거
                        include_once $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/db/db_connect.php";
                        //테이블 안에서 원래 설계를 해야하는데 내 웹사이트 페이지 안에서 자동으로 설계되게끔 해놓은거
                        include_once $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/db/create_table.php";
                        //이미지 게시판 테이블과 답변형 생성
                        create_table($con,"image_board");
                        create_table($con,"image_board_ripple");
                        //isset 은 존재하는지 안하는지
                        if (isset($_GET["page"]))
                            $page = $_GET["page"];
                        else
                            $page = 1;


                        $sql = "select * from image_board order by num desc";
                        //result set 이 저장됨
                        $result = mysqli_query($con, $sql);
                        $total_record = mysqli_num_rows($result); // 전체 글 수

                        $scale = 10;
                        

                        // 전체 페이지 수($total_page) 계산
                        if ($total_record % $scale == 0)
                            $total_page = floor($total_record / $scale);
                        else
                            $total_page = floor($total_record / $scale) + 1;

                        // 표시할 페이지($page)에 따라 $start 계산
                        $start = ($page - 1) * $scale;

                        $number = $total_record - $start;

                        for ($i = $start;
                            //마지막 페이지가 전체의 개수(scale) 보다 작기 때문에 
                             $i < $start + $scale && $i < $total_record; $i++) {
                            //result set에서 내가 가져올 위치를 가리키는 것, // 가져올 레코드로 위치(포인터) 이동
                            mysqli_data_seek($result, $i);
                            //$i 가 가리키는 위치 (0번째, 1번째) 가 가리키는 걸 연관배열로 가져와라
                            $row = mysqli_fetch_array($result);
                            // 하나의 레코드 가져오기
                            $num = $row["num"];
                            $id = $row["id"];
                            $name = $row["name"];
                            $subject = $row["subject"];
                            $regist_day = $row["regist_day"];
                            $hit = $row["hit"];
                            $file_name_0 = $row['file_name'];
                            $file_copied_0 = $row['file_copied'];
                            $file_type_0 = $row['file_type'];
                            //이미지 사이즈를 지정해버림
                            $image_width = 200;
                            $image_height = 200;
                            //이미지 정보를 가져오기 위한 함수 width, height, type
//                            if (!empty($file_name_0)) {
//                                $image_info = getimagesize("./data/" . $file_copied_0);
//                                $image_width = $image_info[0];
//                                $image_height = $image_info[1];
//                                $image_type = $image_info[2];
//                                if ($image_width > 200 ) $image_width = 200;
//                            }

//                            if ($row["file_name"])
//                                $file_image = "<img src='./img/file.gif'>";
//                            else
//                                $file_image = " ";
                            ?>
							<li>
								<span>
									<a href="board_view.php?num=<?= $num ?>&page=<?= $page ?>">
                                    <!-- strpos -> string position이 파일에서 이미지 위치가 있느냐 -->
										<? if (strpos($file_type_0, "image") !== false) echo "<img src='./data/$file_copied_0' width='$image_width' height='$image_height'><br>";
                                        else echo "<img src='./img/user.jpg' width='$image_width' height='$image_height'><br>" ?>
                                        <?= $subject ?></a><br>
								<?= $id ?><br>
								<?= $regist_day ?>
								</span>
							</li>
                            <?php
                            $number--;
                        }
                        mysqli_close($con);

                    ?>
				</ul>
				<ul id="page_num">
                    <?php
                        if ($total_page >= 2 && $page >= 2) {
                            $new_page = $page - 1;
                            echo "<li><a href='board_list.php?page=$new_page'>◀ 이전</a> </li>";
                        } else
                            echo "<li>&nbsp;</li>";

                        // 게시판 목록 하단에 페이지 링크 번호 출력
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($page == $i)     // 현재 페이지 번호 링크 안함
                            {
                                echo "<li><b> $i </b></li>";
                            } else {
                                echo "<li><a href='board_list.php?page=$i'> $i </a><li>";
                            }
                        }
                        if ($total_page >= 2 && $page != $total_page) {
                            $new_page = $page + 1;
                            echo "<li> <a href='board_list.php?page=$new_page'>다음 ▶</a> </li>";
                        } else
                            echo "<li>&nbsp;</li>";
                    ?>
				</ul> <!-- page -->
				<ul class="buttons">
					<li>
						<button onclick="location.href='board_list.php'">목록</button>
					</li>
					<li>
                        <?php
                            if ($userid) {
                                ?>
								<button onclick="location.href='board_form.php'">글쓰기</button>
                                <?php
                            } else {
                                ?>
								<a href="javascript:alert('로그인 후 이용해 주세요!')">
									<button>글쓰기</button>
								</a>
                                <?php
                            }
                        ?>
					</li>
				</ul>
			</div> <!-- board_box -->
		</section>
		<footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/jhytest/20210420/footer.php"; ?>
		</footer>
	</body>
</html>
