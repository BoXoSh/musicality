<?php /** @var $artists \App\Models\Artist[] */ ?>
@foreach($artists as $artist)
    <div class="artist mb-3 col-md-3 col-6 col-sm-4">
        <a href="{{ route('artists.get-show', ['id' => $artist->id, 'slug' => $artist->url]) }}">
            <div style="" class="artist-img">
                <img src="{{ $artist->poster }}" alt="{{ $artist->name }}" class="img-fit">
            </div>
        </a>
        <div class="artist-title">
            <p class="artist-title"><a href="{{ route('artists.get-show', ['id' => $artist->id, 'slug' => $artist->url]) }}">{{ $artist->name }}</a>
            </p>
    </div>

    </div>
@endforeach