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

/*
*ログイン確認 
*/
function loginManegement(){ 
  // ログイン中のユーザーであるかを確認する
  if (isset($_SESSION['user_name'])&&isset($_SESSION['password'])&&$_SESSION['user_name']!==""&&$_SESSION['password']!=="") {
    // ログイン中である場合は、list.phpにリダイレクト（転送）する
    header('Location: ./list.php');
    exit();
  }
}
/*
* cookie管理
*/
function cookieManagement(){
  //cookieに値がある場合、変数に格納する
    if (!empty($_COOKIE['cookie_confirmation'])&&!empty($_COOKIE['user_name'])&&!empty($_COOKIE['password'])) {
      $cookie_confirmation = "checked";
      $user_name= $_COOKIE['user_name'];
      $password= $_COOKIE['password'];
    } 
    else{
      $cookie_confirmation = "";
      $user_name= "";
      $password= "";
    }
    $cookie=[$user_name,$password,$cookie_confirmation];
    return $cookie;
  }
/* 
*セッション設定
*/
function sessionSet($user_id,$user_name,$password){  
  if(!empty($user_id)&&!empty($user_name)&&!empty($password)){ 
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] =  $user_name;
    $_SESSION['password'] =  $password;
  }
  else{
    sessionDelete();
  }
}
/*
*セッション削除 
*/
function sessionDelete(){
  $_SESSION=[];
  session_unset();
  session_destroy();
  session_start();
}
/*
*cookie設定 
*/
function CookieSet($user_name,$password,$cookie_confirmation){
  //Cookieの保存期間
  define('EXPIRATION_PERIOD', 30);
  $cookie_expiration = time() + EXPIRATION_PERIOD * 60*60*24;
  // ユーザー名の保存チェックがされている場合はCookieを保存
  if (isset($user_name)&&isset($password)&&$cookie_confirmation==="checked") {
    setcookie('cookie_confirmation', $cookie_confirmation, $cookie_expiration, "/");
    setcookie('user_name', $user_name, $cookie_expiration, "/");
    setcookie('password', $password, $cookie_expiration, "/");
  } 
}
/*
* cookieの削除
*/
function cookieDelete(){
  // チェックされていない場合はCookieを削除する
    setcookie('cookie_confirmation', '', time() - 3600, "/");
    setcookie('user_name', '', time() - 3600, "/");
    setcookie('password', '', time() - 3600, "/");
}

/*
* セッション管理
*/
function sessionManagement(){        
    // ログイン中のユーザーであるかを確認する
    if (empty($_SESSION['user_name'])||empty($_SESSION['password'])) {
      // ログイン中ではない場合は、ログアウトする。
      $_SESSION["error_log"]="セッションエラーが発生しました<br>ログインし直してください";
      header('Location: ./logout.php');
      exit();
    } 
}
/*
* ログアウト時のセッション終了
*/
function sessionEnd(){
  // セッション名を取得する
  $session = session_name();
  // セッション変数を削除
  $_SESSION = [];
  // セッションID（ユーザ側のCookieに保存されている）を削除
  if (isset($_COOKIE[$session])) {
    // cookie削除
    setcookie($session, '', time() - 3600, '/');
  }
  session_destroy();
}


/*
* ヘッダーメニュー表示・ハンバーガーメニュー表示
*/
function headerDisplay($db){
  ?>
  <header>
  <div class="header">
    <div class="header-left"><h1 class="header-title">
      <?php
      //ログインページ/登録ページ/ログアウトページ以外だった場合
      if($_SERVER['REQUEST_URI']!='/ebina/0003/ec_site/logout.php'&&$_SERVER['REQUEST_URI']!='/ebina/0003/ec_site/index.php'&&$_SERVER['REQUEST_URI']!='/ebina/0003/ec_site/registration.php'){
        //ハンバーガーメニュー
        ?>
        <a href="./list.php">EC Site</a>
        <?php
      }
      else{
      ?>
        <a href="./index.php">EC Site</a>
      <?php
      }
      ?>
    </h1>
  </div>
  <?php
  //ログインページ/登録ページ/ログアウトページ以外だった場合
  if($_SERVER['REQUEST_URI']!='/ebina/0003/ec_site/logout.php'&&$_SERVER['REQUEST_URI']!='/ebina/0003/ec_site/index.php'&&$_SERVER['REQUEST_URI']!='/ebina/0003/ec_site/registration.php'){
    //ハンバーガーメニュー
    ?>
    <div class="header-right">
      <h1 class=user>ようこそ<?php echo $_SESSION["user_name"];?>さん<h1>
      <details>
        <summary><span><p>menu</p></span></summary>
        <ul>
          <?php
          //商品一覧ページ以外だった場合
          if($_SERVER['REQUEST_URI']!='/ebina/0003/ec_site/list.php'){
          ?>
            <li><a href="./list.php">商品一覧</a></li>
          <?php
          }
          
          $user_id=$_SESSION['user_id'];
          $table_name="ec_management";
          $data=['user_id'=>$user_id];
          $join="";
          $select_if=['user_id'=>$user_id];
          $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
          foreach($select_data as $row){
          $select_user_id=$row['user_id'];
          //$select_user_id=$select_data[0];  
          //$_SESSION['error_log']=$select_user_id;
          //$_SESSION['error_log']=$user_id;
            if($user_id==$select_user_id){
              //商品登録ページ以外だった場合
              if($_SERVER['REQUEST_URI']!='/ebina/0003/ec_site/management.php'){
              ?>
                <li><a href="./management.php">商品登録</a></li>
              <?php
              }
            }
          }
          //お気に入りページ以外だった場合
          if($_SERVER['REQUEST_URI']!='/ebina/0003/ec_site/favorite.php'){
          ?>
            <li><a href="./favorite.php">お気に入り</a></li>
          <?php
          }
          //購入履歴ページ以外だった場合
          if($_SERVER['REQUEST_URI']!='/ebina/0003/ec_site/history.php'){
          ?>
            <li><a href="./history.php">購入履歴</a></li>
          <?php
          }
          //カートページ以外だった場合
          if($_SERVER['REQUEST_URI']!='/ebina/0003/ec_site/cart.php'){
          ?>
            <li><a href="./cart.php">カート</a></li>
          <?php
          }
          //個人情報ページ以外だった場合
          if($_SERVER['REQUEST_URI']!='/ebina/0003/ec_site/personal.php'){
          ?>
            <li><a href="./personal.php">個人情報登録</a></li>
          <?php
          }
          ?>
            <li><a href="./logout.php">ログアウト</a></li>
          </ul>
          </details>
        </div>
      </div>
      <?php
    }
    ?>
  </header>
  <!--ヘッダーと重ならないように空間を作成-->
  <div class="header_empty">a</div>
  <?php
}


