<?php


namespace App\Http\Controllers;


use App\Models\Album;
use App\Models\Post;

class AlbumsController extends Controller
{
    public function getIndex()
    {
        $albums = Album::query()->orderByDesc('id')->paginate(15);

        return $this->view('album.index', ['albums' => $albums]);
    }

    public function getShow($id, $slug)
    {
        $album = Album::query()->where('id', $id)->where('url', $slug)->firstOrFail();
        $posts = Post::query()->where('xfields', 'like', '%' . config('xfields.album_id') . '|' . $album->id_zvuk.'%')->paginate(10);
        return $this->view('album.show', ['album' => $album, 'posts' => $posts]);
    }
}