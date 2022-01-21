    <div class="content">
    <header class="header">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ Auth::user() ? url('/book') : url('/')}}">
                    SWB
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if ( Auth::user()->role === "admin" )
                                    <a class="dropdown-item" href="{{ route('top.contact') }}">
                                        管理画面
                                    </a>
                                @endif
                                    <a class="dropdown-item" href="{{ route('stacked.home') }}">
                                        詳細
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
        <div id='app'>
            @if( \Route::current()->getName() === 'stacked.home' ) 
                <example-login-home></example-login-home>
                <example-front></example-front>
                <example-search></example-search>
                <example-resulttitle></example-resulttitle>
                <example-result 
                  v-bind:good_id = "{{ json_encode($goodid) }}"
                  v-bind:bookmark_id = "{{ json_encode($bookmarkid) }}"
                >
                </example-result>
                <example-footer></example-footer>
            @endif
            @if( \Route::current()->getName() === 'stacked.detail' )
                <example-detail-home></example-detail-home>
                <example-detail-result v-bind:bookone = "{{ $books }}"></example-detail-result>
                <example-footer></example-footer>
            @endif
            @if( \Route::current()->getName() === 'stacked.before.home' )
                <example-home></example-home>
                <example-home-before></example-home-before>
                <example-front-before></example-front-before>
                <example-footer></example-footer>
            @endif
        </div>
    </div>