/*
* ログインページと登録ページの表示
*/
function loginDisplay($db){
  // 値の初期化
  $user_name="";
  $password=""; 
  $cookie_confirmation = "";

  if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST["login_btn"])&&!isset($_POST['cookie_confirmation'])){
      cookieDelete();
    }
    //user_namePOST  
    if(isset($_POST['user_name'])){
      $user_name = htmlspecialchars($_POST['user_name'], ENT_QUOTES, 'UTF-8');
    }
    //passwordPOST
    if(isset($_POST['password'])){
      $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
    }
    //cookie_confirmationPOST 
    if(isset($_POST['cookie_confirmation'])){
        $cookie_confirmation="checked";
    }
  }
  if($_SERVER['REQUEST_METHOD']!=='POST'&&$_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/index.php'){
    [$user_name,$password,$cookie_confirmation]=cookieManagement();
  }

  //ログインボタンが押された場合データサーバーにinsert
  if(isset($_POST["login_btn"])){
    if(empty($user_name)||empty($password)||$user_name==""||$password==""){
      $select_id="";
      cookieDelete();
      sessionDelete();
      $_SESSION["error_log"]="ユーザー名かパスワードが違います";
      ob_clean();
      header("Location: ./index.php");
      exit();
    }
    else{
      $table_name='ec_user';
      $date =date('Y-m-d H:i:s');
      $user_id="";
      $data=['user_id'=>$user_id,'user_name'=>$user_name,'password'=>$password];
      $join="";
      $select_if=['user_name'=>$user_name];
      $select_data=dbSelect($db,$table_name,$data,$join,$select_if);  
      if(!empty($select_data)){
        $select_id=$select_data[0]["user_id"];
        $select_name=$select_data[0]["user_name"];
        $select_password=$select_data[0]["password"];
        $password_check=password_verify($password,$select_password);
        //パスワードがあっているか
        if($user_name==$select_name&&$password_check==true){
          if($cookie_confirmation==="checked"){ 
            CookieSet($user_name,$password,$cookie_confirmation);
          }
          else{
            cookieDelete();
          }
          sessionSet($select_id,$user_name,$password);
          ob_clean();
          header("Location: ./list.php");
          exit();
        }
        else{
          $cookie_confirmation = "";
          $user_name="";
          $password="";
          cookieDelete();
          sessionDelete();
          $_SESSION["error_log"]="ユーザー名かパスワードが違います";
          ob_clean();
          header("Location: ./index.php");
          exit();
        }
      }
    }
  }
  //登録ボタンが押された場合データサーバーにinsert
  if(isset($_POST["registration_btn"])){
    $table_name='ec_user';
    $date =date('Y-m-d H:i:s');
    if(validationCheck($user_name,$password)){
      $password_hash=passwordHash($password);
      $data=['user_name'=>$user_name,'password'=>$password_hash,'create_date'=>$date,'update_date'=>$date];
      dbInsert($db,$table_name,$data);
      $_SESSION['error_log']="";
      $user_name="";
      $password="";
      $password_hash="";
      ob_clean();
      header("Location: ./index.php");
      exit();
    }
    else{
      $user_name="";
      $password="";
      $password_hash="";
      ob_clean();
      header("Location: ./registration.php");
      exit();
    }
  }
?>
<div class="centerdisplay">
  <?php
  //ログイン画面だった場合
  if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/index.php'){
    ?>
    <h1 class="section_title">ログイン</h1>
    <form method="post" enctype="multipart/form-data" class="form_flex"> 
    <?php 
    }
    //登録画面だった場合
  if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/registration.php'){
  ?>
    <h1 class="section_title">ユーザー登録</h1>
    <form method="post" enctype="multipart/form-data" class="form_flex">
    <?php
    }
    ?>
    <label for="user_name">ユーザー名<?php if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/registration.php'){echo "<br>5文字以上半角英数字アンダースコア(_)";}?></label><input type="text" id="user_name" name="user_name" value="<?php echo $user_name; ?>"><br>
    <label for="password">パスワード<?php if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/registration.php'){echo "<br>8文字以上半角英数字アンダースコア(_)";}?></label><input type="password" id="password" name="password" value="<?php echo $password; ?>"><br>
          
    <?php
    //ログイン画面だった場合
    if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/index.php'){
      ?>
      <div>
        <input type="checkbox" name="cookie_confirmation" id="cookie_confirmation" <?php echo $cookie_confirmation?>>
        <label for="cookie_confirmation">次回からログインIDの入力を省略する</label><br>
      </div>
      <input type="submit" name="login_btn" value="ログイン">
      <br>
      <a href="registration.php">新規登録ページへ</a>
      <?php
    }
    //登録画面だった場合
    if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/registration.php'){
      ?>
      <br>
      <input type="submit" name="registration_btn" value="登録">
      <br>
      <a href="index.php">ログインページへ</a>
      <?php
    }
    ?>
    </form>
  </div>
  <?php
}

/*
* ページのタイトル表示
*/
function pageTitleDisplay(){
  //商品一覧ページだった場合
  if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/list.php'){
    ?>
    <h1 class="pagetitle">商品一覧</h1>
    <?php
  }
  //商品登録ページだった場合
  else if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/management.php'){
    ?>
    <h1 class="pagetitle">商品登録</h1>
    <?php
  }
  //お気に入りページだった場合
  else if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/favorite.php'){
    ?>
    <h1 class="pagetitle">お気に入り</h1>
    <?php
  }
  //カートページだった場合
  if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/cart.php'){
    ?>
    <h1 class="pagetitle">カート</h1>
    <?php
  }
  //購入履歴ページだった場合
  if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/history.php'){
    ?>
    <h1 class="pagetitle">購入履歴</h1>
    <?php
  }
  //注文ページだった場合
  if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/order.php'){
    ?>
    <h1 class="pagetitle">購入完了</h1>
    <?php
  }
  //個人情報ページだった場合
  if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/personal.php'){
    ?>
    <h1 class="pagetitle">個人情報登録</h1>
    <?php
  }
  //商品詳細ページだった場合
  if(strpos($_SERVER['REQUEST_URI'],'/ebina/0003/ec_site/detail.php')===0){
    ?>
    <h1 class="pagetitle">商品詳細</h1>
    <?php
  }
}

