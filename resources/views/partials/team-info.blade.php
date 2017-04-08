{!! csrf_field() !!}
<div class="modal-body">

	<div class="row">
		<div class="col-sm-5 text-center" style="display: none" id='upload-uniform'>
            <input type="hidden" name="profile_img">
           	<div class="fileinput fileinput-new" data-provides="fileinput" id="file-field">
            	<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="padding:0px 0px">
                	<img id="preview">
                </div>
                <div>
                	<span class="btn btn-info btn-file">
                    	<span class="fileinput-new">Select uniform</span>
                        <span class="fileinput-exists size-exists">Change</span>
                        <input type="file" name="uniform">
                    </span>
                    <a href="#" class="btn btn-danger fileinput-exists" style="width: 99px" data-dismiss="fileinput" id="remove_img">Remove</a>
                </div>
            </div>
        </div>

        <div class="col-sm-5 text-center" id='show-uniform'>
        	<img id='team-uniform-img' style='width: 150px; height: 150px'><br><br>
        	<a class="btn btn-success" id='uniform-change'>Change</a>
        </div>

	    <div class="col-sm-7">
			<div class="form-group fg-line">
				<label for="description">Description</label>
				{{Form::textarea('detail', null, ['class' => 'form-control', 'rows' => '8'])}}
			</div>
			<strong id="error-announcement" class="strong-error"></strong>
		</div>

    </div>

</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-info" id='submit-info'>Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
