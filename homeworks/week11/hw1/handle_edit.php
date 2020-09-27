<?php 
  session_start();
  require_once('conn.php');
  require_once('utils.php');

  if (!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }
  if (empty($_POST['nickname']))
  {
      header('Location: index.php?errCode=1');
      die('資料不齊全');
  }
  
  $nickname = $_POST['nickname'];
  $sql = "update RickyLee_messageboardUsers set nickname =? where username=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss',$nickname,$username);
  $result = $stmt->execute();

  if ($result) {
    header('Location: ./index.php');
  } else {
    echo "failed" . $conn->error;
  }
?>