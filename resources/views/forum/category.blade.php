@extends('layouts.app')

@section('head')
    @parent
    <title>Forum | {{$category->title}}</title>
    @stop

@section('content')

    <ol class="breadcrumb">
        <li><a href="{{ URL::route('forum-home') }}">Forums</a></li>
        <li class="active">{{$category->title}}</li>
    </ol>

    @if(Auth::check()) <!-- users doivent être loggés -->
        <div>
            <a href="{{URL::route('forum-get-new-thread', $category->id)}}" class="btn btn-default">Add Thread</a>
        </div>
    @endif

        <div class="panel panel-primary">
            <div class="panel-heading">
                @if(Auth::check() && Auth::user()->isAdmin())
                <div class="clearfix">
                    <h3 class="panel-title pull-left">{{$category->title}}</h3>
                   <a href="{{URL::route('forum-get-new-thread', $category->id)}}" class="btn btn-success btn-xs pull-right">New Thread</a>
                    <!-- bouton supprimer groupe discussion-->
                    <a id="{{$category->id}}" href="#" data-toggle="modal" data-target="#category_delete" class="btn btn-danger btn-xs pull-right delete_category">Supprimer</a>
                </div>
                @else
                    <div class="clearfix">
                        <h3 class="panel-title">{{$category->title}}</h3>
                        <a href="{{URL::route('forum-get-new-thread', $category->id)}}" class="btn btn-success btn-xs pull-right">New Thread</a>
                    </div>
                @endif
            </div>
            <div class="panel-body panel-list-group">
                <div class="list-group">
                    @foreach($threads as $thread)
                            <a  href="{{URL::route('forum-thread', $thread->id) }}" class="list-group-item">{{$thread->title}}</a>
                    @endforeach
                </div>
            </div>
        </div>

                    <!-- modal de suppression d'un groupe de discussion -->
    @if(Auth::check() && Auth::user()->isAdmin())
        <div class="modal fade" id="category_delete" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Delete Category</h4>
                    </div>
                    <div class="modal-body">
                        <h3>Are you sure you want to delete this category.</h3>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                            <a href="{{URL::route('forum-delete-category', $category->id)}}" type="button" class="btn btn-primary" id="btn_delete_category">Supprimer</a>
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
@stop
