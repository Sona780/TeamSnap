@extends('layouts.new', ['team' => $id, 'active' => 'schedule'])

@section('header')
	<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="card" id="manager" style="height: 7%;">
    		<h4 style="display: inline-block; font-weight: none">
    		&nbsp;&nbsp;&nbsp;&nbsp;Manager : &nbsp;&nbsp;&nbsp;&nbsp;

    		<div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    &nbsp;&nbsp;&nbsp;&nbsp;New&nbsp;&nbsp;&nbsp;&nbsp;<span class="caret"></span>
				</button>
                <ul class="dropdown-menu pull-left" role="menu">
                    <li><a href="#" id="create-game">Game</a></li>
                	<li class="divider"></li>
                	<li><a href="#" id="create-event">Event</a></li>
                </ul>
            </div>
            </h4>
    </div>

    <div class="card p-10 table-responsive" id="table">

                <table id="example" class="table display responsive" cellspacing="0" width="100%">

                        <thead style="font-size: 15px">
                            <tr>
                                <th class="all"><img src='{{url("/")}}/img/blue.jpeg' />&nbsp;Games/ <img src='{{url("/")}}/img/green.jpeg' />&nbsp;Events</th>
			                    <th>Result</th>
			                    <th>Date</th>
			                    <th>Time</th>
			                    <th>Location</th>
			                    <th class="all">Manager</th>
			                    <th class="none">Location Detail</th>
			                    <th class="none">Adress</th>
			                    <th class="none">Link</th>
                            </tr>
                        </thead>

                        <tbody id="tbody" style="font-size: 12px">
                            @foreach($games as $game)
					            <tr>
					                <td><img src='{{url("/")}}/img/blue.jpeg' />&nbsp;&nbsp;&nbsp;vs. {{ $game->name }}</td>
					                <td>
					                	@if( $game->results == ''  )
					                		<button id="edit" key='{{ $game->id }}' type='game' class="b-design">Enter Result</button>
					                	@else
					                		{{ $game->results }}
					                	@endif
					                </td>
					                <td>{{ \Carbon\Carbon::createFromFormat('d/m/Y', $game->date)->format('D d, M Y') }}</td>
					                <td>
					                	{{ $game->hour }}:{{ $game->minute }}&nbsp;{{ $game->time }}
					                </td>
					                <td>{{ $game->location->name }}</td>
					                <td>
	                        			<a id="edit" key='{{ $game->id }}' type='game'>
	                        				<img class="icon-style" src='{{url("/")}}/img/edit.png'>
	                        			</a>

										<a id="delete" key='{{ $game->id }}' type='game'>
	                        				<img class="icon-style" src='{{url("/")}}/img/delete.png'>
	                        			</a>
                                    </td>
                                    <td>{{ $game->location->detail }}</td>
                                    <td>{{ $game->location->address }}</td>
                                    <td>{{ $game->location->link }}</td>
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
					                <td>
                                        <a id="edit" key='{{ $event->id }}' type='event'>
	                        				<img class="icon-style" src='{{url("/")}}/img/edit.png'>
	                        			</a>

										<a id="delete" key='{{ $event->id }}' type='event'>
	                        				<img class="icon-style" src='{{url("/")}}/img/delete.png'>
	                        			</a>
                                    </td>
                                    <td>{{ $event->location->detail }}</td>
                                    <td>{{ $event->location->address }}</td>
                                    <td>{{ $event->location->link }}</td>
					            </tr>
				            @endforeach
                        </tbody>
                </table>


    </div>

    <div class="table-responsive" style="padding: 10px 5px; width: 70%; margin: auto; display: none" id="new-game">
		<form method="POST" action="{{url('/')}}/{{$id}}/new/game" id="game-form">
			@include('partials.game-form', ['submitButton' => 'Save', 'opp' => $opp, 'loc' => $game_loc])
		</form>
	</div>

	<div class="table-responsive" style="padding: 10px 5px; width: 70%; margin: auto; display: none" id="edit-game">
		<form method="POST" action="{{url('/')}}/{{$id}}/edit/game" id="edit-game-form">
			<input type="hidden" name="id">
			@include('partials.game-form', ['submitButton' => 'Modify', 'opp' => $opp, 'loc' => $game_loc])
		</form>
	</div>

	<div class="table-responsive" style="padding: 10px 5px; width: 70%; margin: auto; display: none" id="new-event">
		<form method="POST" action="{{url('/')}}/{{$id}}/new/event" id="event-form">
			@include('partials.event-form', ['submitButton' => 'Save', 'loc' => $event_loc])
		</form>
	</div>

	<div class="table-responsive" style="padding: 10px 5px; width: 70%; margin: auto; display: none" id="edit-event">
		<form method="POST" action="{{url('/')}}/{{$id}}/edit/event" id="edit-event-form">
			<input type="hidden" name="id">
			@include('partials.event-form', ['submitButton' => 'Modify', 'loc' => $event_loc])
		</form>
	</div>

