<?php
namespace App\models;
use App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: maxence
 * Date: 13/03/2016
 * Time: 22:14
 */


class ForumThread  extends Model
{
    protected $table = 'forum_threads';

    public function group()
    {
       return $this->belongsTo('App\models\ForumGroup');
    }
    public function category()
    {
        return $this->belongsTo('App\models\ForumCategory');
    }

    public function comments()
    {
        return $this->hasMany('App\models\ForumComment','thread_id');
    }

    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }
}