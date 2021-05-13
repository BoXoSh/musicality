<?php


namespace App\Http\Controllers;


use App\Models\Artist;
use App\Models\Post;

class ArtistsController extends Controller
{
    public function getIndex()
    {
        $arists = Artist::query()->orderByDesc('id')->paginate(16);

        return $this->view('artist.index', ['albums' => $arists]);
    }

    public function getShow($id, $slug)
    {
        $artist = Artist::query()->where('id', $id)->where('url', $slug)->firstOrFail();
        $posts = Post::query()->where('xfields', 'like', '%' . config('xfields.artist_id') . '|' . $artist->id_zvuk.'%')->paginate(10);
        return $this->view('artist.show', ['album' => $artist, 'posts' => $posts]);
    }
}