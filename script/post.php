<?php
header("Content-Type: application/json; charset=UTF-8");
if( !isset( $_SESSION ) ) {
  session_start();
}
//$_POST['page'] $_POST['ss_mord'][N] $_POST['level']
//postで飛んできたなにがしをページ、チェックそれぞれセッションに保存する

$posts = array(
  'ss_mord' => FILTER_DEFAULT, //jsonとして正規かどうか判別できる関数があればFILTER_CALLBACKで通したい
  'page' => FILTER_VALIDATE_INT,
  'level' => FILTER_VALIDATE_INT
);

$input = filter_input_array(INPUT_POST, $posts);

$input['ss_mord'] = json_decode($input['ss_mord'],true);

if (!isset($_SESSION['ss_mord'])||!isset($_SESSION['page'])||!isset($_SESSION['level'])) {
  foreach ($input['ss_mord'] as $key => $value) {
    $_SESSION['ss_mord'][$key] = $value;
  }
  $_SESSION['page'] = 0;
  $_SESSION['level'] = 0;
}

if (isset($input['ss_mord'])&&isset($input['page'])&&isset($input['level'])) {


  foreach ($input['ss_mord'] as $key => $val) {
    if (!$_SESSION['ss_mord'][$key] == $val) {
      $_SESSION['ss_mord'][$key] = $val;
    }
  }

  if (!$_SESSION['page'] == $input['page']) {
    $_SESSION['page'] == $input['page'];
  }

  if (!$_SESSION['level'] == $input['level']) {
    $_SESSION['level'] == $input['level'];
  }

  echo json_encode($_SESSION);

} else {
  //jsonエラーまで含めてtry-catchで処理したいけど面倒だからとりあえずこれでいいや
  echo 'error:posts not found.';
  echo print_r($_POST);
}
