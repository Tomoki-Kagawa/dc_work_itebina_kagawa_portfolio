<?php
/*
*order_model.php
*/
/*
*購入済みリスト処理
*/
function listProcess($db){
  $user_id=$_SESSION["user_id"];
  if(isset($_POST['product_qty'])){
    $product_qty = htmlspecialchars($_POST['product_qty'], ENT_QUOTES, 'UTF-8');
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
  return $select_data;    
}
/*
*購入済みリスト表示
*/      
function listDisplay($select_data){
  $count=0;
  ?>
  <div class="image_flex">
  <?php
    foreach($select_data as $row) {
      $product_id=$row["product_id"];
      $image_name=$row["image_name"];
      $product_name=$row["product_name"];
      $product_description=$row["product_description"];
      $price=$row["price"];
      $stock_qty=$row["stock_qty"];
      $public_flg=$row["public_flg"];
      $product_qty=$row["product_qty"];
         
      if($public_flg==1&&$stock_qty!=0){
        $count++;
        ?>     
        <div class="list">
          <?php          
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
*購入完了表示 
*/
function completedPurchase(){
  ?>
  <h1 class="complete_purchase">ご購入いただきありがとうございます</h1>
  <?php
}
