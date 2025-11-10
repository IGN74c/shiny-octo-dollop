<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">Демо экзамен</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Главная</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.index') }}">Заявки</a>
                            </li>
                            @if(auth()->user()->isAdmin)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.index') }}">Админ панель</a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <ul class="d-flex gap-3">
                        @auth
                            <a class="btn btn-outline-primary" href="{{ route('logout') }}">Выход</a>
                        @else
                            <a class="btn btn-outline-primary" href="{{ route('login') }}">Вход</a>
                            <a class="btn btn-primary" href="{{ route('register') }}">Регистрация</a>
                        @endauth
                    </ul>

                </div>
            </div>
        </nav>
        @yield('content')
    </div>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>