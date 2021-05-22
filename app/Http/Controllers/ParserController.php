<?php


namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Post;
use App\Models\PostExtras;
use App\Models\PostExtrasCats;
use DiDom\Document;
use Illuminate\Support\Str;

class ParserController extends Controller
{

    public $rootPath = '../admin.muz.asia/';

    public function hittj()
    {
        $category_id = 9;
        $urlProxy = 'https://parser.top/most.php?url=';
        $dom = new Document($urlProxy . 'https://hit.tj/tajikmusic/', true);
        $items = $dom->first('#dle-content')->findInDocument('.track-item');

        foreach ($items as $item) {
            $track_link = trim($item->attr('data-track'));
            $title = trim($item->attr('data-title'));
            $artist = trim($item->attr('data-artist'));
            $img = trim($item->attr('data-img'));
            $full_title = $artist . ' - ' . $title;
            $track_time = $item->firstInDocument('.track-time');
            $track_time = $track_time ? $track_time->text() : '';

            $artistModel = $this->createArtist($artist, empty($img) ? $img : null);
            $alt_name = Str::slug($full_title);

            $track_path = 'uploads/files/' . Str::random() . '_' . $alt_name . '.mp3';

            if (!$filesize = $this->saveFile($urlProxy . $track_link, $track_path))
                continue;

            $xfields = 'artist_name|' . $artist . '||track_name|' . $title . '||name|{name}||description|{description}||id_youtube_0|{id_youtube_0}||duration|' . $track_time . '||size|' . $this->formatSizeUnits($filesize) . '||year|2021';


            if ($artistModel) {
                $xfields .= '||artists_link|<a href=\"/artist/' . $artistModel->id . '-' . $artistModel->url . '.html\">' . $artist . '</a>||id_artist|' . $artistModel->id_zvuk;
                if (!empty($img)) {
                    $xfields .= '||poster|/' . $artistModel->poster . '||image|' . $img;
                }
            }

            if (!empty($track_path))
                $xfields .= '||music_link|/' . $track_path;

            $post = Post::create([
                'autor' => 'Admin',
                'date' => date('Y-m-d H:i:s'),
                'short_story' => '',
                'full_story' => '',
                'xfields' => $xfields,
                'title' => $full_title,
                'descr' => '',
                'keywords' => '',
                'category' => $category_id,
                'alt_name' => Str::slug($full_title),
                'comm_num' => 0,
                'allow_comm' => 1,
                'allow_main' => 1,
                'approve' => 1,
                'fixed' => 0,
                'allow_br' => 1,
                'symbol' => '',
                'tags' => $full_title,
                'meta_title' => $full_title,
                'zvuk_id' => 0,
            ]);

            if (!$post)
                continue;


            PostExtrasCats::create([
                'news_id' => $post->id,
                'cat_id' => $category_id
            ]);

            PostExtras::create([
                'news_id' => $post->id,
                'related_ids' => '',
                'access' => '',
                'editor' => '',
                'reason' => '',
                'user_id' => 1
            ]);

            exit;
        }
    }

    public function createArtist($name, $poster = null)
    {
        $slug = Str::slug($name);
        $artist = Artist::query()->where('url', $slug)->first();

        $poster_url = '';
        if (!$artist) {
            if (!empty($poster)) {
                $posterPath = 'uploads/artist/' . date('Y-m') . '/' . $slug . '.jpeg';
                if ($this->saveFile($poster, $posterPath))
                    $poster_url = '/' . $posterPath;
            }
            $artist = Artist::create([
                'name' => $name,
                'meta_title' => $name . ' все песни',
                'meta_description' => '',
                'keywords' => $name . ', все песни, слушать песни онлайн',
                'poster' => $poster_url,
                'description' => "",
                'id_zvuk' => 0,
                'counttrack' => 0,
                'vievs' => 0
            ]);

            $artist->update(['id_zvuk' => $artist->id]);
        }
        return $artist;
    }

    public function saveFile($url, $path)
    {
        $path = base_path($this->rootPath . $path);
        return copy($url, $path) ? filesize($this->rootPath . $path) : false;
    }

    public function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}