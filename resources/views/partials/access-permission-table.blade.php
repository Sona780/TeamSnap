{{ Form::open(['method' => 'post', 'url' => $id.$formURL]) }}
	<br>
	{!! csrf_field() !!}
	<table class="table table-hover dt-responsive mem-tab nowrap">
		<th>View</th>
		<th style="text-align: center">
			Access permission
			<ul class="actions pull-right">
	        	<li id='dropdown-li' class="dropdown">
	            	<!-- start show dots -->
	                	<a href="" id='menu-dots' data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>
	                <!-- end show dots -->

	                <!-- start show edit option -->
	                	<ul class="dropdown-menu dropdown-menu-right">
	                        <li><a id="edit" key='{{$buttonKey}}' style="cursor: pointer">Edit</a></li>
	                        <li><a id="cancel" key='{{$buttonKey}}' style="cursor: pointer; display: none;">Cancel</a></li>
	                    </ul>
	                <!-- stop show edit option -->
	            </li>
	        </ul>
		</th>
		<tbody>
			<tr>
				<td>Members</td>
			  	<td style="text-align: center" id="member">
			  		@if($access->member == 0)
			  	  		<span style="color: red">Not Granted</span>
			  	  	@else
			  	  		<span style="color: green">Granted</span>
			  	  	@endif
			  	</td>
			</tr>
			<tr>
				<td>Schedule</td>
			  	<td style="text-align: center" id="schedule">
			  		@if($access->schedule == 0)
			  	  		<span style="color: red">Not Granted</span>
			  	  	@else
			  	  		<span style="color: green">Granted</span>
			  	  	@endif
			  	</td>
			</tr>
			<tr>
				<td>Availability</td>
			  	<td style="text-align: center" id="availability">
			  		@if($access->availability == 0)
			  	  		<span style="color: red">Not Granted</span>
			  	  	@else
			  	  		<span style="color: green">Granted</span>
			  	  	@endif
			  	</td>
			</tr>
			<tr>
				<td>Records</td>
			  	<td style="text-align: center" id="record">
			  		@if($access->record == 0)
			  	  		<span style="color: red">Not Granted</span>
			  	  	@else
			  	  		<span style="color: green">Granted</span>
			  	  	@endif
			  	</td>
			</tr>
			<tr>
				<td>Media</td>
		   		<td style="text-align: center" id="media">
			  	  	@if($access->media == 0)
			  	  		<span style="color: red">Not Granted</span>
			  	  	@else
			  	  		<span style="color: green">Granted</span>
			  	  	@endif
			  	</td>
			</tr>
			<tr>
				<td>Messages</td>
			  	<td style="text-align: center" id="message">
			  		@if($access->message == 0)
			  	  		<span style="color: red">Not Granted</span>
			  	  	@else
			  	  		<span style="color: green">Granted</span>
			  	  	@endif
			  	</td>
			</tr>
			<tr>
				<td>Assets</td>
			  	<td style="text-align: center" id="asset">
			  		@if($access->asset == 0)
			  	  		<span style="color: red">Not Granted</span>
			  	  	@else
			  	  		<span style="color: green">Granted</span>
			  	  	@endif
			  	</td>
			</tr>
			<tr>
				<td>Settings</td>
			  	<td style="text-align: center" id="setting">
			  		@if($access->setting == 0)
			  	  		<span style="color: red">Not Granted</span>
			  	  	@else
			  	  		<span style="color: green">Granted</span>
			  	  	@endif
				</td>
			</tr>
		</tbody>
	</table>
	<button type="submit" class="btn btn-success col-sm-12 col-xs-12" style="display:none" id="submit">
		Upadte Permissions
	</button>
{{Form::close()}}
