<?php
/*
* DB接続を行いPDOインスタンスを返す
* @param object $dsn,$login_user,$password
* @return object $pdo 
*/
function db_connection() {
  $dsn = 'mysql:host=localhost;dbname=xb513874_7y8lo';
  $login_user = 'xb513874_ek608'; 
  $password = '5z6i9869r6'; 
  try{
    // PDOインスタンスの生成
   $db = new PDO($dsn,$login_user,$password);
   $db->beginTransaction();	// トランザクション開始
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit();
  }
  return $db;
}
/*
* 正規表現
* @param object $dsn,$login_user,$password
* @return object $pdo 
*/
function validation($check_text,$db){
  //echo $check_text;
     //ボタンを押した時
    if(isset($_POST["image_post"])){
      if(preg_match('/^[a-zA-Z0-9]$/',$check_text)&&$check_text != '') {
            
      //$db->beginTransaction();	// トランザクション開始
        if (isset($_POST['get_text'])&&isset($_FILES['image']['name'])!="") {
        $name=$_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $image_dir='./image/'.basename($name);
        $image_date=move_uploaded_file($_FILES['image']['tmp_name'],$image_dir) ;
        $size = $_FILES['image']['size'];
        $date =date('Y-m-d H:i:s');
        $title=$_POST['get_text'];
        $public_flg=1;
          
        if(preg_match('/\.jpeg$/i',$name)||preg_match('/\.png$/i',$name))
        {
          $insert="INSERT INTO `image_table`(`image_name`, `image_type`, `image_size`, `create_date`, `title`, `public_flg`) VALUES ('$name', '$type', '$size', '$date','$title','$public_flg')";
          
          if($result = $db->query($insert)) {
            $row = $result->rowCount();
            echo "INSERTに成功";
          }
          else {
            $error_msg[] = 'INSERT実行エラー [実行SQL]' . $insert;
          }
          if (isset($error_msg) == 0) {
            //echo $row.'件更新しました。'; 
            $db->commit();	// 正常に終了したらコミット
          }
          else {
            //echo '更新が失敗しました。'; 
            $db->rollback();	// エラーが起きたらロールバック
          }
        } 
        else{
          echo '画像ファイルはpngかjpegにしてください';
        }
          //var_dump($error_msg);           
      }
    }
      else {
        echo "半角英数字で記入してください";
      }
      $check_text= '';
    }
}

