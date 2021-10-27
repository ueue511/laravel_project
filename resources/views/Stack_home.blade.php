@extends( 'layouts.inc.head' )
@section( 'stackcontent' )
  @include( 'layouts.inc.header' )
  <div><example-front v-bind:books='$books'></example-front></div>
@endsection

