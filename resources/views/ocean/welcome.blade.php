<?php
/** @var \App\Models\Post[] $last_posts */
?>
@section('title', 'Последние громкие новинки в формате mp3')
@extends('layouts.ocean')

@section('content')
    <h1 class="sect-title sect-header">Новые песни 2021</h1>
    <div class="posts">
        @include('ocean.parts.short_news', ['posts' => $last_posts])
    </div>
    <!--noindex-->
    <div class="bottom-nav clr ignore-select">
        <div class="nav-load">
            <a href="{{ route('home.lastnews') }}" class="pagi-load1">Посмотреть все</a>
        </div>
    </div>
    <!--/noindex-->
@endsection