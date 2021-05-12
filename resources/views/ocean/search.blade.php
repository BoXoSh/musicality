<?php
/** @var \App\Models\Post[] $last_posts */
?>
@section('title', 'Поиск')
@extends('layouts.ocean')
@section('head_title', 'Поиск: '.request('query', ''))
@section('content')
    @include('ocean.parts.short_news', ['posts' => $last_posts])
    <div class="bottom-nav clr">
        {{ $last_posts->links() }}
    </div>

@endsection
