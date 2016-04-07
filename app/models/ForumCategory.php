<?php
namespace App\models;
use App\models;
use Illuminate\Database\Eloquent\Model;

/**
 * @property  group_id
 */
class ForumCategory extends Model
{
    protected $table = 'forum_categories';

    public function group()
    {
        return $this->belongsTo('App\models\ForumGroup');
    }

    public function threads()
    {
        return $this->hasMany('App\models\ForumThread','category_id');
    }
    public function comments()
    {
        return $this->hasMany('App\models\ForumComment','category_id');
    }

}