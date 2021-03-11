<?php 
header("Content-Type: text/html; charset=UTF-8");
if( !isset( $_SESSION ) ) {
  //session関連の設定
  //php.iniでセッションファイルの保存箇所を指定しておく session.save_path = "ディレクトリ(フルパス)"
  ini_set( 'session.gc_maxlifetime', 86400 );  // 秒(デフォルト:1440)
  session_set_cookie_params(86400);
  session_start();
}else{
  if(isset($_SESSION['ss_mord'])){
    $ss_mord = json_encode($_SESSION['ss_mord'],true);
  }
  if(isset($_SESSION['page'])){
    $page = $_SESSION['page'];
  }
  if(isset($_SESSION['level'])){
    $level = $_SESSION['level'];
  }
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
<script>
<?php
  //セッションの値をjsにわたす
  if(isset($ss_mord)&&isset($page)&&isset($level)){ ?>
    let ss_mord = JSON.parse('<?php echo $ss_mord; ?>');
    let page = parseFloat('<?php echo $page; ?>');
    let level = parseFloat('<?php echo $level; ?>');
  <?php }else{ ?>
    //ページ初期設定
    let ss_mord= new Array();
    for (let i = 0; i < 80; i++) {
      ss_mord[i] = 0;
    }
    let page = 0; //現在ページ
    let level = 0; //level:0
  <?php } ?>
  console.log(ss_mord,page,level);
</script>
<script src="script/script.js"></script>
</body>
</html>