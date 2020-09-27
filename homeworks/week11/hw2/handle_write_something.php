<?php 
  session_start();
  require_once('./conn.php');
  require_once("utils.php");

  $username = NULL;
  if (!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }

  if (!$username) {
    die('Error');
  }
  $category_id = $_POST['category_id'];
  $title = $_POST['title'];
  $content = $_POST['content'];

  if (empty($_POST['category_id']) || empty($_POST['title']) || empty($_POST['content']) )
  {
      header('Location: write_something.php?errCode=1');
      die('資料不齊全');
  }

  $stmt = $conn->prepare("INSERT INTO RickyLee_Articles (category_id,title,content) VALUES(?,?,?)");
  $stmt->bind_param('iss',$category_id,$title,$content);
  $result = $stmt->execute();
  
  if ($result) {
    $result = $stmt->get_result();
    header('Location: ./index.php');
  } else {
    echo "failed" . $conn->error;
  }
?>