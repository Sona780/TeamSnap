@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="lc-block toggled" id="l-login" style="width: 95%;">

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
              {{ csrf_field() }}

              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} input-group m-b-20">
                  <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>

                  <div class="fg-line">
                      <input id="name" type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus>

                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} input-group m-b-20">
                  <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>

                  <div class="fg-line">
                      <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>

                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} input-group m-b-20">
                  <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>

                  <div class="fg-line">
                      <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                      @if ($errors->has('password'))
                          <span class="help-block">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>
              </div>

              <div class="form-group input-group m-b-20">
                  <span class="input-group-addon"><i class="zmdi zmdi-key"></i></span>

                  <div class="fg-line">
                      <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control" name="password_confirmation" required>
                  </div>
              </div>

                <button type="submit" class="btn btn-login btn-danger btn-float waves-effect waves-circle waves-float">
                  <i class="zmdi zmdi-arrow-forward"></i>
                </button>


              </form>
            <ul class="login-navigation">
                  <div class="btn-demo">
                  <a href="{{ url('/login') }}"><button class="btn btn-success btn-xs pills-auth">Login</button></a>
                  </div>  
              </ul>
               

            </div>
          </div>
    </div>
</div>
@endsection
