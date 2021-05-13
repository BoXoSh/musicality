<?php
/** @var \App\Models\Artist $artist */
?>
@section('title', $artist->name.' Скачать свежую музыку бесплатно')
@extends('layouts.ocean')
@section('content')
    <article class="article ignore-select">
        <div class="sect fmain">
            <div class="fcols fx-row">
                <div class="fimg img-fit">
                    <img src="{{ $artist->poster }}" alt="{{ $artist->name}}" style="border-radius: 100%"/>
                </div>
                <div class="fdesc fx-1">
                    <h1 style="margin-bottom: 5px" class="sect-title sect-header"><span>{{ $artist->name }}</span></h1>
                    <ul class="finfo">
                            <li><span>Название:</span> <span>{!! $artist->name !!}</span></li>
                            <li><span>Треков:</span> <span>{{ $artist->counttrack }}</span></li>
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
