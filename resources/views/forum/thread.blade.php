@extends('layouts.app')

@section('head')
    @parent
    <title>Forum | {{$thread->title}}</title>
@stop

@section('content')
    <div class="well">
        <h1>{{$thread->title}}</h1>
        <h4> By : {{$author }} on {{$thread->created_at}} </h4> <!-- $author pointe dans ForumController  function thread($id) qui récupère le nom de l'utilisateur qui a écris le msg.-->
        <hr style="border-color: #d58512">
        <p>{{ nl2br(BBCode::parse($thread->body)) }}</p> <!-- todo bbcode ne fonctionne pas sur la page -->
        </hr>
    </div>
    @stop
