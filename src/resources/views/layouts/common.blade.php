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
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header__logo">
                <a href="/" class="header__logo-link">FashionablyLate</a>
            </div>
            @hasSection('header-right')
            <div class="header__right">
                @yield('header-right')
            </div>
            @endif
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>