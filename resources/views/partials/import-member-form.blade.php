<div class="modal-body">
	<div style="text-align: center; color: red" id="imember-error"></div>
	<br/>
	<div class="form-group">
		<label for="team">Select a team</label>
	    <select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" name="team" id="team" title='Choose Team..'>
	        @foreach($teams as $team)
	            <option value="{{$team->id}}">{{$team->teamname}}</option>
	        @endforeach
		</select>
	</div>

	<div style="text-align: center; display: none;" id="imember-load">Members are loading...</div>
	<br/>

	<div class="form-group" id='imember-div' style="display: none">
		<label for="members">Select members to import</label>
	    <select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" name="members[]" title='Choose Categories..' id="members" multiple="multiple">

		</select>
	</div>
</div>

<div class="modal-footer">
    <button type="submit" class="btn btn-success" id="imember-submit">Import</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
