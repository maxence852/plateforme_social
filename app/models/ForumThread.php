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
        $this->belongsTo('ForumGroup');
    }
    public function category()
    {
        $this->belongsTo('ForumCategory');
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