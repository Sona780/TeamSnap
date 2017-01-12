@extends('layouts.app')


@section('content')

<div class="container content">
       <a href="{{url('createteam')}}"><button type="button" class="btn btn-danger">Create Team</button></a>
       <h3>Teams:</h3>


       @foreach($teams as $team )

       <div class="col-sm-3">
            <div class="card">
              <a class="f-20 f-700" href="{{$team->teamname}}/dashboard">{{$team->teamname}}</a>
            </div>
       </div>

      @endforeach

</div>


@endsection
