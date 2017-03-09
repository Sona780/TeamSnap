@if( $members->count() == 0 )
	<div style="text-align: center"><p style="font-size: 15px;">No member available in the team</p></div>
@else
	<div class="table-responsive ">
		<table  class="table table-hover table-condensed mem-tab">
			<thead>
			    <tr>
			        <th data-column-id="id" data-type="numeric">Photo</th>
			        <th data-column-id="sender">Name</th>
			        <th data-column-id="received" data-order="desc">Contact</th>
			        <th data-column-id="received" data-order="desc">Position</th>
			    	<th data-column-id="received" data-order="desc">Manager</th>
				</tr>
			</thead>
			<tbody>
				@foreach($members as $member)
					<tr>
	                    <td>
	                        <img src ="{{url('/')}}/{{ $member->avatar }}" style="width:50px; height:50px; border-radius: 50%;"/>
	                    </td>
	                    <td>{{$member->firstname}}&nbsp;&nbsp;{{$member->lastname}}</td>
	                    <td>
	                        <p>{{$member->email}}</p>
	                        <p>{{$member->mobile}}
	                    </td>
	                    <td>{{$member->role}}</td>
	                    <td>
	                        <img src="{{url('/')}}/img/edit.png" class="icon-style" id="edit" key="{{$member->id}}" data-toggle="modal" data-target="#edit-member"/>
	                        <a href="{{url('/')}}/{{$member->id}}/profile/delete"><img class="icon-style" src='{{url("/")}}/img/delete.png'></a>
	                    </td>
	                </tr>
	            @endforeach
	        </tbody>
		</table>
	</div>
@endif
