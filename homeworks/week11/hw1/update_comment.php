<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");
  $id = $_GET['id'];
  
  $username = NULL;
  if (!empty($_SESSION['username'])){
    $user = getUserFromUsername($_SESSION['username']);
    $username = $_SESSION['username'];
  }
  
  $stmt = $conn->prepare(
    'select * from RickyLee_messageboard where id =?'
    );
  $stmt->bind_param("i",$id);

  $result = $stmt->execute();

  if (!$result) {
    die('Error:' . $conn->error);
  } 
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  ?>
  

<!DOCTYPE html>
<html>

 <head>
  
   <meta charset="utf-8">
   <title>編輯留言</title>
   <link rel ='stylesheet' href='style.css'>
 </head>
 <body>
   <div class = 'message__board'>
    <div class = 'nav'>注意！本站為練習用網站，因教學用途而刻意忽略資安的操作，註冊時請勿使用任何真實的帳號或密碼</div>
    <div class = 'comment__container'>
     <div class = 'comment__edit'>
     <?php 
       if (!empty($_GET['errCode'])){
         $code = $_GET['errCode'];
         $msg = 'Error';
         if ($code === '1') {
           $msg = '資料不齊全';
           echo '<h2 class = "error">' . $msg . '</h2>';
         }
       }
       ?>
       <div class = 'title'>編輯留言</div>
       
       <?php if ($username) { ?>
       <form method = "POST" action = "./handle_update_comment.php">
         <div> 
         <textarea type = "text" rows = "5" name = "comment" ><?php echo $row['comment'] ?></textarea>
        </div>
         <input type = "hidden" name = "id" value ="<?php echo $row['id'] ?>"/>
         <input class = "submit__btn" type = "submit" value = "送出">
       </form>
       <div class = "board__hr"></div>
       <?php } ?>
      </div>
      </div>
    </div>
   </div>
   
 </body>

</html>
