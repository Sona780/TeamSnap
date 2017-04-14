@extends('layouts.new', ['team' => $id, 'active' => 'schedule', 'name' => $league->league_name])

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

    <div class="col-lg-12 col-xs-12 col-centered" id="manager">
        <div class='well'>

		    	<div style="display: inline-block; font-weight: none">
		    		&nbsp;&nbsp;&nbsp;&nbsp;Manager : &nbsp;&nbsp;&nbsp;&nbsp;

		    		<!--<div class="btn-group">
		                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
		                    &nbsp;&nbsp;&nbsp;&nbsp;New&nbsp;&nbsp;&nbsp;&nbsp;<span class="caret"></span>
						</button>
		                <ul class="dropdown-menu pull-left" role="menu">
		                    <li><a href="#create-match" role="tab" data-toggle="tab">Match</a></li>
		                	<li class="divider"></li>
		                	<li><a href='#' id="create-event">Event</a></li>
		                </ul>
		            </div>-->
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
			                <th class="all">Division</th>
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
                      	  <td><span style="text-transform: uppercase">{{$match->team_name}}</span> <B>v/s</B> <span style="text-transform: uppercase">{{$match->opponent}}</span></td>
                      	  <td>{{$match->division_name}}</td>
                      	  <td>{{$match->result}}</td>
                      	  <td>{{ \Carbon\Carbon::createFromFormat('d/m/Y', $match->match_date)->format('D d, M Y') }}</td>
                      	  <td>{{$match->hour}}:{{$match->minute}} {{$match->time}}</td>
                      	  <td>{{$match->loc_name}}</td>
                      	  <td>{{$match->contact}}</td>
                      	  <td style="text-align: center">
						    <a id="delete" key='{{ $match->id }}' type='match'>
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
            <!-- Modal header -->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="text-align: center">Create Match</h4>
              <h6 id='error-match' style="text-align: center; color:red"></h6>
            </div>

              {{ Form::open(['method' => 'post', 'url' => 'league/'.$id.'/match/save', 'id' => 'create-match-form']) }}
                <div class="modal-body">
                  <!-- start divisions -->
                    <div class="col-sm-12">
	                  <div class="form-group col-sm-12">
	                  	<select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" name="league_division_id" title='Select a league division' id="league_division">
						  @foreach($divisions as $division)
						  	<option value="{{$division->id}}">{{$division->division_name}}</option>
						  @endforeach
						</select>
	                  </div>
	                </div>
	              <!-- end divisions -->

                  <!-- start teams -->
                    <div class="col-sm-12">
                  	  <div class="form-group col-sm-5">
					  	<select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" name="team1" title='Select a team' id="team1">
					    </select>
					  </div>
					  <div class="col-sm-2">
					  	<h6 style="text-align: center">v/s</h6>
					  </div>
					  <div class="form-group col-sm-5">
					  	<select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" name="team2" title='Select opponent team' id="team2">
					  	</select>
					  </div>
                  	</div>
                  <!-- end teams -->

				  <!-- start date & time -->
				    <div class="col-sm-12">
					  <div class="form-group col-sm-6">
						<label>Date</label>
						<input type='text' class="form-control date-picker birthday" name="match_date">
					  </div>
					  <div class="form-group col-sm-6">
						<label>Time</label>
						<div class="form-inline">
						  <input type="text" class="form-control" name="hour" style="width: 50px">&nbsp;:&nbsp;
						  <input type="text" class="form-control" name="minute" style="width: 50px">&nbsp;&nbsp;
						  <select name="time" class="form-control" style="width: 50px">
							<option value="0">AM</option>
							<option value="1">PM</option>
						  </select>
						</div>
					  </div>
				    </div>
				  <!-- end date & time -->

				  <!-- start location dropdown -->
				  	<div class="col-sm-12">
					  <div class="form-group col-sm-12" style="padding-top: 13px">
		                <label for="categories" style="padding-right: 53px">Location</label>
		                <select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" name="location" title='Choose location' id="location">
		                </select>
		              </div>
		            </div>
		          <!-- end location dropdown -->

		          <!-- start new location detail -->
		          	<div class="col-sm-12">
		              <div class="form-group col-sm-4">
						<input type="text" class="form-control" name="loc_name" placeholder='Location name'>
					  </div>
					  <div class="form-group col-sm-4">
						<input type="text" class="form-control" name="loc_detail" placeholder='Location detail'>
					  </div>
					  <div class="form-group col-sm-4">
						<input type="text" class="form-control" name="contact" placeholder='Contact person'>
					  </div>
					</div>
				  <!-- end new location detail -->

                </div>
                <div class="modal-footer">
                  <button class="btn btn-success adjust" type="submit">Save</button>
                  <button class="btn btn-default adjust" type="button" id="cancel">Cancel</button>
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

  	form.submit(function(e){
  		e.preventDefault();

  		t1   = form.find('select[name="team1"]').val();
  		t2   = form.find('select[name="team2"]').val();

  		date = form.find('input[name="match_date"]').val();
  		hour = form.find('input[name="hour"]').val();
  		min  = form.find('input[name="minute"]').val();
  		loc  = form.find('select[name="location"]').val();
  		name = form.find('input[name="loc_name"]').val();

  		if(t1 == '' || t2 == '')
  			$('#error-match').html('Select teams to schedule match.');
  		else if( date == '' || hour == '' || min == '' )
  			$('#error-match').html('Required fields should\'t be empty.');
  		else if( isNaN(hour) || isNaN(min) )
  			$('#error-match').html('Hour & minute should be integer only.');
  		else if( loc == 0 && name == '' )
  			$('#error-match').html('Location name required.');
  		else
  			this.submit();
  	});

    $('#league_division').change(function(){
    	id = $(this).val();
    	url = '{{url("division/team_location")}}/'+id;
    	$.post(url, function(data){
    	  team_content = '';
    	  loc_content  = '<option value="0" checked>New Location</option><option value="default" disabled>-------------------------------</option> ';

    	  for( i = 0; i < data['teams'].length; i++ )
    	  	team_content += '<option value="'+ data['teams'][i]['id'] +'">'+ data['teams'][i]['team_name'] +'</option>';

    	  for( i = 0; i < data['loc'].length; i++ )
    	  	loc_content  += '<option value="'+ data['loc'][i]['id'] +'">'+ data['loc'][i]['loc_name'] +'</option>';

    	  form.find('#team1').html(team_content).selectpicker('refresh');
    	  form.find('#team2').html(team_content).selectpicker('refresh');
    	  form.find('#location').html(loc_content).selectpicker('refresh');
    	});
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
                  window.location.href = '{{url("league/".$id."/match/delete")}}/'+id;
          });
      	});

    	// start load datatable on page load
	        $(document).ready(function(){
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
