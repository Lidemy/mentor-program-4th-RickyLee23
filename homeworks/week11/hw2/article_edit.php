<?php
  session_start();
  require_once('conn.php');
  require_once("utils.php");


  $username = NULL;
  if (!empty($_SESSION['username'])){
    $username = $_SESSION['username'];
  }

  if(!empty($_GET['id'])){
    $id = $_GET['id'];
  } else {
    header('Location: admin_article.php?errCode=1');
    die('ERROR');
  }

  $stmt_1 = $conn->prepare("SELECT * FROM RickyLee_Articles WHERE id = ? ");
  $stmt_1->bind_param('i', $id);
  $result = $stmt_1->execute();
  $result = $stmt_1->get_result();
  $row = $result->fetch_assoc();

  $stmt_2 = $conn->prepare("SELECT * FROM RickyLee_Categories ORDER BY created_at DESC");
  $result_category = $stmt_2->execute();
  $result_category =$stmt_2->get_result();

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
    <form class="write__something__form" method = 'POST' action= 'handle_article_edit.php'>
        分類：<select class="category__select" name="category_id">
        <?php
          while($row_category = $result_category->fetch_assoc()){
            $id = $row_category["id"];
            $name = $row_category["name"];
            $is_selected = $row['category_id'] === $id ? "selected":"";
            echo "<option value='$id' $is_selected>$name</option>";
          }
          ?>
        </select>
        <div>標題：<textarea class="write__something__title" name='title' row='5'><?php echo escape($row['title']) ?></textarea></div>
        <div>寫些什麼：<textarea class="write__something__content" name='content' row='5'><?php echo escape($row['content']) ?></textarea></div>
        <input type='hidden' name="id" value="<?php echo escape($row['id']) ?>" />
      
        <div><input class="submit__btn" type = 'submit' value = '送出'/></div>
    </form>
    </div>

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