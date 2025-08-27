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
require_once '../../include/model/logout_model.php';
// Viewファイル読み込み
include_once '../../include/view/logout_view.php';
//共通ファイル読み込み
require_once '../../include/utility/common.php';
//databaseファイル読み込み
require_once '../../include/utility/database.php';
//Sessionファイル読み込み
require_once '../../include/utility/cookie_session.php';
// データベース接続
$db=dbConnection($db_dsn,$db_login_user,$db_password);
// ヘッダー表示
headerDisplay($db);
// エラー表示
errorDisplay();
// ログアウト表示
logoutDisplay();
// バッファー終了
ob_end_flush();
