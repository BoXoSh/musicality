<?php


namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Cache};

class HomeController extends Controller
{
    public function getIndex(Request $request)
    {
        $lastPosts = Cache::remember('idx_last_posts', 7200, function () {
            return Post::query()->orderByDesc('id')->paginate(15);
        });


        return $this->view('welcome', [
            'last_posts' => $lastPosts
        ]);
    }

    public function getPost($id, $alt_name)
    {
        $post = Post::query()
            ->where('id', $id)
            ->where('alt_name', $alt_name)
            ->firstOrFail();

        $related_posts = Post::query()->where('category', $post->category)->where('id', '!=', $post->id)->inRandomOrder()->limit(5)->get();

        DB::update("UPDATE `dle_post_extras` SET `news_read` = `news_read`+1 WHERE `news_id` = ?", [$post->id]);

        return $this->view('view', [
            'post' => $post,
            'related_posts' => $related_posts
        ]);
    }

    public function getLastNews()
    {
        $lastPosts = Post::query()
            ->orderByDesc('id')
            ->paginate(15);

        return $this->view('lastnews', [
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

        return $this->view('popular', [
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

        return $this->view('search', [
            'last_posts' => $lastPosts
        ]);
//        MATCH (title, short_story, full_story, xfields) AGAINST ('{$body}')
    }
}
