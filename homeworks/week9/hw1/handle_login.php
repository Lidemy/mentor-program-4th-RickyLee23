<?php 
  require_once('./conn.php');
  require_once('./utils.php');
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)){
      header('Location: login.php?errCode=1');
      die($conn->error);
  }

  $sql = sprintf("select * from RickyLee_messageboardusers where username = '%s' and
   password = '%s'",
   $username,
   $password
  );
  $result = $conn->query($sql);

  if (!$result) {
    die($conn->error);
  }
  if ($result->num_rows) {
    $token = generateToken();
    $sql = sprintf("
      insert into RickyLee_tokens(token,username) values('%s','%s')",$token,$username);
      $result = $conn->query($sql);
    $expire = time() + 3600 * 24 *30;
    setcookie("token", $token, $expire);
    header("Location: index.php");
  } else {
    header("Location:login.php?errCode=2");
  }
?>
