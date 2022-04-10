<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | ITIVA Admin</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <header class="header">
                <a href="{{ url('/') }}" class="header__logo">
                    <img src="/img/logo.svg" alt="ITIVA" class="header__logo-img">
                </a>
                <nav class="header__nav">
                    @guest

                    @else
                        <p class="header__nav-user">{{ Auth::user()->name }}</p>
                        <a href="{{ route('logout') }}" class="header__nav-btn btn"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                            @csrf
                        </form>
                    @endguest
                </nav>
            </header>

            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>
