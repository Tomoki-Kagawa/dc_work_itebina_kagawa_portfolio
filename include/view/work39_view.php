<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>work39</title>
    <style>
      /*全体*/
      *{
            margin: 0;
            padding: 0;
            max-width: 100%;
            box-sizing: border-box;
            letter-spacing: 0.05em;
        }
          form{
            display:flex;
            flex-direction: column;
            width:400px;
          }
          .form_flex{
            display:flex;
          }
          .image_label{
            padding:0 15px 0 0;
          }
          .image_input{
            width:300px;
          }
          .btn{
            width: 80px;
          }
          .flex{
            display:flex;
            flex-direction: column;
          }
          .image_flex{
            display:flex;
            width: 100%;
            flex-wrap: wrap;
            justify-content:start;
          }
          .image_parent{
            text-align: center;
            margin: 0 auto;
            width: 30%;
            height: 30%;
            border: solid black;
          }
          .image_parent1{
            text-align: center;
            margin: 0 auto;
            width: 30%;
            height: 30%;
            border: solid black;
            background-color: white;
          }
          .image_parent2{
            text-align: center;
            margin: 0 auto;
            width: 30%;
            height: 30%;
            border: solid black;
            background-color: gray;
          }
          .empty_box{
            content:"";
            opacity: 0;
            border: none;
          }
          .flg_btn{
            margin:0 auto;
            width: 100px;
          }
    </style>
  </head>
</html>