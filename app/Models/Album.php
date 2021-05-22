<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Album
 * @package App\Models
 *
 * @property int $id
 * @property string $name
 * @property string $meta_title
 * @property string $meta_description
 * @property string $keywords
 * @property string $poster
 * @property string $description
 * @property string $id_zvuk
 * @property string $id_artist
 * @property string $url
 * @property int $counttrack
 * @property int $views
 * @property string $artist_name
 * @property int $artistsurl
 */
class Album extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $table = 'albums';
}
