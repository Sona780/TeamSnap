@extends('layouts.app')

@section('content')

<div class="mini-charts">
  <div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4">
      <a>
        <div class="mini-charts-item bgm-cyan">
          <div class="clearfix">
            <div class="count">
              <small>Registered users</small>
              <h2>{{$users}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4">
      <a>
        <div class="mini-charts-item bgm-cyan">
          <div class="clearfix">
            <div class="count">
              <small>Registered Teams</small>
              <h2>{{$teams}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4">
      <a>
        <div class="mini-charts-item bgm-cyan">
          <div class="clearfix">
            <div class="count">
              <small>Registered Leagues</small>
              <h2>{{$leagues}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
  	Owner list
  </div>
  <div class="table-responsive card-body">
	<table class="table dt-responsive nowrap" cellspacing="0" style="font-size: 13px">
	  <thead>
	  	<th>Name</th>
	  	<th>Email</th>
	  	<th>Action</th>
	  </thead>
	  <hr>
	  <tbody>
	  	@foreach( $owners as $owner )
	  	  <tr>
		  	<td>{{$owner->firstname}} {{$owner->lastname}}</td>
		  	<td>{{$owner->email}}</td>
		  	<td>
		  	  <a href='{{url("owner/$owner->users_id")}}'><img src="{{url('/')}}/img/access.png" class="icon-style"/></a>
		  	</td>
	  	  </tr>
	  	@endforeach
	  </tbody>
	</table>
  </div>
</table>

@endsection
