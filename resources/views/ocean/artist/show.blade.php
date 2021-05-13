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
                    <h1 style="margin-bottom: 5px" class="sect-title sect-header"><span>{{ $album->name }}</span></h1>
                    <p style="margin-bottom: 15px">{!! $album->artistsurl !!}</p>
                    <ul class="finfo">
                            <li><span>Артисты:</span> <span>{!! $album->artistsurl !!}</span></li>
                            <li><span>Название:</span> <span>{!! $album->name !!}</span></li>
                            <li><span>Треков:</span> <span>{{ $album->counttrack }}</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="sect sect-bg">
{{--            <div class="sect-header sect-title">Песни</div>--}}
            <div class="sect-content">
                @include('ocean.parts.short_news', ['posts' => $posts])
            </div>
            <div class="bottom-nav clr">
                {{ $posts->links() }}
            </div>
        </div>
    </article>
@endsection
