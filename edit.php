<?php
// $user = "suzuki";
$user = "b2fbdeebe3f7ad";
// $pass = "wakusei0921";
$pass = "d01235c7";
//require_once '\xampp\db_config.php';
// require_once '.\..\xampp\prod.php';
try{
  if (!isset($_GET['id'])) throw new Exception('ID無し');
  if(!preg_match('/\A[0-9]{1,4}+\z/',$_GET['id'])) throw new Exception('ID不正');
  $id = (int) $_GET['id'];
  if(($id < 1) || ($id) >1000) throw new Exception('ID範囲外');
  $dbh = new PDO('mysql:host=us-cdbr-east-04.cleardb.com;dbname=heroku_c9b3d3edba4158f;charset=utf8mb4', $user, $pass);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT * FROM recipes WHERE id = ?";
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(1, $id, PDO::PARAM_INT);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $dbh = null;
} catch (Exception $e) {
  echo "エラー発生： " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
  die();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>入力フォーム</title>
</head>
<body>
  レシピの登録<br>
  <form method="post" action="update.php">
    料理名：<input type="text" name="recipe_name" value="<?php echo htmlspecialchars($result['recipe_name'], ENT_QUOTES, 'UTF-8'); ?>"><br>
    カテゴリ：
    <select name="category">
      <option value="">選択してください</option>
      <option value="1" <?php if ($result['category'] === 1)
      echo "selected" ?>>和食</option>
      <option value="2" <?php if ($result['category'] === 2)
      echo "selected" ?>>中華</option>
      <option value="3" <?php if ($result['category'] === 3)
      echo "selected" ?>>洋食</option>
    </selected>
    <br>
    難易度：
    <input type="radio" name="difficulty" value="1" <?php if($result['difficulty'] === 1) echo "checked" ?>>簡単
    <input type="radio" name="difficulty" value="2" <?php if($result['difficulty'] === 2) echo "checked" ?>>普通
    <input type="radio" name="difficulty" value="3" <?php if($result['difficulty'] === 3) echo "checked" ?>>難しい
    <br>
    予算：<input type="number" name="budget" value="<?php echo htmlspecialchars($result['budget'], ENT_QUOTES, 'UTF-8'); ?>">円
    <br>
    作り方：
     <textarea name="howto" cols="40" rows="4" maxlength="150"><?php echo htmlspecialchars($result['howto'], ENT_QUOTES, 'UTF-8'); ?></textarea>
     <br>
     <input type="hidden" name="id" value="<?php echo htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8'); ?>">
     <input type="submit" value="送信">
   </form>
 </body>
 </html>
