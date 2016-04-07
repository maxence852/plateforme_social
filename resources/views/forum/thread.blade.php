@extends('layouts.app')

@section('head')
    @parent
    <title>Forum | {{$thread->title}}</title>
@stop

@section('content')
    <div class="clearfix">
    <ol class="breadcrumb pull-left">
        <li><a href="{{ URL::route('forum-home') }}">Forums</a></li>
        <li><a href="{{ URL::route('forum-category',$thread->category_id) }}">{{$thread->category->title}}</a></li>
        <li class="active">{{$thread->title}}</li>
    </ol>
        <a href="{{URL::route('forum-delete-thread',$thread->id)}}" class="btn btn-danger pull-right"> Delete</a>
    </div>
    <div class="well">
        <h1>{{$thread->title}}</h1>
        <h4> By : {{$author }} on {{$thread->created_at}} </h4> <!-- $author pointe dans ForumController  function thread($id) qui récupère le nom de l'utilisateur qui a écris le msg.-->
        <hr style="border-color: #d58512">
        <p>{{ nl2br(BBCode::parse($thread->body)) }}</p> <!-- todo bbcode ne fonctionne pas sur la page -->
        </hr>
    </div>
    @stop
