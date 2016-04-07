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
use Thread;

class ForumController extends BaseController
{

    public function index()
    {
        $groups = ForumGroup::all();
        $categories = ForumCategory::all();
        return  view('forum.index')->with('groups', $groups)->with('categories', $categories);
    }
    public function category($id)
    {
        $category = ForumCategory::find($id);
        if($category == null) //sécurité si si il n'existe pas. Car user peux trafiquer l'url.
        {
            return redirect()->route('forum-home')->with('fail', "That category doesn't exist. ");
        }
        $threads = $category->threads()->get();
        return view('forum.category')->with('category', $category)->with('threads',$threads);

    }
    public function thread($id)
    {
        $thread = ForumThread::find($id);
        if ($thread == null)
        {
            return redirect()->route('forum-home')->with('fail', "The thread doesn't exist. ");
        }
        $author = $thread->author()->first()->name; //on utilise cette forme d'écriture car nous avons fais une relation. dans le dossier modes ForumThread function author. renvoie le nom de l'auteur dans thread.blade $author

        return view('forum.thread')->with('thread', $thread)->with('author',$author);
    }
    //Ajoute un nouveau groupe de discussion et utilise le validator pour afficher un msg d'erreur si le nom du champ est vide
    public function storeGroup(Request $request)
    {

        $validation = validator::make($request->all(), [
            'group_name' => 'required|unique:forum_groups,title'
        ]);

        if ($validation->fails())
        {
            return redirect()->route('forum-home')->withInput()->withErrors($validation)->with('modal', '#group_form');
        }
        else
        {
            $group = new ForumGroup();
            $group->title = Input::get('group_name');
            $group->author_id = Auth::user()->id;

            if($group->save())
            {
                return redirect()->route('forum-home')->with('success', 'Le groupe a été créé avec succes');
            }
            else
            {
                return redirect()->route('forum-home')->with('fail', 'Une erreur est survenu en tentant de sauvegarder le groupe');
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
            return redirect()->route('forum-home')->with('fail', 'Le groupe de discussion n\'existe pas.');
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
            return redirect()->route('forum-home')->with('success', 'Le groupe a été supprimé avec succes.');
        }
        else
        {
            return redirect()->route('forum-home')->with('fail', 'Une erreur est survenu en tentant de supprimer le groupe');
        }
    }

    public function deleteCategory($id)
    {
        $category = ForumCategory::find($id);
        if($category == null)
        {
            return redirect()->route('forum-home')->with('fail', 'La category de discussion n\'existe pas.');
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
            return redirect()->route('forum-home')->with('success', 'Le category a été supprimé avec succes.');
        }
        else
        {
            return redirect()->route('forum-home')->with('fail', 'Une erreur est survenu en tentant de supprimer le category');
        }
    }
    public function storeCategory(Request $request,$id)
    {
        $validation = validator::make($request->all(), [
            'category_name' => 'required|unique:forum_categories,title'
        ]);

        if ($validation->fails())
        {
            return redirect()->route('forum-home')->withInput()->withErrors($validation)->with('category-modal', '#category_modal')->with('group-id', $id); //devrais afficher la modal comme c'est écris ds le js de fin de page ds index.blade
        }
        else
        {
            $group = ForumGroup::find($id);

            if($group == null)
            {
                return redirect()->route('forum-home')->with('fail', "That group doesn't exist.");
            }
            $category = new ForumCategory;
            $category->title = Input::get('category_name');
            $category->author_id = Auth::user()->id;
            $category->group_id = $id;


            if($category->save())
            {
                return redirect()->route('forum-home')->with('success', 'The category was created');
            }
            else
            {
                return redirect()->route('forum-home')->with('fail', 'An error occured while saving the category.');
            }
        }
    }

    public function newThread($id)
    {
        return view('forum.newthread')->with('id',$id);
    }

    /*
     * Alors sur la fonction redirect()->route je ne sais pas pq mais d'habitude j'utilisais juste Redirect() et ça fonctionnait mais ici pour storeThread sa ne fonctionne pas.
     */

    public function storeThread(Request $request,$id)
    {
        $category = ForumCategory::find($id);
        if($category == null)
        {
            return redirect()->route('forum-get-new-thread')->with('fail', 'You posted to an invalid category.');
        }
        $validation = validator::make($request->all(), [
            'title' => 'required|min:3|max:255', //titre min 3 et max 255 caractères
            'body'  => 'required|min:10|max:65000'
        ]);
        if($validation->fails())
        {
            return redirect()->route('forum-get-new-thread',$id)->withInput()->withErrors($validation)->with('fail',"Your input doesn't match the requirements.");
        }
        else
        {
            $thread = new ForumThread();
            $thread->title = Input::get('title');
            $thread->body = Input::get('body');
            $thread->category_id = $id;
            $thread->group_id = $category->group_id;
            $thread->author_id = Auth::user()->id;

            if($thread->save())
            {
                return redirect()->route('forum-thread', $thread->id)->with('success',"Your thread has been saved.");
            }
            else
            {
                return redirect()->route('forum-get-new-thread',$id)->with('fail',"An error occured while saving your thread.")->withInput();
            }

        }
    }
        public function deleteThread($id)
    {
       $thread = ForumThread::find($id);
        if($thread == null)
        {
            return redirect()->route('forum-home')->with('fail', "That thread doesn't exist " );
        }
        $category_id = $thread->category_id;
        $comments = $thread->comments;
        if($comments->count() > 0)  //si il y'a des commentaires -> delete sinon erreur.
        {
            if ($comments->delete() && $thread->delete())
            {
                return redirect()->route('forum-category', $category_id)->with('success', "The thread was deleted.");
            }
            else
            {
                return redirect()->route('forum-home', $category_id)->with('fail', "An occured while deleting the thread.");
            }
        }
            else
            {
                if($thread->delete())
                {
                    return redirect()->route('forum-category', $category_id)->with('success', "The thread was deleted.");
                }
                else
                {
                    return redirect()->route('forum-home', $category_id)->with('fail', "An occured while deleting the thread.");
                }
            }



    }

}