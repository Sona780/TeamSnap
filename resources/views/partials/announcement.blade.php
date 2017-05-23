{!! csrf_field() !!}
<div class="modal-body">
  <div class="col-sm-12">

	<!-- start start date -->
	  <div class="col-sm-6">
		<div class="form-group fg-line">
			<label for="Subject">Start date</label>
			{{Form::text('start', null, ['class' => 'form-control date-picker'])}}
		</div>
	  </div>
	<!-- end start date -->

	<!-- start end date -->
	  <div class="col-sm-6">
		<div class="form-group fg-line">
			<label for="Subject">End date</label>
			{{Form::text('end', null, ['class' => 'form-control date-picker'])}}
		</div>
	  </div>
	<!-- end end date -->

	<!-- start title -->
	  <div class="col-sm-12">
		<div class="form-group fg-line">
			<label for="Subject">Title</label>
			{{Form::text('title', null, ['class' => 'form-control', 'autofocus' => true])}}
		</div>
	  </div>
	<!-- end title -->

	<!-- start announcement -->
      <div class="col-sm-12">
		<div class="form-group fg-line">
			<label for="body">Announcement</label>
			{{Form::textarea('announcement', null, ['class' => 'form-control', 'rows' => '5'])}}
		</div>
	  </div>
	<!-- end announcement -->

  </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-info" id='{{$save}}'>Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
