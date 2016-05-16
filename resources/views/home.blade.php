@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Bonjour {{ Auth::user()->name }} bienvenue sur la plateforme sociale</div>
                    <div class="panel-body">
                        Vous êtes connectés sur la platforme sociale
                    </div>
            </div>
         </div>
    </div>
</div>
@endsection
