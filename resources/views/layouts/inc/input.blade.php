<!-- form部分 -->
<!-- 繰り返しで使う連想配列内容 -->

@php
$array = array (
  'item_name' => ['本のタイトル', 'text'],
  'item_number' => ['冊数', 'text'],
  'item_amount' =>['金額', 'text'],
  'published' => ['本公開日', 'date'],
); 
@endphp

<!-- 新規登録か上書き保存かの判定 -->

@if ( isset ( $book_one ) )

  <!-- formの繰り返し -->

  @foreach ( $array as $key => $value )
    @php $validate_line = '' @endphp
    <div class="card-title">
      {{ $value[0] }}
    </div>
    <div>

      <!-- validateが発生した場合 そのformで表示 -->

      @if ( $errors->first( $key ) )
        @php $validate_line = 'border-color:red' @endphp
        @foreach ( $errors->get( $key ) as $error) 
          <div style="color: red;">{{ $error }}</div>
        @endforeach
      @endif
    </div>
    <div class="form-group">
      <div class="col-sm-6">
        @php if ( $key === 'published' ) {
               $value_one = ( mb_substr ( $book_one[0]['published'],0, 10 ) );
             } else {
               $value_one = $book_one[0][$key];
             } 
        @endphp
        <input type={{ $value[1] }} name={{ $key }} class="form-control " value="{{ $value_one }}" style={{ $validate_line }}>
      </div>
    </div>
  @endforeach

  <!-- 新規登録 -->

@else

  <!-- formの繰り返し -->

  @foreach ($array as $key => $value)
    @php $validate_line = '' @endphp
    <div class="card-title">
      {{ $value[0] }}
    </div>
    <div>

      <!-- validateが発生した場合 そのformで表示 -->

      @if ( $errors->first( $key ) )
        @php $validate_line = 'border-color:red' @endphp
        @foreach($errors->get( $key ) as $error)
          <div style="color: red;">{{ $error }}</div>
        @endforeach
      @endif
    </div>
    <div class="form-group">

      <!-- form本体 画面移管後も入力した内容は保持 -->

      <div class="col-sm-6">
        <input type={{ $value[1] }} name={{ $key }} class="form-control " value="{{ old( $key ) }}" style={{ $validate_line }}>
      </div>
    </div>
  @endforeach
@endif