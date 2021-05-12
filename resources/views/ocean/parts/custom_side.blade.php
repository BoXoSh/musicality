@foreach($posts as $post)
    @php
    $xf = $post->xfields;
            @endphp
    <a class="side-item nowrap" href="{{ route('home.get_post', ['id'=> $post->id, 'alt_name' => $post->alt_name]) }}">
        <div class="nowrap">{{ $xf->get(config('xfields.artist_name')) }}</div>
        {{ $xf->get(config('xfields.song_name')) }}
    </a>
@endforeach
