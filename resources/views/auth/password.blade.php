@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card panel-default">
                <div class="card-header bgm-cyan"><h5>Reset Password</h5></div>

                @if ($errors->any())
                    <div class="alert alert-success alert-dismissable" style="text-align: center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>{{$errors->first()}}</strong>
                    </div>
                @endif

                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/save') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="mail" value="{{ $mail }}">

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
