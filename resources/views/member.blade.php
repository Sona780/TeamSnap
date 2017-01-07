@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   <a href="{{ url( 'createteam') }} ">Create Your team</a>
                   <a href="{{ url('team_setup')}}">Add members</a>
                   <a href="{{ url('members') }}">Members</a>
                   <br/>
                   <br/>
                   <table class="table table-striped">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      
  @foreach( $memberdetails as $notice )
      <tr>
        <td>{{$notice->firstname}}</td>
        <td>{{$notice->lastname}}</td>
        <td>{{$notice->email}}</td>
      </tr>
   @endforeach   
        
    </tbody>
  </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
