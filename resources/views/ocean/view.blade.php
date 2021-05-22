<?php
/** @var \App\Models\Post $post */

$xfields = $post->xfields;
$song_name = $xfields->get(config('xfields.song_name'));
$artist_name = $xfields->get(config('xfields.artist_name'));
$artists_url = str_replace('\"', '"', $xfields->get(config('xfields.artists_url')));
$song_poster = $xfields->get(config('xfields.song_poster'));
if (empty($song_poster))
    $song_poster = '/ocean/images/no_image.jpg';

$mp3_url = $xfields->get(config('xfields.mp3_url'));
$youtube_id = $xfields->get(config('xfields.youtube_id'));
if ($youtube_id === '{id_youtube_0}')
    $youtube_id = null;

$genres = $xfields->get('genre');
if (!empty($genres))
    $genres = implode(', ', getGenreUrl($genres));

$albom_url = $xfields->get(config('xfields.album_url'));


$filesize = $xfields->get(config('xfields.song_filesize'));

if(stripos($filesize, "MB") === false)
    $filesize .= " MB"


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
                    <h1 class="sect-title sect-header"><span>{!! $artists_url !!}</span> - {{ $song_name }}</h1>
                    <ul class="finfo">
                        <li><span>Артисты:</span> <span>{!! $artists_url !!}</span></li>
                        @if(!empty($albom_url))
                            <li><span>Альбом:</span> <span>{!! $albom_url !!}</span></li>
                        @endif
                        @if(!empty($genres))
                            <li><span>Жанры:</span> <span>{!! $genres !!}</span></li>
                        @endif

                        <li><span>Размер:</span> <span>{{ $filesize }}</span></li>
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
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $youtube_id }}"
                            frameborder="0"
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
