<?php 
  require_once('./conn.php');
  $nickname = $_POST['nickname'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

  if (empty($nickname) || empty($username) || empty($password)){
      header('Location: register.php?errCode=1');
      die($conn->error);
  }

  $sql = "INSERT INTO RickyLee_messageboardUsers (nickname ,username ,password) VALUES(?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $nickname , $username, $password);
  $result = $stmt->execute();

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