<?php 
  require_once('./conn.php');
  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($nickname) || empty($username) || empty($password)){
      header('Location: register.php?errCode=1');
      die($conn->error);
  }

  $sql = "INSERT INTO RickyLee_messageboardusers (nickname ,username ,password) VALUES('$nickname','$username','$password')";
  $result = $conn->query($sql);

  if ($result) {
    header('Location: ./login.php');
  } else {
    $code = $conn->errno;
    if ($code === 1062) {
      header('Location: register.php?errCode=2');
    }
    die($conn->error);
    }
  
?>