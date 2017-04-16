@if( $members->count() == 0 )
	<div style="text-align: center"><p style="font-size: 15px;">No member available in the team</p></div>
@else
	<div class="table-responsive">
		<table class="table table-hover dt-responsive mem-tab nowrap" style="width:100% !important">
			<thead>
			    <tr>
			    	<th class="none"></th>
			        <th class="all">Photo</th>
			        <th class="">Name</th>
			        <th class="">Birthday</th>
			        <th class="">Gender</th>
			        <th class="">Age</th>
			        <th class="">Member Type</th>
			        <th>Position</th>
			        <th>Contact</th>
			        @if($user->manager_access != 0)
			    		<th class="all">Manager</th>
			    	@endif
			    	<th class="none">Domicile</th>
				</tr>
			</thead>
			<tbody>
				@foreach($members as $member)
					<tr>
						<td></td>
	                    <td>
	                    	<div class="lightbox photos">
	                    	<div data-src="{{url($member->avatar)}}" class="col-md-2 col-sm-4 col-xs-6">

					            <img src ="{{url($member->avatar)}}" style="width:50px; height:50px; border-radius: 50%;"/>
					          </div>

					        </div>
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
	                    @if($user->manager_access != 0 && $member->role != 'manager')
		                    <td>
		                        <img src="{{url('/')}}/img/edit.png" class="icon-style" id="edit" key="{{$member->id}}" data-toggle="modal" data-target="#edit-member"/>
		                        <a id="delete" key="{{$member->id}}"><img class="icon-style" src='{{url("/")}}/img/delete.png'></a>
		                    </td>
		                @endif
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