/*
* 商品登録ページの表示
*/
function formManagementDisplay($db){
  if(isset($_POST['product_name'])){
    $product_name = htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8');
  }  
  if(isset($_POST['product_description'])){
    $product_description = htmlspecialchars($_POST['product_description'], ENT_QUOTES, 'UTF-8');
  }
  if(isset($_POST['price'])){
    $price = htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8');
  }
  if(isset($_POST['stock_qty'])){
    $stock_qty = htmlspecialchars($_POST['stock_qty'], ENT_QUOTES, 'UTF-8');
  }
  if(isset($_FILES['image']['name'])){
    $image = $_FILES['image']['name'];
    $image_save = './image/'.basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'],$image_save);
  }
  if(isset($_POST['public_flg'])){
    $public_flg=$_POST['public_flg'];
  }
  //登録ボタンが押された時
  if(isset($_POST["management_btn"])){
    if($product_name!=""&&$product_description!=""&&$price!=""&&$image!=""&&$stock_qty!=""){
      $table_name='ec_product';
      $date =date('Y-m-d H:i:s');
      $data=['product_name'=>$product_name,'product_description'=>$product_description,'price'=>$price,'public_flg'=>$public_flg,'create_date'=>$date,'update_date'=>$date];
      dbInsert($db,$table_name,$data);
      $product_id="";
      $data=["product_id"=>$product_id];
      $join="";
      $select_if=['product_name'=>$product_name];
      $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
      $select_id=$select_data[0]["product_id"];
      $table_name='ec_stock';
      $data=['product_id'=>$select_id,'stock_qty'=>$stock_qty,'create_date'=>$date,'update_date'=>$date];
      dbInsert($db,$table_name,$data);
      $table_name='ec_image';
      $data=['product_id'=>$select_id,'image_name'=>$image,'create_date'=>$date,'update_date'=>$date];
      dbInsert($db,$table_name,$data);
      $_SESSION["log"]=$product_name."を登録しました";
      ob_clean();
      header("Location: ./management.php");
      exit();
    }
    else{
      $_SESSION["log"]="登録できませんでした";
      ob_clean();
      header("Location: ./management.php");
      exit();
    }
  }
  ?>
  <div class="management_form">
    <h3>商品登録フォーム</h3>
    <form method="post" enctype="multipart/form-data" class="management_form">
       <div><label for="product_name" class="labelsize">商品名</label>：<input type="text" id="product_name" name="product_name"></div>
       <div><label for="count" class="labelsize">説明文</label>：<input type="text" id="product_description" name="product_description"></div>
       <div><label for="price" class="labelsize">価格(円)</label>：<input type="text" id="price" name="price"></div>
       <div><label for="count" class="labelsize">在庫数(個)</label>：<input type="text" id="stock_qty" name="stock_qty" ></div>
       <div><label for="image_file" class="labelsize">商品画像</label>：<input type="file" name="image" class="image" ></div>
       <div><label for="public_flg" class="labelsize">公開状態</label>：
       <label><input type="radio" name="public_flg" class="public_flg"  value="1" checked>公開にする</label>
       <label><input type="radio" name="public_flg" class="public_flg"  value="0">非公開にする</label>
      </div>  
      <input class="btn" name="management_btn" type="submit" value="登録">
    </form>
  </div>
  <?php
}



