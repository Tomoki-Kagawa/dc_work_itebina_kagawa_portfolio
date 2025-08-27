<?php
/*
* 商品登録ページ
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
sessionManagement();
$db=dbConnection($db_dsn,$db_login_user,$db_password);
headerDisplay($db);
pageTitleDisplay();
errorDisplay();
formManagementDisplay($db);
managemenList($db);
ob_end_flush();