<?php
header("Content-Type: application/json; charset=UTF-8");
?>
<div class="contents">
<?php

// 探検記録配列作成
// 0番号	1目的地  2時間	3天候	4エモート	5探検記録 6メモ

$target_html = file_get_contents('https://wikiwiki.jp/ff14n/%E6%8E%A2%E6%A4%9C%E6%89%8B%E5%B8%B3');
$target_html = mb_convert_encoding($target_html, 'HTML-ENTITIES', 'utf8');
// $target_html = mb_convert_encoding($target_html, "utf8", "utf8");

$dom = new DOMDocument;
@$dom->loadHTML($target_html);
$xpath = new DOMXPath($dom);

$nodes = $xpath->query('//div[@class="h-scrollable"][position()>1][position()<5]/table/tbody');

$iq = 0;
for ($b = 0; $b < $nodes->length; $b++) {
  $ch_nodes = $nodes->item($b)->childNodes;
  for ($i = 0; $i < $ch_nodes->length; $i++) {
    $ex_nodes = $ch_nodes->item($i)->childNodes;
    $ib = 0;
    foreach ($ex_nodes as $node) {
      $sightseeing_log[$iq][$ib] = $node->nodeValue;
      $ib++;
    }
    $iq++;
  }
};

for ($iii=0; $iii < count($sightseeing_log); $iii++) { 
  $val = $sightseeing_log[$iii];
  $sightseeing_log[$iii][1] = preg_replace('/(Y:[0-9.]+\)).*/', '$1', $val[1]);
  $sightseeing_log[$iii][6] = str_replace($sightseeing_log[$iii][1], '', $val[1]);
  $sightseeing_log[$iii][6] = preg_replace('/\A[\p{Zs}]/u', '', $sightseeing_log[$iii][6]);
  // $sightseeing_log[$iii][6] = preg_replace('/[\p{Zs}]/u', ' ', $sightseeing_log[$iii][6]);

  for ($ii=0; $ii < 6; $ii++) { 
    $sightseeing_log[$iii][$ii] = htmlentities( $sightseeing_log[$iii][$ii], ENT_QUOTES);
  }
};

// 探検記録配列作成ここまで

$file_name = 'sightseeing_log-pre.php';
$log_json = json_encode($sightseeing_log,JSON_UNESCAPED_UNICODE);


if (!file_put_contents($file_name , $log_json) === false) {
  chmod($file_name , 0775); ?>
<p>以下の通りにファイル「sightseeing_log-pre.json」を作成しました。</p>
<pre>
  <?php var_dump($sightseeing_log); ?>
</pre>
<?php } else {
  echo '<p>jsonファイルの更新に失敗しました。</p>';
};
?>
</div>