/*
*リスト表示
*/
function listDisplay($db){
  $count=0;
  $product_id="";
  $product_qty="";
  //user_namePOST  
  if(isset($_POST['product_id'])){
    $product_id = htmlspecialchars($_POST['product_id'], ENT_QUOTES, 'UTF-8');
  }
  //user_namePOST  
  if(isset($_POST['product_qty'])){
    $product_qty = htmlspecialchars($_POST['product_qty'], ENT_QUOTES, 'UTF-8');
  }
  if(isset($_POST['product_name'])){
    $product_name = htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8');
  }
  //カートに入れるボタンを押した時
  if(isset($_POST['cart_btn'])){
    $table_name='ec_cart';
    $user_id=$_SESSION["user_id"];
    $date =date('Y-m-d H:i:s');
    $delete_if=['product_id' => $product_id,'user_id' => $user_id];
    dbDelete($db,$table_name,$delete_if);
    $data=['user_id'=>$user_id,'product_id'=>$product_id,'product_qty'=>$product_qty,'create_date'=>$date,'update_date'=>$date];
    dbInsert($db,$table_name,$data);
    $_SESSION["log"]=$product_name."を".$product_qty."個カートに入れました";
    ob_clean();
    //お気に入りページだった場合
    if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/favorite.php'){
      header("Location: ./favorite.php");
      exit();
    }
    if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/history.php'){
      header("Location: ./history.php");
      exit();
    }
    else{
      header("Location: ./list.php");
      exit();
    }
  }
  //お気に入りに入れるボタンを押した時
  if(isset($_POST['favorite_btn'])){
    $table_name='ec_favorite';
    $user_id=$_SESSION["user_id"];
    $date =date('Y-m-d H:i:s');
    $data=['user_id'=>$user_id,'product_id'=>$product_id,'create_date'=>$date,'update_date'=>$date];
    dbInsert($db,$table_name,$data);
    $_SESSION["log"]= $product_name."をお気に入りに入れました";
    ob_clean();
    header("Location: ./list.php");
    exit();
  }
  //個数変更ボタンを押した時
  if(isset($_POST['change_btn'])){
    $table_name='ec_cart';
    $user_id=$_SESSION["user_id"];
    $date =date('Y-m-d H:i:s');
    $delete_if=['product_id' => $product_id,'user_id' => $user_id];
    dbDelete($db,$table_name,$delete_if);
    $data=['user_id'=>$user_id,'product_id'=>$product_id,'product_qty'=>$product_qty,'create_date'=>$date,'update_date'=>$date];
    dbInsert($db,$table_name,$data);
    $_SESSION["log"]=$product_name."を".$product_qty."個に変更しました";
    ob_clean();
    header("Location: ./cart.php");
    exit(); 
  }
  //削除ボタンを押した時
  if(isset($_POST['delete_btn'])){
    $table_name='ec_cart';
    $user_id=$_SESSION["user_id"];
    $date =date('Y-m-d H:i:s');
    $delete_if=['product_id' => $product_id,'user_id' => $user_id];
    dbDelete($db,$table_name,$delete_if);
    $_SESSION["log"]=$product_name."をカートから出しました";
    ob_clean();
    header("Location: ./cart.php");
    exit(); 
  }
  //お気に入り削除ボタンを押した時
  if(isset($_POST['favorite_delete_btn'])){
    $table_name='ec_favorite';
    $user_id=$_SESSION["user_id"];
    $date =date('Y-m-d H:i:s');
    $delete_if=['product_id' => $product_id,'user_id' => $user_id];
    dbDelete($db,$table_name,$delete_if);
    $_SESSION["log"]=$product_name."をお気に入りから削除しました";
    ob_clean();
    header("Location: ./favorite.php");
    exit(); 
  }

  ?>
  <div class="image_flex">
  <?php
    //商品一覧ページだった場合
    if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/list.php'){
      $table_name="ec_product";
      $product_id="";$product_name="";$product_description="";$price="";$public_flg="";$stock_qty="";$image_name="";
      $data=['ec_product.product_id'=>$product_id,'ec_product.product_name'=>$product_name,'ec_product.product_description'=>$product_description,'ec_product.price'=>$price,'ec_product.public_flg'=>$public_flg,'ec_stock.stock_qty'=>$stock_qty,'ec_image.image_name'=>$image_name ];
      $join=[['ec_stock','ec_product.product_id','ec_stock.product_id'],['ec_image','ec_product.product_id','ec_image.product_id']];
      $select_if="";
      $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
    }
    //カートページだった場合
    if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/cart.php'||$_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/order.php'){
      $user_id=$_SESSION['user_id'];
      $table_name="ec_product";
      $product_id="";$product_name="";$product_description="";$price="";$public_flg="";$stock_qty="";$image_name="";
      $data=['ec_product.product_id'=>$product_id,'ec_product.product_name'=>$product_name,'ec_product.product_description'=>$product_description,'ec_product.price'=>$price,'ec_product.public_flg'=>$public_flg,'ec_stock.stock_qty'=>$stock_qty,'ec_image.image_name'=>$image_name,'ec_cart.product_qty'=>$product_qty];
      $join=[['ec_stock','ec_product.product_id','ec_stock.product_id'],['ec_image','ec_product.product_id','ec_image.product_id'],['ec_cart','ec_product.product_id','ec_cart.product_id']];
      $select_if=['ec_cart.user_id'=>$user_id];
      $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
    }    
    //お気に入りページだった場合
    if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/favorite.php'){
      $user_id=$_SESSION['user_id'];
      $table_name="ec_product";
      $product_id="";$product_name="";$product_description="";$price="";$public_flg="";$stock_qty="";$image_name="";
      $data=['ec_product.product_id'=>$product_id,'ec_product.product_name'=>$product_name,'ec_product.product_description'=>$product_description,'ec_product.price'=>$price,'ec_product.public_flg'=>$public_flg,'ec_stock.stock_qty'=>$stock_qty,'ec_image.image_name'=>$image_name];
      $join=[['ec_stock','ec_product.product_id','ec_stock.product_id'],['ec_image','ec_product.product_id','ec_image.product_id'],['ec_favorite','ec_product.product_id','ec_favorite.product_id']];
      $select_if=['ec_favorite.user_id'=>$user_id];
      $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
    }
    //購入履歴ページだった場合
    if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/history.php'){
      $user_id=$_SESSION['user_id'];
      $table_name="ec_product";
      $product_id="";$product_name="";$product_description="";$price="";$public_flg="";$stock_qty="";$image_name="";
      $data=['ec_product.product_id'=>$product_id,'ec_product.product_name'=>$product_name,'ec_product.product_description'=>$product_description,'ec_product.price'=>$price,'ec_product.public_flg'=>$public_flg,'ec_stock.stock_qty'=>$stock_qty,'ec_image.image_name'=>$image_name];
      $join=[['ec_stock','ec_product.product_id','ec_stock.product_id'],['ec_image','ec_product.product_id','ec_image.product_id'],['ec_history','ec_product.product_id','ec_history.product_id']];
      $select_if=['ec_history.user_id'=>$user_id];
      $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
    }
    //注文ページだった場合
    if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/order.php'){
      $order_id=0;
      $table_name='ec_order';
      $data=['order_id'=>$order_id];
      $join="";
      $select_if=['user_id'=>$user_id];
      $order_data=dbSelect($db,$table_name,$data,$join,$select_if);
      foreach($order_data as $row) {
        $order_id=$row["order_id"];
      }
      $table_name="ec_product";
      $product_id="";$product_name="";$product_description="";$price="";$public_flg="";$stock_qty="";$image_name="";
      $data=['ec_product.product_id'=>$product_id,'ec_product.product_name'=>$product_name,'ec_product.product_description'=>$product_description,'ec_product.price'=>$price,'ec_product.public_flg'=>$public_flg,'ec_stock.stock_qty'=>$stock_qty,'ec_image.image_name'=>$image_name,'ec_order.product_qty'=>$product_qty];
      $join=[['ec_stock','ec_product.product_id','ec_stock.product_id'],['ec_image','ec_product.product_id','ec_image.product_id'],['ec_order','ec_product.product_id','ec_order.product_id']];
      $select_if=['ec_order.user_id'=>$user_id,'ec_order.order_id'=>$order_id];
      $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
    }    
        
        
    foreach($select_data as $row) {
      $product_id=$row["product_id"];
      $image_name=$row["image_name"];
      $product_name=$row["product_name"];
      $product_description=$row["product_description"];
      $price=$row["price"];
      $stock_qty=$row["stock_qty"];
      $public_flg=$row["public_flg"];
      $product_qty=$row["product_qty"];
                
      ?>     
      <div class="list">
        <?php  
        if($public_flg==1&&$stock_qty!=0){
          $count++;
            //商品一覧ページだった場合
            if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/list.php'){
            ?>
            <div class="name"><?php echo $product_name;?></div>
            <?php echo'<a href="./detail.php?product_id='.$product_id.'"><img src="' .'image/'.$image_name. '">'."</a><br>";?>
            <?php echo $price."(円)";?>
            <form method="post" enctype="multipart/form-data" class="form_flex">
              <input type="hidden" name="product_id" value="<?php echo $product_id?>">
              <input type="hidden" name="product_name" value="<?php echo $product_name?>">
              <input type="text" name="product_qty" class="product_qty" value="1"<?php echo $product_qty?>>
              <div><input type="submit" name="cart_btn" value="カートに入れる" class="btn_size">
              <input type="submit" name="favorite_btn" value="お気に入り登録" class="btn_size"></div>
            </form> 
            <?php
            }
            //カートページだった場合
            if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/cart.php'){
            ?>
            <div class="name"><?php echo $product_name;?></div>
            <?php echo'<a href="./detail.php?product_id='.$product_id.'"><img src="' .'image/'.$image_name. '">'."</a><br>";?>
            <?php echo $price."(円) ";?>
            <form method="post" enctype="multipart/form-data" class="form_flex">
              <input type="hidden" name="product_id" value="<?php echo $product_id?>">
              <input type="hidden" name="product_name" value="<?php echo $product_name?>">
              <input type="text" name="product_qty" class="product_qty" value="<?php echo $product_qty?>">
              <div><input type="submit" name="change_btn" value="個数を変更する" class="btn_size">
              <input type="submit" name="delete_btn" value="カートから出す" class="btn_size"></div>
            </form>
            <?php
            }
            //お気に入りページだった場合
            if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/favorite.php'){
            ?>
            <div class="name"><?php echo $product_name;?></div>
            <?php echo'<a href="./detail.php?product_id='.$product_id.'"><img src="' .'image/'.$image_name. '">'."</a><br>";?>
            <?php echo $price."(円) ";?>
            <form method="post" enctype="multipart/form-data" class="form_flex">
              <input type="hidden" name="product_id" value="<?php echo $product_id?>">
              <input type="hidden" name="product_name" value="<?php echo $product_name?>">
              <input type="text" name="product_qty" class="product_qty" value="1"<?php echo $product_qty?>>
              <div><input type="submit" name="cart_btn" value="カートに入れる" class="btn_size">
              <input type="submit" name="favorite_delete_btn" value="お気に入り削除" class="btn_size"></div>
            </form>
            <?php
            }
            //購入履歴ページだった場合
            if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/history.php'){
              ?>
              <div class="name"><?php echo $product_name;?></div>
              <?php echo'<a href="./detail.php?product_id='.$product_id.'"><img src="' .'image/'.$image_name. '">'."</a><br>";?>
              <?php echo $price."(円) ";?>
              <form method="post" enctype="multipart/form-data" class="form_flex">
                <input type="hidden" name="product_id" value="<?php echo $product_id?>">
                <input type="hidden" name="product_name" value="<?php echo $product_name?>">
                <input type="text" name="product_qty" class="product_qty" value="1"<?php echo $product_qty?>>
                <div><input type="submit" name="cart_btn" value="カートに入れる" class="btn_size"></div>
              </form>
            <?php
            }
            //購入ページだった場合
            if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/order.php'){
              ?>
              <div class="name"><?php echo $product_name;?></div>
              <?php echo'<img src="' .'image/'.$image_name. '">'."<br>";
              echo $price."(円) ";
              echo $product_qty."個";
            ?>
            <?php
            }
          ?>
          </div>
        <?php
        }
      }
    $remainder=$count%3;
    if($remainder==2){
      ?><div class="list_empty">a</div><?php
    }
    elseif($remainder){
      ?><div class="list_empty">a</div><?php
      ?><div class="list_empty">a</div><?php
    }
  ?>
  </div>            
  <?php
} 


