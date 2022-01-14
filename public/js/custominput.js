// HPが読み込まれた時、sessionStorageにdataがある場合表示 session判定で利用
document.addEventListener("DOMContentLoaded", function () {
  let item = '';
  let session_js = $('#inputFile_add').data();
  let $html = "";

  let input_type = $('#inputFile_add').attr('input_type');
  
  session_js['session'] !== '' ? item = JSON.parse(sessionStorage.getItem("set_img")) : sessionStorage.removeItem("set_img");

  if (item && input_type === 'new') {
    $html = ['<div class="d-inline-block mr-1 mt-4 ml-3"><img class="img-thumbnail" src="', item.img, '" title="', item.name, '" style="height:100px;" /><div class="small text-muted text-center">', item['name'], '</div></div>'].join('');

    $('.custom-file-input').next('.custom-file-label').html('1個のファイルを選択しました').parents('.input-group').after('<div id="preview"></div>');

    $('#preview').append($html);
  } else {
    $html = '';
  }
});

// inputに画像を入力したときの処理
$('.custom-file-input').on('change', handleFileSelect);
function handleFileSelect(evt) {
  $('span#group-show').hide(); //ファイルを変更したら消す
  $('#preview').remove();// 繰り返し実行時の処理
  $(this).parents('.input-group').after('<div id="preview"></div>');
  
  var files = evt.target.files;

  for (var i = 0, f; f = files[i]; i++) {

    var reader = new FileReader();

    reader.onload = (function(theFile) {
      return function(e) {
        if (theFile.type.match('image.*')) {
          var $html = ['<div class="d-inline-block mr-1 mt-4 ml-3"><img class="img-thumbnail" src="', e.target.result, '" title="', theFile.name, '" style="height:100px;" /><div class="small text-muted text-center">', theFile.name, '</div></div>'].join('');// 画像では画像のプレビューとファイル名の表示

          const set_img = {
            name: theFile.name,
            type: theFile.type,
            img: e.target.result
          }  

          sessionStorage.setItem('set_img', JSON.stringify(set_img)); //セッションストレージに保存

        } else {
          var $html = ['<div class="d-inline-block mr-1"><span class="small">', theFile.name,'</span></div>'].join('');//画像以外はファイル名のみの表示
        }

        $('#preview').append($html);
      };
    })(f);

    reader.readAsDataURL(f);
  }
  $(this).next('.custom-file-label').html(+ files.length + '個のファイルを選択しました');
}


//ファイルの取消
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

// base64をFileに変換
// function convertToFile(imgData) {
//   const blob = atob(imgData.img.replace(/^.*,/, ''));
//   let buffer = new Uint8Array(blob.length);
//   for (let i = 0; i < blob.length; i++) {
//     buffer[i] = blob.charCodeAt(i);
//   }
//   return new File([buffer.buffer], imgData.name, {type: imgData.type});
// }