<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }

  $category_id = $_GET['category_id'];

  $stmt = $conn->prepare("SELECT A.id AS Aid ,
  A.title AS title ,A.content AS content ,
   A.created_at AS created_at ,
    C.name AS name FROM RickyLee_Articles AS A LEFT JOIN RickyLee_Categories AS C on A.category_id = C.id
     WHERE C.id = ? order by A.id DESC");
  $stmt->bind_param('i',$category_id);
  $result = $stmt->execute();
  
  if(!$result){
    die('Error:'.$conn->error);
  }
  $result = $stmt->get_result();
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
  
  <section class="article__showup">
    <?php 
    while ($row = $result->fetch_assoc()){
    ?>
    <div class="article">
            <div class="article__pic"></div>
            <div class="article__detail">
              <div class="article__category__mark"><?php echo escape($row['name']) ?></div>
              <div class="article__created_at"><?php echo escape($row['created_at']) ?></div>
              <div class="article__title"><h1><?php echo escape($row['title']) ?><h1></div>
              <div class="article__content"><?php echo escape($row['content']) ?></div>
              <div class="readmore"><a href="article_view.php?article_id=<?php echo escape($row['Aid']) ?>">read more ...</a></div>
            </div>
    </div>
    <?php } ?>
    <div class="article hidden">
    </div>
    
  </section>
  <footer>
  <div class = 'footer__lower'>
                        Copyright © 2020 RickyLee All Rights Reserved. 
                </div>
  </footer>
</div>


</body>

</html>