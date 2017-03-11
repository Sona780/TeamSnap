<div class="modal-body">
	{!! csrf_field() !!}
	<div style="text-align: center; color: red" id="ictg-error"></div>
	<br/>
	<div class="form-group">
		<label for="team">Select a team</label>
	    <select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" name="team" id="team" title='Choose Team..'>
	        @foreach($teams as $team)
	            <option value="{{$team->id}}">{{$team->teamname}}</option>
	        @endforeach
		</select>
	</div>

	<div style="text-align: center; display: none;" id="ctg-imp-load">Categories are loading...</div>
	<br/>

	<div class="form-group" id='ictg-div' style="display: none">
		<label for="categories">Select categories to import</label>
	    <select class="selectpicker show-menu-arrow" data-actions-box="true" data-header="Choose members" data-live-search="true" data-style="grey" data-size="5" name="categories[]" title='Choose Categories..' id="categories" multiple="multiple">

		</select>
	</div>
</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-success" id="ictg-submit">Import</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
