<?php
namespace App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: maxence
 * Date: 13/03/2016
 * Time: 22:13
 */


class ForumGroup extends Model
 {
    protected $table = 'forum_groups';

    public function categories()
    {
        return $this->hasMany('App\models\ForumCategory','group_id');
    }
    public function threads()
    {
        return $this->hasMany('App\models\ForumThread','group_id');
    }
    public function comments()
    {
        return $this->hasMany('App\models\ForumComment','group_id');
    }

}