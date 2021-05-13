<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Artist
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
 * @property string $url
 * @property int $counttrack
 * @property int $vievs
 */
class Artist extends Model
{
    use HasFactory;
    protected $table = "artists";
}
