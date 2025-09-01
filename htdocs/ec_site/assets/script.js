if(location.pathname === "/ebina/0003/ec_site/registration.php"){

  // 入力要素とエラー表示要素を取得
  const user_name_input = document.getElementById('user_name');
  const password_input = document.getElementById('password');
  const username_error = document.getElementById('user_name_error');
  const password_error = document.getElementById('password_error');
  const submit_btn = document.getElementById('registration_btn');

  // バリデーション用の正規表現
  const user_name_regex = /^[A-Za-z0-9]{5,}$/;   // 半角英数字かつ5文字以上
  const password_regex = /^[A-Za-z0-9]{8,}$/;   // 半角英数字かつ8文字以上

  // 各フィールドが有効かどうかのフラグ
  let user_name_valid = false;
  let password_valid = false;

  // ユーザー名リアルタイムチェック
  user_name_input.addEventListener('input', function() {
    const value = user_name_input.value.trim();
    if (value === '') {
      username_error.textContent = '';
      username_error.style.display = 'none';
      user_name_valid = false;
    } else if (!user_name_regex.test(value)) {
      username_error.textContent = '登録条件を満たしてください';
      username_error.style.display = 'block';
      user_name_valid = false;
    } else {
      username_error.textContent = '';
      username_error.style.display = 'none';
      user_name_valid = true;
    }
    toggleSubmitButton();
  });

  // パスワードリアルタイムチェック
  password_input.addEventListener('input', function() {
    const value = password_input.value;
    if (value === '') {
      password_error.textContent = '';
      password_error.style.display = 'none';
      password_valid = false;
    } else if (!password_regex.test(value)) {
      password_error.textContent = '登録条件を満たしてください';
      password_error.style.display = 'block';
      password_valid = false;
    } else {
      password_error.textContent = '';
      password_error.style.display = 'none';
      password_valid = true;
    }
    toggleSubmitButton();
  });

  // 両方とも有効になったら送信ボタンを有効化
  function toggleSubmitButton() {
    submit_btn.disabled = !(user_name_valid && password_valid);
  }

  // フォーム送信前にも最終チェック（保険として）
  document.getElementById('registration_form').addEventListener('submit', function(e) {
    if (!user_name_valid || !password_valid) {
      e.preventDefault();
    }
  });
}

if(location.pathname === "/ebina/0003/ec_site/management.php"){

  // 要素を取得
  const product_name_input = document.getElementById('product_name');
  const description_input = document.getElementById('product_description');
  const stock_qty_input = document.getElementById('stock_qty');
  const price_input = document.getElementById('price');
  const image_input = document.getElementById('image');
  const submit_btn = document.getElementById('management_btn');

  const name_error = document.getElementById('name_error');
  const description_error = document.getElementById('description_error');
  const stock_qty_error = document.getElementById('stock_qty_error');
  const price_error = document.getElementById('price_error');
  const image_error = document.getElementById('image_error');

  // バリデーション状態を保持するフラグ
  let name_valid  = false;
  let description_valid = false;
  let stock_qty_valid   = false;
  let price_valid = false;
  let image_valid = false;

  // 商品名のチェック：空欄でないか
  product_name_input.addEventListener('input', () => {
    const val = product_name_input.value.trim();
    if (val.length === 0) {
      name_error.style.display = 'block';
      name_valid = false;
    } else {
      name_error.style.display = 'none';
      name_valid = true;
    }
    toggleSubmit();
  });

  // 商品名のチェック：空欄でないか
  description_input .addEventListener('input', () => {
    const val = description_input.value.trim();
    if (val.length === 0) {
      description_error.style.display = 'block';
      description_valid = false;
    } else {
      description_error.style.display = 'none';
      description_valid = true;
    }
    toggleSubmit();
  });

  // 数量のチェック：1以上の整数か
  stock_qty_input.addEventListener('input', () => {
    const val = stock_qty_input.value.trim();
    // 数字のみ（整数）かつ 1 以上
    if (/^[0-9]+$/.test(val) && Number(val) >= 1) {
      stock_qty_error.style.display = 'none';
      stock_qty_valid = true;
    } else {
      stock_qty_error.style.display = 'block';
      stock_qty_valid = false;
    }
    toggleSubmit();
  });

  // 価格のチェック：1以上の整数か
  price_input.addEventListener('input', () => {
    const val = price_input.value.trim();
    if (/^[0-9]+$/.test(val) && Number(val) >= 1) {
      price_error.style.display = 'none';
      price_valid = true;
    } else {
      price_error.style.display = 'block';
      price_valid = false;
    }
    toggleSubmit();
  });

  // 画像のチェック：選択あり、かつ JPEG/PNG か
  image_input.addEventListener('change', () => {
    const file = image_input.files[0];
    if (file) {
      const mime = file.type.toLowerCase();
      if (mime === 'image/jpeg' || mime === 'image/png') {
        image_error.style.display = 'none';
        image_valid = true;
      } else {
        image_error.style.display = 'block';
        image_valid = false;
      }
    } else {
      // 未選択状態はエラー扱いとする
      image_error.style.display = 'block';
      image_valid = false;
    }
    toggleSubmit();
  });

  // 全部のバリデーションが通ったら送信を許可
  function toggleSubmit() {
    if (name_valid && description_valid && stock_qty_valid && price_valid && image_valid) {
      submit_btn.disabled = false;
    } else {
      submit_btn.disabled = true;
    }
  }

  // フォーム最終チェック（JS無効時の保険）
  document.getElementById('management_form').addEventListener('submit', (e) => {
    if (!(name_valid && description_valid && stock_qty_valid && price_valid && image_valid)) {
      e.preventDefault();
    }
  });

  // ページ読み込み時は全フラグを false にしておく
  name_error.style.display  = 'none';
  description_error.style.display='none';
  stock_qty_error.style.display   = 'none';
  price_error.style.display = 'none';
  image_error.style.display = 'none';
  submit_btn.disabled = true;
}
//登録時のバリデーションチェック
/*
if(location.pathname === "/ebina/0003/ec_site/registration.php"){
document.getElementById('registration_form').addEventListener("submit", function(event) {

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
document.getElementById('managementform').addEventListener('submit',function(event){

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
}*/

