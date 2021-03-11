<?php 
//$_SESSION['page'] $_SESSION['ss_mord'] $_SESSION['level']
//ajax おれお前のことなにもわからないよ

$json_log = file_get_contents('log/sightseeing_log.json');
$ss_log = json_decode($json_log, true);

$sortable_th = [
    ['id', '#'],
    ['place', '目的地'],
    ['time', '時間'],
    ['weather', '天候'],
    ['emote', 'エモート'],
    ['destination', '探検記録'],
    ['memo', 'メモ']
];
  
  $bt_cnt = 0;

// button id: ***_bt name/val: ***_log
// list tr id: ***_list
?>
<div class="contents">

<div class="ss_wrap">
<p>探検手帳</p>
<div class="flex">
<div class="wrap_left">

<div class="page_wrap">
<button id="1p" type="button" name="1p" value="1" class="page_bt">1</button>
<button id="2p" type="button" name="2p" value="2" class="page_bt none">2</button>
<button id="3p" type="button" name="3p" value="3" class="page_bt none">3</button>
<button id="4p" type="button" name="4p" value="4" class="page_bt none">4</button>
</div><!-- page_wrap end  -->

<div class="sightseeing_log">
  <table class="log">
    <?php
    for ($row=0; $row < 5 ; $row++) { ?>
      <tr id="row<?=$row?>" class="log_row">
        <?php for ($cel=0; $cel < 5; $cel++) { ?>
          <td id="cel<?=$row?>_<?=$cel?>" class="log_cel">
            <button id="<?=$ss_log[($bt_cnt)][0]?>_bt" type="button" name="log<?=$ss_log[($bt_cnt)][0]?>_log" value="<?=$ss_log[($bt_cnt)][0]?>" class="log_bt<?php
            //必要なのはここに.offを入れるかどうかの判定だわ

            ?>"><?=$ss_log[($bt_cnt)][0]?></button>
          </td>
        <?php
        $bt_cnt++;
        }; ?>
      </tr>  
      <?php }; ?>
    </table>
  </div><!-- log end -->

  <div>
  <button id="half_p" type="button" name="half_page" value="last" class="half_bt">後半を表示</button>
  <button id="re_p" type="button" name="re_page" value="re" class="re_bt">リセット</button>
  </div>

  </div><!-- wrap_left end -->

  <div class="wrap_right">

    <div id="sightseeing_view">
    詳細説明
    </div><!-- view end -->

  </div><!-- wrap_right end -->

</div><!-- flex end -->
</div><!-- ss_wrap end -->


  <div>
    ソートつきでリストアップ

   <table class="list" id="sightseeing_list">
       <thead>
       <tr>
       <?php
        foreach ($sortable_th as $key => $value) { ?>
          <th class="th<?=$key?>">
            <?=$value[1]?>
          </th>
        <?php } ?>
       </tr>
       </thead>
       <tbody>
         <?php foreach ($ss_log as $log) { ?>
          <tr id="<?=$log[0]?>_list"<?php
            //ここにstyle="display:none"を入れるかどうかを判定する

            ?> >
          <?php for ($i=0; $i < 7; $i++) { ?>
          <td>
            <?=$log[$i]?>
          </td>
         <?php }  ?>
          </tr>
         <?php
        }  ?>
       </tbody>
   </table><!-- list end -->

  </div>

</div><!-- contents end -->
