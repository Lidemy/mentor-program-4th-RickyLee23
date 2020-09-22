<?php
  session_start();
  require_once("conn.php");
  require_once("utils.php");

  $username = NULL;
  if(!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }

  $stmt = $conn->prepare('select * from RickyLee_Categories order by id desc');
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
  <?php if ($username) { ?>
  <section class="admin__wrapper">
          <div class="admin__view">
              <form class="category__admin__add" method="POST" action="handle_category_add.php">
                <input type="text" class="category__add" name="category_name" placeholder="輸入欲新增的類別" />
                <input type="submit" class="category__add__btn" value="新增"/>
              </form>
            <?php while($row = $result->fetch_assoc())  { ?>
            <div class="admin__view__each">
              <span class="admin__article__title"><?php echo escape($row['name']) ?></span>
              <span class="admin__function">
                <span class="admin__edit"><a href="./catergory_edit.php?id=<?php echo escape($row['id']) ?>">編輯</a></span>
                <span class="admin__delete"><a href="./handle_category_delete.php?id=<?php echo escape($row['id']) ?>">刪除</a></span>
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