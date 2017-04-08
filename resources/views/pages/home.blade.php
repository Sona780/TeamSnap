@extends('layouts.app')


@section('content')

<div class="block-header">
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header m-b-20">
        <h2>My Teams</h2>

        @if($user->manager_access == 1)
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

          @if($user->manager_access == 1)
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
