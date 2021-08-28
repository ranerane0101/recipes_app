<?php
// $user = "suzuki";
$user = "b2fbdeebe3f7ad";
// $pass = "wakusei0921";
$pass = "d01235c7";
//require_once '\xampp\db_config.php';
// require_once '.\..\xampp\prod.php';
try{
  if(!isset($_GET['id']))throw new Exception('ID無し');
  if(!preg_match('/\A[0-9]{1,4}+\z/',$_GET['id'])) throw new Exception('ID不正');
  $id = (int) $_GET['id'];
  if(($id < 1) || ($id) > 1000) throw new Exception('ID範囲外');
  $dbh = new PDO('mysql:host=us-cdbr-east-04.cleardb.com;dbname=heroku_c9b3d3edba4158f;charset=utf8mb4',$user,$pass);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM recipes WHERE id = ?";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(1, $id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  echo "料理名：" . htmlspecialchars($result['recipe_name'],ENT_QUOTES,'UTF-8') . "<br>\n";
  echo "カテゴリ：" . htmlspecialchars($result['category'],ENT_QUOTES,'UTF-8') . "<br>\n";
  echo "予算：" . htmlspecialchars($result['budget'],ENT_QUOTES,'UTF-8') . "<br>\n";
  echo "難易度：" . htmlspecialchars($result['difficulty'],ENT_QUOTES,'UTF-8') . "<br>\n";
  echo "作り方：<br>" . nl2br(htmlspecialchars($result['howto'],ENT_QUOTES,'UTF-8')) . "<br>\n";
  echo "<a href='index.php'>トップページへ戻る</a>";
  $dbh =null;
} catch(Exception $e) {
  echo "エラー発生： " . htmlspecialchars($e->getMessage(),
  ENT_QUOTES, 'UTF-8') . "<br>";
  die();
}
