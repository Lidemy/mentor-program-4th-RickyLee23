<?php
  require_once("conn.php");
  require_once("utils.php");
  
  $username = NULL;
  if (!empty($_COOKIE['token'])) {
    $user = getUserFromToken($_COOKIE['token']);
    $username = $user['username'];
    $nickname = $user['nickname'];
  }
  $result = $conn->query("select * from RickyLee_messageboard order by id desc");
  if (!$result) {
    die('Error:' . $conn->error);
  }
  ?>
  
<!DOCTYPE html>
<html>
 <head>
   <meta charset="utf-8">
   <title>留言板</title>
   <link rel = 'stylesheet' href="style.css">
 </head>
 <body>
   <div class = 'message__board'>
    <div class = 'nav'>注意！本站為練習用網站，因教學用途而刻意忽略資安的操作，註冊時請勿使用任何真實的帳號或密碼</div>
    <div class = 'comment__container'>
     <div class = "board__service">
    <?php if (!$username) { ?>
     <a class = "board__btn" href = './register.php'>註冊</a>
     <a class = "board__btn" href = './login.php'>登入</a>
    <?php } else { ?>
     <a class = "board__btn" href = './logout.php'>登出</a>
    <?php } ?>
    </div>
     <div class = 'comment__edit'>
       <div class = 'title'>Comments</div>
       <?php if($username){ ?>
         <div class= 'title'>你好！！ <?php echo $nickname ?></div>
       <?php } ?>

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
       <?php if ($username) { ?>
       <form method = "POST" action = "./handle_add.php">
         <div> 
         <textarea type = "text" rows = "5" placeholder = "請輸入你的留言" name = "comment"></textarea>
        </div>
         <input class = "submit__btn" type = "submit" value = "送出">
       </form>
       <div class = "board__hr"></div>
       <?php } else { ?>
        <h3 class = "reminder">請登入後再發布留言＾＾</h3>
       <?php } ?>
       
     
     </div>

     <?php 
     while ($row = $result->fetch_assoc()) { 
     ?>
     <div class = "message__review">
        <div class = "photo"></div>
        <div class = "message__info">
          <span class = "nickname"><? echo $row['nickname']; ?></span>
          <span class = "time"><? echo $row['created_at']; ?></span>
          <div class = "message"><? echo $row['comment']; ?>
          </div>
        </div>
     </div>
     <?php } ?>
    </div>
   </div>
   
 </body>

</html>