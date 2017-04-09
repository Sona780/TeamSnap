@extends('layouts.new', ['team' => $id, 'active' => 'dashboard', 'logo' => $team->team_logo, 'name' => $team->teamname])


@section('header')

@endsection

@section('content')

<div class="block-header">
</div>

<div class="mini-charts">
  <div class="row">
    <div class="col-xs-6 col-sm-3 col-md-3">
      <a href='{{url($id."/members")}}'>
        <div class="mini-charts-item bgm-cyan">
          <div class="clearfix">
            <div class="count">
              <small>Total Members </small>
              <h2>{{$total['members']}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-6 col-sm-3 col-md-3">
      <a href='{{url($id."/schedule")}}'>
        <div class="mini-charts-item bgm-lightgreen">
          <div class="clearfix">
            <div class="count">
              <small>Events</small>
              <h2>{{$total['events']}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-6 col-sm-3 col-md-3">
      <a href='{{url($id."/schedule")}}'>
        <div class="mini-charts-item bgm-orange">
          <div class="clearfix">
            <div class="count">
              <small>Games Played</small>
              <h2>{{$total['games_played']}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-6 col-sm-3 col-md-3">
      <a href='{{url($id."/schedule")}}'>
        <div class="mini-charts-item bgm-orange">
          <div class="clearfix">
            <div class="count">
              <small>Games</small>
              <h2>{{$total['games']}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<div class="dash-widgets">
  <div class="row">

    <div class="col-md-9 col-sm-12">
      <div id="pie-charts" class="dash-widget-item bgm-pink" style="min-height: 260px;">
        <div class="bgm-pink">
          <div class="dash-widget-header">
            <div class="dash-widget-title f-20">Team Info</div>
            <div class="pull-right col-sm-1" style="display: inline-block;">

              @if( $user->manager_access == 1 )
                <ul class="actions">
                  <li class="dropdown">
                    <a href="" data-toggle="dropdown">
                      <i class="zmdi zmdi-more-vert"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                      <li><a id='info-edit' style="cursor: pointer">Edit</a></li>
                    </ul>
                  </li>
                @endif
              </ul>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class=" p-20 m-t-25" style="color: #fff" id='team-detail'>
            <div class="col-sm-8" >
              {{$info->detail}}
            </div>
            <div class="col-sm-4 pull-right">
              <img src='@if($info->uniform != "") {{url($info->uniform)}} @endif ' id='team-uniform' style="width: 200px; height: 200px">
            </div>
          </div>



        </div>
      </div>
    </div>

    <div class="col-md-3 col-sm-12">
      <div id="site-visits" class="dash-widget-item bgm-teal card" style="min-height: 20px;">
        <div class="card-header" style="padding-top: 3em;">
          <div class="dash-widget-title">Public URL :
            <div class="pull-right">
              <div class="toggle-switch" data-ts-color="lime" >
                <input id="ts2" type="checkbox"  hidden="hidden">
                <label for="ts2" class="ts-helper" ></label>
              </div>
            </div>
            <br>
            <a href="http://{{$teamname}}.org4teams.com" class="c-white f-400">http://{{$teamname}}.org4teams.com</a>
          </div>
        </div>

        <div class="p-20">
          <small>Page Views</small>
          <h3 class="m-0 f-400">6,536</h3>
          <br/>
          <small>Site Visitors</small>
          <h3 class="m-0 f-400">5,799</h3>
          <br/>
          <small>Total Clicks</small>
          <h3 class="m-0 f-400">13,965</h3>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header bgm-bluegray m-b-20">
        <h2>Announcements <small>Don't miss latest team updates</small></h2>

        @if( $user->manager_access == 1 )
          <button class="btn bgm-blue btn-float waves-effect waves-circle waves-float" data-toggle="modal" id="new-announcement" data-target="#announcement-modal">
            <i class="zmdi zmdi-plus"></i>
          </button>
        @endif
      </div>

      <div class="card-body">
        <div class="listview" id='all-announcements'>

          <ul class='li-class' id="example2">
            @foreach($announcements as $a)
              <li>
                <a class="lv-item">
                  <div class="media">
                    <div class="media-body">
                      <div class="lv-title">{{$a->title}}</div>
                      <small class="lv-small">{{$a->announcement}}</small>
                    </div>
                  </div>
                </a>
              </li>
            @endforeach
          </ul>

          <div class="lv-footer">
            <div id="example2-pagination">
              <a id="example2-previous" href="#">&laquo; Previous</a>
              <a id="example2-next" href="#">Next &raquo;</a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <!-- Calendar -->
    <div id="calendar"></div>
  </div>
</div>

<!-- start new info modal -->
<div id="team-info-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center">Team Detail</h4>
      </div>
      <!-- Modal header -->
      {{ Form::model($info, ['method' => 'post', 'url' => $id.'/team/info/save', 'files' => true, 'id' => 'info-form']) }}
          @include('partials.team-info')
      {{Form::close()}}
    </div>
  </div>
</div>
<!-- end new info modal -->

<!-- start new announcement modal -->
<div id="announcement-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center">New Announcement</h4>
      </div>
      <!-- Modal header -->
      {{ Form::open(['method' => 'post', 'url' => '/announcement/save', 'id' => 'announcement-form']) }}
          @include('partials.announcement')
      {{Form::close()}}
    </div>
  </div>
</div>
<!-- end new announcement modal -->

@endsection

@section('footer')
<script src="{{URL::to('/')}}/js/notify.js"></script>
<script>

  $('#info-edit').click(function(){
    $('#team-info-modal').modal('show');
    $('#info-form').trigger("reset");
    $('#team-uniform-img').attr('src', '{{url($info->uniform)}}');
  });

  $('#uniform-change').click(function(){
    $('#upload-uniform').show();
    $('#show-uniform').hide();
  });

  $('#new-announcement').click(function(){
    $('#announcement-form').trigger("reset");
  });

  $('#submit-announcement').click(function(){
    form = $('#announcement-form');
    title = form.find('input[name="title"]');
    data  = form.find('textarea[name="announcement"]');

    form.find('strong').html('');

    if( title.val() == '' )
    {
      title.focus();
      $('#error-title').html('Title of the announcement required.');
    }
    else if( data.val() == '' )
    {
      data.focus();
      $('#error-announcement').html('Announcement Detail required.');
    }
    else
    {
      url = '{{url($id."/announcement/save")}}';
      $.post(url, $('#announcement-form').serializeArray(), function(){
        $('#announcement-modal').modal('hide');

        content = '<li><a class="lv-item"><div class="media"><div class="media-body"><div class="lv-title">'+ title.val() +'</div><small class="lv-small">'+ data.val() +'</small></div></div></a></li>';

        $('#example2').prepend(content).paginate({itemsPerPage: 5});
      });
    }
  });

  $(document).ready(function() {

    $('#example2').paginate({itemsPerPage: 5});

    var cId = $('#calendar'); //Change the name if you want. I'm also using thsi add button for more actions

    //Generate the Calendar
    cId.fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,listYear'
      },

      displayEventTime: true, // don't show the time column in list view
      googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',
      height: 500,

      //Add Events
      events: [
        @if( count($games) != 0 )
          @foreach( $games as $game )
          {
            id: {{$game->id}},
            type: 'game',
            title: 'vs. {{ $game->name }}',
            start: new Date( {{ \Carbon\Carbon::createFromFormat('d/m/Y', $game->date)->format('Y') }}, {{ \Carbon\Carbon::createFromFormat('d/m/Y', $game->date)->format('m') }} - 1, {{ \Carbon\Carbon::createFromFormat('d/m/Y', $game->date)->format('d') }}, {{$game->hour}}, {{$game->minute}} ),
            allDay: false,
            color: '#2196F3',
          },
          @endforeach
        @endif

        @if( count($events) != 0 )
          @foreach( $events as $event )
          {
            id: {{$event->id}},
            type: 'event',
            title: '{{ $event->name }}',
            start: new Date( {{ \Carbon\Carbon::createFromFormat('d/m/Y', $event->date)->format('Y') }}, {{ \Carbon\Carbon::createFromFormat('d/m/Y', $event->date)->format('m') }} - 1, {{ \Carbon\Carbon::createFromFormat('d/m/Y', $event->date)->format('d') }}, {{$event->hour}}, {{$event->minute}} ),
            allDay: false,
            color: '#4CAF50'
          },
          @endforeach
        @endif

      ],

      axisFormat: 'hh:mm a',

    });

    $('.fc-right').find('.fc-button-group').addClass('hidden-xs');
    $('.fc-content').find('.fc-time').hide();

    $('.fc-month-button').click(function(){
      $('.fc-content').find('.fc-time').hide();
    });

    $("#a").addClass("active");

    function notify(message, type){
      $.growl({
        message: message
      },{
        type: type,
        allow_dismiss: false,
        label: 'Cancel',
        className: 'btn-xs btn-inverse',
        placement: {
          from: 'top',
          align: 'right'
        },
        delay: 2000,
        animate: {
          enter: 'animated fadeIn',
          exit: 'animated fadeOut'
        },
        offset: {
          x: 20,
          y: 135
        }
      });
    };

    if (!$('.login-content')[0]) {
      notify('Welcome to Team : {{$teamname}} dashboard', 'inverse');
    }

  });

</script>
@endsection
