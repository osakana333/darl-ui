//セッション保存に成功したら画面作成関数にする

let ss_mord= new Array();
for (let i = 0; i < 80; i++) {
  ss_mord[i] = 0;
}
let page = 0; //現在ページ
let level = 0; //level:0
  
function ss_start() { //これはページの初期化処理

  //初期状態では21以降のボタンとリストを非表示
  for (let x = 21; x <= 80; x++) {
    var id = '0' + x;
    $('#' + id + '_bt').hide();
    $('#' + id + '_list').hide();
  }
  // //２ページ目以降を非表示
  // for (let xx = 2; xx <= 4; xx++) {
  //   $('#' + xx + 'p').hide();
  // }
  
}

function toggle_bt(bt_id) { //buttonのon-off処理
  var tmp = $('#' + bt_id).attr('class');
  if (tmp=='log_bt') { //offを含まないかどうかで判定したほうがよい
    $('#' + bt_id).attr('class','log_bt off');
  } else {
    $('#' + bt_id).attr('class','log_bt');
  }
}


function ajax_savelog(mord, page, level) {
  $.ajax({
    type:"POST",
    url: "script/post.php",
    data: {
      "ss_mord": JSON.stringify(mord), //配列はjsonにパース
      "page": page,
      "level": level
    },
    cache: false,
    dataType: 'text',
    timeout: 5000
}).then(
  function (data) {
    console.log('通信成功');
    console.log(data);
  },
  function (jqXHR, textStatus, errorThrown) {
    console.log('通信失敗');
    console.log(jqXHR.status); //例：404
    console.log(textStatus); //例：error
    console.log(errorThrown); //例：NOT FOUND
  }
).always( function() {
  //ボタンをやわらかくする処理
  console.log('処理終了');
} );

}

//探索手帳の初期化
ss_start();

$(function () {

  //リストのソート化 ライブラリ使用
  $('#sightseeing_list').tablesorter({
      textExtraction: function(node){
          var attr = $(node).attr('data-value');
          if(typeof attr !== 'undefined' && attr !== false){
              return attr;
          }
          return $(node).text();
      }
  });
    // シングルクリックで詳細説明、ダブルクリックでチェック済み化
    var click_timer = new Array();
    var click_num = 0;
    
    $('.log_bt').click(function(){
      var ss_id = $(this).attr('id');
        var timer = setTimeout(function() {
          // console.log("click");
          $('#sightseeing_view').text('探索手帳'+parseFloat(ss_id)+'番の詳細説明');
        }, 200);
        click_timer[click_num] = timer;
        click_num++;
    });
    
    $('.log_bt').dblclick(function(){
        click_timer.forEach (function(timer){
            clearTimeout(timer);
        });
      // console.log("dblclick");
      var ss_id = $(this).attr('id');
      ss_list = ss_id.replace('_bt', '');
      $('#' + ss_list + '_list').toggle();
      toggle_bt(ss_id);

      //test
      ajax_savelog(ss_mord, page, level);
    });
});

