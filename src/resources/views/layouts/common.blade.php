<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="https://use.typekit.net/zjr2bsf.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Andada+Pro:ital,wght@0,400..840;1,400..840&family=Gorditas:wght@400;700&family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                <a href="{{ route('index') }}" class="header__logo-link">FashionablyLate</a>
            </div>
            @hasSection('header-right')
            <div class="header__right">
                @yield('header-right')
            </div>
            @endif
        </div>
    </header>
    <main>
        <div class="form__content">
            <div class="form__heading">
                <h1 class="form__header">@yield('page_title')</h1>
            </div>
            @yield('content')
        </div>
    </main>
</body>

</html>