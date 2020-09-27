<?php 
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['comment']))
  {
      header('Location: update_comment.php?errCode=1&id='.$_POST['id']);
      die('資料不齊全');
  }
  
  $username = $_SESSION['username'];
  $id = $_POST['id'];
  $comment = $_POST['comment'];

  $sql = "update RickyLee_messageboard set comment =? where id=? and username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sii',$comment,$id,$username);
  $result = $stmt->execute();

  if ($result) {
    header('Location: ./index.php');
  } else {
    echo "failed" . $conn->error;
  }
?>