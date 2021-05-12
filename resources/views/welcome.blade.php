<?php
/** @var \App\Models\Post[] $last_posts */
?>
@section('title', 'Последние громкие новинки в формате mp3')
@extends('layouts.frontend')

@section('content')
    <div class="section-title mt-5 mb-4">
        <h4><a class="text-danger" href="{{ route('home.lastnews') }}">Последние</a></h4>
    </div>
    <div class="posts">
        @foreach($last_posts as $post)
            <article class="music row py-2">
                <div class="col-10">
                    <h5 class="music-title">
                        <a href="{{ route('home.get_post', ['id'=> $post->id, 'alt_name' => $post->alt_name]) }}">{{ $post->title }}</a>
                    </h5>
                </div>
                <div class="col-2 text-end">
                    <span class="music-duration">{{ $post->xfields->get('mp3_duration', '') }}</span>
                </div>
{{--                <div class="col-1 text-end">--}}
{{--                    <span class="download"><a href="{{ $post->xfields->get('orginal', '/') }}"><i class="fas fa-save"></i></a></span>--}}
{{--                </div>--}}
            </article>
        @endforeach
    </div>
    <div class="py-3 d-block text-center">
        <a href="{{ route('home.lastnews') }}" class="btn btn-light btn-lg">Посмотреть все</a>
    </div>
@endsection
