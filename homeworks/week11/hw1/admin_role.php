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

  $stmt = $conn->prepare(
    "SELECT U.id AS id, 
    U.username AS username ,
    U.nickname AS nickname ,
    R.role_id AS role_id ,
    R.role_name AS role_name from RickyLee_messageboardUsers AS U 
    LEFT JOIN RickyLee_messageboardRoles AS R on U.role = R.role_id ORDER BY U.id desc");
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
   <link rel ='stylesheet' href='style.css'>
 </head>
 <body>
  <div class = 'message__board'>
    <div class = 'nav'>注意！本站為練習用網站，因教學用途而刻意忽略資安的操作，註冊時請勿使用任何真實的帳號或密碼</div>
    <div class = 'comment__container'>
     <div class = "board__service">
     <a class = "board__btn" href = './index.php'>回到留言板</a>
     <a class = "board__btn" href = './logout.php'>登出</a>
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
       <div class = 'title'>權限管理！</div>
       <?php if($username){ ?>
       <div class = 'title'>你好！！ <?php echo $user['nickname'] ?> ( <?php echo selectRole($user['role']) ?> )</div>
       <?php } ?>

      <?php if ($username && $user['role'] === 2) { ?> 
        <div class='admin__role__management'>
          <div class='admin__role__column'>
            
              <div class="admin__role__title">
                <span class="admin__role__item">user-id</span>
                <span class="admin__role__item">username</span>
                <span class="admin__role__item">nickname</span>
                <span class="admin__role__item">authority</span>
                <div class = "board__hr"></div>
              </div>
              <?php while($row = $result->fetch_assoc()) { ?>
              <div>
                <form method="POST" class="admin__role__form" action="handle_admin_role.php">
                <span class="admin__role__item"><?php echo escape($row['id']); ?></span>
                <span class="admin__role__item"><?php echo escape($row['username']); ?></span>
                <span class="admin__role__item"><?php echo escape($row['nickname']); ?></span>
                <select class="admin__role__item" name="role_id" value="<?php echo escape($row['role_id']); ?>">
               <?php
                  $stmt = $conn->prepare('select * from RickyLee_messageboardRoles');
                  $result_role = $stmt->execute();
                  $result_role = $stmt->get_result();
                  while($role = $result_role->fetch_assoc()) {
                  $id = $role['role_id'];
                  $name = $role['role_name'];
                  $is_selected = $row['role_id'] === $id ? "selected":"";
                  echo "<option value='$id' $is_selected>$name</option>";
                } ?>
                </select>
                <input type='hidden' name="id" value="<?php echo escape($row['id']); ?>" />
                <input class="submit__btn" type="submit">
                <div class = "board__hr"></div>
                </form>
              </div>
              
              
            <?php } ?>
            
              
            
        </div>
      <?php } else { ?>
        <h3 class = "reminder">請登入管理員帳號＾＾</h3>
      <?php } ?>
    </div>
     <div class = "board__hr"></div>
  </div>
   
 </body>

</html>
