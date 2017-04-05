
   {!! csrf_field() !!}
   <div class="modal-body">

        <div class="form-group fg-line">
            <label for="VideoTitle">Video Title</label>
            <input type="text" id="title" class="form-control input-sm" name="title" placeholder="Title of the Video.." autofocus>
            <strong id="error-title" class="strong-error"></strong>
        </div>

        <div class="form-group fg-line">
            <label for="url">URL</label>
            <input type="text" id="url" class="form-control input-sm" name="url" placeholder="URL of the Video..">
            <strong id="error-url" class="strong-error"></strong>
        </div>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-info">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
