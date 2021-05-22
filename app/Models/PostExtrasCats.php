<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PostExtrasCats extends Model
{
    protected $table = "dle_post_extras_cats";
    public $timestamps = false;
    protected $guarded = [];
}