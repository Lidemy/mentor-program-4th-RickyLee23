<?php 
  session_start();
  require_once('conn.php');
  require_once("utils.php");
  $category_name = $_POST['category_name'];

  $username = NULL;
  if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }

  if (empty($_POST['category_name'] ))
  {
      header('Location: admin_category.php?errCode=1');
      die('資料不齊全');
  }

  if(!$username) {
    die('ERROR');
  }
  
  $stmt = $conn->prepare("INSERT INTO RickyLee_Categories ( name ) VALUES ( ? )");
  $stmt->bind_param('s',$category_name);
  $result = $stmt->execute();
  

  if (!$result) {
    die('ERROR');
  } else {
    $result = $stmt->get_result();
    header('Location: ./admin_category.php');
  }
  
?>