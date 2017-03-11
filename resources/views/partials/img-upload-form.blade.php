<div class="modal-body">
	{!! csrf_field() !!}
	<div style="text-align: center; color: red" id="iupload-error"></div>
	<br/>
	<!-- image preview -->
    <div class="fileinput fileinput-new" data-provides="fileinput">
      <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
      <div>
        <span class="btn btn-info btn-file">
          	<span class="fileinput-new">Select image</span>
          	<span class="fileinput-exists">Change</span>
          	<input type="file" name="image">
        </span>
        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
      </div>
    </div>
   	<!-- image preview -->
</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-success">Upload</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
