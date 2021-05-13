<?php
/** @var \App\Models\Post $post */

$xfields = $post->xfields;
$song_name = $xfields->get(config('xfields.song_name'));
$artist_name = $xfields->get(config('xfields.artist_name'));
$song_poster = $xfields->get(config('xfields.song_poster'));
if(empty($song_poster))
    $song_poster = '/ocean/images/no_image.jpg';

$mp3_url = $xfields->get(config('xfields.mp3_url'));
$youtube_id = $xfields->get(config('xfields.youtube_id'));
if ($youtube_id === '{id_youtube_0}')
    $youtube_id = null;
?>
@section('title', $post->title.' Скачать свежую музыку бесплатно')
@extends('layouts.ocean')
@section('content')
    <article class="article ignore-select">
        <div class="sect fmain">
            <div class="fcols fx-row">
                <div class="fimg img-fit">
                    <img src="{{ $song_poster }}" alt="{{ $song_name }}"/>
                </div>
                <div class="fdesc fx-1">
                    <h1 class="sect-title sect-header"><span>{{ $artist_name }}</span> - {{ $song_name }}</h1>
                    <ul class="finfo">
                        artist_name|Zivert||track_name|Life||name|{name}||description|{description}||artists_link|<a href="/artist/31-zivert.html">Zivert</a>||album_link|<a href="/album/42-vinyl-1.html">Vinyl #1</a>||music_link|/uploads/files/2021-05/1a1fadaec6fc2f06e9c5d5ffee5e1034_zivert-life.mp3||id_zvuk|65166794||id_album|9350408||id_artist|99662297||id_youtube_0|{id_youtube_0}||genre|Поп||poster|/uploads/posts/2021-05/1955a1f6d7c009166847d83df7bbb3c1_image.jpeg||image|https://cdn52.zvuk.com/pic?type=release&id=9350408&size=500x500&ext=jpg||duration|3:8||size|7.5||year|2019||album_name|Vinyl #1

                        <li><span>Артисты:</span> <span>{{ $xfields->get(config('xfields.artists_url')) }}</span></li>
                        <li><span>Альбом:</span> <span>{{ $xfields->get(config('xfields.album_url')) }}</span></li>
                        <li><span>Размер:</span> <span>{{ $xfields->get(config('xfields.song_filesize')) }} MB</span></li>
                        <li><span>Длительность:</span> <span>{{ $xfields->get(config('xfields.song_duration')) }}</span></li>
                        <li><span>Год:</span> <span>{{ $xfields->get(config('xfields.song_year')) }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="fbtm fx-row js-item" data-track="{{ $mp3_url }}" data-title="{{ $song_name }}"
                 data-artist="{{ $artist_name }}" data-img="{{ $song_poster }}">
                <div class="fdl fplay js-play">
                    <span class="fas fa-play"></span> Слушать
                </div>
                <a href="{{ $mp3_url }}" class="fdl" target="_blank" download>
                    <span class="fal fa-arrow-circle-down"></span> Скачать
                </a>
                <div class="fcaption fx-1">
                    <div>На этой странице Вы можете <b>скачать песню {{ $post->title }}</b>!.
                        Слушайте онлайн в хорошем качестве, со своего телефона на Android, iphone или пк в любое время.
                    </div>
                </div>
            </div>
        </div>

        @if($youtube_id)
            <div class="sect sect-bg">
                <div class="sect-header sect-title">Клип на песню</div>
                <div class="sect-content video-box">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $youtube_id }}" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
            </div>
        @endif
            <div class="sect sect-bg">
                <div class="sect-header sect-title">Текст песни</div>
                <div class="sect-content ftext full-text clearfix">
                    {!! $post->full_story !!}
                </div>
            </div>

            <div class="sect sect-bg">
                <div class="sect-header sect-title">Похожие песни</div>
                <div class="sect-content">
                    @include('ocean.parts.short_news', ['posts' => $related_posts])
                </div>
            </div>
    </article>
@endsection
