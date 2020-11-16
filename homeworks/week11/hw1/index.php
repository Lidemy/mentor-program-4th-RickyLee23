<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");
  $username = NULL;
  $user = NULL;
  if (!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
    $user = getUserFromUsername($username);
  }

  $page = 1;
  if (!empty($_GET['page'])) {
    $page = $_GET['page'];
  }
  $items_per_page = 5;
  $offset = ($page - 1) * $items_per_page;

  $stmt = $conn->prepare(
    'select '.
      'M.id as id, M.comment as comment, '.
      'M.created_at as created_at, U.nickname as nickname,U.role as role, U.username as username '.
    'from RickyLee_messageboard as M '.
    'left join RickyLee_messageboardUsers as U on M.username = U.username '.
    'where M.isDeleted IS NULL '.
    'order by M.id desc '.
    'limit ? offset ?'
    );
    $stmt->bind_param('ii', $items_per_page, $offset);
    $result = $stmt->execute();

  if (!$result) {
    die('Error:' . $conn->error);
  } 
  $result = $stmt->get_result();
  ?>
  

<!DOCTYPE html>
<html>

 <head>
  
   <meta charset="utf-8">
   <title>留言板</title>
   <link rel='stylesheet' href='style.css'>
 </head>
 <body>
   <div class='message__board'>
    <div class='nav'>注意！本站為練習用網站，因教學用途而刻意忽略資安的操作，註冊時請勿使用任何真實的帳號或密碼</div>
    <div class='comment__container'>
     <div class="board__service">
    <?php if (!$username) { //若非登入狀態，只可以註冊跟登入 ?>
     <a class="board__btn" href = './register.php'>註冊</a>
     <a class="board__btn" href = './login.php'>登入</a>
    <?php } else { //有登入後，再判定權限 ?>
      <?php if ($user['role'] === 2) { //管理者狀態：role = 2 ?>
     <a class="board__btn" href = './logout.php'>登出</a>
     <a class="board__btn edit__nickname" >編輯暱稱</a>
     <a class="board__btn admin__role" href='./admin_role.php'>進入權限管理</a>
      <?php } if ($user['role'] === 1 || $user['role'] === 0) { //停權狀態：role = 0 ,一般使用者：role = 1 ?>
     <a class ="board__btn" href = './logout.php'>登出</a>
     <a class ="board__btn edit__nickname" >編輯暱稱</a>
      <?php } ?>
     <form class = 'hide nickname__reset  edit__nickname__submit' method = 'POST' action = "./handle_edit.php">
         <textarea type = "text" rows = "2" placeholder = "請輸入你的新暱稱" name = "nickname"></textarea>
         <input class = 'submit__btn' type = 'submit' value='送出' ></input>
     </form> 
    <?php } ?>
    </div>
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
       <div class = 'title'>Comments</div>
       <?php if($username){ ?>
         <div class = 'title'>你好！！ <?php echo $user['nickname'] ?> ( <?php echo selectRole($user['role']) ?> )</div>
       <?php } ?>

       <?php if ($username) { 
          if ($user['role'] === 1 || $user['role'] === 2) { ?>
            <form method = "POST" action = "./handle_add.php">
               <div><textarea type = "text" rows = "5" placeholder = "請輸入你的留言" name = "comment"></textarea></div>
            <input class = "submit__btn" type = "submit" value = "送出">
          <?php } else { ?>
            <h3 class = "reminder">你已被停權摟＾＾</h3>
          <?php } ?>
         </form>
         <div class = "board__hr"></div>
       <?php } else { ?>
        <h3 class = "reminder">請登入後再發布留言＾＾</h3>
       <?php } ?> 
    </div>

     <?php 
     while ($row = $result->fetch_assoc()) { //導入留言 
     ?>
    <div class = "message__review">
       <div class = "message__admin">
          <div class = "photo"></div>
          <div class = "message__info">
            <span class = "nickname"><?php echo escape($row['nickname']); ?></span>
            <span class = "username">(@<?php echo escape($row['username']); ?>)</span>
            <span class = "time"><?php echo escape($row['created_at']); ?></span>
            <div class = "message"><?php echo escape($row['comment']); ?></div>
          </div>
       </div>
       <div class = "message__function">
      <?php if ($username && $user['role'] === 2) { //如果是管理者，可以編輯每一則留言 ?>
          <a href = "update_comment.php?id=<?php echo escape($row['id']) ?>"><img src="./edit.png" class = "message__edit" ></a>
          <a href = "handle_delete_comment.php?id=<?php echo escape($row['id']) ?>"><img src="./delete.png" class = "message__delete" ></a>
      <?php } else {    
          if ($row['username'] === $username) { //如果不是管理者，只可以編輯自己的留言 ?>
          <a href = "update_comment.php?id=<?php echo escape($row['id']) ?>"><img src="./edit.png" class = "message__edit" ></a>
          <a href = "handle_delete_comment.php?id=<?php echo escape($row['id']) ?>"><img src="./delete.png" class = "message__delete" ></a>
        <?php } 
      } ?>
       </div>
    </div>
     <?php } ?>
     <div class = "board__hr"></div>
     <?php 
      $stmt = $conn->prepare(
        'select count(id) as count from RickyLee_messageboard where isDeleted IS NULL'
      );
      $result = $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();
      $count = $row['count'];
      $total_page = ceil($count / $items_per_page);
      
      ?>
      <div class = "page__info">
       <span>總共有 <?php echo $count ?> 筆資料</span>
       <span>， 你在第 <?php echo $page?> / <?php echo $total_page ?>頁</span>
       <div class = "paginator">
       <?php if ($page != 1){ ?>
       <a href="index.php?page=1">首頁</a>
       <a href="index.php?page=<?php echo $page - 1 ?>">上一頁</a>
       <?php } ?>
       <?php if ($page < $total_page) { ?>
       <a href="index.php?page=<?php echo $page + 1 ?>">下一頁</a>
       <a href="index.php?page=<?php echo $total_page ?>">最末頁</a>
       <?php } ?>
    </div>
      </div>
     
   </div>
   <script>
  <?php if ($username) {?>
   let editNickname = document.querySelector('.edit__nickname')
   editNickname.addEventListener('click',function(){
     let remove = document.querySelector('.edit__nickname__submit')
     remove.classList.toggle('hide')
   })
  <?php } ?>
   </script>
 </body>

</html>
