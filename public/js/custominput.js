// HPが読み込まれた時、sessionStorageにdataがある場合表示 session判定で利用
let $html = "";

document.addEventListener("DOMContentLoaded", function () {
  let item = '';
  let session_js = $('#inputFile_add').data();
  let $html = "";

  let input_type = $('#inputFile_add').attr('input_type');
  
  session_js['session'] !== '' ? item = JSON.parse(sessionStorage.getItem("set_img")) : sessionStorage.removeItem("set_img");

  // 新規で画像を挿入し何かしらリダレクトし、localsessionに画像dataがある場合、表示する
  if (item && input_type === 'new') {
    $html = ['<div class="d-inline-block mr-1 mt-4 ml-3"><img class="img-thumbnail" src="', item.img, '" title="', item.name, '" style="height:100px;" /><div class="small text-muted text-center">', item['name'], '</div></div>'].join('');

    $('.custom-file-input').next('.custom-file-label').html('1個のファイルを選択しました').parents('.input-group').after('<div id="preview"></div>');

    $('#preview').append($html);
  } else {
    $html = '';
  }
});

// inputに画像を入力したときの処理
$('.custom-file-input').on('change', HandleFileSelect);


function HandleFileSelect(evt) {
  $('span#group-show').hide(); //ファイルを変更したら消す
  $('#preview').remove();// 繰り返し実行時の処理
  $(this).parents('.input-group').after('<div id="preview"></div>');
  sessionStorage.removeItem("set_img"); //session内容を消去

  // エラー文が表示時、非表示にする
  $('.custom-file-label').css('cssText', 'color', 'block');
  $('.input-group-text').css('cssText', 'color', 'block');
  let name = 'item_img'
  let error_id = ('error_' + name);
  $('#' + error_id).remove();
  
  let files = evt.target.files;

  for (let i = 0, f; f = files[i]; i++) {

    if (files[i].size >= 1000000) {
    $html = [
      '<div style="color: red;" id="img_validation">画像容量が1Mを超えています</div>'
    ];
      return $('.custom-file-input').val(''),
             $('.input-group').before($html),
             $('#inputFile_add').attr("value", ''),
             $('.custom-file-label').text('画像を選択してください');

  } else {
    $('#img_validation').remove();
      let reader = new FileReader();
      reader.onload = (function (theFile) {
        return function (e) {
          if (theFile.type.match('image.*')) {
            $html = ['<div class="d-inline-block mr-1 mt-4 ml-3"><img class="img-thumbnail" src="', e.target.result, '" title="', theFile.name, '" style="height:100px;" /><div class="small text-muted text-center">', theFile.name, '</div></div>'].join('');// 画像では画像のプレビューとファイル名の表示

            const set_img = {
              name: theFile.name,
              type: theFile.type,
              img: e.target.result
            }

            sessionStorage.setItem('set_img', JSON.stringify(set_img)); //セッションストレージに保存

          } else {
            $html = ['<div class="d-inline-block mr-1"><span class="small">', theFile.name, '</span></div>'].join('');//画像以外はファイル名のみの表示
          }

          $('#preview').append($html);
        };
      })(f);

      reader.readAsDataURL(f);
    }
    $(this).next('.custom-file-label').html(+ files.length + '個のファイルを選択しました');
  }
}


// ファイルの取消
$('#inputFileReset').on('click', function(){
  $(this).parent().prev().children('.custom-file-label').html('画像を選択してください');
  $('#preview').remove();
  $('.custom-file-input').val('');
})

// Since the detail screen is displayed as img and the new one as data, the 'input' type is replaced.
$('#inputFile_add').on({
  'mouseenter': function() {
    $(this).get(0).type = "file";
  },
  'mouseleave': function () {
    const file = $('#inputFile_add')[0].files[0];
    if (file !== undefined) {
      ;
    } else {
      $(this).get(0).type = "text";
    }
  }
})

// 入力時、エラー文を非表示
// form
$('.form-control').on('change', function () {
  $(this).css('cssText', 'color', 'block');
  let name = $(this).attr('name');
  let error_id = ('error_' + name);
  $('#' + error_id).remove();
});

// radio
$('.control-label').on('change', function () {
  let name = 'book_tag';
  let error_id = ('error_' + name);
  $('#' + error_id).remove();
})


