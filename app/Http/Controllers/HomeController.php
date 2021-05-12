<?php


namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function getTest()
    {
        Post::query()
            ->select('post.*')
            ->leftJoin('post_extras', 'post_extras.news_id', '=', 'post.id')
            ->where('post_extras.news_read', '<', '50')
            ->whereDate('post.date', '<', '2021-01-01')
            ->limit(100)
            ->chunk(200, function ($lastPosts){
                foreach ($lastPosts as $lastPost) {
                    $lastPost->delete();
                }
            });
    }

    public function getIndex(Request $request)
    {
        $lastPosts = Post::query()
            ->orderByDesc('id')
            ->paginate(15);

        return view('welcome', [
            'last_posts' => $lastPosts
        ]);
    }

    public function getPost($id, $alt_name)
    {
        $post = Post::query()
            ->where('id', $id)
            ->where('alt_name', $alt_name)
            ->firstOrFail();

        $dbPrefix= env('DB_PREFIX', '');
        DB::update("UPDATE `".$dbPrefix."post_extras` SET `news_read` = `news_read`+1 WHERE `news_id` = ?", [$post->id]);

        return view('view', [
            'post' => $post
        ]);
    }

    public function getLastNews()
    {
        $lastPosts = Post::query()
            ->orderByDesc('id')
            ->paginate(15);

        return view('lastnews', [
            'last_posts' => $lastPosts
        ]);
    }

    public function getPopular()
    {
        $lastPosts = \App\Models\Post::query()
            ->select('post.*')
            ->leftJoin('post_extras', 'post.id', '=', 'post_extras.news_id')
            ->orderByDesc('post_extras.news_read')
            ->paginate(15);

        return view('popular', [
            'last_posts' => $lastPosts
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $lastPosts = Post::query()
            ->selectRaw('dle_post.*, MATCH (dle_post.title, dle_post.short_story, dle_post.full_story, dle_post.xfields) AGAINST (?) as score', [$query])
            ->whereRaw('MATCH (title, short_story, full_story, xfields) AGAINST (?)', [$query])
            ->orderByDesc('score')
            ->paginate(15);

        return view('search', [
            'last_posts' => $lastPosts
        ]);
//        MATCH (title, short_story, full_story, xfields) AGAINST ('{$body}')
    }
}
