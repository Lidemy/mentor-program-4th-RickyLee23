<?php 
  session_start();
  require_once('conn.php');
  require_once('utils.php');
  $username = NULL;
  if (!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }
  if(!$username && ($_POST['role_id'] !==2 ) ){
    die('無權限使用');
  }

  if (!isset($_POST['role_id']) || empty($_POST['id'])) //這邊把 role_id 的判斷改用isset,因為發現用empty 會把0判斷成空值
  {
      die('資料不齊全');
  }
  
  $role_id = $_POST['role_id'];
  $id = $_POST['id'];

  $stmt = $conn->prepare("update RickyLee_messageboardUsers set role = ? where id =?");
  $stmt->bind_param('ii',$role_id,$id);
  $result = $stmt->execute();

  if ($result) {
    header('Location: ./admin_role.php'); 
  } else {
    echo "failed" . $conn->error; 
  } 
?>