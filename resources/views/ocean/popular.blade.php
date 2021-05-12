<?php
/** @var \App\Models\Post[] $last_posts */
?>
@section('title', 'Популярные песни')
@extends('layouts.ocean')
@section('head_title', 'Популярные песни')
@section('content')
    @include('ocean.parts.short_news', ['posts' => $last_posts])
    <div class="bottom-nav clr">
        {{ $last_posts->links() }}
    </div>
@endsection
