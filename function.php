<?php
function dbConnect(){
  $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
  $db['heroku_c9b3d3edba4158f'] = ltrim($db['path'], '/');
  $dsn = "mysql:host={$db['us-cdbr-east-04.cleardb.com']};dbname={$db['heroku_c9b3d3edba4158f']};charset=utf8";
  $user = $db['b2fbdeebe3f7ad'];
  $password = $db['d01235c7'];
  $options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
  );
  $dbh = new PDO($dsn,$user,$password,$options);
  return $dbh;
}

?>
