<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PostExtras
 * @package App\Models
 *
 * @property integer $eid
 * @property integer $news_id
 * @property integer $allow_rate
 * @property integer $rating
 * @property integer $vote_num
 * @property integer $votes
 * @property integer $view_edit
 * @property integer $disable_index
 * @property string $access
 * @property integer $editdate
 * @property string $editor
 * @property string $reason
 * @property integer $user_id
 * @property integer $disable_search
 * @property integer $need_pass
 */
class PostExtras extends Model
{
    use HasFactory;

    protected $table = 'post_extras';
}
