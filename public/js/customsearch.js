// ajax
let book_data = ""
function SearchApi(search_text) {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/ajax/rakutenbook/',
    type: 'POST',
    data: {
      'item_name': search_text
    },
  }) // modal1(検索結果)の表示
    .then(function (data) {
      const html_all = []
      const array_data = JSON.parse(data);
      book_data = array_data;
 
      for (let i = 0; i < array_data.length; i++) {
        $html_one = [
          '<div ><p book_no = ' + i + ' class="modal_result">・' + array_data[i].item_name + '</p></div>'
        ];
        html_all.push($html_one);
      }
      $('#search_modal').append('<div class="modal_title_list">' + html_all.join('') + '</div>');
      $('#modal_titel_list').modal();
    })
    .fail(function (data, xhr, err) {
      console.log('エラー');
      console.log(err);
      console.log(xhr)
    });
  return false;
}

// modal2(詳細)の表示
function SearchResult() {
  let book_no = $(this).attr('book_no');
  $html = ['<div class="row no-gutters modal_result_list"><div class="col-md-4"><img class="bd-placeholder-img img_modal" width="100%" height="250" src = ', book_data[book_no].item_img, ' preserveAspectRatio="xMidYMid slice" focusable = "false"></img></div > <div class="col-md-8"><div class="card-body"><h5 class="card-title title_modal" >', book_data[book_no].item_name, '</h5><p class="card-text">', book_data[book_no].caption,'</p><p class="card-text" name="item_amount" value=', book_data[book_no].item_amount,'>', book_data[book_no].item_amount, '円</p><p class="card-text" >', book_data[book_no].published, '、販売</p></div></div></div><input type="hidden" name="item_img" value=',book_data[book_no].item_img, '><input type="hidden" name="item_name" value=',book_data[book_no].item_name,'><input type="hidden" name="item_amount" value=', book_data[book_no].item_amount,'><input type="hidden" name="published" value=', book_data[book_no].published,'>'].join('')
  $('#card-body-add').append($html);
  $('#modal_result_list').modal();
};

// Api開始
function StartSeachApi() {
  let searchOk = $( this ).prop( 'checked' )
  if (searchOk === true) {
    
    const search_text = $('input[name = "item_name"]').val();
    SearchApi(search_text);
  } else {
    '';
  }
};

// チェックボタンが入ったら検索開始
$( '#search_checkbox' ).on( 'change', StartSeachApi);

// modalを閉じた時、中身も削除
$('.modal_close').on('click', function () {
  $('.modal_title_list').remove();
})

//modal2(詳細)
$(document).on('click', '.modal_result', SearchResult);

// modal2を閉じた時、中身も削除
$('.modal_close_result').on('click', function () {
  $('.modal_result_list').remove();
});
