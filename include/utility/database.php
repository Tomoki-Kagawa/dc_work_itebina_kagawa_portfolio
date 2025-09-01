<?php
/*
*ec_site
*https://portfolio02.dc-itex.com/ebina/0003/ec_site/list.php
*ID:user
*pass:W2uUi3Tv 
*/
/*
*myphpadmin
*https://phpmyadmin-sv360.xbiz.ne.jp/
*ID:xb513874_ek608
*pass:5z6i9869r6
*/
/*
* データベース接続を行う
*/
function dbConnection($db_dsn,$db_login_user,$db_password) {
  try{
    // PDOインスタンスの生成
    $db = new PDO($db_dsn,$db_login_user,$db_password);
  } catch (PDOException $e) {
    $_SESSION['error_log']=$e->getMessage();
    exit();
  }
  return $db;
}
