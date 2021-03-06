<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>レシピの一覧</title>
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body class="bg-light">
  <div class="container w-75">
  <h1 class="text-center text-info my-4">レシピの一覧</h1>
  <a href="form.html">レシピの新規登録</a>
</div>

<?php
// $user = "suzuki";
$user = "b2fbdeebe3f7ad";
// $pass = "wakusei0921";
$pass = "d01235c7";
// require_once '\xampp\db_config.php';
// require_once '.:\xampp\prod.php';

try{
$dbh = new PDO('mysql:host=us-cdbr-east-04.cleardb.com;dbname=heroku_c9b3d3edba4158f;charset=utf8mb4', $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "SELECT * FROM recipes";
$stmt = $dbh->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<table>\n";
echo "<tr>\n";
echo "<th>料理名</th><th>予算</th><th>難易度</th>\n";
echo "</tr>\n";
foreach($result as $row){
  echo "<tr>\n";
  echo "<td>" .htmlspecialchars($row['recipe_name'],ENT_QUOTES,'UTF-8') ."</td>\n";
  echo "<td>" .htmlspecialchars($row['budget'],ENT_QUOTES,'UTF-8') ."</td>\n";
  echo "<td>" .htmlspecialchars($row['difficulty'],ENT_QUOTES,'UTF-8') ."</td>\n";
  echo "<td>\n";
  echo "<a href=detail.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . ">詳細</a>\n";
  echo "|<a href=edit.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . ">変更</a>\n";
  echo "|<a href=delete.php?id=" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . ">削除</a>\n";
  echo "</td>\n";
  echo "</tr>\n";
}
echo "</table>\n";
$dbh = null;
} catch(Exception $e) {
  echo "エラー発生： " . htmlspecialchars($e->getMessage(),
  ENT_QUOTES, 'UTF-8') . "<br>";
  die();
}
?>
</body>
</html>
