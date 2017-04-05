{!! csrf_field() !!}
<div class="modal-body">
	<div class="row">
	 <div class="col-sm-12">
	  <div class="col-sm-12">
		<div class="form-group fg-line">
			<label for="Subject">Subject</label>
		    <input type="text" class="form-control input-sm one" name="subject" id="subject" placeholder="Write subject of mail.." autofocus>
		    <strong id="error-subject" class="strong-error"></strong>
		</div>
	  </div>

      <div class="col-sm-12">
		<div class="form-group fg-line">
			<label for="body">Body</label>
		    <textarea class="form-control" rows="8" id="body" name="body"></textarea>
		    <strong id="error-body" class="strong-error"></strong>
		</div>
	  </div>

		<?php $count = 1; ?>
		<div class="form-group col-sm-12">
			<label for="Add Receivers">Add Receivers &nbsp;&nbsp;<span><button class="btn btn-info" type='button' id='selectall'>Select All</button></span></label>
			<ul id="example">
				<?php $count = 1; ?>
				@foreach($members as $member )
	            	<li class="members-li p-5">
	            		<input type="checkbox" id="cb{{$count}}" name="receivers[{{$count}}]" class="member_checkbox" value="{{$member->id}}" />
	                	<label for="cb{{$count}}"><img src='{{ url($member->avatar) }}' class="img-circle"/></label>
	                	<span>{{$member->firstname}}</span>
	                </li>
	                <?php $count += 1; ?>
	            @endforeach
	        </ul>
	        <strong id="error-receivers" class="strong-error"></strong>
        </div>

     </div>
	</div>
</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-info">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
