<?php
/** @var \App\Models\Post[] $posts */
?>
@section('title', $category->name)
@extends('layouts.ocean')
@section('head_title', $category->name)
@section('content')
    @include('ocean.parts.short_news', ['posts' => $posts])
    <div class="bottom-nav clr">
        {{ $posts->links() }}
    </div>
@endsection
