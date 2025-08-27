//参考ページ
//https://okumocchi.jp/php/re.php
//https://troutlurefishing.jp/regex.htm

//登録時のバリデーションチェック
if(location.pathname === "/ebina/0003/ec_site/registration.php"){
document.getElementById('registration_btn').addEventListener("submit", function(event) {

  var chack_user_name=/^[a-zA-Z0-9_]{5,}$/;
  var chack_password=/^[a-zA-Z0-9_]{8,}$/;

  let user_name = document.getElementById('user_name').value;
  let password = document.getElementById('password').value;

  let js_vc_user_name = document.getElementById("js_vc_user_name");
  let js_vc_password = document.getElementById("js_vc_password");

  if(user_name.match(chack_user_name)){
    js_vc_user_name.value = "true";
  }
  else{
    js_vc_user_name.value = "false";
  }
  if(password.match(chack_password)){
    js_vc_password.value = "true";
  }
  else{
    js_vc_password.value = "false";
  }
},);
}

//登録時のバリデーションチェック
if(location.pathname === "/ebina/0003/ec_site/management.php"){
document.getElementById('management_btn').addEventListener('submit',function(event){

  var chack_number=/^[0-9]+$/;
  
  let price = document.getElementById('price').value;
  let stock_qty = document.getElementById('stock_qty').value;

  let js_vc_price = document.getElementById("js_vc_price");
  let js_vc_stock_qty = document.getElementById("js_vc_stock_qty");

  if(price.match(chack_number)){
    js_vc_price.value="true";
  }
  else{
    js_vc_price.value="false";
  }
  if(stock_qty.match(chack_number)){
    js_vc_stock_qty.value="true";
  }
  else{
    js_vc_stock_qty.value="false";
  }
});
}

