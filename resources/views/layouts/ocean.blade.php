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
    <link rel="preload" href="/ocean/css/styles.min.css" as="style">
    <link rel="preload" href="/ocean/css/bootstrap/bootstrap-grid.min.css" as="style">

    <link rel="preload" href="/ocean/js/jquery.js" as="script">
    <link rel="preload" href="/ocean/js/libs.min.js" as="script">
{{--    <link rel="preload" href="/ocean/css/fonts.min.css" as="style">--}}
    <link rel="preload" href="/ocean/webfonts/fa-light-300.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/ocean/webfonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>
    <link href="/ocean/css/styles.min.css?t={{ filemtime(public_path('/ocean/css/styles.css')) }}" type="text/css" rel="stylesheet" />
{{--    <link href="/ocean/css/fonts.min.css" type="text/css" rel="stylesheet" />--}}
{{--    <link href="/ocean/css/engine.css?t={{ filemtime(public_path('/ocean/css/engine.css')) }}" type="text/css" rel="stylesheet" />--}}
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
                <li><a href="/novinki"><span class="fal fa-compact-disc"></span>Новинки</a></li>
                <li class="submenu">
                    <a href="#"><span class="fal fa-list-music"></span>Жанры</a>
                    <ul class="hidden-menu anim">
                        <li><a href="/genre/Русский рэп">Русский рэп</a></li>
                        <li><a href="/genre/K-Pop">K-Pop</a></li>
                        <li><a href="/genre/Поп">Поп-музыка</a></li>
                        <li><a href="/genre/Из видеоигр">Из видеоигр</a></li>
                        <li><a href="/genre/Диджей-миксы">Диджей-миксы</a></li>
                        <li><a href="/genre/Премия МУЗ-ТВ">Премия МУЗ-ТВ</a></li>
                        <li><a href="/genre/Релакс">Релакс</a></li>
                        <li><a href="/genre/Рок">Рок</a></li>
                        <li><a href="/genre/Тренировка">Тренировка</a></li>
                        <li><a href="/genre/Метал">Метал</a></li>
                        <li><a href="/genre/Хип-хоп">Хип-хоп</a></li>
                        <li><a href="/genre/Cаундтреки">Cаундтреки</a></li>
                        <li><a href="/genre/Вечеринка">Вечеринка</a></li>
                        <li><a href="/genre/Мотивация">Мотивация</a></li>
                        <li><a href="/genre/Хиты по годам">Хиты по годам</a></li>
                        <li><a href="/genre/Электроника">Электроника</a></li>
                        <li><a href="/genre/Альтернатива">Альтернатива</a></li>
                        <li><a href="/genre/Русский шансон">Русский шансон</a></li>
                        <li><a href="/genre/R&B и фанк">R&B и фанк</a></li>
                        <li><a href="genre/Классическая">Классическая</a></li>
                        <li><a href="/genre/В дорогу">В дорогу</a></li>
                        <li><a href="/genre/Грустно">Грустно</a></li>
                        <li><a href="/genreДжаз">Джаз</a></li>
                        <li><a href="/genre/Блюз">Блюз</a></li>
                        <li><a href="/genre/9 мая"></a>9 мая</li>
                    </ul>
                </li>
                <li><a href="/artists"><span class="fal fa-user-music"></span>Исполнители</a></li>
                <li><a href="#"><span class="fal fa-album-collection"></span>Сборники</a></li>
                <li><a href="/genre/Детская"><span class="fal fa-child"></span>Детские песни</a></li>
                <li><a href="/albums"><span class="fal fa-album"></span>Альбомы</a></li>
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
<script src="/ocean/js/libs.min.js"></script>
@yield('scripts')
</body>
</html>
<?php
