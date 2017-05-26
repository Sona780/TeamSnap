@extends('layouts.new', ['team' => $id, 'active' => 'schedule', 'logo' => $team->team_logo, 'name' => $team->teamname, 'first' => $team->team_color_first])

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
    	@if(Session::has('success'))
	      <div class="alert alert-success alert-dismissable" id='alert'>
	        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	        <strong>{{ Session::get('success') }}</strong>
	      </div>
	    @endif
    	@if( $user->manager_access != 0 )
        <div class='well'>
        @endif
        	@if( $user->manager_access != 0 )
		    	<div style="display: inline-block; font-weight: none">
		    		&nbsp;&nbsp;&nbsp;&nbsp;Manager : &nbsp;&nbsp;&nbsp;&nbsp;

		    		<div class="btn-group">
		                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
		                    &nbsp;&nbsp;&nbsp;&nbsp;New&nbsp;&nbsp;&nbsp;&nbsp;<span class="caret"></span>
						</button>
		                <ul class="dropdown-menu pull-left" role="menu">
		                    <li><a href='#' id="create-game">Game</a></li>
		                	<li class="divider"></li>
		                	<li><a href='#' id="create-event">Event</a></li>
		                </ul>
		            </div>
		        </div>
		    @endif

			<div class="fc-button-group pull-right" style="margin-top: 10px; margin-right: 10px">
				<button type="button" class="fc-month-button fc-button fc-state-default fc-corner-left fc-state-active" href="#schedule-list" role="tab" data-toggle="tab" id="list-view" disabled>List View</button>
				<button type="button" class="fc-listYear-button fc-button fc-state-default fc-corner-right" href="#schedule-calender" role="tab" data-toggle="tab" id="cal-view">Calender View</button>
			</div>
		@if( $user->manager_access != 0 )
    	</div>
    	@endif
    </div>

    <!-- start list and calendar view of the schedule -->
    <div class="tab-content" id='schedule-view'>

    	<!-- start list view of schedule -->
    	<div role="tabpanel" class="col-lg-12 col-xs-12 col-centered tab-pane active" id="schedule-list">
    	  @if( $games->count() > 0 || $events->count() > 0 )
    		<div class="card p-10 table-responsive" id="table">

                <table id="example" class="table display responsive" cellspacing="0" width="100%">

                    <thead style="font-size: 15px">
                    	<tr>
                        	<th class="all"><img src='{{url("/")}}/img/blue.jpeg' />&nbsp;Games/ <img src='{{url("/")}}/img/green.jpeg' />&nbsp;Events</th>
			                <th>Result</th>
			                <th>Date</th>
			                <th>Time</th>
			                <th>Location</th>
			                @if( $user->manager_access != 0 )
			                	<th class="all">Manager</th>
			                @endif
			                <th class="none">Location Detail</th>
			                <th class="none">Adress</th>
			                <th class="none">Link</th>
                        </tr>
                    </thead>

                    <tbody id="tbody" style="font-size: 12px">
				        @foreach($games as $game)
					    	<tr>
					        	<td><img src='{{url("/")}}/img/blue.jpeg' />&nbsp;&nbsp;&nbsp;vs. {{ $game['opp']->teamname }}</td>
					            <td>
					            	@if( $game['detail']->result == ''  )
					            		@if( $user->manager_access != 0 && $game['ch'] == 'yes' )
					                		<button id="edit" key='{{ $game["id"] }}' type='game' class="b-design">Enter Result</button>
					                	@else
					                		<span style="color: red">Not yet available</span>
					                	@endif
					               	@else
					                	{{ $game['detail']->result }}
					                @endif
					            </td>
					            <td>
					              @if( $game['type'] == 0 )
					                {{ \Carbon\Carbon::createFromFormat('d/m/Y', $game['detail']->date)->format('D d, M Y') }}
					              @else
					              	{{ \Carbon\Carbon::createFromFormat('d/m/Y', $game['detail']->match_date)->format('D d, M Y') }}
					              @endif
					            </td>
					            <td>
					            	{{ $game['detail']->hour }}:{{ $game['detail']->minute }}&nbsp;{{ $game['detail']->time }}
					            </td>

					            <td>
					              @if( $game['type'] == 0 ) {{ $game['loc']->name }}
					              @else {{ $game['loc']->loc_name }}
					              @endif
					            </td>

					            @if( $user->manager_access != 0 )
					              @if($game['ch'] == 'no') <td></td>
					              @else
						            <td>
		                        		<a id="edit" key='{{ $game["id"] }}' type='game'>
		                        			<img class="icon-style" src='{{url("/")}}/img/edit.png'>
		                        		</a>

										<a id="delete" key='{{ $game["id"] }}' type='game'>
		                        			<img class="icon-style" src='{{url("/")}}/img/delete.png'>
		                        		</a>
	                                </td>
	                              @endif
	                            @endif
	                            @if( $game['type'] == 0 )
                                  <td>{{ $game['loc']->detail }}</td>
                                  <td>{{ $game['loc']->address }}</td>
                                  <td>{{ $game['loc']->link }}</td>
                                @else
                                  <td>{{ $game['loc']->loc_detail }}</td>
                                  <td>{{ $game['loc']->contact }}</td>
                                  <td>-</td>
                                @endif
					        </tr>
				        @endforeach
				        @foreach($events as $event)
							<tr>
				                <td><img src='{{url("/")}}/img/green.jpeg' />&nbsp;&nbsp;&nbsp;{{ $event->name }}</td>
					            <td></td>
					            <td>{{ \Carbon\Carbon::createFromFormat('d/m/Y', $event->date)->format('D d, M Y') }}</td>
					            <td>
					            	{{ $event->hour }}:{{ $event->minute }}&nbsp;{{ $event->time }}
					            </td>
					            <td>{{ $event->location->name }}</td>
					            @if( $user->manager_access != 0 )
						            <td>
	                                	<a id="edit" key='{{ $event->id }}' type='event'>
		                        			<img class="icon-style" src='{{url("/")}}/img/edit.png'>
		                        		</a>

										<a id="delete" key='{{ $event->id }}' type='event'>
		                        			<img class="icon-style" src='{{url("/")}}/img/delete.png'>
		                        		</a>
	                                </td>
	                            @endif
                                <td>{{ $event->location->detail }}</td>
                                <td>{{ $event->location->address }}</td>
                                <td>{{ $event->location->link }}</td>
					        </tr>
				        @endforeach
                    </tbody>

                </table>

		    </div>
		  @else
		  	<div style="text-align: center">Nothing has been scheduled yet.</div>
		  @endif
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

    @if( $user->manager_access != 0 )
	    <!-- start create new game -->
	    	<div class="table-responsive" style="padding: 10px 5px; width: 70%; margin: auto; display: none" id="new-game">
				<div class="card">
				  <div class="card-header">
	                <h4>New Game</h4>
				  </div>
				  <div class="card-body card-padding">
					<form method="POST" action="{{url('/')}}/{{$id}}/new/game" id="game-form" class="form-horizontal" role="form">
						@include('partials.game-form', ['submitButton' => 'Save', 'opp' => $opp, 'loc' => $game_loc])
					</form>
				  </div>
				</div>
			</div>
		<!-- end create new game -->

		<!-- start create new event -->
			<div class="table-responsive" style="padding: 10px 5px; width: 70%; margin: auto; display: none" id="new-event">
				<div class="card">
				  <div class="card-header">
	                <h4>New Event</h4>
				  </div>
				  <div class="card-body card-padding">
					<form method="POST" action="{{url('/')}}/{{$id}}/new/event" id="event-form">
						@include('partials.event-form', ['submitButton' => 'Save', 'loc' => $event_loc])
					</form>
				  </div>
				</div>
			</div>
		<!-- end create new event -->

		<!-- start edit game -->
			<div class="table-responsive" style="padding: 10px 5px; width: 70%; margin: auto; display: none" id="edit-game">
				<div class="card">
				  <div class="card-header">
	                <h4>Edit Game</h4>
				  </div>
				  <div class="card-body card-padding">
					<form method="POST" action="{{url('/')}}/{{$id}}/edit/game" id="edit-game-form">
						<input type="hidden" name="id">
						@include('partials.game-form', ['submitButton' => 'Modify', 'opp' => $opp, 'loc' => $game_loc])
					</form>
				  </div>
				</div>
			</div>
		<!-- end edit game -->

		<!-- start edit event -->
			<div class="table-responsive" style="padding: 10px 5px; width: 70%; margin: auto; display: none" id="edit-event">
				<div class="card">
				  <div class="card-header">
	                <h4>Edit Game</h4>
				  </div>
				  <div class="card-body card-padding">
					<form method="POST" action="{{url('/')}}/{{$id}}/edit/event" id="edit-event-form">
						<input type="hidden" name="id">
						@include('partials.event-form', ['submitButton' => 'Modify', 'loc' => $event_loc])
					</form>
				  </div>
				</div>
			</div>
		<!-- end edit event -->
	@endif


	<!-- start modal to show game info in claendar view -->
	<div class="modal fade" id="game-data" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        	<div class="modal-content">
            	<div class="modal-header">
                	<h4 class="modal-title">Game Information</h4>
                </div>
                <div class="modal-body" id='game-details'>

                	<!-- start game schedule -->
	                	<div class="pmb-block">
				            <!-- start header of game schedule -->
				            <div class="pmbb-header">
				                <h4>Schedule</h4>
				            </div>
				            <!-- end header of game schedule -->

				            <!-- start body of game schedule -->
		                	<div class="pmbb-body p-l-30">
			                    <div class="pmbb-view">
			                        <dl class="dl-horizontal"><dt>Date</dt><dd id="date"></dd></dl>
			                        <dl class="dl-horizontal"><dt>Time</dt><dd id="time"></dd></dl>
			                        <dl class="dl-horizontal"><dt>Duration</dt><dd id="duration"></dd></dl>
			                    </div>
			                </div>
			                <!-- end body of game schedule -->
		                </div>
	                <!-- end game schedule -->

	                <!-- start opponent detail -->
	                	<div class="pmb-block">
				            <!-- start header of opponent detail -->
				            <div class="pmbb-header">
				                <h4>Opponent Details</h4>
				            </div>
				            <!-- end header of opponent detail -->

				            <!-- start body of opponent detail -->
		                	<div class="pmbb-body p-l-30">
			                    <div class="pmbb-view">
			                        <dl class="dl-horizontal"><dt>Name</dt><dd id="name"></dd></dl>
			                        <dl class="dl-horizontal"><dt>Contact Person</dt><dd id="c-person"></dd></dl>
			                        <dl class="dl-horizontal"><dt>Phone No.</dt><dd id="phone"></dd></dl>
			                        <dl class="dl-horizontal"><dt>Email</dt><dd id="email"></dd></dl>
			                    </div>
			                </div>
			                <!-- end body of opponent detail -->
		                </div>
	                <!-- end opponent detail -->

	                <!-- start location detail -->
	                	<div class="pmb-block">
				            <!-- start header of location detail -->
				            <div class="pmbb-header">
				                <h4>Location Details</h4>
				            </div>
				            <!-- end header of location detail -->

				            <!-- start body of location detail -->
		                	<div class="pmbb-body p-l-30">
			                    <div class="pmbb-view">
			                        <dl class="dl-horizontal"><dt>Name</dt><dd id="l-name"></dd></dl>
			                        <dl class="dl-horizontal"><dt>Loction Detail</dt><dd id="l-detail"></dd></dl>
			                        <dl class="dl-horizontal"><dt>Address</dt><dd id="address"></dd></dl>
			                        <dl class="dl-horizontal"><dt>Link</dt><dd id="link"></dd></dl>
			                    </div>
			                </div>
			                <!-- end body of location detail -->
		                </div>
	                <!-- end location detail -->

                </div>
                <div class="modal-footer">
                	@if( $user->manager_access != 0 )
	                	<button type="button" class="btn btn-link" id="game-data-edit">edit</button>
	                	<button type="button" class="btn btn-link" id="game-data-delete">Delete</button>
                	@endif
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal to show game info in claendar view -->

    <!-- start modal to show event info in claendar view -->
    <div class="modal fade" id="event-data" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        	<div class="modal-content">
            	<div class="modal-header">
                	<h4 class="modal-title">Event Information</h4>
                </div>
                <div class="modal-body" id='event-details'>

                	<!-- start location detail -->
	                	<div class="pmb-block">
				            <!-- start header of location detail -->
				            <div class="pmbb-header">
				                <h4>Details</h4>
				            </div>
				            <!-- end header of location detail -->

				            <!-- start body of location detail -->
		                	<div class="pmbb-body p-l-30">
			                    <div class="pmbb-view">
			                        <dl class="dl-horizontal"><dt>Name</dt><dd id="name"></dd></dl>
			                        <dl class="dl-horizontal"><dt>Short Label</dt><dd id="label"></dd></dl>
			                    </div>
			                </div>
			                <!-- end body of location detail -->
		                </div>
	                <!-- end location detail -->

                	<!-- start event schedule -->
	                	<div class="pmb-block">
				            <!-- start header of event schedule -->
				            <div class="pmbb-header">
				                <h4>Schedule</h4>
				            </div>
				            <!-- end header of event schedule -->

				            <!-- start body of event schedule -->
		                	<div class="pmbb-body p-l-30">
			                    <div class="pmbb-view">
			                        <dl class="dl-horizontal"><dt>Date</dt><dd id="date"></dd></dl>
			                        <dl class="dl-horizontal"><dt>Time</dt><dd id="time"></dd></dl>
			                    </div>
			                </div>
			                <!-- end body of event schedule -->
		                </div>
	                <!-- end event schedule -->

                	<!-- start location detail -->
	                	<div class="pmb-block">
				            <!-- start header of location detail -->
				            <div class="pmbb-header">
				                <h4>Location Details</h4>
				            </div>
				            <!-- end header of location detail -->

				            <!-- start body of location detail -->
		                	<div class="pmbb-body p-l-30">
			                    <div class="pmbb-view">
			                        <dl class="dl-horizontal"><dt>Name</dt><dd id="l-name"></dd></dl>
			                        <dl class="dl-horizontal"><dt>Loction Detail</dt><dd id="l-detail"></dd></dl>
			                        <dl class="dl-horizontal"><dt>Address</dt><dd id="address"></dd></dl>
			                        <dl class="dl-horizontal"><dt>Link</dt><dd id="link"></dd></dl>
			                    </div>
			                </div>
			                <!-- end body of location detail -->
		                </div>
	                <!-- end location detail -->

                </div>
                <div class="modal-footer">
                	@if( $user->manager_access != 0 )
                		<button type="button" class="btn btn-link" id="event-data-edit">Edit</button>
                		<button type="button" class="btn btn-link" id="event-data-delete">Delete</button>
                	@endif
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal to show event info in claendar view -->

