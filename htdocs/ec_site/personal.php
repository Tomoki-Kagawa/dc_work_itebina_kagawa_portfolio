<?php
/*
*住所設定ページ
*/
// 一時バッファー
ob_start();
// Sessionスタート
session_start();
// Constファイル読み込み
require_once '../../include/config/const.php';
// Modelファイル読み込み
require_once '../../include/model/personal_model.php';
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
//表のボタンを押した時
personalBtn($db);
//表の処理
$select_data=personalProcess($db);
// Viewファイル読み込み
include_once '../../include/view/personal_view.php';
// バッファー終了
ob_end_flush();