/*
*購入ボタン
*/
function transitionButton($db){
  if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/list.php'||$_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/favorite.php'||$_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/history.php'){
    ?>
    <div class="purchase_form">
      <form action="cart.php" method="post" enctype="multipart/form-data">
        <?php
          echo '<input type="submit" value="カートへ移動" class="purchase_btn">';
        ?>
      </form>
    </div>
  <?php
  }
  if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/cart.php'){
    ?>
    <script>
    //購入確認のwindow表示
    function purchaseWindowDisplay(){
      var purchase=confirm("本当に購入しますか？");
      //OKを押した時に購入したことをwindowで知らせ、formのactionを実行する
      if(purchase==true){     
        <?php
        //メール用送信関数
        emailSend($db);
        $user_id=$_SESSION['user_id'];
        $order_id=0;
        $table_name='ec_order';
        $data=['order_id'=>$order_id];
        $join="";
        $select_if=['user_id'=>$user_id];
        $order_data=dbSelect($db,$table_name,$data,$join,$select_if);
        foreach($order_data as $row) {
          $order_id=$row["order_id"];
        }
        $order_id=(int)$order_id+1;
        $user_id=$_SESSION['user_id'];
        $table_name="ec_product";
        $product_id="";$product_name="";$product_description="";$price="";$public_flg="";$stock_qty="";$image_name="";$product_qty="";
        $data=['ec_product.product_id'=>$product_id,'ec_product.product_name'=>$product_name,'ec_product.product_description'=>$product_description,'ec_product.price'=>$price,'ec_product.public_flg'=>$public_flg,'ec_stock.stock_qty'=>$stock_qty,'ec_image.image_name'=>$image_name,'ec_cart.product_qty'=>$product_qty];
        $join=[['ec_stock','ec_product.product_id','ec_stock.product_id'],['ec_image','ec_product.product_id','ec_image.product_id'],['ec_cart','ec_product.product_id','ec_cart.product_id']];
        $select_if=['ec_cart.user_id'=>$user_id];
        $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
        foreach($select_data as $row) {
          $product_id=$row["product_id"];
          $image_name=$row["image_name"];
          $product_name=$row["product_name"];
          $product_description=$row["product_description"];
          $price=$row["price"];
          $stock_qty=$row["stock_qty"];
          $public_flg=$row["public_flg"];
          $product_qty=$row["product_qty"];
          
          $table_name='ec_history';
          $delete_if=['product_id' => $product_id,'user_id' => $user_id];
          dbDelete($db,$table_name,$delete_if);
          $date =date('Y-m-d H:i:s');
          $data=['user_id'=>$user_id,'product_id'=>$product_id,'create_date'=>$date,'update_date'=>$date];
          dbInsert($db,$table_name,$data);
          
          $table_name='ec_order';
          $date =date('Y-m-d H:i:s');
          $data=['order_id'=>$order_id,'user_id'=>$user_id,'product_id'=>$product_id,'product_qty'=>$product_qty,'create_date'=>$date,'update_date'=>$date];
          dbInsert($db,$table_name,$data);
          
          $table_name='ec_cart';
          $user_id=$_SESSION["user_id"];
          $date =date('Y-m-d H:i:s');
          $delete_if=['product_id' => $product_id,'user_id' => $user_id];
          dbDelete($db,$table_name,$delete_if);
          
          $stock_qty=$stock_qty-$product_qty;
          $table_name="ec_stock";
          $date =date('Y-m-d H:i:s');
          $data=['stock_qty'=>$stock_qty,'update_date'=>$date];
          $update_if=['product_id'=>$product_id];
          dbUpdate($db,$table_name,$data,$update_if);
        }        
      ?>   
      alert("購入しました");
      }
      else if(purchase==false){
        //キャンセルを押した時に購入しなかったことをwindowで知らせ、formのactionを実行しない
        event.preventDefault();
        alert("購入しませんでした");
      }
    }
    </script>
    <div class="purchase_form">
      <form action="./order.php" method="post" enctype="multipart/form-data" onsubmit="purchaseWindowDisplay()"> 
      <?php
        echo '<input type="submit" value="購入する" class="purchase_btn">';
      ?>
      </form>
    </div>
    <?php
  }
}

