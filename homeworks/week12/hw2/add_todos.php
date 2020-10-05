<?php
  require_once('conn.php');
  header('Content-type:application/json;charset=utf-8');//回覆的檔案是 json 格式
  if (
    empty($_POST['todo'])
  ) {
    $json = array(
      "ok" => false,
      "message" => "Please input missing fields"
    );

    $response = json_encode($json);
    echo $response;
    die();
  }

  $todo = $_POST['todo'];

  $sql = "INSERT INTO todolist (todo) values (?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s',$todo);
  $result = $stmt->execute();

  if (!$result) {
    $json = array(
      "ok" => false,
      "message" => $conn->error
    );
    $response = json_encode($json);
    echo $response;
    die();
  }

    $json = array(
      "ok" => true,
      "message" => "success",
      "id" => $conn->insert_id,
    );
    $response = json_encode($json);
    echo $response;  

  ?>