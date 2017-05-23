@extends('layouts.app')


@section('content')

<div class="block-header">
</div>
@if(Session::has('success'))
<div class="alert alert-success alert-dismissable" id='alert'>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>{{ Session::get('success') }}</strong>
</div>
@endif

<div role="tabpanel">
  @if($user->manager_access != 0)
  <ul class="tab-nav tab-nav" role="tablist" id="myTab">
    <li class="@if(!Session::has('home')) active @endif"><a href="#my-teams" role="tab" data-toggle="tab">Teams</a></li>
    <li role="presentation" class="@if(Session::has('home')) active @endif"><a href="#my-leagues" role="tab" data-toggle="tab">Leagues</a></li>
  </ul>
  @endif

  <div class="tab-content">
    <!-- start teams -->
    <div role="tabpanel" class="tab-pane @if(!Session::has('home')) active @endif" id="my-teams">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header m-b-20">
              <h2>My Teams</h2>

              @if($user->manager_access != 0)
                <a href="{{url('team/create')}}">
                  <button class="btn bgm-red btn-float waves-effect"><i class="zmdi zmdi-plus"></i></button>
                </a>
              @endif

            </div>
          </div>
        </div>
      </div>

      <div class="row">

        @foreach($teams as $team )
          <div class="col-sm-3">
            <div class="card team-card" style="background-color: {{$team->team_color_first}};">

              <div class="card-body" style="padding: 10px 10px;">

                <div style="display: inline-block">
                  <img src="{{url($team->team_logo)}}" style="height: 70; border-radius: 20px" />
                </div>

                @if($user->manager_access != 0)
                  <div class="pull-right" style="display: inline-block;">
                    <ul class="actions">
                      <li class="dropdown">
                        <a href="" data-toggle="dropdown">
                          <i class="zmdi zmdi-more-vert"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="{{url('team/edit/'.$team->id)}}">Edit</a></li>
                          <li><a team='{{$team->id}}' id='delete' style="cursor: pointer">Delete</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                @endif

                <div class="set-width" style="padding-left:10%; text-transform: uppercase; cursor: pointer; overflow-x: hidden" team='{{$team->id}}' id="team_tab">
                  <h6>{{$team->teamname}}</h6>
                </div>

              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <!-- end teams -->

    <div role="tabpanel" class="tab-pane @if(Session::has('home')) active @endif" id="my-leagues">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header m-b-20">
              <h2>My Leagues</h2>

              @if($user->manager_access != 0)
                <button class="btn bgm-red btn-float waves-effect" data-toggle="modal" data-target="#league-modal"><i class="zmdi zmdi-plus"></i></button>
              @endif

            </div>
          </div>
        </div>
      </div>

      <div class="row">

        @foreach($leagues as $league )
          <div class="col-sm-3">
            <div class="card bgm-cyan">

              <div class="card-body" style="padding: 30px 10px; text-align: center; text-transform: uppercase">

                <a style="color: black;" href="{{url('l/'.$league->id.'/d/'.$league->ldid.'/dashboard')}}">{{$league->league_name}}</a>

              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<div id="league-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center">Create a League</h4>
        <h6 id="error-league" style="text-align: center; color: red"></h6>
      </div>

      {{ Form::open(['method' => 'post', 'url' => '/league/create', 'id' => 'league-form']) }}
        {!! csrf_field() !!}
        <div class="modal-body">
          <div class="form-group fg-line">
            <label for="name">Name <small style="color: red">(required)</small></label>
            <input type="text" class="form-control input-sm" name="league_name" autofocus>
          </div>

          <div class="form-group fg-line">
            <label for="lastname">No. of teams <small style="color: red">(required)</small></label>
            <input type="text" class="form-control input-sm" name="tot_teams">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info">Create</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      {{Form::close()}}

    </div>
  </div>
</div>

@endsection

@section('footer')

<script src="{{URL::to('/')}}/js/notify.js"></script>
<script type="text/javascript">
  $('#league-form').submit(function(e){
    e.preventDefault();
    name  = $(this).find('input[name="league_name"]').val();
    teams = $(this).find('input[name="tot_teams"]').val();

    if( name = '' || teams == '' )
      $('#error-league').html('Required fields are important.');
    else if(isNaN(teams))
      $('#error-league').html('Numeric value required for number of teams.');
    else
      this.submit();
  });

  $(document).ready(function(){
    $("#alert").fadeTo(2000, 500).slideUp(500, function(){
      $("#success-alert").slideUp(500);
    });
    switch({{$user->manager_access}})
    {
      case 0: type = "a member";
              break;
      case 1: type = "an owner";
              break;
      case 2: type = "a manager";
              break;
    }

    notify('top', 'right', 'inverse', 'Welcome <B>{{$user->firstname}} {{$user->lastname}}</B>. You are logged in as '+type);
  });

  $('.row').on('click', '#team_tab', function(){
    path = $(this).attr('team')+"/dashboard";
    window.location = "{{url('/')}}/"+path;
  });

  $('.row').on('click', '#delete', function(){
    id = $(this).attr('team');

    swal({
      title: "Are you sure?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: true
      }, function(){
        window.location.href = '{{url("team/delete")}}/'+id;
    });
  });
</script>

@endsection