/*
* 登録済みのリスト
*/
function managemenList($db){
  if(isset($_POST['product_name'])){
    $product_name = htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8');
  }
  //公開状態変更ボタンを押した時  
  if(isset($_POST['public_flg_btn'])){
    $product_id = $_POST['product_id'];
    $public_flg = $_POST['public_flg'];
    $table_name="ec_product";
    $date =date('Y-m-d H:i:s');
    $data=['public_flg'=>$public_flg,'update_date'=>$date];
    $update_if=['product_id'=>$product_id];
    dbUpdate($db,$table_name,$data,$update_if);
    $_SESSION["log"]="公開状態を変更しました";
    ob_clean();
    header("Location: ./management.php");
    exit(); 
  }
  //削除ボタンを押した時
  if(isset($_POST['delete_btn'])){
    $product_id = $_POST['product_id'];
    $table_name="ec_image";
    $delete_if=['product_id' => $product_id];
    dbDelete($db,$table_name,$delete_if);
    $table_name="ec_stock";
    dbDelete($db,$table_name,$delete_if);
    $table_name="ec_product";
    dbDelete($db,$table_name,$delete_if);
    $_SESSION["log"]="削除しました";
    ob_clean();
    header("Location: ./management.php");
    exit();
  }
  //ストック変更ボタンを押した時
  if(isset($_POST['stock_change_btn'])){
    $product_id = $_POST['product_id'];
    $stock_qty = $_POST['stock_qty'];  
    $table_name="ec_stock";
    $date =date('Y-m-d H:i:s');
    $data=['stock_qty'=>$stock_qty,'update_date'=>$date];
    $update_if=['product_id'=>$product_id];
    dbUpdate($db,$table_name,$data,$update_if);
     $_SESSION["log"]=$product_name."を".$stock_qty."個に変更しました";
    ob_clean();
    header("Location: ./management.php");
    exit();
  }


  ?>
  <table>
    <tr>
      <th>商品番号</th>
      <th>商品画像</th>
      <th>商品名</th>
      <th>説明文</th>
      <th>価格(円)</th>
      <th>在庫数(個)</th>
      <th>公開状態</th>
      <th>削除</th>
    </tr>
    <?php
   
    
    $table_name="ec_product";
    $product_id="";$product_name="";$product_description="";$price="";$public_flg="";$stock_qty="";$image_name="";
    $data=['ec_product.product_id'=>$product_id,'ec_product.product_name'=>$product_name,'ec_product.product_description'=>$product_description,'ec_product.price'=>$price,'ec_product.public_flg'=>$public_flg,'ec_stock.stock_qty'=>$stock_qty,'ec_image.image_name'=>$image_name ];
    $join=[['ec_stock','ec_product.product_id','ec_stock.product_id'],['ec_image','ec_product.product_id','ec_image.product_id']];
    $select_if="";
    $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
    foreach($select_data as $row) {
      $product_id=$row["product_id"];
      $image_name=$row["image_name"];
      $product_name=$row["product_name"];
      $product_description=$row["product_description"];
      $price=$row["price"];
      $stock_qty=$row["stock_qty"];
      $public_flg=$row["public_flg"];
      if($public_flg==1&&$stock_qty!=0){?>
        <tr>
        <?php
      }
      else{?>
        <tr id=gray>
        <?php
      }
      ?>
      <form method="post">
        <td><input type="hidden" name="product_id" value="<?php echo $product_id;?>"><?php echo $product_id;?></td>
        <td><?php echo '<img src="' .'image/'.$image_name.'"class="td_image_display">';?></td>
        <td><input type="hidden" name="product_name" value="<?php echo $product_name;?>"><?php echo $product_name;?></td>
        <td class="product_description"><?php echo $product_description;?></td>
        <td><?php echo $price;?></td>
        <td><input type="text" name="stock_qty" class="stock_qty" value="<?php echo $stock_qty?>"><input type="submit" name="stock_change_btn" value="変更する"></td>
        <?php
        if($public_flg==1){?>
          <td>
          <input type="hidden" name="public_flg" value="0">
          <input type="submit" name="public_flg_btn" value="公開しない"></td>
          </td>
          <?php
        }
        else{?>
          <td>
          <input type="hidden" name="public_flg" value="1">
          <input type="submit" name="public_flg_btn" value="公開する"></td>
          </td>
          <?php 
        }?>
        <td><input type="submit" name="delete_btn" value="削除する"></td>
      </form>
    </tr>  
    <?php
    }
  ?>
  </table>
  <?php
}

/*
* 詳細ページの表示
*/
function detailDisplay($db){
  $product_id=$_GET['product_id'];
  if(isset($_POST['product_qty'])){
    $product_qty = htmlspecialchars($_POST['product_qty'], ENT_QUOTES, 'UTF-8');
  }
  //カートに入れるボタンを押した時
  if(isset($_POST['cart_btn'])){
    $product_name=$_POST['product_name'];
    $table_name='ec_cart';
    $user_id=$_SESSION["user_id"];
    $date =date('Y-m-d H:i:s');
    $delete_if=['product_id' => $product_id,'user_id' => $user_id];
    dbDelete($db,$table_name,$delete_if);
    $data=['user_id'=>$user_id,'product_id'=>$product_id,'product_qty'=>$product_qty,'create_date'=>$date,'update_date'=>$date];
    dbInsert($db,$table_name,$data);
    $_SESSION["log"]=$product_name."を".$product_qty."個カートに入れました";
    ob_clean();
    header("Location: ./detail.php?product_id=".$product_id);
    exit();
  }
  $table_name="ec_product";
  $product_name="";$product_description="";$price="";$public_flg="";$stock_qty="";$image_name="";
  $data=['ec_product.product_id'=>$product_id,'ec_product.product_name'=>$product_name,'ec_product.product_description'=>$product_description,'ec_product.price'=>$price,'ec_product.public_flg'=>$public_flg,'ec_stock.stock_qty'=>$stock_qty,'ec_image.image_name'=>$image_name ];
  $join=[['ec_stock','ec_product.product_id','ec_stock.product_id'],['ec_image','ec_product.product_id','ec_image.product_id']];
  $select_if=['ec_product.product_id'=>$product_id];
  $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
  foreach($select_data as $row) {
    $product_id=$row["product_id"];
    $image_name=$row["image_name"];
    $product_name=$row["product_name"];
    $product_description=$row["product_description"];
    $price=$row["price"];
    $stock_qty=$row["stock_qty"];
    $public_flg=$row["public_flg"];
    ?>
    <div class="detail_display">
      <div class="detail_content">
        <?php echo'<img src="' .'image/'.$image_name. '" class="image_display">'."<br>";?>
      </div>
      <div class="detail_content">
        <p>商品名：<?php echo $product_name;?></p>
        <p>説明文：<?php echo $product_description;?></p>
        <p>価格(円)：<?php echo $price;?></p>
        <form method="post" enctype="multipart/form-data" class="form_flex">
          <input type="hidden" name="product_name" value="<?php echo $product_name;?>">
          <p>個数(個)：<input type="text" name="product_qty" class="product_qty" value="1"<?php echo $product_qty?>>
          <input type="submit" name="cart_btn" value="カートに入れる">
        </form>
      </div>
    </div>
    <?php
  }
}
/*
*個人情報入力フォーム 
*/
function personalDisplay($db){
  $user_id="";$personal_name="";$tel="";$address="";$email_address="";
  
  $user_id=$_SESSION['user_id'];
  
  if(isset($_POST['personal_name'])){
    $personal_name = htmlspecialchars($_POST['personal_name'], ENT_QUOTES, 'UTF-8');
  }
  if(isset($_POST['tel'])){
    $tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8');
  }
  if(isset($_POST['email_address'])){
    $email_address = htmlspecialchars($_POST['email_address'], ENT_QUOTES, 'UTF-8');
  }  
  if(isset($_POST['address'])){
    $address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
  }

  if(isset($_POST['personal_btn'])){
    $table_name='ec_personal';
    $date =date('Y-m-d H:i:s');
    $user_id=$_SESSION['user_id'];
    $delete_if=['user_id' => $user_id];
    dbDelete($db,$table_name,$delete_if);
    $data=['user_id' => $user_id,'personal_name'=>$personal_name,'tel'=>$tel,'address'=>$address,'email_address'=>$email_address,'create_date'=>$date,'update_date'=>$date];
    dbInsert($db,$table_name,$data);
    $_SESSION["log"]="個人情報を更新しました";
    ob_clean();
    header("Location: ./personal.php");
    exit();
  }
  $table_name="ec_personal";
  $data=['personal_name'=>$personal_name,'tel'=>$tel,'address'=>$address,'email_address'=>$email_address];
  $join="";
  $select_if=['user_id'=>$user_id];
  $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
  foreach($select_data as $row){
    $personal_name=$row["personal_name"];
    $tel=$row["tel"];
    $address=$row["address"];
    $email_address=$row["email_address"];    
  }
  if(empty($personal_name)||empty($tel)&&empty($address)&&empty($email_address)){
    $personal_name="";$tel="";$address="";$email_address="";
  }
  ?>
  <div class="management_form">
    <h3>個人情報登録フォーム</h3>
    <form method="post" enctype="multipart/form-data" class="management_form">
      <div><label for="tel" class="labelsize">名前</label>：<input type="text" class="input_right" id="personal_name"  name="personal_name" value="<?php echo $personal_name; ?>"></div>
      <div><label for="tel" class="labelsize">電話番号</label>：<input type="text" class="input_right" id="tel" name="tel" value="<?php echo $tel; ?>"></div>
      <div><label for="email_address" class="labelsize">メールアドレス</label>：<input type="text" class="input_right" id="email_address" name="email_address" value="<?php echo $email_address; ?>"></div>
      <div><label for="address" class="labelsize">住所</label>：<input type="text" class="input_right" id="address" name="address" value="<?php echo $address; ?>"></div>
      <input class="btn" name="personal_btn" type="submit" value="登録">
   </form>
  </div>
  <?php
}