/*
* 正規表現
* @param object $dsn,$login_user,$password
* @return object $id_count
*/
function id_count($db){
    $count="SELECT COUNT(`image_id`) FROM `image_table`;";
    if ($result = $db->query($count)) {
      while ($row = $result->fetch()) {
        $id_count=$row["COUNT(`image_id`)"];
        return $id_count;
      }
    }
}
/*
* 画像一覧表示
* @param object $dsn,$login_user,$password
* @return object $pdo 
*/
function repeat_gallary($id_count,$db){
  
  ?><div class="image_flex">
        <?php
        //print_r($id_count);
        //function image_list($id_count,$db){
        for($call=1;$call<=$id_count;$call++){
          $call_flg='callflg'.$call;
          //呼び出し
          $select = "SELECT image_id,image_name,image_type,image_size,create_date,title,public_flg FROM image_table WHERE image_id=$call";
          if ($result = $db->query($select)) {
            //取得
            while ($row = $result->fetch()) {
              $id=$row["image_id"];
              $name = $row["image_name"];
              $type = $row["image_type"];
              //$content = $row["image_content"];
              $size = $row["image_size"];
              $date = $row["create_date"];
              $title = $row["title"];
              $public_flg = $row["public_flg"];
          }
        }   
          
        if($public_flg==1){
          echo '<div class="image_parent1">';
          ?>
          <div class="name">
          <?php      
            //タイトル表示
            echo $title;
          ?>
        </div>
        <?php
          //画像表示
          echo'<img src="' .'image/'.$name. '">'."<br>";      
          ?>
            <form method="post" enctype="multipart/form-data">
            <?php  
              echo '<input type="submit" name="'.$call_flg.'" value="非表示にする" class="flg_btn">';
            ?>
            </form>
            <?php 
            }
            //非表示
            else if($public_flg==2){
              echo '<div class="image_parent2">';
              ?>
            <div class="name">
              <?php      
              //タイトル表示
              echo $title;
              ?>
            </div>
          <?php
          //画像表示
          echo'<img src="' .'image/'.$name. '">'."<br>";      
          ?>
          <form method="post" enctype="multipart/form-data">
          <?php
            echo '<input type="submit" name="'.$call_flg.'" value="表示にする" class="flg_btn">';
          ?>
          </form>
          <?php
          }
          //表示・非表示ボタンの認識
          if(isset($_POST[$call_flg])){
           if($public_flg==1){
            $public_flg=2;
            $update="UPDATE image_table SET public_flg=2 WHERE image_id=$call;";
            //$result = $db->query($update);
            if($result = $db->query($update)) {
              $row = $result->rowCount();
              echo "UPDATEに成功";
            }
            else {
              $error_msg[] = 'INSERT実行エラー [実行SQL]' . $update;
            }
            if (isset($error_msg) == 0) {
              echo $row.'件更新しました。'; 
              $db->commit();	// 正常に終了したらコミット
            }
            else {
              echo '更新が失敗しました。'; 
              $db->rollback();	// エラーが起きたらロールバック
            }
          }
        
          //非表示
          else if($public_flg==2){         
            $public_flg=1;
            $update="UPDATE image_table SET public_flg=1 WHERE image_id=$call;";
            //$result = $db->query($update);
            if($result = $db->query($update)) {
              $row = $result->rowCount();
              //echo "UPDATEに成功";
            }
            else {
              $error_msg[] = 'UPDATE実行エラー [実行SQL]' . $update;
            }
            if (isset($error_msg) == 0) {
              echo $row.'件更新しました。'; 
              $db->commit();	// 正常に終了したらコミット
            }
            else {
            echo '更新が失敗しました。'; 
            $db->rollback();	// エラーが起きたらロールバック
            }
          }
          //事業所
          header('Location: https://portfolio02.dc-itex.com/ebina/0003/work/work39/work39_gallary.php');
          //home
          //header('Location: http://localhost/dc_work_itebina_kagawa_PHP/htdocs/mid/work30/work30_gallery.php');
          exit;
        }
       ?>
        </div>
        <?php
        }//}
      ?>
      
      <?php            
      $remainder=$id_count%3;
      if($remainder==1){?>
        <div class="image_parent1 empty_box">a</div>
        <div class="image_parent1 empty_box">a</div>
      <?php
      }
      else if($remainder==2){
      ?>
      <div class="image_parent1 empty_box">a</div>
      <?php
        }
      ?>    
      <?php
        if($public_flg==1){
          echo '</div>';
        } 
        else if($public_flg==2){
          echo '</div>';
        }
        ?> 
      </div>
      <?php
    }
    
    function repeat($id_count,$db,$minus){
      ?>
      <div class="image_flex">
        <?php
        //function image_list($id_count,$db,$minus){
        for($call=1;$call<=$id_count;$call++){
        $call_flg='callflg'.$call;
        //呼び出し
        $select = "SELECT image_id,image_name,image_type,image_size,create_date,title,public_flg FROM image_table WHERE image_id=$call";
        ?>
        <?php
                if ($result = $db->query($select)) {
                //取得
                while ($row = $result->fetch()) {
                $id=$row["image_id"];
                $name = $row["image_name"];
                $type = $row["image_type"];
                //$content = $row["image_content"];
                $size = $row["image_size"];
                $date = $row["create_date"];
                $title = $row["title"];
                $public_flg = $row["public_flg"];
            }
        }   
          
          if($public_flg==1){
            echo '<div class="image_parent">';
          
           ?>
                    
          <div class="name">
          <?php      
            //タイトル表示
            echo $title;
          ?>
        </div>
        <?php
            //画像表示
            echo'<img src="' .'image/'.$name. '">'."<br>";      
          ?>
         
        </div>
      <?php
          }
          else if($public_flg==2){
            $minus++;
          }
    }//}
    ?>
      <?php     
        $remainder=($id_count-$minus)%3;
            if($remainder==1){?>
            <div class="image_parent empty_box">a</div>
            <div class="image_parent empty_box">a</div>
            <?php
            }
            else if($remainder==2){
            ?>
            <div class="image_parent empty_box">a</div>
          <?php
          }
        ?>    
        <?php
          if($public_flg==1){
            echo '</div>';
          } 
          else if($public_flg==2){
            echo '</div>';
          }
          ?> 
      </div>
      <?php
      }
      function theme(){
        echo "<h4>画像一覧<br></h4>";
      }
      function transition(){
        echo "<h4><a href='https://portfolio02.dc-itex.com/ebina/0003/work/work39/work39_gallary.php'>画像投稿ページへ</a></h4>";
      }

  function theme_gallary(){
      //テキストPOST
  //$check_text= '';		// 初期化
  if(isset($_POST['get_text'])){
    $check_text = htmlspecialchars($_POST['get_text'], ENT_QUOTES, 'UTF-8');
  }
  //画像POST
  //$check_data ='';		// 初期化
  if(isset($_POST['image'])){
    $check_data = htmlspecialchars($_POST['image'], ENT_QUOTES, 'UTF-8');
  }
    ?>
    <!--フォーム-->
    <form method="post" enctype="multipart/form-data">
      <h3>画像投稿</h3>
      <div class="form_flex">
        <label for="title">画像名：</label>
        <input type="text" name="get_text" value= <?php echo $check_text ?>>
      </div>
      <div class="form_flex">
        <label for="image_file" class="image_label">画像</label><div>：</div>
        <input type="file" name="image" class="image_input"  value= <?php echo $check_data ?>>
      </div>
      <input type="submit" name="image_post" value="画像投稿" class="btn">
      </form>
    <h4><a href='https://portfolio02.dc-itex.com/ebina/0003/work/work39/work39.php'>画像一覧ページへ</a></h4>
    <?php
    
    //echo $check_text."<br>";
    //echo $check_data;
    $array=[$check_text,$check_data];
    return $array;
  }
   ?>
