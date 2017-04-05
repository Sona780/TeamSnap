@extends('layouts.app')


@section('content')

<div class="block-header">
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header m-b-20">
        <h2>My Teams</h2>

        <a href="{{url('team/create')}}">
          <button class="btn bgm-red btn-float waves-effect"><i class="zmdi zmdi-plus"></i></button>
        </a>

      </div>
    </div>
  </div>
</div>

<div class="row">

  @foreach($teams as $team )
    <div class="col-sm-3" team='{{$team->id}}' id="team_tab">
      <div class="card" style="background-color: {{$team->team_color_first}};">
        <div class="card-body" style="padding: 10px 10px">
          <div style="display: inline-block">
            <img src="{{url($team->team_logo)}}" style="height: 70; border-radius: 20px" />
          </div>
          <div style="display: inline-block; padding-left: 20%; text-transform: uppercase; cursor: pointer">
            <h6>{{$team->teamname}}</h6>
          </div>
        </div>
      </div>
    </div>
  @endforeach

</div>

@endsection

@section('footer')

<script src="{{URL::to('/')}}/js/notify.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    type = ( {{$user->manager_access}} == 1 ) ? 'manager' : 'member';
    notify('top', 'right', 'inverse', 'Welcome <B>{{$user->firstname}} {{$user->lastname}}</B>. You are logged in as a '+type);
  });

  $('.row').on('click', '#team_tab', function(){
    path = $(this).attr('team')+"/dashboard";
    window.location = "{{url('/')}}/"+path;
  });
</script>

@endsection
