@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Bienvenue dans la gestion de votre compte {{ Auth::user()->name }}, veuillez compléter les informations supplémentaires sur vous.</div>
                </div>
            </div>
        </div>
    </div>
@endsection
