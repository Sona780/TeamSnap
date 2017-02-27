@extends('layouts.new')

@section('content')
    <div class="card" id="manager">
		<div class="btn-group" style="padding: 10px 5px;">
			<button type="button" class="btn btn-primary" data-toggle="dropdown">
               	&nbsp;&nbsp;&nbsp;&nbsp; New &nbsp;&nbsp;&nbsp;&nbsp;<i class="caret"></i>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="#" id="create-game">Game</a></li>
                <li class="divider"></li>
                <li><a href="#" id="create-event">Event</a></li>
            </ul>
        </div>
    </div>

    <div class="card" style="padding: 10px 5px;" id="table">
        <table id="data-table-command" class="table table-striped table-vmiddle">
            <thead>
	            <tr style="font-size: 12px">
	                <th data-column-id="type">Games/ Events</th>
	                <th data-column-id="Result">Result</th>
	                <th data-column-id="date" data-order="desc">Date</th>
	                <th data-column-id="time">Time</th>
	                <th data-column-id="location">Location</th>
	                <th data-column-id="location_detail">Location Detail</th>
	                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
	            </tr>
	        </thead>
	    	<tbody>
	    		@foreach($games as $game)
		            <tr>
		                <td>vs. {{ $game->opponent }}</td>
		                <td></td>
		                <td>{{ $game->date }}</td>
		                <td>{{ $game->time }}</td>
		                <td>{{ $game->location }}</td>
		                <td>{{ $game->location_detail }}</td>
		            </tr>
	            @endforeach
	            @foreach($events as $event)
		            <tr>
		                <td>{{ $event->name }}</td>
		                <td></td>
		                <td>{{ $event->date }}</td>
		                <td>{{ $event->time }}</td>
		                <td>{{ $event->location }}</td>
		                <td>{{ $event->location_detail }}</td>
		            </tr>
	            @endforeach
			</tbody>
		</table>
	</div>

	<div class="card" style="padding: 10px 5px; width: 70%; margin: auto; display: none" id="new-game">
		<div class="card-body table-responsive">
		<form method="POST" action="{{url('new/game')}}" id="game-form">
			{!! csrf_field() !!}
			<table class="table table-bordered" style="width:100%; height: 50%;">
				<tr>
					<td colspan="2">New Game</td>
				</tr>
				<tr>
					<td class="first-col"><label>Date:</label></td>
					<td class="padd-left">
						<input type="date" name="date">
						<strong id="error-date" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Time:</label></td>
					<td class="padd-left">
						<input type="text" name="hour">&nbsp;:&nbsp;
						<input type="text" name="minute">
						<select name="time">
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>
						<strong id="error-time" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Opponent:</label></td>
					<td class="padd-left">
						<input type="text" name="opponent">
						<strong id="error-opponent" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Location:</label></td>
					<td class="padd-left">
						<input type="text" name="location">
						<strong id="error-location" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Location Detail:</label></td>
					<td class="padd-left">
						<input type="text" name="location_detail">
						<strong id="error-location_detail" class="strong-error"></strong>
					</td>
				</tr>
				<tr><td colspan="2"></td></tr>
			</table>
			<button class="btn btn-warning adjust" type="button" id="cancel">Cancel</button>
			<button class="btn btn-success adjust" type="submit">Save</button>
		</form>
		</div>
	</div>

	<div class="card" style="padding: 10px 5px; width: 70%; margin: auto; display: none" id="new-event">
		<div class="card-body table-responsive">
		<form method="POST" action="{{url('new/event')}}" id="event-form">
			{!! csrf_field() !!}
			<table class="table table-bordered" style="width:100%; height: 50%;">
				<tr>
					<td colspan="2">New Event</td>
				</tr>
				<tr>
					<td class="first-col"><label>Name of the Event:</label></td>
					<td class="padd-left">
						<input type="text" name="name">
						<strong id="error-name" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Short Label:</label></td>
					<td class="padd-left">
						<input type="text" name="label">
						<strong id="error-label" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Date:</label></td>
					<td class="padd-left">
						<input type="date" name="date">
						<strong id="error-date" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Time:</label></td>
					<td class="padd-left">
						<input type="text" name="hour">&nbsp;:&nbsp;
						<input type="text" name="minute">
						<select name="time">
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>
						<strong id="error-time" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Repeat:</label></td>
					<td class="padd-left">
						<select name="repeat">
							<option value="0">Does Not Repeat</option>
							<option value="1">Weekly</option>
							<option value="2">Monthly</option>
							<option value="3">Yearly</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Location:</label></td>
					<td class="padd-left">
						<input type="text" name="location">
						<strong id="error-location" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Location Detail:</label></td>
					<td class="padd-left">
						<input type="text" name="location_detail">
						<strong id="error-location_detail" class="strong-error"></strong>
					</td>
				</tr>
				<tr><td colspan="2"></td></tr>
			</table>
			<button class="btn btn-warning adjust" type="button" id="cancel">Cancel</button>
			<button class="btn btn-success adjust" type="submit">Save</button>
		</form>
		</div>
	</div>


