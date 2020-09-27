<?php 
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }
  
  if (empty($_GET['id']))
  {
      header('Location: index.php');
      die('資料不齊全');
  }
  
  $id = $_GET['id'];

  $sql = "update RickyLee_messageboard set isDeleted=1 where id=? and username=? ";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('is',$id,$username);
  $result = $stmt->execute();

  if ($result) {
    header('Location: ./index.php');
  } else {
    echo "failed" . $conn->error;
  }
?>