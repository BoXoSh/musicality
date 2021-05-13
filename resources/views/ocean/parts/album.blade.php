<?php /** @var $albums \App\Models\Album[] */ ?>
@foreach($albums as $album)
    <div class="album col-md-3 col-6 col-sm-4">
        <a href="{{ route('albums.get-show', ['id' => $album->id, 'slug' => $album->url]) }}">
            <img src="{{ $album->poster }}" alt="{{ $album->name }}" class="img-fit fimg">
        </a>
        <p class="album-title"><a
                    href="{{ route('albums.get-show', ['id' => $album->id, 'slug' => $album->url]) }}">{{ $album->name }}</a>
        </p>
        <p class="album-artist">
            {{ $album->artist_name }}
        </p>
    </div>
@endforeach