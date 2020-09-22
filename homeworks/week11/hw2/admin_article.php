<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  if (!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }
  
  $stmt = $conn->prepare('SELECT C.name AS Cname ,
  A.title AS title , A.created_at AS created_at,
  A.id AS id FROM RickyLee_Articles AS A LEFT JOIN RickyLee_Categories 
  AS C on A.category_id = C.id
  order by A.created_at DESC');
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
  
  <?php if($username){ ?>
  <section class="admin__wrapper">
          <div class="admin__view">
            <div class="admin__view__each">
              <span class="admin__article__category">類別</span>
              <span class="admin__article__title">標題</span>
              <span class="admin__created__at">我是建立時間</span>
              <span class="admin__function">
                <span class="admin__add"><a href="./write_something.php">新增文章</a></span>
              </span>
            </div>
            <?php while($row = $result->fetch_assoc())  { ?>
            <div class="admin__view__each">
              <span class="admin__article__category"><?php echo escape($row['Cname']) ?></span>
              <span class="admin__article__title"><?php echo escape($row['title']) ?></span>
              <span class="admin__created__at"><?php echo escape($row['created_at']) ?></span>
              <span class="admin__function">
                <span class="admin__edit"><a href="./article_edit.php?id=<?php echo escape($row['id']) ?>">編輯</a></span>
                <span class="admin__delete"><a href="./handle_article_delete.php?id=<?php echo escape($row['id']) ?>">刪除</a></span>
              </span>
            </div>
            <?php } ?>
          </div>
  </section>
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