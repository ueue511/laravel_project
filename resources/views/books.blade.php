{{-- resources/views/books.blade.php --}}
@extends( 'layouts.app' )
@section( 'content' )
  {{-- Bootstrapの定型コード --}}
  <div class="card-body" id="book-form">
    {{-- バリデーションエラーの表示に使用 --}}
    {{-- @include('common.errors') --}}
    {{-- バリデーションエラーの表示に使用 --}}

    {{-- book_one(詳細内容)の有無により表示内容を変更 --}}
    {{-- @php ddd(gettype($book_one)); @endphp --}}
      @php if ( isset ( $book_one ) ) {
        if ( gettype($book_one) === 'object') {
          $url = ( '/admin/book/'. $book_one->id );
        } elseif ( gettype($book_one) === 'array') {
          $url = ( '/admin/book/'. $book_one[0]->id );
        }
        $date_button = 'add';
        $method = 'put';
        $reset_button = 'reset';
      } else {
        $url = 'books';
        $date_button = 'save';
        $method = 'post';
      };
      @endphp

    {{-- 本登録フォーム --}}
    <form enctype="multipart/form-data" action="{{ url($url) }}" method="POST" class="form-horizontal">
      @csrf
      @method( $method )
      
      {{-- 本のinput --}}
      @include('layouts.inc.input')

      {{-- 本 登録ボタン --}}
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6 ">
          <button type="submit" class="btn btn-primary">
            {{ $date_button }}
          </button>
          @if( isset($reset_button) )
            <a href={{ url($url) }} class="btn  btn-warning reset_button" role="button">
              reset
            </a>
          @endif
        </div>
      </div>
    </form>
  </div>
  
  {{-- Book: 既に登録されてる本のリスト --}}
  {{-- 現在の本 --}}
  @if (count($books) > 0)
    <div class="card-body">
      <div class="card-body">
        <table class="table table-striped task-table">
          
          {{-- テーブルヘッダ --}}
          <thead>
            <th>本一覧</th>
            <th>&nbsp;</th>
          </thead>
          
          {{-- テーブル本体 --}}
          <tbody>
            @foreach ( $books as $book )
            <tr>

              {{-- 本タイトル --}}
              <td class="table-text">
                <div>{{ $book->item_name }}</div>
                <div> <img src="{{ $book['item_img']  }}" width="100" alt="no_img"></div>
              </td>

              {{-- 本：詳細ボタン --}}
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
                <form action="{{url( 'admin/book/'.$book->id )}}" method="GET">
                  @csrf                {{-- CSRFからの保護 --}}
                  @method( 'GET' )  {{-- 擬似フォームメソッド --}}
                  <button type="submit" class="btn btn-info alert-pop" {{ $click_off }}>
                    {{ $button_name }}
                  </button>
                </form>
              </td>

              {{-- 本：削除ボタン --}}
              <td>
                <form action="{{url('book/'.$book->id .'/delete')}}" method="POST">
                  @csrf                {{-- CSRFからの保護 --}}
                  @method( 'DELETE' ) {{-- 擬似フォームメソッド --}}
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
    <div class="row">
      <div class="col-md-4 offset-md-4">
        {{ $books->links() }}
      </div>
    </div>
  @endif
@endsection