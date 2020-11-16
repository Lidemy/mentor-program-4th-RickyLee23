<?php 
  session_start();
  require_once('conn.php');
  require_once("utils.php");
  $id = $_GET['id'];

  $username = NULL;
  if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  } else {
    die ('errorrrrr');
  }

  if (!$username) {
    die('Error');
  }
  if (empty($_GET['id']) ) {
      header('Location: admin_article.php?errCode=1');
      die('資料不齊全');
  }

  $stmt = $conn->prepare("DELETE FROM RickyLee_Articles WHERE id = ? ");
  $stmt->bind_param('i',$id);
  $result = $stmt->execute();
  

  if (!$result) {
      die('error!');
  } else {
    $result = $stmt->get_result();
    header('Location: ./admin_article.php');
  }
  
?>