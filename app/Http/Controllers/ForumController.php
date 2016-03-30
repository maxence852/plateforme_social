<?php
namespace App\Http\Controllers;
use App\models;
use App\models\ForumCategory;
use App\models\ForumComment;
use App\models\ForumGroup;
use App\Http\Requests;
use App\models\ForumThread;
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
        $category = ForumCategory::find($id);
        if($category == null) //sécurité si si il n'existe pas. Car user peux trafiquer l'url.
        {
            return Redirect('/forum')->with('fail', "That category doesn't exist. ");
        }
        $threads = $category->threads();
        return View('forum.category')->with('category', $category)->with('threads',$threads);

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
            // bout de code de base de Laravel 4
            /*$validator = Validator::make(array(
                   'group_name' => 'required|unique:forum_groups'
                ), Input::all());
                if($validator -> fails())
                {
                    return Redirect::route('forum-home')-> withInput()->withErrors($validator)->with('modal', '#group_form');
                }*/

    }
    public function deleteGroup($id)
    {
        $group = ForumGroup::find($id);
        if($group == null)
        {
            return Redirect('/forum')->with('fail', 'Le groupe de discussion n\'existe pas.');
        }

        $categories = $group->categories(); // avant c'était noté ForumCategory::where('group_id', $id); mais grâche à la relation on note ce qui est noté mtn. car ds models\ForumGroup il y'a la function categories. #vidéo9
        $threads = $group->threads();
        $comments = $group->comments();

        $delCa = true;
        $delT = true;
        $delCo = true;

        if($categories->count()>0)
        {
            $delCa =  $categories->delete();
        }
        if($threads->count()>0)
        {
            $delT = $threads ->delete();
        }
        if($comments->count()>0)
        {
            $delCo = $comments->delete();
        }

        if($delCa && $delT && $delCo && $group->delete())
        {
            return Redirect('/forum')->with('success', 'Le groupe a été supprimé avec succes.');
        }
        else
        {
            return Redirect('/forum')->with('fail', 'Une erreur est survenu en tentant de supprimer le groupe');
        }
    }

    public function deleteCategory($id)
    {
        $category = ForumCategory::find($id);
        if($category == null)
        {
            return Redirect('/forum')->with('fail', 'La category de discussion n\'existe pas.');
        }

        $threads = $category->threads();
        $comments = $category->comments();

        $delT = true;
        $delCo = true;

        if($threads->count()>0)
        {
            $delT = $threads ->delete();
        }
        if($comments->count()>0)
        {
            $delCo = $comments->delete();
        }

        if($delT && $delCo && $category->delete())
        {
            return Redirect('/forum')->with('success', 'Le category a été supprimé avec succes.');
        }
        else
        {
            return Redirect('/forum')->with('fail', 'Une erreur est survenu en tentant de supprimer le category');
        }
    }
}