/*
*データベースの上書き
*/
function dbUpdate($db,$table_name,$data,$update_if){
  $column=array_keys($data);
  foreach($column as $key){
    $data_set[]=$key."= :".$key;
  }
  $if_key=array_keys($update_if);
  $if_value=array_values($update_if);
  $if_placeholder=':'.$if_key[0]; 
  $db_where=" WHERE ".$if_key[0]." = ".$if_placeholder;
  $update="UPDATE ".$table_name." SET ".implode(',',$data_set).$db_where;

  try{
    $stmt=$db->prepare($update);

    foreach($data as $key => $value){
      if(is_int($value)){
        $stmt->bindValue(':'.$key,$value,PDO::PARAM_INT);
      }
      elseif(is_bool($value)){
        $stmt->bindValue(':'.$key,$value,PDO::PARAM_BOOL);
      }
      elseif(is_null($value)){
        $stmt->bindValue(':'.$key,$value,PDO::PARAM_NULL);
      }
      elseif(is_string($value)){
        $stmt->bindValue(':'.$key,$value,PDO::PARAM_STR);
      }
    }
    if(is_int($if_value[0])){
      $stmt->bindValue(':'.$if_key[0],$if_value[0],PDO::PARAM_INT);
    }
    elseif(is_bool($if_value[0])){
      $stmt->bindValue(':'.$if_key[0],$if_value[0],PDO::PARAM_BOOL);
    }
    elseif(is_null($if_value[0])){
      $stmt->bindValue(':'.$if_key[0],$if_value[0],PDO::PARAM_NULL);
    }
    elseif(is_string($if_value[0])){
      $stmt->bindValue(':'.$if_key[0],$if_value[0],PDO::PARAM_STR);
    }
    $stmt->execute();
  }
  catch (PDOException $e) {
    $_SESSION['error_log']=$e->getMessage();
    exit();
  }
}

/*
*データベースの差し込み
*/
function dbInsert($db,$table_name,$data){
  $column=array_keys($data);
  $placeholder=array_map(fn($col)=>':'.$col,$column);

  $insert="INSERT INTO `".$table_name."`(`".implode("` , `",$column)."`) VALUES (".implode(" , ",$placeholder).")";
  try{
    $stmt=$db->prepare($insert);
    foreach($data as $key => $value){
      if(is_int($value)){
        $stmt->bindValue(':'.$key,$value,PDO::PARAM_INT);
      }
      elseif(is_bool($value)){
        $stmt->bindValue(':'.$key,$value,PDO::PARAM_BOOL);
      }
      elseif(is_null($value)){
        $stmt->bindValue(':'.$key,$value,PDO::PARAM_NULL);
      }
      elseif(is_string($value)){
        $stmt->bindValue(':'.$key,$value,PDO::PARAM_STR);
      }
    }
    $stmt->execute();

  }
  catch(PDOException $e){
    $_SESSION['error_log']=$e->getMessage();
    throw $e;
  }
}

