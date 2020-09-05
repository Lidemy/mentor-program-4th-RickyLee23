<!DOCTYPE html>
<html>

 <head>
   <meta charset="utf-8">
   <title>留言板</title>
   <link rel='stylesheet' href="style.css">
 </head>
 <body>
   <div class = 'message__board'>
    <div class = 'nav'>注意！本站為練習用網站，因教學用途而刻意忽略資安的操作，註冊時請勿使用任何真實的帳號或密碼</div>
    <div class = 'comment__container'>
     <div class = "board__service">
     <a class = "board__btn" href = './index.php'>回到留言板</a>
     <a class = "board__btn" href = './login.php'>登入</a>
     </div>
     <div class = 'comment__edit'>
       <div class = 'title'>註冊帳號</div>
       <?php 
       if (!empty($_GET['errCode'])){
         $code = $_GET['errCode'];
         $msg = 'Error';
         if ($code === '1') {
           $msg = '錯誤：資料不齊全';
           echo '<h2 class = "error">' . $msg . '</h2>';
         }
         if ($code === '2') {
          $msg = '錯誤：帳號已被註冊';
          echo '<h2 class = "error">' . $msg . '</h2>';
        }
       }
       ?>
       <form method = "POST" action = "./handle_register.php">
         <div>
         <label for = "nickname__input">暱稱：</label>
         <input class = "input__column" type = "text" id = "nickname__input" name = "nickname"/>   
         </div>
         <div>
         <label for = "username__input">帳號：</label>
         <input class = "input__column" type = "text" id = "username__input" name = "username"/>   
         </div>
         <div>
         <label for = "passsword__input">密碼：</label>
         <input class = "input__column" type = "password" id = "password__input" name = "password"/>   
         </div>
         <input class = "submit__btn" type = "submit" value = "送出申請">
       </form>
       <div class = "board__hr"></div>

       
     
     </div>

     
    </div>
   </div>
   
 </body>

</html>