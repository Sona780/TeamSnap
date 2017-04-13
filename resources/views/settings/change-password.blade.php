@extends('layouts.new', ['team' => $id, 'active' => 'settings', 'logo' => $team->team_logo, 'name' => $team->teamname])

@section('content')
<div class="col-sm-4 col-sm-offset-4">
	<div class="card">
		<div class="card-header ch-alt">
			<h2>Change Password</h2>
		</div>
		<div class="card-body card-padding">
			{{ Form::open(['method' => 'post', 'url' => $id.'/change/password', 'id' => 'password-form']) }}
                <div class="form-group fg-line">
                	<label for="current">Current password</label>
                    <input type="password" class="form-control input-sm" name="current" autofocus>
               	</div>
               	@if ($errors->has('current'))
                    <span class="help-block">
                    	<strong style="color: red">{{ $errors->first('current') }}</strong>
                	</span>
                @endif
                @if(Session::has('pass'))
                    <span class="help-block">
                    	<strong style="color: red">{{ Session::get('pass') }}</strong>
                	</span>
                @endif
                <br>
               	<div class="form-group fg-line">
                	<label for="new">New password</label>
                    <input type="password" class="form-control input-sm" name="password">
               	</div>
               	@if ($errors->has('password'))
                    <span class="help-block">
                    	<strong style="color: red">{{ $errors->first('password') }}</strong>
                	</span>
                @endif
               	<br>
               	<div class="form-group fg-line">
                	<label for="confirm">Confirm new password</label>
                    <input type="password" class="form-control input-sm" name="password_confirmation">
               	</div>
               	<br>
               	<button class="col-xs-12 col-sm-12 btn btn-success">Update</button>
               	<br>
            {{Form::close()}}
		</div>
	</div>
</div>
@endsection
