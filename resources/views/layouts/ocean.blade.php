<?php
use Illuminate\Support\Facades\Route;



$routeName = Route::currentRouteName(); // string
?>
        <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#061d24">
    <link rel="shortcut icon" href="/ocean/images/logo.svg" />
    <link rel="preload" href="/ocean/css/styles.css" as="style">
{{--    <link rel="preload" href="/ocean/css/engine.css" as="style">--}}
    <link rel="preload" href="/ocean/webfonts/fa-light-300.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/ocean/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>
    <link href="/ocean/css/styles.css?t={{ filemtime(public_path('/ocean/css/styles.css')) }}" type="text/css" rel="stylesheet" />
    <link href="/ocean/css/engine.css?t={{ filemtime(public_path('/ocean/css/engine.css')) }}" type="text/css" rel="stylesheet" />
    <link href="/ocean/css/bootstrap/bootstrap-grid.min.css?t={{ filemtime(public_path('/ocean/css/bootstrap/bootstrap-grid.min.css')) }}" type="text/css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,800&display=swap&subset=cyrillic" rel="stylesheet">

    <title>@yield('title')</title>
    @yield('styles')
</head>
<body>
<div class="wrap">

    <header class="header wrap-center fx-row fx-middle">
        <a href="/" class="logo">
            MUZ<span>.ASIA</span>
            <div>Музыкальный океан</div>
        </a>
        <div class="search-wrap fx-1">
            <form action="/search" id="searchform" class="search-form" method="get" role="search">
                <div class="search-box">
                    <input value="{{ request('query', '') }}" name="query" placeholder="Поиск по сайту..." type="text" />
                    <button type="submit" class="search-btn"><span class="fal fa-search"></span></button>
                </div>
            </form>
        </div>
        <div class="hshare fx-row">
            <span class="wbr-fb" data-id="fb"></span>
            <span class="wbr-vk" data-id="vk"></span>
            <span class="wbr-ok" data-id="ok"></span>
            <span class="wbr-tw" data-id="tw"></span>
            <span class="wbr-tlg" data-id="tlg"></span>
        </div>
        <div class="btn-menu hidden"><span class="fal fa-bars"></span></div>
    </header>

    <!-- END HEADER -->

    <div class="wrap-main wrap-center">

        <nav class="nav to-mob">
            <ul class="main-nav fx-row">
                <li class="submenu">
                    <a href="#"><span class="fal fa-list-music"></span>Жанры</a>
                    <ul class="hidden-menu anim">
                        <li><a href="#">Поп</a></li>
                        <li><a href="#">Зарубежный рэп</a></li>
                        <li><a href="#">Шансон</a></li>
                        <li><a href="#">Русский рэп</a></li>
                        <li><a href="#">House</a></li>
                        <li><a href="#">Deep House</a></li>
                        <li><a href="#">Танцевальная</a></li>
                        <li><a href="#">Русский рок</a></li>
                        <li><a href="#">Рейв</a></li>
                        <li><a href="#">Зарубежный рок</a></li>
                        <li><a href="#">Электронная</a></li>
                        <li><a href="#">Drum-n-Bass</a></li>
                        <li><a href="#">Lounge</a></li>
                        <li><a href="#">Джаз</a></li>
                        <li><a href="#">Webrambo</a></li>
                    </ul>
                </li>
                <li><a href="#"><span class="fal fa-compact-disc"></span>Хиты</a></li>
                <li><a href="#"><span class="fal fa-trophy"></span>Топ 100</a></li>
                <li><a href="#"><span class="fal fa-dumbbell"></span>Тренировки</a></li>
                <li><a href="#"><span class="fal fa-glass-cheers"></span>Новогодние</a></li>
                <li><a href="#"><span class="fal fa-tire"></span>В машину</a></li>
                <li><a href="#"><span class="fal fa-folders"></span>Подборки</a></li>
                <li><a href="#"><span class="fal fa-album-collection"></span>Альбомы</a></li>
                <li><a href="#"><span class="fal fa-radio"></span>Радио</a></li>
            </ul>
        </nav>

        <!-- END NAV -->

        <div class="cols fx-row">

            <main class="col-main fx-1" id="wajax">
                <div class="sect">
                    @hasSection('head_title')
                    <h1 class="sect-header sect-title">@yield('head_title')</h1>
                    @endif
                    <div class="sect-content">@yield('content')</div>
                </div>
            </main>

            <!-- END COL-MAIN -->

            @include('ocean.right_side')

            <!-- END COL-RIGHT -->

        </div>

        <!-- END COLS -->

        <div class="site-desc fx-row fx-middle">
            <div class="logo">
                MUZ<span>.ASIA</span>
                <div>Музыкальный океан</div>
            </div>
            <div class="site-desc-in fx-1">
                ООО «АдвМьюзик» заключил лицензионные соглашения
                <br>с крупнейшими российскими правообладателями авторских и смежных прав. <a href="#">Подробнее</a>
                <div class="site-copyright">© {{ config('app.name') }} 2021. Почта для правообладателей: <span>mp3ocean@gmail.com</span></div>
            </div>
        </div>

    </div>

    <!-- END WRAP-MAIN -->

    <footer class="footer fx-row fx-middle wrap-center">
        <ul class="footer-menu fx-row fx-start fx-1">
            <li><a href="#">Контакты</a></li>
            <li><a href="#">Правила</a></li>
            <li><a href="#">О портале</a></li>
        </ul>
        <div class="footer-counter"></div>
        <div id="gotop"><span class="fal fa-arrow-up"></span></div>
    </footer>

    <!-- END FOOTER -->

</div>

<!-- END WRAP -->
<script src="/ocean/js/jquery.js"></script>
<script src="/ocean/js/libs.js"></script>
@yield('scripts')
</body>
</html>
<?php
