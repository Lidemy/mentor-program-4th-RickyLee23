<?php 
  session_start();
  require_once('conn.php');
  require_once("utils.php");

  $username = NULL;
  if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }

  $id = $_POST['id'];
  $name = $_POST['name'];

  if (empty($_POST['id']) || empty($_POST['name']))
  {
      header('Location: category_edit.php?errCode=1');
      die('資料不齊全');
  }
  if (!$username) {
    die('Error');
  } 

  $stmt = $conn->prepare("UPDATE RickyLee_Categories SET name = ? WHERE id = ? ");
  $stmt->bind_param('si',$name,$id);
  $result = $stmt->execute();

  if (!$result) {
    die('Error');
  } else {
    $result = $stmt->get_result();
    header('Location: ./admin_category.php');
  }

?>