@extends('layouts.new')


@section('layout')

<div class="container content">
       <a href="{{url('createteam')}}"><button type="button" class="btn btn-danger">Create Team</button></a>    
       <h3>Teams:</h3>


       @foreach($users as $user )
      
       <div class="col-sm-3">
            <div class="teamcard">
              <p>{{$user->teamname}}</p>
            </div>
       </div>

      @endforeach    

</div>


@endsection

