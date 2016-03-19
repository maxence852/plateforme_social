<?php
namespace App\Http\Controllers;
use App\models\ForumCategory;
use App\models\ForumGroup;
use App\Http\Requests;
use Illuminate\Routing\Controller as BaseController;

class ForumController extends BaseController
{
    public function index()
    {
        $groups = ForumGroup::all();
        $categories = ForumCategory::all();
        return View('forum.index')->with('groups', $groups)->with('categories', $categories);
    }
    public function category($id)
    {

    }
    public function thread($id)
    {

    }
}