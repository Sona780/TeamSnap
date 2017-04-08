@extends('layouts.new')

@section('content')
   <div class="card">
      <h2>Account Setting:</h2>
      <button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">Edit</button><br/>

      Name:{{$account->name}}<br/>
      UserName:{{$account->email}}<br/>
      AccountEmail:{{$account->email}}<br/>
      Address:<br/>
            <!--Modal for edit-->


			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">edit</h4>
			      </div>
			      <div class="modal-body">
			            {!! Form::model($account, ['method' => 'PATCH','route' => ['account.update', $account->id]]) !!}
                              {!! csrf_field() !!}
		                      Name:<input id="name" type="text" class="form-control" placeholder="Name" name="name"  value="{{$account->name}}" required autofocus>
		                      Email:<input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ $account->email }}" required autofocus>

		                      <input type="submit" value="submit"/>
                        {!! Form::close() !!}
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div>

			  </div>
			</div>
   </div>

@stop