@endsection
@section('footer')

	<script src="{{URL::to('/')}}/js/notify.js"></script>

    <script type="text/javascript">

    	// start load datatable on page load
	        $(document).ready(function(){
	        	$('input[name="date"]').datetimepicker({ minDate: new Date(), format: 'DD/MM/YYYY' });
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

		                @if( count($games) != 0 )
		                    @foreach( $games as $game )
		                        {
		                        	id: {{$game['id']}},
		                        	type: 'game',
		                            title: 'vs. {{ $game["opp"]["teamname"] }}',
		                            start:
		                              @if( $game['type'] == 0 )
		                            	new Date( {{ \Carbon\Carbon::createFromFormat('d/m/Y', $game['detail']->date)->format('Y') }}, {{ \Carbon\Carbon::createFromFormat('d/m/Y', $game['detail']->date)->format('m') }} - 1, {{ \Carbon\Carbon::createFromFormat('d/m/Y', $game['detail']->date)->format('d') }}, {{$game['detail']->hour}}, {{$game['detail']->minute}} ),
		                              @else
		                              	new Date( {{ \Carbon\Carbon::createFromFormat('d/m/Y', $game['detail']->match_date)->format('Y') }}, {{ \Carbon\Carbon::createFromFormat('d/m/Y', $game['detail']->match_date)->format('m') }} - 1, {{ \Carbon\Carbon::createFromFormat('d/m/Y', $game['detail']->match_date)->format('d') }}, {{$game['detail']->hour}}, {{$game['detail']->minute}} ),
		                              @endif
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

		            eventClick: function(event) {
						id   = event.id;
						type = event.type;

						if(type == 'game')
							viewGame(id);
						else
							viewEvent(id);
					},

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

	    // start js for event data modal
		    // start populate event data modal on clicking on an event in calendar view
		    	function viewEvent(id)
		    	{
		    		url = '{{url("event/data")}}/'+id;

		    		$.post(url, function(event){
		    			$('#event-data').modal('show');
		    			det = $('#event-details');

		    			det.find('#name').html(event['name']);
		    			det.find('#label').html(event['label']);

		    			det.find('#l-name').html(event['loc_name']);
		    			det.find('#l-detail').html(event['loc_detail']);
		    			det.find('#address').html(event['address']);
		    			det.find('#link').html(event['link']);

		    			if( parseInt(event['minute']) < 10 )
		    				event['minute'] = '0'+event['minute'];

		    			det.find('#date').html(event['date']);
		    			det.find('#time').html(event['hour']+':'+event['minute']+' '+event['time']);

		    			$('#event-data-edit').attr('key', id);
		    			$('#event-data-delete').attr('key', id);
		    		});
		    	}
		    // end populate event data modal on clicking on an event in calendar view

	    	// start open edit event form on clicking edit button
		    	$('#event-data-edit').click(function(){
		    		editEvent($(this).attr('key'));
		    		$('#event-data').modal('hide');
		    	});
	    	// end open edit event form on clicking edit button

	    	// start delete event on clicking delete button
		    	$('#event-data-delete').click(function(){
		    		id = $(this).attr('key');
		    		deleteEvent(id);
		    	});
	    	// end delete event on clicking delete button
	    // end js for event data modal

    	// start js for game data modal
	    	// start populate game data modal on clicking on a game in calendar view
		    	function viewGame(id)
		    	{
		    		url = '{{url($id."/game/data")}}/'+id;

		    		$.post(url, function(game){
		    			$('#game-data').modal('show');
		    			det = $('#game-details');
		    			det.find('#name').html(game['name']);

		    			if( game['game_type'] == 0 )
		    			{
		    			  det.find('#c-person').html(game['contact_person']);
		    			  det.find('#phone').html(game['phone_no']);
		    			  det.find('#email').html(game['email']);

		    			  det.find('#l-name').html(game['loc']['name']);
		    			  det.find('#l-detail').html(game['loc']['detail']);
		    			  det.find('#address').html(game['loc']['address']);
		    			  det.find('#link').html(game['loc']['link']);

		    			  det.find('#duration').html(game['detail']['duration_hour']+':'+game['detail']['duration_minute']);
		    			  det.find('#date').html(game['detail']['date']);

		    			  $('#game-data-edit').show();
		    			  $('#game-data-delete').show();
		    			}
		    			else
		    			{
		    			  det.find('#c-person').html('-');
		    			  det.find('#phone').html('-');
		    			  det.find('#email').html('-');
		    			  det.find('#address').html('-');
		    			  det.find('#link').html('-');
		    			  det.find('#duration').html('-');

		    			  det.find('#l-name').html(game['loc']['loc_name']);
		    			  det.find('#l-detail').html(game['loc']['loc_detail']);
		    			  det.find('#date').html(game['detail']['match_date']);

		    			  $('#game-data-edit').hide();
		    			  $('#game-data-delete').hide();
		    			}

		    			det.find('#time').html(game['detail']['hour']+':'+game['detail']['minute']+' '+game['detail']['time']);

		    			$('#game-data-edit').attr('key', id);
		    			$('#game-data-delete').attr('key', id);
		    		});
		    	}
	    	// start populate game data modal on clicking on a game in calendar view

	    	// start open edit game form on clicking edit button
		    	$('#game-data-edit').click(function(){
		    		editGame($(this).attr('key'));
		    		$('#game-data').modal('hide');
		    	});
	    	// end open edit game form on clicking edit button

	    	// start delete game on clicking delete button
		    	$('#game-data-delete').click(function(){
		    		id = $(this).attr('key');
		    		deleteGame(id);
		    	});
	    	// end delete game on clicking delete button
	    // end js for game data modal

    	// start manage opponent while creating game
	    	$('#new-game').find('#opponent').change(function(){
	    		val = $(this).val();
	    		if( val != 0 || val == '' )
	    			$('#new-game').find('#opp-detail').hide();
	    		else
	    			$('#new-game').find('#opp-detail').show();
	    	});
    	// end manage opponent while creating game

    	// start manage location while creating game
	    	$('#new-game').find('#location').change(function(){
	    		val = $(this).val();
	    		if( val != 0 || val == '' )
	    			$('#new-game').find('tr[id="loc-data"]').hide();
	    		else
	    			$('#new-game').find('tr[id="loc-data"]').show();
	    	});
    	// end manage location while creating game

    	// start manage opponent while editing game info
	    	$('#edit-game').find('#opponent').change(function(){
	    		val = $(this).val();
	    		if( val != 0 || val == '' )
	    			$('#edit-game').find('#opp-detail').hide();
	    		else
	    		{
	    			$('#edit-game').find('#opp-detail').show();
	    			$('#edit-game').find('#opp-detail').find('input').val('');
	    		}
	    	});
    	// end manage opponent while editing game info

    	// start manage location while editing game info
	    	$('#edit-game').find('#location').change(function(){
	    		val = $(this).val();

	    		if( val != 0 || val == '' )
	    			$('#edit-game').find('tr[id="loc-data"]').hide();
	    		else
	    		{
	    			$('#edit-game').find('tr[id="loc-data"]').show();
	    			$('#edit-game').find('tr[id="loc-data"]').find('input').val('');
	    		}
	    	});
    	// end manage location while editing game info

    	// start manage opponent while editing event info
	    	$('#edit-event').find('#location').change(function(){
	    		val = $(this).val();

	    		if( val != 0 || val == '' )
	    			$('#edit-event').find('tr[id="loc-data"]').hide();
	    		else
	    		{
	    			$('#edit-event').find('tr[id="loc-data"]').show();
	    			$('#edit-event').find('tr[id="loc-data"]').find('input').val('');
	    		}
	    	});
    	// end manage opponent while editing event info

    	// start manage location while creatin event
	    	$('#new-event').find('#location').change(function(){
	    		val = $(this).val();
	    		if( val != 0 || val == '' )
	    			$('#new-event').find('tr[id="loc-data"]').hide();
	    		else
	    			$('#new-event').find('tr[id="loc-data"]').show();
	    	});
    	// end manage location while creatin event

    	// start toggle additional info in game
	    	ii = 0;
	    	$('#info').click(function(){
	    		$('#new-game').find('tr[id="add-info"]').toggle();
	    		if( ii == 0 )
	    		{
	    			ii = 1;
	    			$('#info-img').attr('src', "{{url('/')}}/img/up.png");
	    		}
	    		else
	    		{
	    			ii = 0;
	    			$('#info-img').attr('src', "{{url('/')}}/img/down.png");
	    		}
	    	});
    	// end toggle additional info in game

    	// start confirm deletion of a game/ event
	    	$('#tbody').on('click', '#delete', function(){
		        id = $(this).attr('key');
		        type = $(this).attr('type');

		        swal({
		            title: "Are you sure?",
		            text: "The "+ type +" will be cancelled and will be removed from team schedule!",
		            type: "warning",
		            showCancelButton: true,
		            confirmButtonColor: "#DD6B55",
		            confirmButtonText: "Yes, delete it!",
		            closeOnConfirm: true
		            }, function(){
		                (type == 'event') ? deleteEvent(id) : deleteGame(id);
		        });
		    });
	    // end confirm deletion of a game/ event

	    // start delete a game
		    function deleteEvent(id)
		    {
		    	window.location.href = '{{ url("/") }}/{{$id}}/event/delete/'+ id;
		    }
	    // end delete a game

	    // start delete a event
		    function deleteGame(id)
		    {
		    	window.location.href = '{{ url("/") }}/{{$id}}/game/delete/'+ id;
		    }
	    // end delete a event

	    // start jquery when game form submitted
	    	$("#game-form").submit(function(e) {
		        e.preventDefault();
		        var detail = $('#game-form').serializeArray();
		        var url = '{{ url("game/validate") }}';
		        var self = this;
		        getGameData(self, url, detail, 'game-form');
		    });
	    // end jquery when game form submitted

	    // start jquery when edit game form submitted
		    $("#edit-game-form").submit(function(e) {
		        e.preventDefault();
		        var detail = $('#edit-game-form').serializeArray();
		        var url = '{{ url("game/validate") }}';
		        var self = this;
		        getGameData(self, url, detail, 'edit-game-form');
		    });
	    // end jquery when edit game form submitted

	    // start validate game form on submit
		    function getGameData(self, url, detail, src)
		    {
		    	$.get(url, detail, function(data){
		            var d = data;
		            $('#'+ src).find('strong').html('');
		            if( d['date'] != '' )
		            {
		            	$('#'+ src).find('#error-date').html('<br /><br />'+d['date']);
		            	$('#'+ src).find('input[name="date"]').focus();
		            }
		            else if( d['hour'] != '' )
		            {
		            	$('#'+ src).find('input[name="hour"]').focus();
		            	$('#'+ src).find('#error-time').html('<br /><br />'+d['hour']);
		            }
		            else if( d['minute'] != '' )
		            {
		            	$('#'+ src).find('input[name="minute"]').focus();
		            	$('#'+ src).find('#error-time').html('<br /><br />'+d['minute']);
		            }
		            else if( d['opponent'] != '' )
		            {
		            	$('#'+ src).find('input[name="opponent"]').focus();
		            	$('#'+ src).find('#error-opponent').html('<br /><br />'+d['opponent']);
		            }
		            else if( d['name'] != '' )
		            {
		            	$('#'+ src).find('input[name="name"]').focus();
		            	$('#'+ src).find('#error-name').html('<br /><br />'+d['name']);
		            }
		            else if( d['contact_person'] != '' )
		            {
		            	$('#'+ src).find('input[name="contact_person"]').focus();
		            	$('#'+ src).find('#error-contact_person').html('<br /><br />'+d['contact_person']);
		            }
		            else if( d['phone'] != '' )
		            {
		            	$('#'+ src).find('input[name="phone"]').focus();
		            	$('#'+ src).find('#error-phone').html('<br /><br />'+d['phone']);
		            }
		            else if( d['email'] != '' )
		            {
		            	$('#'+ src).find('input[name="email"]').focus();
		            	$('#'+ src).find('#error-email').html('<br /><br />'+d['email']);
		            }

		            else if( d['location'] != '' )
		            {
		            	$('#'+ src).find('input[name="location"]').focus();
		            	$('#'+ src).find('#error-location').html('<br /><br />'+d['location']);
		            }
		            else if( d['location_detail'] != '' )
		            {
		            	$('#'+ src).find('input[name="location_detail"]').focus();
		            	$('#'+ src).find('#error-location_detail').html('<br /><br />'+d['location_detail']);
		            }
		            else if( d['loc_name'] != '' )
		            {
		            	$('#'+ src).find('input[name="loc_name"]').focus();
		            	$('#'+ src).find('#error-loc_name').html('<br /><br />'+d['loc_name']);
		            }
		            else if( d['address'] != '' )
		            {
		            	$('#'+ src).find('input[name="address"]').focus();
		            	$('#'+ src).find('#error-address').html('<br /><br />'+d['address']);
		            }
		            else if( d['link'] != '' )
		            {
		            	$('#'+ src).find('input[name="link"]').focus();
		            	$('#'+ src).find('#error-link').html('<br /><br />'+d['link']);
		            }

		            else if( d['d_hour'] != '' )
		            {
		            	$('#'+ src).find('input[name="d_hour"]').focus();
		            	$('#'+ src).find('#error-duration').html('<br /><br />The duration hour field must be between 1 and 12.');
		            }
		            else if( d['d_minute'] != '' )
		            {
		            	$('#'+ src).find('input[name="d_minute"]').focus();
		            	$('#'+ src).find('#error-duration').html('<br /><br />The duration minute field must be between 0 and 59.');
		            }
		            else
	                    self.submit();
		        });
		    }
	    // end validate game form on submit

	    // start jquery when event form submitted
	    	$('#edit-event-form').submit(function(e) {
	    		e.preventDefault();
	    		var detail = $('#edit-event-form').serializeArray();
	    		var url = '{{ url("event/validate") }}';
	    		var self = this;
	    		getEventData(self, url, detail, 'edit-event-form');
	    	});
    	// end jquery when event form submitted

	    // start jquery when edit event form submitted
		    $("#event-form").submit(function(e) {
		        e.preventDefault();
		        var detail = $('#event-form').serializeArray();
		        var url = '{{ url("event/validate") }}';
		        var self = this;
		        getEventData(self, url, detail, 'event-form');
		    });
	    // end jquery when edit event form submitted

	    // start validate event form on submit
		    function getEventData(self, url, detail, src)
		    {
		    	$.get(url, detail, function(data){
		            var d = data;
		            $('#'+ src).find('strong').html('');
		            if( d['name'] != '' )
		            {
		            	$('#'+ src).find('input[name="name"]').focus();
		            	$('#'+ src).find('#error-name').html('<br /><br />'+d['name']);
		            }
		            else if( d['date'] != '' )
		            {
		            	$('#'+ src).find('input[name="date"]').focus();
		            	$('#'+ src).find('#error-date').html('<br /><br />'+d['date']);
		            }
		            else if( d['hour'] != '' )
		            {
		            	$('#'+ src).find('input[name="hour"]').focus();
		            	$('#'+ src).find('#error-time').html('<br /><br />'+d['hour']);
		            }
		            else if( d['minute'] != '' )
		            {
		            	$('#'+ src).find('input[name="minute"]').focus();
		            	$('#'+ src).find('#error-time').html('<br /><br />'+d['minute']);
		            }
		            else if( d['location'] != '' )
		            {
		            	$('#'+ src).find('input[name="location"]').focus();
		            	$('#'+ src).find('#error-location').html('<br /><br />'+d['location']);
		            }
		            else if( d['location_detail'] != '' )
		            {
		            	$('#'+ src).find('input[name="location_detail"]').focus();
		            	$('#'+ src).find('#error-location_detail').html('<br /><br />'+d['location_detail']);
		            }
		            else if( d['loc_name'] != '' )
		            {
		            	$('#'+ src).find('input[name="loc_name"]').focus();
		            	$('#'+ src).find('#error-loc_name').html('<br /><br />'+d['loc_name']);
		            }
		            else if( d['address'] != '' )
		            {
		            	$('#'+ src).find('input[name="address"]').focus();
		            	$('#'+ src).find('#error-address').html('<br /><br />'+d['address']);
		            }
		            else if( d['link'] != '' )
		            {
		            	$('#'+ src).find('input[name="link"]').focus();
		            	$('#'+ src).find('#error-link').html('<br /><br />'+d['link']);
		            }
		            else
	                    self.submit();
		        });
		    }
	    // end validate event form on submit

	    // start initialize some var
		    view   = $('#schedule-view');
		    ngame  = $('#new-game');
		    nevent = $('#new-event');
		    egame  = $('#edit-game');
		    eevent = $('#edit-event');
		    manage = $('#manager');
	    // end initialize some var

	    // start manage tab on clicking create new game
	    	$('#create-game').click(function(){
	    		view.hide();
	    		nevent.hide();
	    		egame.hide();
	    		eevent.hide();
	    		manage.hide();
	    		ngame.show();
	    	});
    	// end manage tab on clicking create new game

    	// start manage tab on clicking create new event
	    	$('#create-event').click(function(){
	    		view.hide();
	    		ngame.hide();
	    		egame.hide();
	    		eevent.hide();
	    		manage.hide();
	    		nevent.show();
	    	});
    	// end manage tab on clicking create new event

    	//start when cancel button clicked
	    	$('button[id="cancel"]').click(function(){
	    		ngame.hide();
	    		nevent.hide();
	    		egame.hide();
	    		eevent.hide();
	    		manage.show();
	    		view.show();
	    	});
    	//end when cancel button clicked

    	// start when edit button clicked
	    	$('#table').on('click', '#edit', function(){
		        id = $(this).attr('key');
		        type = $(this).attr('type');
		        if( type == "game" )
		        	editGame(id);
		        else
		        	editEvent(id);
		    });
	    // end when edit button clicked

	    // start when edit game is clicked populate the form with DB values
		    function editGame(id)
		    {
		    	ngame.hide();
	    		nevent.hide();
	    		eevent.hide();
	    		manage.hide();
	    		view.hide();
	    		egame.show();

	    		url = '{{ url($id."/game/data") }}/'+ id;

	    		$.post(url, function(data){
	    			time = 1;
	    			if( data['detail']['time'] == 'AM' )
	    				time = 0;

	    			$('#edit-game-form').find('input[name="id"]').val(id);
	            	$('input[name="date"]').val(data['detail']['date']);
		    		$('input[name="hour"]').val(data['detail']['hour']);
		    		$('input[name="minute"]').val(data['detail']['minute']);
		    		$('#edit-game-form').find('#time option').eq(time).prop('selected', true);

		    		//opponent data
		    		$('#edit-game-form').find('#opponent option[value="'+data['opp']['id']+'"]').prop('selected', true);
		    		/*$('#edit-game-form').find('input[name="name"]').val(data['opp']['name']);
		    		$('#edit-game-form').find('input[name="contact_person"]').val(data['opp']['contact_person']);
		    		$('#edit-game-form').find('input[name="phone"]').val(data['opp']['phone_no']);
		    		$('#edit-game-form').find('input[name="email"]').val(data['opp']['email']);*/
		    		//end opponent data

		    		//location data
		    		$('#edit-game-form').find('#location option[value="'+data['loc']['id']+'"]').prop('selected', true);
		    		//end location data

		    		$('input[name="result"]').val(data['detail']['result']);
	        	});
		    }
		// end when edit game is clicked populate the form with DB values

	    // start when edit event is clicked populate the form with DB values
		    function editEvent(id)
	    	{
	    		ngame.hide();
	    		nevent.hide();
	    		egame.hide();
	    		manage.hide();
	    		view.hide();
	    		eevent.show();

	    		url = '{{ url("event/data") }}/'+ id;

	    		$.post(url, function(event){
	    			time = 1;
	    			if( event['time'] == 'AM' )
	    				time = 0;
	    			$('#edit-event-form').find('input[name="id"]').val(id);
	    			$('#edit-event-form').find('input[name="name"]').val(event['name']);
	    			$('#edit-event-form').find('input[name="label"]').val(event['label']);
	    			$('#edit-event-form').find('input[name="date"]').val(event['date']);
	    			$('#edit-event-form').find('input[name="hour"]').val(event['hour']);
	    			$('#edit-event-form').find('input[name="minute"]').val(event['minute']);
	    			$('#edit-event-form').find('#time option').eq(time).prop('selected', true);
	    			$('#edit-event-form').find('#repeat option').eq(Number(event['repeat'])).prop('selected', true);

	    			//location data
		    		$('#edit-event-form').find('#location option[value="'+event['loc']['id']+'"]').prop('selected', true);
		    		//end location data
	        	});
	    	}
    	// end when edit event is clicked populate the form with DB values


    </script>

@endsection
