<nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Pina-Pina-Telegram</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
            </ul>
            
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('pina')}}">ホーム</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pina.pet')}}">ペット</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pina.bird')}}">野鳥</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{ route('pina.bird')}}" data-bs-toggle="dropdown" aria-expanded="false">投稿</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.pina.create')}}">投稿画面</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.pina')}}">投稿一覧検索画面</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">プロフィール</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.profile.create')}}">プロフィール画面</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.profile.index')}}">プロフィール一覧検索画面</a></li>
                    </ul>
                </li>
                {{-- 以下を追記 --}}
                <!-- Authentication Links -->
                {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                @guest
                <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a></li>
                {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('messages.logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
                {{-- 以上までを追記 --}}
            </ul>
        </div>
    </div>
</nav>