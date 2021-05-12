<?php
/** @var \App\Models\Post $post */

$xfields = $post->xfields;
?>
@section('title', $post->title.' Скачать свежую музыку бесплатно')
@extends('layouts.frontend')
@section('content')
    <div class="post-container my-5">
        <article class="post">
            <div class="post-head">
                <h1>{{ $post->title }}</h1>
                <p class="text-muted">Скачать песню {{ $post->title }} или слушать онлайн</p>
                <div class="activity text-muted d-block">
                    <span class="post-date">{{ $post->date->format('d-m-Y') }}</span>
                    <span class="post-views">{{ $post->extras->news_read }}</span>
                </div>
            </div>
            <div class="music-download my-3 row" style="background-color: #f7f7f7;padding:15px 20px">
                <div class="col-lg-8">
                    <div class="small">Скачать песню {{ $post->title }} mp3 бесплатно<br>(битрейт: {{ $xfields->get('mp3_quality', 320) }} кбит/с, продолжительность: {{ $xfields->get('mp3_duration', '00:00') }}, размер: {{ $xfields->get('mp3_mb', 0) }} мб)</div>
                </div>
                <div class="col-lg-4 mt-3 mt-lg-0 text-end">
                    <a target="_blank" href="{{ $xfields->get('mp3_path', '/') }}" class="btn btn-danger px-5 w-100" rel="nofollow">Скачать</a>
                </div>
            </div>
            <div class="post-body">
                <div class="post-lyrics py-3">
                    <h5>Текст песни</h5>
                    <p class="small text-muted">Слова {{ $post->title }} для караоке</p>
                    <p>{!! $post->full_story !!}</p>
                </div>
            </div>
        </article>
    </div>
@endsection
