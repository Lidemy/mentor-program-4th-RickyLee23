<?php 
  session_start();
  session_destroy();
  require_once('./conn.php');
  header('location: '.$_SERVER['HTTP_REFERER']); //登出之後留在當前頁面

?>
