<?php
/** @var \App\Models\Post[] $last_posts */
?>
@section('title', 'Последные новинки')
@extends('layouts.frontend')
@section('content')
    <div class="section-title my-5">
        <h4>Последные новинки</h4>
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
            </article>
        @endforeach
    </div>
    <div class="my-4">
        {{ $last_posts->links() }}
    </div>

@endsection