@endsection
@section('footer')
        <!-- Data Table -->
        <script type="text/javascript">
            $(document).ready(function(){

                //Command Buttons
                $("#data-table-command").bootgrid({
                    css: {
                        icon: 'zmdi icon',
                        iconColumns: 'zmdi-view-module',
                        iconDown: 'zmdi-expand-more',
                        iconRefresh: 'zmdi-refresh',
                        iconUp: 'zmdi-expand-less'
                    },
                    formatters: {
                        "commands": function(column, row) {
                            return "<button type=\"button\" class=\"btn btn-icon command-edit waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-edit\"></span></button> " +
                                "<button type=\"button\" class=\"btn btn-icon command-delete waves-effect waves-circle\" data-row-id=\"" + row.id + "\"><span class=\"zmdi zmdi-delete\"></span></button>";
                        }
                    }
                });
            });
        </script>

    <script type="text/javascript">
    	$("#game-form").submit(function(e) {
	        e.preventDefault();
	        var detail = $('#game-form').serializeArray();
	        var url = '{{ url("game/validate") }}';

	        var self = this;
	        $.get(url, detail, function(data){
	            var d = data;
	            $('#game-form').find('strong').html('');
	            if( d['date'] != '' )
	            	$('#game-form').find('#error-date').html('<br /><br />'+d['date']);
	            else if( d['hour'] != '' )
	            	$('#game-form').find('#error-time').html('<br /><br />'+d['hour']);
	            else if( d['minute'] != '' )
	            	$('#game-form').find('#error-time').html('<br /><br />'+d['minute']);
	            else if( d['opponent'] != '' )
	            	$('#game-form').find('#error-opponent').html('<br /><br />'+d['opponent']);
	            else if( d['location'] != '' )
	            	$('#game-form').find('#error-location').html('<br /><br />'+d['location']);
	            else if( d['location_detail'] != '' )
	            	$('#game-form').find('#error-location_detail').html('<br /><br />'+d['location_detail']);
	            else
                    self.submit();
	        });
	    });

	    $("#event-form").submit(function(e) {
	        e.preventDefault();
	        var detail = $('#event-form').serializeArray();
	        var url = '{{ url("event/validate") }}';

	        var self = this;
	        $.get(url, detail, function(data){
	            var d = data;
	            $('#event-form').find('strong').html('');
	            if( d['name'] != '' )
	            	$('#event-form').find('#error-name').html('<br /><br />'+d['name']);
	            else if( d['date'] != '' )
	            	$('#event-form').find('#error-date').html('<br /><br />'+d['date']);
	            else if( d['hour'] != '' )
	            	$('#event-form').find('#error-time').html('<br /><br />'+d['hour']);
	            else if( d['minute'] != '' )
	            	$('#event-form').find('#error-time').html('<br /><br />'+d['minute']);
	            else if( d['location'] != '' )
	            	$('#event-form').find('#error-location').html('<br /><br />'+d['location']);
	            else if( d['location_detail'] != '' )
	            	$('#event-form').find('#error-location_detail').html('<br /><br />'+d['location_detail']);
	            else
                    self.submit();
	        });
	    });

    	$('#create-game').click(function(){
    		showNewGame();
    	});


    	$('#create-event').click(function(){
    		showNewEvent();
    	});

    	$('button[id="cancel"]').click(function(){
    		showTable();
    	});

    	function showNewGame()
    	{
    		$('#new-game').show();
    		$('#table').hide();
    		$('#manager').hide();
    		$('#new-event').hide();
    	}

    	function showNewEvent()
    	{
    		$('#new-event').show();
    		$('#new-game').hide();
    		$('#table').hide();
    		$('#manager').hide();
    	}

    	function showTable()
    	{
    		$('#table').show();
    		$('#manager').show();
    		$('#new-game').hide();
    		$('#new-event').hide();
    	}
    </script>

@endsection
