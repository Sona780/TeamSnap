@extends('layouts.new', ['team' => $id, 'active' => 'dashboard', 'logo' => $league->team_logo, 'name' => $league->league_name])


@section('header')

@endsection

@section('content')

<div class="block-header">
</div>

<div class="mini-charts">
  <div class="row">
    <div class="col-xs-6 col-sm-3 col-md-3">
      <a href='{{url("league/".$id."/detail")}}'>
        <div class="mini-charts-item bgm-cyan">
          <div class="clearfix">
            <div class="count">
              <small>Total Teams </small>
              <h2>{{$total['teams']}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-6 col-sm-3 col-md-3">
      <a href='{{url("league/".$id."/schedule")}}'>
        <div class="mini-charts-item bgm-lightgreen">
          <div class="clearfix">
            <div class="count">
              <small>Total matches</small>
              <h2>{{$total['matches']}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-6 col-sm-3 col-md-3">
      <a href='{{url("league/".$id."/schedule")}}'>
        <div class="mini-charts-item bgm-orange">
          <div class="clearfix">
            <div class="count">
              <small>Match Played</small>
              <h2>{{$total['played']}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-6 col-sm-3 col-md-3">
      <a href='{{url("league/".$id."/schedule")}}'>
        <div class="mini-charts-item bgm-orange">
          <div class="clearfix">
            <div class="count">
              <small>Remaining matches</small>
              <h2>{{$total['future']}}</h2>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header bgm-bluegray m-b-20">
        <h2>Announcements <small>Don't miss latest team updates</small></h2>


          <button class="btn bgm-blue btn-float waves-effect waves-circle waves-float" data-toggle="modal" id="new-announcement" data-target="#announcement-modal">
            <i class="zmdi zmdi-plus"></i>
          </button>

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
      {{ Form::open(['method' => 'post', 'url' => 'league/'.$id.'/announcement/save', 'id' => 'announcement-form']) }}
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
      url = '{{url("league/".$id."/announcement/save")}}';
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
        @if( count($matches) != 0 )
          @foreach( $matches as $match )
          {
            id: {{$match->id}},
            type: 'match',
            title: '{{ $match->team_name }} v/s {{ $match->opponent }}',
            start: new Date( {{ \Carbon\Carbon::createFromFormat('d/m/Y', $match->match_date)->format('Y') }}, {{ \Carbon\Carbon::createFromFormat('d/m/Y', $match->match_date)->format('m') }} - 1, {{ \Carbon\Carbon::createFromFormat('d/m/Y', $match->match_date)->format('d') }}, {{$match->hour}}, {{$match->minute}} ),
            allDay: false,
            color: '#2196F3',
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
      notify('Welcome to League : {{$league->league_name}} dashboard', 'inverse');
    }

  });

</script>
@endsection
