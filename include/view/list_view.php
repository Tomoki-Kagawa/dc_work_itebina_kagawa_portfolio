<!--
list_view.php
-->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>EC Site:商品一覧</title>
    <link rel="stylesheet" href="../ec_site/assets/style.css">
  </head>
  <body>
  <?php
  // ヘッダー表示
  headerDisplay($db);
  // ページタイトル表示
  pageTitleDisplay();
  // エラー表示
  errorDisplay();
  // 商品リスト表示
  listDisplay($select_data);
  // カートへ移動ボタン表示
  transitionButton($db);
  ?> 
  </body>
</html>