@extends('layouts.new', ['team' => $id, 'active' => 'schedule', 'name' => $curr, 'ld' => $ldid])

@section('header')
	<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" rel="stylesheet">
    <style type="text/css">
    	.table > tbody > tr > td
    	{
    		border-top: 0px;
    	}
    	.form-horizontal .control-label-new
    	{
            margin-bottom: 0;
		    padding-top: 7px;
		}
		.opp-detail
		{
			display: none;
		}
    </style>
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

    <div class="col-lg-12 col-xs-12 col-centered" id="manager">
      @if(Session::has('success'))
      <div class="alert alert-success alert-dismissable" id='alert'>
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{ Session::get('success') }}</strong>
      </div>
      @endif
      <div class='well'>
		   	<div style="display: inline-block; font-weight: none">
		    	&nbsp;&nbsp;&nbsp;&nbsp;Manager : &nbsp;&nbsp;&nbsp;&nbsp;
		        <button  class="btn btn-success" data-toggle="modal" data-target="#create-match">
                	New Match
            	</button>
		    </div>
  			<div class="fc-button-group pull-right" style="margin-top: 10px; margin-right: 10px">
  				<button type="button" class="fc-month-button fc-button fc-state-default fc-corner-left fc-state-active" href="#schedule-list" role="tab" data-toggle="tab" id="list-view" disabled>List View</button>
  				<button type="button" class="fc-listYear-button fc-button fc-state-default fc-corner-right" href="#schedule-calender" role="tab" data-toggle="tab" id="cal-view">Calender View</button>
  			</div>
    	</div>
    </div>

    <!-- start list and calendar view of the schedule -->
    <div class="tab-content" id='schedule-view'>

    	<!-- start list view of schedule -->
    	<div role="tabpanel" class="col-lg-12 col-xs-12 col-centered tab-pane active" id="schedule-list">

    		<div class="card p-10 table-responsive" id="table">

                <table id="example" class="table display responsive" cellspacing="0" width="100%">

                    <thead style="font-size: 15px">
                    	<tr>
                        	<th class="all" class="all"><img src='{{url("/")}}/img/blue.jpeg' />&nbsp;Matches</th>

			                <th>Result</th>
			                <th>Date</th>
			                <th>Time</th>
			                <th>Location</th>
			                <th>Contact person</th>
			                <th style="text-align: center" class="all">Manager</th>
                        </tr>
                    </thead>

                    <tbody id="tbody" style="font-size: 12px">
                      @foreach($matches as $match)
                      	<tr>
                      	  <td><B style="text-transform: uppercase">{{$match->team_name}}</B> ({{$match->div1}}) <B>v/s</B> <B style="text-transform: uppercase">{{$match->opponent}}</B> ({{$match->div2}})</td>

                      	  <td>{{$match->result}}</td>
                      	  <td>{{ \Carbon\Carbon::createFromFormat('d/m/Y', $match->match_date)->format('D d, M Y') }}</td>
                      	  <td>{{$match->hour}}:{{$match->minute}} {{$match->time}}</td>
                      	  <td>{{$match->loc_name}}</td>
                      	  <td>{{$match->contact}}</td>
                      	  <td style="text-align: center">
                      	  	<img src="{{url('/')}}/img/edit.png" class="icon-style" id="edit" key="{{ $match->id }}" data-toggle="modal" data-target="#edit-match" style="cursor: pointer" />
						                <a id="delete" key='{{ $match->id }}' type='match' style="cursor: pointer" >
		                          <img class="icon-style" src='{{url("/")}}/img/delete.png'>
		                        </a>
                      	  </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>

		    </div>

    	</div>
    	<!-- end list view of schedule -->


    	<!-- start calender view of schedule -->
    	<div role="tabpanel" class="tab-pane active" id="schedule-calender">
			<div class="col-sm-11 col-md-11">
	            <div id="loading"></div>
	            <div id="calendar"></div>
        	</div>
    	</div>
    	<!-- end calender view of schedule -->

    </div>
    <!-- end list and calendar view of the schedule -->



      <div id="create-match" class="modal fade" role="dialog">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <!-- start Modal header -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="text-align: center">Create Match</h4>
              <h6 id='error-new' style="text-align: center; color:red"></h6>
            </div>
            <!-- end Modal header -->
            {{ Form::open(['method' => 'post', 'url' => 'l/'.$id.'/d/'.$ldid.'/match/save', 'id' => 'create-match-form']) }}
              <div class="modal-body" id="create-body">
                <input type="hidden" name="league_division_id" value="{{$ldid}}">

                @if( $div['teams']->count() == 0 )
                  <!-- start divisions -->
                    <div class="col-sm-12">
                      <div class="form-group col-sm-5">
                        <select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" title='Select a league division' id="div1">
                          @foreach($div['child'] as $division)
                            <option value="{{$division->id}}">{{$division->division_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col-sm-2"></div>
                      <div class="form-group col-sm-5">
                        <select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" title='Select a league division' id="div2">
                          @foreach($div['child'] as $division)
                            <option value="{{$division->id}}">{{$division->division_name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  <!-- end divisions -->
                @endif

                <!-- start teams -->
                  <div class="col-sm-12">
                    <div class="form-group col-sm-5">
                      <select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" name="team1_id" title='Select a team' id="team1">
                        @if( $div['teams']->count() > 0 )
                          @foreach($div['teams'] as $team)
                            <option value="{{$team->team_id}}">{{$team->teamname}}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <h6 style="text-align: center">v/s</h6>
                    </div>
                    <div class="form-group col-sm-5">
                      <select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" name="team2_id" title='Select opponent team' id="team2">
                        @if( $div['teams']->count() > 0 )
                          @foreach($div['teams'] as $team)
                            <option value="{{$team->team_id}}">{{$team->teamname}}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                <!-- end teams -->

                @include('partials.league-match')
              </div>
              <div class="modal-footer">
                <button class="btn btn-success adjust" type="submit">Save</button>
                <button class="btn btn-default adjust" type="button" data-dismiss="modal" id="cancel">Cancel</button>
              </div>
            {{Form::close()}}
          </div>
        </div>
      </div>

      <div id="edit-match" class="modal fade" role="dialog">
        <div class="modal-dialog modal-default">
          <div class="modal-content">
            <!-- start Modal header -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="text-align: center" id="heading"></h4>
              <h6 id='error-edit' style="text-align: center; color:red"></h6>
            </div>
            <!-- end Modal header -->
            {{ Form::open(['method' => 'post', 'url' => "l/$id/d/$ldid/match/edit", 'id' => 'edit-match-form']) }}
              <div class="modal-body" id="edit-body">
                <input type="hidden" name="mid" id="mid">
                <input type="hidden" name="league_division_id" value="{{$ldid}}">
                @include('partials.league-match')
              </div>
              <div class="modal-footer">
                <button class="btn btn-success adjust" type="submit">Update</button>
                <button class="btn btn-default adjust" type="button" data-dismiss="modal" id="cancel">Cancel</button>
              </div>
            {{Form::close()}}
          </div>
        </div>
      </div>

@endsection
@section('footer')
  <script src="{{URL::to('/')}}/js/notify.js"></script>
  <script type="text/javascript">
    form = $('#create-match-form');

    form.find('#location').change(function(){
      val = $(this).val();
      if( val == 'new' ) form.find('#new_loc').show();
      else form.find('#new_loc').hide();
    });

  	form.submit(function(e){
  		e.preventDefault();
      form = $('#create-body');

  		t1   = form.find('#team1').val();
  		t2   = form.find('#team2').val();

      if(t1 == '' || t2 == '')
        $('#error-new').html('Select teams for the match.');
      else
        vali(form, $('#error-new'), this);
  	});

    function vali(form, error, self)
    {
      date = form.find('input[name="match_date"]').val();
      hour = form.find('input[name="hour"]').val();
      min  = form.find('input[name="minute"]').val();
      loc  = form.find('select[name="location"]').val();
      name = form.find('input[name="loc_name"]').val();

      if( date == '' || hour == '' || min == '' )
        error.html('Required fields should\'t be empty.');
      else if( isNaN(hour) || isNaN(min) )
        error.html('Hour & minute should be integer only.');
      else if( loc == 'new' && name == '' )
        error.html('Location name required.');
      else
        self.submit();
    }

    $('#div1').change(function(){
    	id = $(this).val();
      getDivTeams(id, 'team1');
    });

    $('#div2').change(function(){
      id = $(this).val();
      getDivTeams(id, 'team2');
    });

    function getDivTeams(id, team)
    {
      url = '{{url("division/team")}}/'+id;
      $.post(url, function(t){
        content = '';
        for(i = 0; i < t.length; i++ )
          content += '<option value="'+t[i]['id']+'">'+t[i]['teamname']+'</option>';
        $('#create-body').find('#'+team).html(content).selectpicker('refresh');
      });
    }


    body = $('#edit-body');

    $('#tbody').on('click', '#edit', function(){
      id = $(this).attr('key');
      url = '{{url("l/$id/d/$ldid/match")}}/'+id;

      $.post(url, function(g){
        $('#heading').html(g['t1']+" vs "+g['t2']);
        body.find('input[name="match_date"]').val(g['detail']['match_date']);
        body.find('input[name="hour"]').val(g['detail']['hour']);
        body.find('input[name="minute"]').val(g['detail']['minute']);
        body.find('input[name="result"]').val(g['detail']['result']);
        body.find('select[name="time"]').val(g['detail']['time']);
        body.find('#location').val(g['detail']['league_location_id']);
        body.find('#location').selectpicker('refresh');
        body.find('#new_loc').hide();
        body.find('#mid').val(id);
      });
    });

    $('#edit-match-form').find('#location').change(function(){
      val = $(this).val();
      if( val == 'new' ) body.find('#new_loc').show();
      else body.find('#new_loc').hide();
    });

    $('#edit-match-form').submit(function(e){
      e.preventDefault();
      vali(body, $('#error-edit'), this);
    });

  		$('#example').on('click', '#delete', function(){
          id = $(this).attr('key');

          swal({
              title: "Are you sure?",
              text: "Do you really want to delete this match?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: true
              }, function(){
                  window.location.href = '{{url("l/$id/d/$ldid/match/delete")}}/'+id;
          });
      	});

    	// start load datatable on page load
	        $(document).ready(function(){
              $("#alert").fadeTo(2000, 500).slideUp(500, function(){
                $("#success-alert").slideUp(500);
              });
	            $('#example').DataTable();
	            $('#new-game').find('tr[id="add-info"]').hide();
	        });
        // end load datatable on page load

        // start active list view button on clicking it
	        $('#list-view').click(function(){
	        	$('#cal-view').removeClass('fc-state-active');
		    	$('#list-view').addClass('fc-state-active');
	        });
	    // end active list view button on clicking it

        // start when calendar view is opened
	    	$('#cal-view').click(function(){
	    		$('#list-view').removeAttr('disabled');
	    		$('#list-view').removeClass('fc-state-active');
	    		$('#cal-view').addClass('fc-state-active');

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
		                            title: '{{$match->team_name}} v/s {{ $match->opponent }}',
		                            start: new Date( {{ \Carbon\Carbon::createFromFormat('d/m/Y', $match->match_date)->format('Y') }}, {{ \Carbon\Carbon::createFromFormat('d/m/Y', $match->match_date)->format('m') }} - 1, {{ \Carbon\Carbon::createFromFormat('d/m/Y', $match->match_date)->format('d') }}, {{$match->hour}}, {{$match->minute}} ),
		                            allDay: false,
		                            color: '#2196F3',
		                        },
		                    @endforeach
		                @endif
		            ],

					axisFormat: 'hh:mm a',

					loading: function(bool) {
						$('#loading').html('loading...').toggle(bool);
					},

		            //On Day Select
		            select: function(start, end, allDay) {
		                $('#addNew-event').modal('show');
		                $('#addNew-event input:text').val('');
		                $('#getStart').val(start);
		                $('#getEnd').val(end);
		            }
		        });

		        $('.fc-right').find('.fc-button-group').addClass('hidden-xs');
	    	});
	    // end when calendar view is opened
    </script>
@endsection
