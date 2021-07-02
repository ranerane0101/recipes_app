<?php
//$user = "suzuki";
//$pass = "wakusei0921";
//require_once '\xampp\db_config.php';
require_once '.\..\xampp\prod.php';
try{
  if(empty($_GET['id'])) throw new Exception('ID不正');
  $id = (int) $_GET['id'];
  $dbh = new PDO('mysql:host=us-cdbr-east-04.cleardb.com;dbname=heroku_c9b3d3edba4158f;charset=utf8',
  $user,$pass);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "DELETE FROM recipes WHERE id = ?";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(1, $id, PDO::PARAM_INT);
  $stmt->execute();
  $dbh = null;
  echo "ID: " . htmlspecialchars($id, ENT_QUOTES,'UTF-8') . "の削除が完了しました。<br>";
  echo "<a href='index.php'>トップページへ戻る</a>";
}catch (Exception $e) {
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}








 ?>
