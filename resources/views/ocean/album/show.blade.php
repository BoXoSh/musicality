<?php
/** @var \App\Models\Album $album */

?>
@section('title', $album->name.' Скачать свежую музыку бесплатно')
@extends('layouts.ocean')
@section('content')
    <article class="article ignore-select">
        <div class="sect fmain">
            <div class="fcols fx-row">
                <div class="fimg img-fit">
                    <img src="{{ $album->poster }}" alt="{{ $album->name}}"/>
                </div>
                <div class="fdesc fx-1">
                    {{--                    <h1 class="sect-title sect-header"><span>{{ $artist_name }}</span> - {{ $song_name }}</h1>--}}
                    <ul class="finfo">
                        {{--                        <li><span>Слушали:</span> <span>{{ $album->extras->news_read }}</span></li>--}}
                        {{--                        <li><span>Размер:</span> <span>{{ $xfields->get(config('xfields.song_filesize')) }} MB</span></li>--}}
                        {{--                        <li><span>Длительность:</span> <span>{{ $xfields->get(config('xfields.song_duration')) }}</span></li>--}}
                        {{--                        <li><span>Год:</span> <span>{{ $xfields->get(config('xfields.song_year')) }}</span></li>--}}
                        {{--                        <li><span>Дата релиза:</span> <span>{{ $album->date->format('d F Y') }}</span></li>--}}
                    </ul>
                </div>
            </div>
        </div>

        <div class="sect sect-bg">
            <div class="sect-header sect-title">Песни</div>
            <div class="sect-content">
                @include('ocean.parts.short_news', ['posts' => $posts])
            </div>
            <div class="bottom-nav clr">
                {{ $posts->links() }}
            </div>
        </div>
    </article>
@endsection
