<?php


namespace App\Http\Controllers;


use App\Models\Artist;
use App\Models\Post;

class ArtistsController extends Controller
{
    public function getIndex()
    {
        $arists = Artist::query()->orderByDesc('id')->paginate(16);

        return $this->view('artist.index', ['artists' => $arists]);
    }

    public function getShow($id, $slug)
    {
        $artist = Artist::query()->where('id', $id)->where('url', $slug)->firstOrFail();
        $posts = Post::query()->where('xfields', 'like', '%||id_artist|%' . $artist->id_zvuk.'||%')->orderByDesc('id')->paginate(10);
        return $this->view('artist.show', ['artist' => $artist, 'posts' => $posts]);
    }
}