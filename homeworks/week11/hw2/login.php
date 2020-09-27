<?php
  session_start();
  $username = NULL;
  if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }

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
  <?php if (!$username) { ?>
    <section class="login__column">
      <form method="POST"  class="login__insert" action = "./handle_login.php">
        <div>Username：
          <input class = "input__column" type = "text" name = "username"/>
        </div>
        <div>Password：
          <input class = "input__column" type = "password" name = "password"/>
        </div>
          <input class = "submit__btn" type = "submit" value = "登入">
        </form>
  <?php } else { ?>
    <div class="error__message">
        <span>你已登入會員^.^</span>
    </div>
  <?php } ?>
    </section>

  <footer>
  <div class = 'footer__lower'>
                        Copyright © 2020 RickyLee All Rights Reserved. 
                </div>
  </footer>
</div>


</body>

</html>