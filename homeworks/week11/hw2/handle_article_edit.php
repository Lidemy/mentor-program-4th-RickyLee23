<?php
  session_start();
  require_once('conn.php');
  require_once("utils.php");

  $username = NULL;
  if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }
  
  $category_id = $_POST['category_id'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  $id = $_POST['id'];

  $stmt = $conn->prepare("UPDATE RickyLee_Articles SET category_id = ?,title = ?,content = ? WHERE id = ?");
  $stmt->bind_param('issi',$category_id,$title,$content,$id);
  $result = $stmt->execute();

  if (empty($_POST['category_id']) || empty($_POST['title']) || empty($_POST['content']) )
      {
      header('Location: article_edit.php?errCode=1');
      die('資料不齊全');
      }
  
  if (!$username) {
      die('請先登入');
  } else {
      if (!$result) {
        die('ERROR');
      } else {
        $result = $stmt->get_result();
        header('Location: ./admin_article.php');
      }
  }
?>
