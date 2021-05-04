<!-- 모든 페이지에서의 세션값을 헤더.php에서 정해주고 있음 로그인했을 때 정해주고 로그아웃 하면 없애줌 -->
<!-- 로그인할 때 세션값을 부여 -->
<!-- 로그아웃 할 때 세션값을 삭제 -->
<!-- 모든 페이지에서 세션값을 확인하고 가져오겠다. 세션값이 없으면 문자열'' 저장하겠다. -->
<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";
    if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
    else $userpoint = "";
?>

<nav class="navbar">

        <!-- 네비게이션 로고 -->
        <div class="navbar_logo">
            <i class="fab fa-itunes-note"></i>
            <a href="http://<?=$_SERVER['HTTP_HOST'];?>/jhytest/20210420/index.php" id="jin">Jin's Academy</a>
        </div>

       <!-- 네비게이션 메뉴 -->
       <ul class="navbar_menu">
            <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/jhytest/20210420/index.php">MAIN</a></li>
            <!-- rv 는 리시브로 넘어간다 -->
            <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/jhytest/20210420/memo/message_box.php?mode=rv">MESSAGE_BOX</a></li>
            <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/jhytest/20210420/board/board_list.php">BOARD</a></li>
            <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/jhytest/20210420/image_board/board_list.php">IMAGE</a></li>
            <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/jhytest/20210420/notice/notice_list.php">NOTICE</a></li>
            <li><a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/jhytest/20210420/free/list.php">Q&A</a></li>
        </ul>

        <ul id="navbar_menu2">
        <?php
            if(!$userid) {
                ?>
                <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/jhytest/20210420/member/member_form.php">Sign up</a> </li>
                <li> | </li>
                <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/jhytest/20210420/login/login_form.php">Login</a></li>
                <?php
            } else {
                $logged = $username."(".$userid.")님[Level:".$userlevel.", Point:".$userpoint."]";
                ?>
                <li><?=$logged?> </li>
                <li> | </li>
                <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/jhytest/20210420/login/logout.php">Logout</a> </li>
                <li> | </li>
                <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/jhytest/20210420/member/member_modify_form.php">MyPage</a></li>
	            <li> | </li>
	            <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/jhytest/20210420/member/member_delete_form.php">Withdrawal</a></li>
                <?php
            }
        ?>
         <?php
            if($userlevel==1) {
                ?>
                <li> | </li>
                <li><a href="http://<?=$_SERVER['HTTP_HOST'];?>/jhytest/20210420/admin/admin.php">ADMIN</a></li>
                <?php
            }
        ?>
        </ul>    
</nav>