@endsection
@section('footer')
    <!-- Data Table -->
    <script type="text/javascript">
        $(document).ready(function(){

            $('#example').DataTable();
            $('#new-game').find('tr[id="add-info"]').hide();
        });
    </script>

    <script type="text/javascript">
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

    	$('#new-game').find('#opponent').change(function(){
    		val = $(this).val();
    		if( val != 0 || val == '' )
    			$('#new-game').find('#opp-detail').hide();
    		else
    			$('#new-game').find('#opp-detail').show();
    	});

    	// game location management
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

    	$('#new-game').find('#location').change(function(){
    		val = $(this).val();
    		if( val != 0 || val == '' )
    			$('#new-game').find('tr[id="loc-data"]').hide();
    		else
    			$('#new-game').find('tr[id="loc-data"]').show();
    	});
    	// end game location management

    	// event location management
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

    	$('#new-event').find('#location').change(function(){
    		val = $(this).val();
    		if( val != 0 || val == '' )
    			$('#new-event').find('tr[id="loc-data"]').hide();
    		else
    			$('#new-event').find('tr[id="loc-data"]').show();
    	});
    	// end event location management

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

	    function deleteEvent(id)
	    {
	    	window.location.href = '{{ url("/") }}/{{$id}}/event/delete/'+ id;
	    }

	    function deleteGame(id)
	    {
	    	window.location.href = '{{ url("/") }}/{{$id}}/game/delete/'+ id;
	    }

    	$("#game-form").submit(function(e) {
	        e.preventDefault();
	        var detail = $('#game-form').serializeArray();
	        var url = '{{ url("game/validate") }}';
	        var self = this;
	        getGameData(self, url, detail, 'game-form');
	    });

	    $("#edit-game-form").submit(function(e) {
	        e.preventDefault();
	        var detail = $('#edit-game-form').serializeArray();
	        var url = '{{ url("game/validate") }}';
	        var self = this;
	        getGameData(self, url, detail, 'edit-game-form');
	    });

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

    	$('#edit-event-form').submit(function(e) {
    		e.preventDefault();
    		var detail = $('#edit-event-form').serializeArray();
    		var url = '{{ url("event/validate") }}';
    		var self = this;
    		getEventData(self, url, detail, 'edit-event-form');
    	});

	    $("#event-form").submit(function(e) {
	        e.preventDefault();
	        var detail = $('#event-form').serializeArray();
	        var url = '{{ url("event/validate") }}';
	        var self = this;
	        getEventData(self, url, detail, 'event-form');
	    });

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

    	$('#create-game').click(function(){
    		showNewGame();
    	});


    	$('#create-event').click(function(){
    		showNewEvent();
    	});

    	$('button[id="cancel"]').click(function(){
    		showTable();
    	});

    	$('#table').on('click', '#edit', function(){
	        id = $(this).attr('key');
	        type = $(this).attr('type');
	        if( type == "game" )
	        	editGame(id);
	        else
	        	editEvent(id);
	    });

	    function editGame(id)
	    {
	    	$('#edit-game').show();
	    	$('#new-game').hide();
	   		$('#table').hide();
	    	$('#manager').hide();
	    	$('#new-event').hide();
	    	$('#edit-event').hide();

    		url = '{{ url("game/data") }}/'+ id;

    		$.get(url, function(data){
    			time = 1;
    			if( data['time'] == 'AM' )
    				time = 0;

    			$('#edit-game-form').find('input[name="id"]').val(id);
            	$('input[name="date"]').val(data['date']);
	    		$('input[name="hour"]').val(data['hour']);
	    		$('input[name="minute"]').val(data['minute']);
	    		$('#edit-game-form').find('#time option').eq(time).prop('selected', true);

	    		//opponent data
	    		$('#edit-game-form').find('#opponent option[value="'+data['opp_id']+'"]').prop('selected', true);
	    		$('#edit-game-form').find('input[name="name"]').val(data['name']);
	    		$('#edit-game-form').find('input[name="contact_person"]').val(data['contact_person']);
	    		$('#edit-game-form').find('input[name="phone"]').val(data['phone_no']);
	    		$('#edit-game-form').find('input[name="email"]').val(data['email']);
	    		//end opponent data

	    		//location data
	    		$('#edit-game-form').find('#location option[value="'+data['loc_id']+'"]').prop('selected', true);
	    		//end location data

	    		$('input[name="result"]').val(data['results']);
        	});
	    }

	    function editEvent(id)
    	{
    		$('#edit-event').show();
    		$('#new-event').hide();
    		$('#new-game').hide();
    		$('#edit-game').hide();
    		$('#table').hide();
    		$('#manager').hide();

    		url = '{{ url("event/data") }}/'+ id;

    		$.get(url, function(data){
    			time = 1;
    			if( data['time'] == 'AM' )
    				time = 0;
    			$('#edit-event-form').find('input[name="id"]').val(id);
    			$('#edit-event-form').find('input[name="name"]').val(data['name']);
    			$('#edit-event-form').find('input[name="label"]').val(data['label']);
    			$('#edit-event-form').find('input[name="date"]').val(data['date']);
    			$('#edit-event-form').find('input[name="hour"]').val(data['hour']);
    			$('#edit-event-form').find('input[name="minute"]').val(data['minute']);
    			$('#edit-event-form').find('#time option').eq(time).prop('selected', true);
    			$('#edit-event-form').find('input[name="opponent"]').val(data['opponent']);
    			$('#edit-event-form').find('#repeat option').eq(Number(data['repeat'])).prop('selected', true);

    			//location data
	    		$('#edit-event-form').find('#location option[value="'+data['loc_id']+'"]').prop('selected', true);
	    		//end location data
        	});
    	}

    	function showNewGame()
    	{
    		$('#new-game').show();
    		$('#table').hide();
    		$('#edit-game').hide();
    		$('#manager').hide();
    		$('#new-event').hide();
    		$('#edit-event').hide();
    		$('#game-form').find('input[id="f-ip"]').val('');
    	}

    	function showNewEvent()
    	{
    		$('#new-event').show();
    		$('#new-game').hide();
    		$('#table').hide();
    		$('#manager').hide();
    		$('#edit-game').hide();
    		$('#edit-event').hide();
    		$('#event-form').find('input[id="f-ip"]').val('');
    	}

    	function showTable()
    	{
    		$('#table').show();
    		$('#manager').show();
    		$('#new-game').hide();
    		$('#new-event').hide();
    		$('#edit-game').hide();
    		$('#edit-event').hide();
    	}
    </script>

@endsection
