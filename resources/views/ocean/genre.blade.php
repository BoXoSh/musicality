<?php
/** @var \App\Models\Post[] $last_posts */
?>
@section('title', $title.' песни')
@extends('layouts.ocean')
@section('head_title', $title.' песни')
@section('content')
    @include('ocean.parts.short_news', ['posts' => $posts])
    <div class="bottom-nav clr">
        {{ $posts->links() }}
    </div>
@endsection
