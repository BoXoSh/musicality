<?php /** @var $albums \App\Models\Album[] */ ?>
@foreach($albums as $album)
    <div class="fimg img-fit">
        <a href="{{ route('albums.get-show', ['id' => $album->id, 'slug' => $album->url]) }}">
            <img src="{{ $album->poster }}" alt="{{ $album->name }}">
            <p>{{ $album->name }}</p>
        </a>
    </div>
@endforeach