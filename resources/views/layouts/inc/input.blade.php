{{-- form部分 --}}
{{-- 繰り返しで使う連想配列内容 --}}
@php
$array = array (
  'item_name' => ['本のタイトル', 'text', 'タイトルを入力して下さい。入力後「Api検索」で「楽天検索」'],
  'book_tag' => ['ジャンル', 'checkbox' ],
  'item_amount' =>['金額', 'text', '金額を設定して下さい'],
  'published' => ['本公開日', 'date', '直接入力または、カレンダーアイコンより選択して下さい'],
  'item_img' => ['画像', '画像を選択して下さい']
);

@endphp

{{-- 新規登録か上書き保存かの判定 --}}
@if ( isset ( $book_one ) )

  @php if ( gettype( $book_one ) === "object") {
    $booklist = clone $book_one;
  } 
  else {
    $booklist = $book_one[0];
  }
  // 上書き保存のadd 画像inputタブの判別に使用
  $input_type = 'add';
  @endphp

  {{-- formの繰り返し 上書き保存--}}

  @foreach ( $array as $key => $value )
    @php $validate_line = '' @endphp
    <div class="card-title">
      {{ $value[0] }}
    </div>
    {{-- validateが発生した場合 そのformで表示 --}}
    <div>
      @if ( $errors->first( $key ) )
        @php $validate_line = 'border-color:red'; @endphp
        @foreach ( $errors->get($key) as $error ) 
          <div id="error_{{ $key }}" style="color: red;">{{ $error }}</div>
        @endforeach
      @endif
    </div>
    <div class="form-group">
      @php if ( $key === 'published' ) {
              $value_one = ( mb_substr ( $booklist['published'],0, 10 ) );
            } else {
              $value_one = $booklist[$key];
            } 
      @endphp

      @if ( $key != 'item_img' and $key != 'book_tag')
        <div class="col-sm-6">
          <input type={{ $value[1] }} name={{ $key }} class="form-control" value="{{ $errors->get($key)? old($value_one) : $value_one }}" style="{{ $validate_line }}">
        </div>

      @elseif( $key === 'book_tag')
        @foreach ( $tags as $key => $value )
          <label class="control-label" style="margin-left: 15px;">
            <input type="checkbox" name="book_tag[]" value="{{ $value['id'] }}"
            {{ in_array($value['id'], (array)$book_tag )? 'checked' : ''}}>
            {{ $value['tab'] }}
          </label>
        @endforeach
      @else
        {{-- file追加 --}}
        <div class="input-group col-sm-8 img-input">
          <div class="custom-file">
            <input 
              type="text" 
              class="custom-file-input" 
              id="inputFile_add" 
              name='item_img'
              value="{{ session('filename') ?? $booklist['img_name'] }}"
              data-session={{ session('filename') }}
              input_type = {{ $input_type }}
            >
            <label class="custom-file-label" for="inputFile_add" data-browse="参照" style={{ $validate_line }}>{{ session( 'filename' ) ?? $booklist['img_name'] }}</label>
          </div>
        </div>

          <span id='group-show'>
            <div class="d-inline-block mr-1 mt-4 ml-3">
              <img 
                class="img-thumbnail" 
                src="{{ session( 'filename' ) && session( 'filename' ) !== $booklist['img_name'] ? asset( 'temporary/'. session('filename') ) : $booklist['item_img'] }}" 
                title={{ $booklist['public_id'] }} 
                style="height:100px;" 
              />
              <div class="small text-muted text-center">{{ $booklist['img_name'] }}</div>
            </div>
          </span>

      @endif
    </div>
  @endforeach
  

  {{-- 新規登録 --}}

@else
  @php $input_type = 'new'; @endphp
  {{-- formの繰り返し --}}

  @foreach ($array as $key => $value)
    @php $validate_line = '' @endphp
    <div class="card-title">
      {{ $value[0] }}
    </div>
    <div>
      {{-- validateが発生した場合 そのformで表示 --}}
      @if ( $errors->first( $key ) )
        @php $validate_line = 'border-color:red' @endphp
        @foreach($errors->get( $key ) as $error)
          <div id="error_{{ $key }}" style="color: red;">{{ $error }}</div>
        @endforeach
      @endif
    </div>

    <div class="form-group">
      {{-- form本体 画面移管後も入力した内容は保持 --}}
      @if ( $key != 'item_img' and $key != 'book_tag' and $key != 'item_name')
        <div class="col-sm-6" data-toggle="tooltip" title="{{ $value[2] }}">
          <input type={{ $value[1] }} name={{ $key }} class="form-control" value="{{ old( $key )? old( $key ): "" }}" style={{ $validate_line }}>
        </div>

      @elseif ( $key === 'item_name' )
        <div class="col-sm-6 input-group" data-toggle="tooltip" data-trigger='hover' title="{{ $value[2] }}">
          <input type={{ $value[1] }} name={{ $key }} class="form-control" value="{{ old( $key )? old( $key ): ""  }}" style={{ $validate_line }} >
          <div class="text-right">
            <label class="search-label" style="margin: 15px;">
              <input type="checkbox" id="search_checkbox" style={{ $validate_line }} > Api検索
            </label>
          </div>
        </div>
      @elseif ( $key === 'book_tag')
        @foreach ( $tags as $key => $value )
          <label class="control-label" style="margin-left: 15px;">
            <input type="checkbox" name="book_tag[]" value="{{ $value['id'] }}" {{ in_array($value['id'], (array)old('book_tag') )? 'checked' : ''}}> {{ $value['tab'] }}
          </label>
        @endforeach
      @else
      {{-- file追加 --}}

        <div class="input-group col-sm-6 img-input" >
          <div class="custom-file" data-toggle="tooltip" data-trigger='hover' title="{{ $value[1] }}">
            <input 
              type="text" 
              class="custom-file-input" 
              id="inputFile_add" 
              name='item_img'
              value="{{ session('filename') ?? old( 'item_img' ) }}" data-session="{{ session('filename') }}"
              input_type = {{ $input_type }}
            >
            <label 
              class="custom-file-label" 
              for="inputFile_add" 
              data-browse="参照" 
              style={{ $validate_line }}
            >{{ old( 'item_img' )? '1個のファイルを選択しました': '画像を選択してください'}}</label>
          </div>
          <div class="input-group-append">
            <button type="button" class="btn btn-outline-secondary input-group-text" id="inputFileReset" style={{ $validate_line }}>取消</button>
          </div>
        </div>
        @if ( $html ) 
          {!! $html !!}
        @endif
      @endif
    </div>
  @endforeach
@endif
