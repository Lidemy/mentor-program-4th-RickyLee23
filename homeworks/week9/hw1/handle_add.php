<?php 
  require_once('conn.php');
  require_once('utils.php');

  if (empty($_POST['comment']))
  {
      header('Location: index.php?errCode=1');
      die('資料不齊全');
  }

  $user = getUserFromToken($_COOKIE['token']);
  $nickname = $user['nickname'];
  $comment = $_POST['comment'];

  $sql = "INSERT INTO RickyLee_messageboard (nickname ,comment) VALUES('$nickname','$comment')";
  $result = $conn->query($sql);

  if ($result) {
    header('Location: ./index.php');
  } else {
    echo "failed" . $conn->error;
  }
?>