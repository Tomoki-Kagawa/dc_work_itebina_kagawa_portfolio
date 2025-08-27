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
