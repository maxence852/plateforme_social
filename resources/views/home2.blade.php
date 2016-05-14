
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Facebook</div>

                    <div class="panel-body">
                        <h4>ton nom est {{Auth::user()->name}}</h4>
                        <h4>ton email est {{Auth::user()->email}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection