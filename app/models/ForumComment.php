<?php
namespace App\models;
use App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: maxence
 * Date: 13/03/2016
 * Time: 22:13
 */



class ForumComment extends Model
{
    protected $table = 'forum_comments';
    public function group()
    {
        return $this->belongsTo('App\models\ForumGroup');
    }
    public function category()
    {
        return $this->belongsTo('App\models\ForumCategory');
    }

    public function thread()
    {
        return $this->belongsTo('App\models\ForumThread');
    }
}