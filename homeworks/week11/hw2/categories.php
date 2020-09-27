<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }

  $stmt = $conn->prepare("select * from RickyLee_Categories order by id desc");
  $result = $stmt->execute();
  $result = $stmt->get_result();

  if(!$result){
    die('Error:'.$conn->error);
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
  
  
  <section class="categories">
  <?php while ($row = $result->fetch_assoc()) { ?>
    <div class="category__info">
      <span class="category__name"><a href="category_list.php?category_id=<?php echo escape($row['id']) ?>"><?php echo escape($row['name']) ?></span>
    </div>
  <?php } ?>
  </section>
    </div>
    <footer>
  <div class = 'footer__lower'>
                        Copyright © 2020 RickyLee All Rights Reserved. 
  </div>
  </footer>


</body>

</html>