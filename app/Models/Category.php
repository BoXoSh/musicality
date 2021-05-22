<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'dle_category';
    protected $guarded = [];
    public $timestamps = false;
}