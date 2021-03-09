<?php 
header("Content-Type: text/html; charset=UTF-8");
if( !isset( $_SESSION ) ) {
  //session関連の設定
  //php.iniでセッションファイルの保存箇所を指定しておく session.save_path = "ディレクトリ(フルパス)"
  ini_set( 'session.gc_maxlifetime', 86400 );  // 秒(デフォルト:1440)
  session_set_cookie_params(86400);
  session_start();
}?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
  <title>darl-ui</title>
</head>
<body id="#">
<header>

</header>
<div id="ground">
<?php include_once('./main.php') ?>
</div>
<footer>
<p>記載されている会社名・製品名・システム名などは、各社の商標、または登録商標です。</p>
<p>data: Copyright (C) 2010 - 2021 SQUARE ENIX CO., LTD. All Rights Reserved. </p>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js" integrity="sha512-qzgd5cYSZcosqpzpn7zF2ZId8f/8CHmFKZ8j7mU4OUXTNRd5g+ZHBPsgKEwoqxCtdQvExE5LprwwPAgoicguNg==" crossorigin="anonymous"></script>
<script src="script/script.js"></script>
</body>
</html>