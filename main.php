<?php include $_SERVER['DOCUMENT_ROOT'].'/jhytest/20210420/main_img_bar.php'; ?>

<div id='main_content'>

    <!-- 최근 게시글 5개 display -->
    <div id='latest'>
        <h4>최근 게시글</h4>
        <ul>
            <!-- 최근 게시 글 DB에서 불러오기 -->
        <?php
            include_once 'db/db_connect.php';
            //board 테이블에서 num 내림차순 정렬 상위 5개 레코드 출력
            $sql = 'select * from board order by num desc limit 5';
            $result = mysqli_query( $con, $sql );

            if ( !$result )
                echo '<li><span>아직 게시글이 없습니다!</span></li>';
            else {
                // result set 에서 첫번째 포인트 레코드 $row 연관배열 저장
                while ( $row = mysqli_fetch_array( $result ) ) {
                    $regist_day = substr( $row['regist_day'], 0, 10 );
        ?>
                    <li>
                        <span>
                            <?=$row['subject'] ?>
                        </span>
                        <span>
                            <?=$row['name'] ?>
                        </span>
                        <span>
                            <?=$regist_day ?>
                        </span>
                    </li>
        <?php
                }//end of while
            }//end of else
        ?>
        </ul>
    </div>

    <!-- 최근 상위포인트 랭킹 5개 출력 -->
    <div id='point_rank'>
        <h4>포인트 랭킹</h4>
        <ul>
        
<?php
            $rank = 1;
            $sql = 'select * from members order by point desc limit 5';
            $result = mysqli_query( $con, $sql );

            if ( !$result )
                echo '<li>아직 가입된 회원이 없습니다!</li>';
            else {
                while ( $row = mysqli_fetch_array( $result ) ) {
                    $name = $row['name'];
                    $id = $row['id'];
                    $point = $row['point'];
                    $name = mb_substr( $name, 0, 1 ) . ' * ' . mb_substr( $name, 2, 1 );
?>
                    <li>
                        <span>
                            <?=$rank ?>
                        </span>
                        <span>
                            <?=$name ?>
                        </span>
                        <span>
                            <?=$id ?>
                        </span>
                        <span>
                            <?=$point ?>
                        </span>
                    </li>
 <?php
                    $rank++;
                }//end of while
            } //end of else

           
?>

        </ul>
    </div>
</div>

<div id='main_content'>

    <!-- 최근 게시글 5개 display -->
    <div id='latest'>
        <h4>자유게시판</h4>
        <ul>
            <!-- 최근 게시 글 DB에서 불러오기 -->
        <?php
            //board 테이블에서 num 내림차순 정렬 상위 5개 레코드 출력
            $sql = 'select * from free order by num desc limit 5';
            $result = mysqli_query( $con, $sql );

            if ( !$result )
                echo '<li><span>아직 게시글이 없습니다!</span></li>';
            else {
                // result set 에서 첫번째 포인트 레코드 $row 연관배열 저장
                while ( $row = mysqli_fetch_array( $result ) ) {
                    $regist_day = substr( $row['regist_day'], 0, 10 );
        ?>
                    <li>
                        <span>
                            <?=$row['subject'] ?>
                        </span>
                        <span>
                            <?=$row['name'] ?>
                        </span>
                        <span>
                            <?=$regist_day ?>
                        </span>
                    </li>
        <?php
                }//end of while
            }//end of else
        ?>
        </ul>
    </div>

    <!-- 최근 상위포인트 랭킹 5개 출력 -->
    <div id='point_rank'>
        <h4>이미지 게시판 랭킹(HIT)</h4>
        <ul>
        
<?php
            $rank = 1;
            $sql = 'select * from image_board order by hit desc limit 5';
            $result = mysqli_query( $con, $sql );

            if ( !$result )
                echo '<li>아직 등록된 이미지 게시판 내용이 없습니다!</li>';
            else {
                while ( $row = mysqli_fetch_array( $result ) ) {
                    $name = $row['name'];
                    $id = $row['id'];
                    $point = $row['hit'];
                    $name = mb_substr( $name, 0, 1 ) . ' * ' . mb_substr( $name, 2, 1 );
?>
                    <li>
                        <span>
                            <?=$rank ?>
                        </span>
                        <span>
                            <?=$name ?>
                        </span>
                        <span>
                            <?=$id ?>
                        </span>
                        <span>
                            <?=$point ?>
                        </span>
                    </li>
 <?php
                    $rank++;
                }//end of while
            } //end of else

            mysqli_close( $con );
?>

        </ul>
    </div>
</div>