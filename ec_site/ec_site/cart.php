<?php
/*
*カートページ
*/
//一時バッファー
ob_start();
// Sessionスタート
session_start();
// Constファイル読み込み
require_once '../../include/config/const.php';
// Modelファイル読み込み
require_once '../../include/model/cart_model.php';
// Viewファイル読み込み
include_once '../../include/view/cart_view.php';
// 共通ファイル読み込み
require_once '../../include/utility/common.php';
// databaseファイル読み込み
require_once '../../include/utility/database.php';
// Sessionファイル読み込み
require_once '../../include/utility/cookie_session.php';
// セッション管理
sessionManagement();
// データベース接続
$db=dbConnection($db_dsn,$db_login_user,$db_password);
// ヘッダー表示
headerDisplay($db);
// タイトル表示
pageTitleDisplay();
// エラー表示
errorDisplay();
// 商品リスト表示
listDisplay($db);
// 小計表示
totalDisplay($db);
// 購入ボタン表示
transitionButton($db);
// バッファー終了
ob_end_flush();