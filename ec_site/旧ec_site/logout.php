<?php
/*
*ログアウトページ 
*/
//一時バッファー
ob_start();
//Sessionスタート
session_start();
// Constファイル読み込み
require_once '../../include/config/const.php';
// Modelファイル読み込み
require_once '../../include/model/model.php';
// Viewファイル読み込み
include_once '../../include/view/view.php';
$db=dbConnection($db_dsn,$db_login_user,$db_password);
headerDisplay($db);
errorDisplay();
logoutDisplay();
ob_end_flush();