@if( $members->count() == 0 )
	<div style="text-align: center"><p style="font-size: 15px;">No member available in the team</p></div>
@else
	<div class="table-responsive">
		<table class="table table-hover dt-responsive mem-tab nowrap" style="width:100% !important">
			<thead>
			    <tr>
			    	<th class="none"></th>
			        <th class="">Photo</th>
			        <th class="all">Name</th>
			        <th class="">Birthday</th>
			        <th class="">Gender</th>
			        <th class="">Age</th>
			        <th class="">Member Type</th>
			        <th>Position</th>
			        <th>Contact</th>
			    	<th class="all">Manager</th>
			    	<th class="none">Domicile</th>
				</tr>
			</thead>
			<tbody>
				@foreach($members as $member)
					<tr>
						<td></td>
	                    <td>
	                      <a data-toggle="modal" id="aimg-show" name="{{$member->firstname}}  {{$member->lastname}}" image="{{url('/')}}/{{ $member->avatar }}" data-target="#show-img">
	                        <img src ="{{url('/')}}/{{ $member->avatar }}" style="width:50px; height:50px; border-radius: 50%;"/>
	                      </a>
	                    </td>
	                    <td>{{$member->firstname}}&nbsp;&nbsp;{{$member->lastname}}</td>
	                    <td>{{ $member->birthday }}</td>
	                    <td>
	                    	@if( $member->gender == 0 )
	                    		Male
	                    	@else
	                    		Female
	                    	@endif
	                    </td>
	                    <td>
	                    	@if( $member->birthday != '' )
	                    		{{ \Carbon\Carbon::createFromFormat('d/m/Y', $member->birthday)->diff(\Carbon\Carbon::now())->
	                    		format('%y years') }}
	                    	@endif
	                    </td>
	                    <td>
	                    	@if( $member->flag == 1 )
	                    		Player
	                    	@else
	                    		Non Player
	                    	@endif
	                    </td>
	                    <td>{{$member->role}}</td>
	                    <td>
	                        <p>{{$member->email}}</p>
	                        <p>{{$member->mobile}}
	                    </td>
	                    <td>
	                        <img src="{{url('/')}}/img/edit.png" class="icon-style" id="edit" key="{{$member->id}}" data-toggle="modal" data-target="#edit-member"/>
	                        <a id="delete" key="{{$member->id}}"><img class="icon-style" src='{{url("/")}}/img/delete.png'></a>
	                    </td>
	                    <td>
	                    	{{$member->city}}
	                    	@if($member->state != '')
	                    		, {{$member->state}}
	                    	@endif
	                    </td>
	                </tr>
	            @endforeach
	        </tbody>
		</table>
	</div>
@endif
