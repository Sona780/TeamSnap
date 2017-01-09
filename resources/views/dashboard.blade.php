@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   <a href="{{ url( 'createteam') }} ">Create Your team</a>
                   <br/><br/><br/>
                   <h1>Teams:</h1>
                   <br/>

                   @foreach ($users as $item)
                           <p>{{$item->id}}</p><br/>
                          <p>{{$item->teamname}}</p><br/>

                   @endforeach
                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
