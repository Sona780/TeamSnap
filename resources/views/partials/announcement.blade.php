{!! csrf_field() !!}
<div class="modal-body">

	 <div class="col-sm-12">
	  <div class="col-sm-12">
		<div class="form-group fg-line">
			<label for="Subject">Title</label>
			{{Form::text('title', null, ['class' => 'form-control', 'autofocus' => true])}}
		</div>
		<strong id="error-title" class="strong-error"></strong>
	  </div>
	  <br><br>
      <div class="col-sm-12">
		<div class="form-group fg-line">
			<label for="body">Announcement</label>
			{{Form::textarea('announcement', null, ['class' => 'form-control', 'rows' => '5'])}}
		</div>
		<strong id="error-announcement" class="strong-error"></strong>
	  </div>


     </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-info" id='submit-announcement'>Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
