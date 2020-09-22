<?php 
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }
  
  if (empty($_POST['comment']))
  {
      header('Location: index.php?errCode=1');
      die('資料不齊全');
  }
  
  $comment = $_POST['comment'];

  $sql = "INSERT INTO RickyLee_messageboard (username ,comment) VALUES(?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss',$username,$comment);
  $result = $stmt->execute();

  if ($result) {
    header('Location: ./index.php');
  } else {
    echo "failed" . $conn->error;
  }
?>