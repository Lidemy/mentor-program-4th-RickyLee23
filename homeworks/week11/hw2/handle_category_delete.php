<?php 
  session_start();
  require_once('conn.php');
  require_once("utils.php");

  $username = NULL;
  if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }
  
  if (!$username) {
    die('Error');
  }
  $id = $_GET['id'];
  if (empty($_GET['id']) )
  {
      header('Location: admin_category.php?errCode=1');
      die('資料不齊全');
  }

  $stmt = $conn->prepare("DELETE FROM RickyLee_Categories WHERE id = ? ");
  $stmt->bind_param('i',$id);
  $result = $stmt->execute();

  if (!$result) {
    die('Error');
  } else {
    $result = $stmt->get_result();
    header('Location: ./admin_category.php');
  }
?>