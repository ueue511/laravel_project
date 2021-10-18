<!-- resources/views/books.blade.php -->
@extends( 'layouts.app' )
@section( 'content' )
  <!-- Bootstrapの定型コード -->
  <div class="card-body">
    <!-- バリデーションエラーの表示に使用 -->
    {{-- @include('common.errors') --}}
    <!-- バリデーションエラーの表示に使用 -->

    <!-- book_one(詳細内容)の有無により表示内容を変更 -->

      @php if ( isset ( $book_one ) ) {
        $url = ( 'book/'.$book_one[0]->id );
        $date_button = 'add';
        $method = 'PUT';
      } else {
        $url = 'books';
        $date_button = 'save';
        $method = 'POST';
      };
      @endphp

    <!-- 本登録フォーム -->
    <form action="{{url($url)}}" method="POST" class="form-horizontal">
      @csrf
      @method ( $method )
      
      <!-- 本のinput -->
      @include('layouts.inc.input')

      <!-- 本 登録ボタン -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <button type="submit" class="btn btn-primary">
            {{ $date_button }}
          </button>
        </div>
      </div>
    </form>
  </div>
  
  <!-- Book: 既に登録されてる本のリスト -->
  <!-- 現在の本 -->
  @if (count($books) > 0)
    <div class="card-body">
      <div class="card-body">
        <table class="table table-striped task-table">
          
          <!-- テーブルヘッダ -->
          <thead>
            <th>本一覧</th>
            <th>&nbsp;</th>
          </thead>
          
          <!-- テーブル本体 -->
          <tbody>
            @foreach ( $books as $book )
            <tr>

              <!-- 本タイトル -->
              <td class="table-text">
                <div>{{ $book->item_name }}</div>
              </td>

              <!-- 本：詳細ボタン -->
              @php
                if ( isset ( $book_one ) && $book->id === $book_id ) {
                  $button_name = '表示';
                  $click_off = 'disabled';
                } else {
                  $button_name = '詳細';
                  $click_off = null;
                };
              @endphp
              <td>
                <form action="{{url('book/'.$book->id )}}" method="GET">
                  @csrf                <!-- CSRFからの保護 -->
                  @method( 'GET' )  <!-- 擬似フォームメソッド -->
                  <button type="submit" class="btn btn-danger alert-pop" {{ $click_off }}>
                    {{ $button_name }}
                  </button>
                </form>
              </td>

              <!-- 本：削除ボタン -->
              <td>
                <form action="{{url('book/'.$book->id .'/delete')}}" method="POST">
                  @csrf                <!-- CSRFからの保護 -->
                  @method( 'DELETE' ) <!-- 擬似フォームメソッド -->
                  <button type="submit" class="btn btn-danger">
                    削除
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endif
@endsection