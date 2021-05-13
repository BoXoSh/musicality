<?php
/** @var \App\Models\Album[] $albums */
?>
@section('title', 'Албомы')
@extends('layouts.ocean')
@section('head_title', 'Последные новинки')
@section('content')

    <div class="row">
        @include('ocean.parts.album', ['albums' => $artists])
    </div>

    <div class="bottom-nav clr">
        {{ $albums->links() }}
    </div>

@endsection
