<?php 
  session_start();
  require_once('./conn.php');
  require_once("utils.php");

  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)){
      header('Location: login.php?errCode=1');
      die($conn->error);
  }

  $stmt = $conn->prepare("select * from RickyLee_Users where username = ? ");
  $stmt->bind_param('s',$username);
  $result = $stmt->execute();

  if (!$result) {
    die($conn->error); 
  }
  $result = $stmt->get_result();

  if($result->num_rows === 0) { //如果抓不到使用者資料
    header("Location:login.php?errCode=2");
    exit();
  }
  
  $row = $result->fetch_assoc(); //有使用者資料的話，用 fetch_assoc 方式抓出
  if (password_verify($password, $row['password'])) {
    $_SESSION['username'] = $username;
    header("Location: index.php");
  } else { 
    header("Location: login.php?errCode=2");
  }
 

?>
