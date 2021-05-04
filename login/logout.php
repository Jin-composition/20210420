<?php
  session_start();
  // 세션값을 없애버리는거
  unset($_SESSION["userid"]);
  unset($_SESSION["username"]);
  unset($_SESSION["userlevel"]);
  unset($_SESSION["userpoint"]);
  
  echo("
       <script>
          location.href = 'http://{$_SERVER['HTTP_HOST']}/jhytest/20210420/index.php';
         </script>
       ");
?>
