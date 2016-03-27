<?php
namespace App\Http\Controllers;
use App\models\ForumCategory;
use App\models\ForumGroup;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation;
use Illuminate\Http\RedirectResponse;
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
    //Ajoute un nouveau groupe de discussion et utilise le validator pour afficher un msg d'erreur si le nom du champ est vide
    public function storeGroup(Request $request)
    {

        $validation = validator::make($request->all(), [
            'group_name' => 'required|unique:forum_groups,title'
        ]);

        if ($validation->fails())
        {
            return Redirect('/forum')->withInput()->withErrors($validation)->with('modal', '#group_form');
        }
        else
        {
            $group = new ForumGroup();
            $group->title = Input::get('group_name');
            $group->author_id = Auth::user()->id;

            if($group->save())
            {
                return Redirect('/forum')->with('success', 'Le groupe a été créé avec succes');
            }
            else
            {
                return Redirect('/forum')->with('fail', 'Une erreur est survenu en tentant de sauvegarder le groupe');
            }
        }

            /*$validator = Validator::make(array(
                   'group_name' => 'required|unique:forum_groups'
                ), Input::all());
                if($validator -> fails())
                {
                    return Redirect::route('forum-home')-> withInput()->withErrors($validator)->with('modal', '#group_form');
                }*/

    }

}