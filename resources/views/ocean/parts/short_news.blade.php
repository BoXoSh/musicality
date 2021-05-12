@foreach($posts as $post)
    @php
        $xf = $post->xfields;
        $song_name = $xf->get(config('xfields.song_name'));
        $artist_name = $xf->get(config('xfields.artist_name'));
        $song_poster = $xf->get(config('xfields.song_poster'));
        if(empty($song_poster))
            $song_poster = '/ocean/images/no_image.jpg';
    @endphp
<div class="track-item fx-row fx-middle js-item" data-track="{{ $xf->get(config('mp3_url')) }}" data-title="{{ $song_name }}" data-artist="{{ $artist_name }}" data-img="{{ $song_poster }}">
    <div class="track-play fx-col fx-center anim js-play"><span class="fas fa-play"></span></div>
    <a class="track-desc fx-1 nowrap" href="{{ route('home.get_post', ['id'=> $post->id, 'alt_name' => $post->alt_name]) }}">
        <div class="track-title">{{ $song_name }}</div>
        <div class="track-subtitle">{{ $artist_name }}</div>
    </a>
    <div class="track-time">{{ $xf->get(config('song_duration')) }}</div>
</div>
@endforeach