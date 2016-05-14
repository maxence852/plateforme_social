@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Tableau de bord</div>

                <div class="panel-body">
                    Vous êtes connectés sur la plateforme social
                    <h4>ton nom est {{ Auth::user()->name }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
