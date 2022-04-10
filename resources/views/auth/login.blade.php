<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login | ITIVA Admin</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="login">
            <div class="login-body">
                <img src="/img/logo.svg" alt="ITIVA" class="login-logo">
                <h1 class="h1">Login</h1>
                <form method="POST" action="{{ route('login') }}" class="login__form">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="label">E-mail</label>
                        <input type="email" name="email" id="email" class="input" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password" class="label">Password</label>
                        <input type="password" name="password" id="password" class="input" value="{{ old('password') }}" required autocomplete="current-password" autofocus>
                    </div>
                    <div class="login__form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                        <div class="login__form-group-remember">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
