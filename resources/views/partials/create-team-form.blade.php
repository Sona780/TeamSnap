{!! csrf_field() !!}
<div class="row">
  <div class="col-sm-6 ">
    <div class="form-group">
      <label>Team Name <small style="color: red">(required)</small></label>
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
        <div class="fg-line">
          {{Form::text('teamname', null, ['class' => 'form-control', 'placeholder' => 'Full Name', 'autofocus' => true])}}
        </div>
        <strong style="color: #ec7475">
          @if($errors->has('teamname'))
            {{$errors->first('teamname')}}
          @endif
        </strong>
      </div>
    </div>
    <br/><br/>
    <div class="form-group" style="padding-top: 0.75em;">
      <label>Sport <small style="color: red">(required)</small></label>
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-star-circle"></i></span>
        <div class="fg-line">
          {{ Form::select('all_games_id', $games, null, ['class' => 'selectpicker', 'data-live-search' => 'true']) }}
        </div>
      </div>
    </div>
    <br/><br/>
    <div class="form-group">
      <label>Country <small style="color: red">(required)</small></label>
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-pin-drop"></i></span>
        <div class="fg-line">
          {{ Form::select('country', array(
            '0' => 'United States', '1' => 'Canada', '2' => 'India', '3' => 'Pakistan', '4' => 'China', '5' => 'South Africa'
          ), null, ['class' => 'selectpicker', 'data-live-search' => 'true']) }}
        </div>
      </div>
    </div>
    <br/><br/>
    <div class="form-group">
      <label>Zip Code <small style="color: red">(required)</small></label>
      <div class="input-group">
        <span class="input-group-addon"><i class="zmdi zmdi-info"></i></span>
        <div class="fg-line">
          {{Form::text('zip', null, ['class' => 'form-control', 'placeholder' => 'Zip Code'])}}
        </div>
        <strong style="color: #ec7475">
          @if($errors->has('zipcode'))
            {{$errors->first('zipcode')}}
          @endif
        </strong>
      </div>
    </div>
  </div>

  <div class="col-sm-5 col-sm-offset-1">
    <div class="form-group">
      <label>Team Logo </label>

      <div class="input-group" id='load-logo'>
        <div class="fileinput fileinput-new" data-provides="fileinput">
          <div class="fileinput-preview thumbnail" data-trigger="fileinput">
          </div>
          <div>
            <span class="btn btn-info btn-file">
              <span class="fileinput-new">Select image</span>
              <span class="fileinput-exists">Change</span>
              <input type="file" name="logo">
            </span>
            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
          </div>
        </div>
      </div>

      <div id='show-logo' class="text-center" style="display: none; height: 30%; width: 100%;">
        <img id='show-logo-img' style="height: 80%; width: 90%;">
        <a class="btn btn-success" id='change-logo'>Change</a>
      </div>
    </div>

    <div class="form-group">
      <label>Team Color </label>
      <div class="cp-container">
        <div class="input-group form-group">
          <span class="input-group-addon"><i class="zmdi zmdi-invert-colors"></i></span>
          <div class="fg-line dropdown">
            {{Form::text('team_color_first', null, ['class' => 'form-control cp-value', 'data-toggle' => 'dropdown'])}}
            <div class="dropdown-menu">
              <div class="color-picker" data-cp-default="#03A9F4"></div>
            </div>
            <i class="cp-value" id="first-cp"></i>
          </div>
        </div>
      </div>
      <br/><br/>
      <div class="cp-container">
        <div class="input-group form-group">
          <span class="input-group-addon"><i class="zmdi zmdi-invert-colors"></i></span>
          <div class="fg-line dropdown">
            {{Form::text('team_color_second', null, ['class' => 'form-control cp-value', 'data-toggle' => 'dropdown'])}}
            <div class="dropdown-menu">
              <div class="color-picker" data-cp-default="#8BC34A"></div>
            </div>
            <i class="cp-value" id="second-cp"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <br/><br/>
  <button type="submit" class="btn btn-primary btn-block">{{$submitButton}}</button>
</div>
