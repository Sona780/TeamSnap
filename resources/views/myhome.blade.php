@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                   <a href="{{ url( 'createteam') }} ">Create Your team</a>
                   <a href="{{ url('add_members')}}">Add members</a>
                   <a href="{{ url('members') }}">Members</a>
                   <br/>
                   <br/>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
