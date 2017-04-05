@extends('layouts.app')

@section('content')

  <div class="row">
    <div class="col-md-6 col-md-offset-3 col-xs-12">
      <div class="lc-block toggled" id="l-login" style="width: 95%;">

          <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} input-group m-b-20">
                <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>

                <div class="fg-line">
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}@if(session('email')) {{ session('email') }} @endif" required autofocus>

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

            <div class="clearfix"></div>

            <div class="form-group">
              <div class="checkbox">
                  <label>
                      <input type="checkbox" name="remember">
                      <i class="input-helper"></i>
                      Keep me signed in
                  </label>
              </div>
            </div>

              <button type="submit" class="btn btn-login btn-danger btn-float waves-effect waves-circle waves-float" >
                <i class="zmdi zmdi-arrow-forward"></i>
              </button>


            </form>

              <ul class="login-navigation"><!-- 
                  <li data-block="/register" class="bgm-red"><a href="{{ url('/register') }}">Register</a></li>
                  <li data-block="" class="bgm-orange"><a href="{{ url('/password/reset') }}">Forgot Password?</a></li> -->

                  <div class="btn-demo">
                  &nbsp;&nbsp;
                  <a href="{{ url('/register') }}"><button class="btn btn-danger btn-xs pills-auth">Register</button></a>
                  &nbsp; &nbsp;
                    <a href="{{ url('/password/reset') }}"><button class="btn btn-warning btn-xs pills-auth">Forgot Password</button></a>
                  </div>  
              </ul>

          </div>
        </div>
  </div>
@endsection