/*
*データベースの呼び出し
*/
function dbSelect($db,$table_name,$data,$join,$select_if){
  $column=array_keys($data);
  $join_table_name="";
  $inner_join="";
  $value="";
  $db_where="";
  if(!empty($join)){  
    foreach($join as $value){  
      $join_table_name=$value[0];
      $internal_key=$value[1];
      $foreign_key=$value[2];
      $inner_join .= " INNER JOIN $join_table_name ON $internal_key = $foreign_key";
    }
  }
  else{
    $inner_join="";
  } 
  if(!empty($select_if)){
    $where_if=[];
    foreach($select_if as $key =>$value ){
      $not_table=ltrim(strrchr($key, '.'),'.');
      if(!empty($join)){ 
        $where_if[]=$key." = :".$not_table;
      }
      else{
        $where_if[]=$key." = :".$key;
      }
    }
    $db_where=' WHERE '.implode(' AND ',$where_if);
  }

  $select="SELECT ".implode(",",$column)." FROM ".$table_name .$inner_join . $db_where;
 
  try{
    $stmt=$db->prepare($select);

    if(!empty($select_if)){
      foreach($select_if as $key => $value){
        $not_table=ltrim(strrchr($key, '.'),'.');
        if(!empty($join)){
          if(is_int($value)){
            $stmt->bindValue(":" .$not_table,$value,PDO::PARAM_INT);
          }
          else if(is_bool($value)){
            $stmt->bindValue(":" .$not_table,$value,PDO::PARAM_BOOL);
          }
          else if(is_null($value)){
            $stmt->bindValue(":" .$not_table,$value,PDO::PARAM_NULL);
          }
          else if(is_string($value)){
            $stmt->bindValue(":" .$not_table,$value,PDO::PARAM_STR);
          }
        }
        else{
          if(is_int($value)){
            $stmt->bindValue(":" .$key,$value,PDO::PARAM_INT);
          }
          else if(is_bool($value)){
            $stmt->bindValue(":" .$key,$value,PDO::PARAM_BOOL);
          }
          else if(is_null($value)){
            $stmt->bindValue(":" .$key,$value,PDO::PARAM_NULL);
          }
          else if(is_string($value)){
            $stmt->bindValue(":" .$key,$value,PDO::PARAM_STR);
          }
        }
      }
    }
    $stmt->execute();
    $inner_join="";
    return $stmt->fetchALL(PDO::FETCH_ASSOC);
  }
  catch (PDOException $e) {
    $_SESSION['error_log']=$e->getMessage();
    exit();
  }
}
/*
*データベースの削除
*/
function dbDelete($db,$table_name,$delete_if){

  $column=array_keys($delete_if);
  $value=array_values($delete_if);
  foreach($column as $key){
    $delete_where[] = $key." = :".$key;
  }
  $delete="DELETE FROM ".$table_name." WHERE ".implode(" AND ",$delete_where); 

  try{
    $stmt=$db->prepare($delete);
    foreach($delete_if as $key => $value){
      if(is_int($value)){
        $stmt->bindValue(':'.$key,$value,PDO::PARAM_INT);
      }
      elseif(is_bool($value)){
        $stmt->bindValue(':'.$key,$value,PDO::PARAM_BOOL);
      }
      elseif(is_null($value)){
        $stmt->bindValue(':'.$key,$value,PDO::PARAM_NULL);
      }
      elseif(is_string($value)){
        $stmt->bindValue(':'.$key,$value,PDO::PARAM_STR);
      }
    }
    $stmt->execute();
  }
  catch (PDOException $e) {
    $_SESSION['error_log']=$e->getMessage();
    exit();
  }
}

/*
*小計 
*/
function totalDisplay($db){
  $total=0;
  $user_id=$_SESSION['user_id'];
  if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/cart.php'){
    $table_name="ec_product";
    $price="";$product_qty="";
    $data=['ec_product.price'=>$price,'ec_cart.product_qty'=>$product_qty];
    $join=[['ec_cart','ec_product.product_id','ec_cart.product_id']];
    $select_if=['ec_cart.user_id'=>$user_id];
    $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
  }
  if($_SERVER['REQUEST_URI']=='/ebina/0003/ec_site/order.php'){
    $order_id=0;
    $table_name='ec_order';
    $data=['order_id'=>$order_id];
    $join="";
    $select_if=['user_id'=>$user_id];
    $order_data=dbSelect($db,$table_name,$data,$join,$select_if);
    foreach($order_data as $row) {
      $order_id=$row["order_id"];
    }
    $table_name="ec_product";
    $price="";$product_qty="";
    $data=['ec_product.price'=>$price,'ec_order.product_qty'=>$product_qty];
    $join=[['ec_order','ec_product.product_id','ec_order.product_id']];
    $select_if=['ec_order.user_id'=>$user_id, 'ec_order.order_id'=>$order_id];
    $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
  }

  foreach($select_data as $row) {
    $product_qty=$row["product_qty"];
    $price=$row['price'];
    $total += (int)$price * (int)$product_qty;
  }

  echo "<div class='total'>合計：".$total."円</div>";
}

/*
*エラー文表示
*/
function errorDisplay(){
  $log=$_SESSION['log'];
  $error_log=$_SESSION["error_log"];

  if($log!=""){ ?>
    <div class="log">
      <h1><?php echo $log;?></h1>
    </div>
    <?php
    $_SESSION["log"]="";
  }
  if($error_log!=""){
    ?>
    <div class="error_log">
      <h1><?php echo "エラー:".$error_log;?></h1>
    </div>
    <?php
    $_SESSION["error_log"]="";
  }
}

/*
*購入メールを送る
*/
function emailSend($db){
  $user_id=$_SESSION["user_id"];
  $table_name="ec_personal";
  $personal_name="";$email_address="";
  $data=['personal_name'=>$personal_name,'email_address'=>$email_address];
  $join="";
  $select_if=['user_id'=>$user_id];
  $select_data=dbSelect($db,$table_name,$data,$join,$select_if);
  foreach($select_data as $row) {
    $personal_name=$row["personal_name"];
    $to=$row["email_address"];
  }
  
  //送信先のメールアドレス
  //$to="tomoki.career15@gmail.com";
  $subject="ご購入いただきありがとうございます";
  $message=$personal_name."様ご購入いただきありがとうございます";
  $header="From: tomoki.career15@gmail.com";
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");
  mb_send_mail($to,$subject,$message,$header);
}
//パスワードのハッシュ化
function passwordHash($password){
  $password_hash=password_hash($password, PASSWORD_DEFAULT);
  return $password_hash; 
}
//パスワードのハッシュの照合
function hashCheck($password,$password_hash){
  return password_verify($password,$password_hash);
}
/*
*購入完了表示 
*/
function completedPurchase(){
  ?>
  <h1 class="complete_purchase">ご購入いただきありがとうございます</h1>
  <?php
}

/*
* ログアウトを表示する 
*/
function logoutDisplay(){
  sessionEnd();
  ?>
  <div class="centerdisplay">
    <h1>ログアウトしました</h1>
  </div>
  <?php
}


/*
* バリデーション
*/
function validationCheck($user_name,$password){
  if(preg_match('/^[a-zA-Z0-9_]{5,}$/',$user_name)&&preg_match('/^[a-zA-Z0-9_]{8,}$/',$password)){
    return true;
  }
  elseif(!preg_match('/^[a-zA-Z0-9_]{5,}$/',$user_name)&&preg_match('/^[a-zA-Z0-9_]{8,}$/',$password)){
    $_SESSION["error_log"]="ユーザー名は5文字以上かつ半角英数字かアンダースコア(_)にしてください";
    return false;
  }
  elseif(preg_match('/^[a-zA-Z0-9_]{5,}$/',$user_name)&&!preg_match('/^[a-zA-Z0-9_]{8,}$/',$password)){
    $_SESSION["error_log"]="パスワードは8文字以上かつ半角英数字かアンダースコア(_)にしてください";
    return false;
  }
  else{
    $_SESSION["error_log"]="ユーザー名は5文字以上パスワードは8文字以上かつ半角英数字かアンダースコア(_)にしてください";
    return false;
  }
}