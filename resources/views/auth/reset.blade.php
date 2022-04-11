<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reset | ITIVA Admin</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="login">
    <div class="login-body">
        <img src="/img/logo.svg" alt="ITIVA" class="login-logo">
        <h1 class="h1">Reset password</h1>
        <form method="POST" action="{{ route('newPass') }}" class="login__form">
            @csrf
            <div class="form-group">
                <label for="email" class="label">E-mail</label>
                <input type="email" name="email" id="email" class="input" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
            <div class="login__form-group">
                <a href="/login" class="btn3">Back</a>
                <button type="submit" class="btn">Reset</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
