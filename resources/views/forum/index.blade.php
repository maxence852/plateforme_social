@extends('layouts.app')

@section('header')
    @parent
    <title>Forum</title>
    @stop

@section('content')

    @if(Auth::check() && Auth::user()->isAdmin)
        <div>
            <a href="#" class="btn btn-default" data-toggle="modal" data-target="#group_form">Add Group</a>
        </div>
    @endif


    @foreach($groups as $group)
        <div class="panel panel-primary">
            <div class="panel-heading">
                @if(Auth::check()&& Auth::user()->isAdmin)
                    <div class="clearfix">
                        <h3 class="panel-title pull-left">{{$group->title}}</h3>
                        <!-- bouton supprimer et ajouter groupe discussion-->
                        <?php echo ($group->id); ?>
                        <a id="add-category-{{$group->id}}" href="#" data-toggle="modal"data-target="#category_modal" class="btn btn-success btn-xs pull-right new_category">New Category</a>
                        <a id="{{$group->id}}" href="#" data-toggle="modal" data-target="#group_delete" class="btn btn-danger btn-xs pull-right delete_group">Supprimer</a>
                    </div>
                @else
                    <div class="clearfix">
                        <h3 class="panel-title pull-left">{{$group->title}}</h3>
                    </div>
                @endif
                </div>
            <div class="panel-body panel-list-group">
                <div class="list-group">
                    @foreach($categories as $category)
                        @if($category->group_id == $group->id)
                               <a  href="{{URL::route('forum-category', $category->id) }}" class="list-group-item">{{$category->title}}</a>
                        @endif
                    @endforeach
                </div>
            </div>
         </div>
    @endforeach



<!-- note : pour que le form fonctionne correctement j'ai du suivre les 1ère étapes ici https://laravelcollective.com/docs/5.2/html -->

    <!-- modal d'ajout d'un groupe de discussion -->
    @if(Auth::check() && Auth::user()->isAdmin)
        <div class="modal fade" id="group_form" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">New Group</h4>
                    </div>
                    <div class="modal-body">
                        <form id="target_form" method="post" action="{{URL::route('forum-store-group')}}">

                            <div class="form-group{{($errors->has('group_name')) ? 'has-error' : ''}}">
                                <label for="group_name">Group Name:</label>
                                <input type="text" id="group_name" name="group_name" class="form-control">
                                @if($errors->has('group_name'))
                                    <p>{{$errors->first('group_name')}}</p>
                                @endif
                            </div>
                            {{Form::token()}}
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="form_submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endif


            <!-- modal d'ajout d'une category de discussion -->
        @if(Auth::check() && Auth::user()->isAdmin)
        <div class="modal fade" id="category_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">New Category</h4>
                    </div>
                    <div class="modal-body">
                        <form id="category_form" method="post">

                            <div class="form-category{{($errors->has('category_name')) ? 'has-error' : ''}}">
                                <label for="category_name">Category Name:</label>
                                <input type="text" id="category_name" name="category_name" class="form-control">
                                @if($errors->has('category_name'))
                                    <p>{{$errors->first('category_name')}}</p>
                                @endif
                            </div>
                            {{Form::token()}}
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="category_submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
        @endif

    <!-- modal de suppression d'un groupe de discussion -->
        @if(Auth::check() && Auth::user()->isAdmin)
            <div class="modal fade" id="group_delete" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4 class="modal-title">Supprimer le groupe de discussion</h4>
                        </div>
                        <div class="modal-body">
                            <h3>Etes-vous sûr de vouloir supprimer ce groupe de discussion ?</h3>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                            <a href="#" type="button" class="btn btn-primary" id="btn_delete_group">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endif
    @stop


@section('javascript')
    @parent
    <script type="text/javascript" src="{{asset('/js/app.js')}}"></script>
    @if(Session::has('modal'))
    <script type="text/javascript">
    $("{{ Session::get('modal') }}").modal('show');
    </script>
    @endif

@stop