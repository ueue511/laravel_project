<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Stacked-with-Books</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/custominput.js') }}" defer></script> --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/alert.js') }}" defer></script> --}}
    
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    <!-- editorjs関連 -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@quanzo/change-font-size@1.0.0"></script>--}}

    <!-- scrollbar -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vue2-perfect-scrollbar@1.4.0/dist/vue2-perfect-scrollbar.css">
    <script src="https://cdn.jsdelivr.net/npm/vue2-perfect-scrollbar@1.4.0/dist/vue2-perfect-scrollbar.umd.min.js"></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
  @yield( 'stackcontent' )
</body>
</html>