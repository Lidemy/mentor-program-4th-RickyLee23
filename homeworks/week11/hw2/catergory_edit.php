<?php
  session_start();
  require_once('./conn.php');
  require_once("utils.php");

  $username = NULL;
  if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }
  
  $id = $_GET['id'];

  $stmt = $conn->prepare("SELECT * FROM RickyLee_Categories WHERE id = ?");
  $stmt->bind_param('i',$id);
  $result = $stmt->execute();

  if(!$result) {
    die('Error:'.$conn->error);
  }

  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container">
  <nav class="nav">
    <span class="nav__function">
      <div class="nav__title">Ricky's Blog</div>
      <?php if (!$username) { ?>
      <span class="login" ><a href=./login.php>登入</a></span>
      <span class="category" ><a href=./index.php>回到首頁</a></span>
      <span class="category" ><a href=./categories.php>文章分類</a></span>
      <span class="articles"><a href=./articles.php>文章列表</a></span>
      <?php } else { ?>
      <span class="login" ><a href=./logout.php>登出</a></span>
      <span class="category" ><a href=./index.php>回到首頁</a></span>
      <span class="category" ><a href=./categories.php>文章分類</a></span>
      <span class="articles"><a href=./articles.php>文章列表</a></span>
      <span class="write__something"><a href=./write_something.php>想寫些什麼？</a></span>
      <span class="admin__article"><a href=./admin_article.php>文章管理</a></span>
      <span class="admin__category"><a href=./admin_category.php>類別管理</a></span>
      <?php } ?>
    </span>
    
  </nav>
  
  <?php if ($username) { ?>
    <div class="write__something__column">
    <form class="write__something__form" method = 'POST' action= './handle_category_edit.php'>
        <div>類別名稱：<textarea class="write__something__content" name='name' row='5'><?php echo escape($row['name'])?></textarea></div>
        <input type='hidden' name="id" value="<?php echo escape($row['id']) ?>" />
      
        <div><input class="submit__btn" type = 'submit' value = '送出'/></div>
    </form>
    </div>
  <?php } else { ?>
    <div class="error__message">
        <span>請先登入會員^.^</span>
      </div>
    <?php } ?>
  <footer>
  <div class = 'footer__lower'>
                        Copyright © 2020 RickyLee All Rights Reserved. 
                </div>
  </footer>
</div>


</body>

</html>