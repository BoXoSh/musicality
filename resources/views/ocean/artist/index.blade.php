<?php
/** @var \App\Models\Album[] $albums */
?>
@section('title', 'Албомы')
@extends('layouts.ocean')
@section('head_title', 'Последные новинки')
@section('content')

    <div class="row">
        @include('ocean.parts.artist', ['artists' => $artists])
    </div>

    <div class="bottom-nav clr">
        {{ $artists->links() }}
    </div>

@endsection
