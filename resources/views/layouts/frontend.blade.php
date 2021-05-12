<?php
use Illuminate\Support\Facades\Route;

$popular_music = \App\Models\Post::query()
    ->select('post.*')
    ->leftJoin('post_extras', 'post.id', '=', 'post_extras.news_id')
    ->orderByDesc('post_extras.news_read')
    ->limit(10)
    ->get();

$routeName = Route::currentRouteName(); // string
?>
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QF09LM4YME"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-QF09LM4YME');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="/fontawesome/css/all.min.css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <title>@yield('title')</title>
    @yield('styles')
</head>
<body>
<header id="header" class="header">
    <div class="top-wrap">
        <div class="container">
            <div class="row">
                <div id="logo" class="logo">
                    <h1><a href="/">Muzt.net</a></h1>
                    <h4>Последние громкие новинки песни в формате mp3</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="header-wrap py-3" style="background: rgba(0,0,0,0.04)">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-light ">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0 col-md-8">
                                <li class="nav-item">
                                    <a class="nav-link {{ $routeName === "home.index" ? 'active' : "" }}" href="{{ route('home.index') }}">Главная</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $routeName === "home.lastnews" ? 'active' : "" }}" href="{{ route('home.lastnews') }}">Новинки</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ $routeName === "home.popular" ? 'active' : "" }}" href="{{ route('home.popular') }}">Популярные</a>
                                </li>
                            </ul>
                            <div class="search-wrap col-md-4">
                                <form action="/search" id="searchform" class="search-form" method="get" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Название исполнителя или песни"
                                               aria-label="Название исполнителя или песни" name="query" value="{{ request('query', '') }}" required>
                                        <button type="submit" class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div><!-- /.search-wrap -->
                        </div>
                </nav>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
</header>
<main id="main">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-7">
                @yield('content')
            </div>
            <div class="col-md-4">
                <div class="most-popular p-4 border mt-5">
                    <div class="section-title mb-4">
                        <h5><a class="text-danger" href="{{ route('home.lastnews') }}">Популярные</a></h5>
                    </div>
                    <div class="posts">
                        <ul class="list-unstyled">
                            @foreach($popular_music as $post)
                                <li>
                                    <div class="order">{{ $loop->iteration }}</div>
                                    <p>
                                        <a href="{{ route('home.get_post', ['id'=> $post->id, 'alt_name' => $post->alt_name]) }}">{{ $post->title }}</a>
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<footer class="footer mt-5 py-4 bg-light">
    <div class="container">
        <span class="text-muted">Muzt.net - Музыкальные новинки<br>Вопросы, жалобы и сотрудничество: <strong>admin@muzt.net</strong></span>
    </div>
</footer>
{{--<script src="/js/bootstrap.bundle.min.js"></script>--}}
<script src="/js/bootstrap.min.js"></script>
@yield('scripts')
</body>
</html>
