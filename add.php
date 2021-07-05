<?php
//$user = "suzuki";
$user = "b2fbdeebe3f7ad";
//$pass = "wakusei0921";
$pass = "d01235c7";
// require_once '.:\xampp\prod.php';
//require_once '\xampp\db_config.php';
$recipe_name = $_POST['recipe_name'];
$howto = $_POST['howto'];
$category = (int) $_POST['category'];
$difficulty = (int) $_POST['difficulty'];
$budget = (int) $_POST['budget'];
try{
  $dbh = new PDO('mysql:host=us-cdbr-east-04.cleardb.com;dbname=heroku_c9b3d3edba4158f;charset=utf8mb4',
  $user,$pass);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO recipes(recipe_name,category,difficulty,budget,howto) VALUES (?, ?, ?, ?, ?)";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(1, $recipe_name, PDO::PARAM_STR);
  $stmt->bindValue(2, $category, PDO::PARAM_INT);
  $stmt->bindValue(3, $difficulty, PDO::PARAM_INT);
  $stmt->bindValue(4, $budget, PDO::PARAM_INT);
  $stmt->bindValue(5, $howto, PDO::PARAM_STR);
  $stmt->execute();
  $dbh = null;
  echo "レシピの登録が完了しました。<br>";
  echo "<a href='index.php'>トップページへ戻る</a>";
} catch (Exception $e) {
    echo "エラー発生：" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
}


 ?>
