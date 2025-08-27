<?php
/*
* 商品登録ページ
*/
// 一時バッファー
ob_start();
// Sessionスタート
session_start();
// Constファイル読み込み
require_once '../../include/config/const.php';
// Modelファイル読み込み
require_once '../../include/model/management_model.php';
// Viewファイル読み込み
include_once '../../include/view/management_view.php';
// 共通ファイル読み込み
require_once '../../include/utility/common.php';
// databaseファイル読み込み
require_once '../../include/utility/database.php';
// Sessionファイル読み込み
require_once '../../include/utility/cookie_session.php';
// データベース接続
$db=dbConnection($db_dsn,$db_login_user,$db_password);
// 管理者
managerConfirmation($db);
// セッション管理
sessionManagement();
// ヘッダー表示
headerDisplay($db);
// タイトル表示
pageTitleDisplay();
// エラー表示
errorDisplay();
// 登録フォーム表示
formManagementDisplay($db);
// 登録済み表示
managemenList($db);
//　Script.読み込み
?><script src="./assets/script.js"></script>
<?php
// バッファー終了
ob_end_flush();
?>