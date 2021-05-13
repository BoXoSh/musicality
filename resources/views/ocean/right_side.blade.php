@php
    use Illuminate\Support\Facades\Cache;

    $popular_music = Cache::remember('right_side_popular_music', 7200, function (){
        return \App\Models\Post::query()
            ->select('dle_post.*')
            ->leftJoin('dle_post_extras', 'post.id', '=', 'dle_post_extras.news_id')
            ->orderByDesc('dle_post_extras.news_read')
            ->limit(10)
            ->get();
    });
@endphp
<aside class="col-right">
    <div class="side-box">
        <div class="side-bt">Популярные треки</div>
        <div class="side-bc side-items">
            @include('ocean.parts.custom_side', ['posts' => $popular_music])
        </div>
    </div>
</aside>