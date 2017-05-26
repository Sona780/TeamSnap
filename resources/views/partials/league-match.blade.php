<!-- start date & time -->
				    <div class="col-sm-12">
					  <div class="form-group col-sm-6">
						<label>Date</label>
						<input type='text' class="form-control" name="match_date">
					  </div>
					  <div class="form-group col-sm-6">
						<label>Time</label>
						<div class="form-inline">
						  <input type="text" class="form-control" name="hour" style="width: 50px">&nbsp;:&nbsp;
						  <input type="text" class="form-control" name="minute" style="width: 50px">&nbsp;&nbsp;
						  <select name="time" class="form-control" style="width: 50px">
							<option value="0">AM</option>
							<option value="1">PM</option>
						  </select>
						</div>
					  </div>
				    </div>
				  <!-- end date & time -->

				  <!-- result -->
				  	<div class="col-sm-12">
					  <div class="col-sm-12">
					    <label>Result</label>
						<input type='text' class="form-control" name="result">
					  </div>
					</div>
				  <!-- result -->

				  <!-- start location dropdown -->
				  	<div class="col-sm-12">
					  <div class="form-group col-sm-12" style="padding-top: 13px">
		                <label for="categories" style="padding-right: 53px">Location</label>
		                <select class="selectpicker show-menu-arrow" data-live-search="true" data-style="grey" name="location" title='Choose location' id="location">
		                  <option value="new">Add new location</option>
		                  <option value="default" disabled>---------------------------------</option>
		                  @foreach($div['locs'] as $loc)
					  		<option value="{{$loc->id}}">{{$loc->loc_name}}</option>
					  	  @endforeach
		                </select>
		              </div>
		            </div>
		          <!-- end location dropdown -->

		          <!-- start new location detail -->
		          	<div class="col-sm-12" id="new_loc" style="display: none">
		              <div class="form-group col-sm-4">
						<input type="text" class="form-control" name="loc_name" placeholder='Location name'>
					  </div>
					  <div class="form-group col-sm-4">
						<input type="text" class="form-control" name="loc_detail" placeholder='Location detail'>
					  </div>
					  <div class="form-group col-sm-4">
						<input type="text" class="form-control" name="contact" placeholder='Contact person'>
					  </div>
					</div>
				  <!-- end new location detail -->
