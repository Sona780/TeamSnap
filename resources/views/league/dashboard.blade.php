@extends('layouts.new', ['team' => $id, 'active' => 'dashboard', 'logo' => $league->team_logo, 'name' => $curr, 'ld' => $ldid])

@section('header')

@endsection

@section('content')

  <?php $i = 0; ?>
  <h5>
    @foreach($prev as $p)
      @if($i > 0)
        &nbsp;&nbsp;>&nbsp;&nbsp;
      @endif
      <a href="{{url('l/'.$id.'/d/'.$p['id'].'/dashboard')}}">{{$p['name']}}</a>
      <?php $i = 1; ?>
    @endforeach

    @if( sizeof($prev) > 0 )
      &nbsp;&nbsp;>&nbsp;&nbsp;
    @endif
    {{$curr}}
  </h5>
  <br>

@if(Session::has('success'))
<div class="alert alert-success alert-dismissable" id='alert'>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>{{ Session::get('success') }}</strong>
</div>
@endif

<div class="mini-charts">
  <div class="row">
    <div class="col-xs-6 col-sm-3 col-md-3">
      <a href='{{url("l/".$id."/d/".$ldid."/detail")}}'>
        <div class="mini-charts-item bgm-cyan">
          <div class="clearfix">
            <div class="count">
              <small>Total @if( $total['teams'] > 0 ) Teams @else Divisions @endif </small>
              <h2>@if( $total['teams'] > 0 ) {{$total['teams']}} @else {{$total['divs']}} @endif</h2>
            </div>
          </div>
        </div>
      </a>
    </div>

    <div class="col-xs-6 col-sm-3 col-md-3">
      <a href='{{url("l/".$id."/d/".$ldid."/schedule")}}'>
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
      <a href='{{url("l/".$id."/d/".$ldid."/schedule")}}'>
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
      <a href='{{url("l/".$id."/d/".$ldid."/schedule")}}'>
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
        <h2>Announcements <small>Don't miss latest league updates</small></h2>


          <button class="btn bgm-blue btn-float waves-effect waves-circle waves-float" data-toggle="modal" id="new-announcement" data-target="#announcement-modal">
            <i class="zmdi zmdi-plus"></i>
          </button>

      </div>

      <div class="card-body">
        @include('partials.announce-display', ['access' => 1])
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <!-- Calendar -->
    <div id="calendar"></div>
  </div>
</div>

@include('partials.announce-modal')

@endsection

@section('footer')
<script src="{{URL::to('/')}}/js/notify.js"></script>
<script>
  $('#example2').on('click', '#edit', function(){
    id = $(this).attr('key');
    url = '{{url("league/ann/edit")}}/'+id;
    $.post(url, function(d){
      form = $('#edit-ann-form');
      form.find('#id').val(id);
      form.find('input[name="start"]').val(d['start']);
      form.find('input[name="end"]').val(d['end']);
      form.find('input[name="title"]').val(d['title']);
      form.find('textarea[name="announcement"]').val(d['announcement']);
    });
  });

  $('#new-announcement').click(function(){
    $('#announcement-form').trigger("reset");
  });

  $('#submit-announcement').click(function(){
    form  = $('#announcement-form');
    title = form.find('input[name="title"]');
    start = form.find('input[name="start"]');
    end   = form.find('input[name="end"]');
    data  = form.find('textarea[name="announcement"]');
    error = $('#announcement-modal').find('#error-ann');

    error.html('');

    if( start.val() == '' || end.val() == '' )
    {
      error.html('Start and end date required.');
    }
    else if( title.val() == '' )
    {
      title.focus();
      error.html('Title of the announcement required.');
    }
    else if( data.val() == '' )
    {
      data.focus();
      error.html('Announcement Detail required.');
    }
    else
    {
      url = '{{url("l/".$id."/d/".$ldid."/announcement/save")}}';
      $.post(url, $('#announcement-form').serializeArray(), function(aid){
        $('#announcement-modal').modal('hide');

        content = '<li id="li'+aid+'"><a class="lv-item" style="background: white"><div class="media"><div class="media-body"><div class="lv-title" style="text-transform: uppercase" id="heading">'+ title.val() +'</div><p style="color: grey" id="detail">'+ data.val() +'</p></div></div><div class="pull-left" id="dates">'+start.val() +' to '+ end.val()+'</div><div class="pull-right"><button class="btn btn-success" type="button" id="edit" key="'+aid+'" data-toggle="modal" data-target="#edit-ann">Edit</button>&nbsp;<button class="btn btn-danger" type="button" key="'+aid+'" id="delete">Delete</button></div></a></li>';

        $('#example2').prepend(content).paginate({itemsPerPage: 1});
      });
    }
  });

  $('#edit-sub-announcement').click(function(){
    form  = $('#edit-ann-form');
    title = form.find('input[name="title"]');
    start = form.find('input[name="start"]');
    end   = form.find('input[name="end"]');
    data  = form.find('textarea[name="announcement"]');
    error = $('#edit-ann').find('#error-ann');

    error.html('');

    if( start.val() == '' || end.val() == '' )
    {
      error.html('Start and end date required.');
    }
    else if( title.val() == '' )
    {
      title.focus();
      error.html('Title of the announcement required.');
    }
    else if( data.val() == '' )
    {
      data.focus();
      error.html('Announcement Detail required.');
    }
    else
    {
      id = form.find('#id').val();
      url = '{{url("league/ann/edited")}}/'+id;
      $.post(url, form.serializeArray(), function(){
        $('#edit-ann').modal('hide');
        $('#example2').find('li[id="li'+id+'"]').find('#heading').html(title.val());
        $('#example2').find('li[id="li'+id+'"]').find('#detail').html(data.val());
        $('#example2').find('li[id="li'+id+'"]').find('#dates').html(start.val()+"  to  "+end.val());

      });
    }
  });

  $('#example2').on('click', '#delete', function(){

    id  = $(this).attr('key');

    swal({
      title: "Are you sure?",
      text: "The announcement will be deleted!!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: true
      }, function(){
        window.location.href = '{{url("league/announce/delete")}}/'+id;
      }
    );
  });

  $(document).ready(function() {
    $("#alert").fadeTo(2000, 500).slideUp(500, function(){
      $("#success-alert").slideUp(500);
    });

    $('#example2').paginate({itemsPerPage: 1});

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
