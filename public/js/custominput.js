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
          var $html = ['<div class="d-inline-block mr-1 mt-4 ml-3"><img class="img-thumbnail" src="', e.target.result,'" title="', theFile.name, '" style="height:100px;" /><div class="small text-muted text-center">', theFile.name,'</div></div>'].join('');// 画像では画像のプレビューとファイル名の表示
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

//詳細の画像表示
$('#inputFile_add').on({
  'mouseenter': function() {
    $(this).get(0).type = "file";
  },
  'mouseleave': function () {
    const file = $('#inputFile_add')[0].files[0];
    console.log(file)
    if (file !== undefined) {
      ;
    } else {
      $(this).get(0).type = "text";
    }
  }
})