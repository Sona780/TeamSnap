			{!! csrf_field() !!}
			<div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label-new">Date</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                        <input type="email" class="form-control date-picker" name="date" id="f-ip" >
                        <strong id="error-date" class="strong-error"></strong>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label-new">Time</label>
	             <div class="row">
	                <div class="col-sm-2">
	                    <div class="fg-line">
	                        <input type="email" class="form-control" name="hour" id="f-ip" >
	                    </div>
	                </div>
	                <div class="col-sm-2">
	                    <div class="fg-line">
	                        <input type="email" class="form-control" name="minute" id="f-ip" >
	                    </div>
	                </div>
	                <div class="col-sm-2">
			             <select name="time" id="time" class="selectpicker p-t-5">
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>
	                </div>
	                <strong id="error-time" class="strong-error"></strong>
	             </div>   
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label-new">Opponent</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                        <select name="opponent" id="opponent" class="selectpicker" style="width:150px">
							<option value=""></option>
							<option value="0">New Opponent</option>
							@if( $opp->count() > 0 )
								<option value="default" disabled>-------------------------------</option>
								@foreach( $opp as $o )
									<option value="{{$o->id}}">{{$o->name}}</option>
								@endforeach
							@endif
						</select>
						<strong id="error-opponent" class="strong-error"></strong>
                    </div>
                </div>
            </div>
            <div class="row p-10" id="opp-detail" style="display: none;">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Opponent Name</label>
                <div class="col-sm-8">
                    <div class="fg-line">
                        <input type="text" class="form-control" name="name" id="f-ip">
					    <strong id="error-name" class="strong-error"></strong>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Contact Person</label>
                <div class="col-sm-8">
                    <div class="fg-line">
                        <input type="text" class="form-control" name="contact_person" id="f-ip" >
					    <strong id="error-contact_person" class="strong-error"></strong>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Phone</label>
                <div class="col-sm-8">
                    <div class="fg-line">
                        <input type="text" class="form-control" name="phone" id="f-ip" >
						<strong id="error-phone" class="strong-error"></strong>
                    </div>
                </div>
              </div>
              
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label-new">Result</label>
                <div class="col-sm-10">
                    <div class="fg-line">
                        <input type="text" class="form-control" name="result" id="f-ip">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label-new">Location</label>
                <div class="col-sm-10">
                    <select name="location" id="location" class="selectpicker" style="width:150px">
							<option value=""></option>
							<option value="0">New Location</option>
							@if( $loc->count() > 0 )
								<option value="default" disabled>-------------------------------</option>
								@foreach( $loc as $l )
									<option value="{{$l->id}}">{{$l->name}}</option>
								@endforeach
							@endif
						</select>
						<strong id="error-location" class="strong-error"></strong>
                </div>
            </div>
            <div class="row p-10" id="loc-data" style="display: none">
              <div class="form-group">
	                <label for="inputEmail3" class="col-sm-4 control-label">Location Detail</label>
	                <div class="col-sm-8">
	                    <div class="fg-line">
	                        <input type="text" class="form-control" name="location_detail" id="f-ip">
							<strong id="error-location_detail" class="strong-error"></strong>
	                    </div>
	                </div>
              </div>
              <div class="form-group">
	                <label for="inputEmail3" class="col-sm-4 control-label">Location Name</label>
	                <div class="col-sm-8">
	                    <div class="fg-line">
	                        <input type="text" class="form-control" name="loc_name" id="f-ip" style="width: 170px">
						     <strong id="error-loc_name" class="strong-error"></strong>
	                    </div>
	                </div>
              </div>
              <div class="form-group">
	                <label for="inputEmail3" class="col-sm-4 control-label">Address</label>
	                <div class="col-sm-8">
	                    <div class="fg-line">
	                        <input type="text" class="form-control" name="address" id="f-ip" style="width: 170px">
							<strong id="error-adress" class="strong-error"></strong>
	                    </div>
	                </div>
              </div>
              <div class="form-group">
	                <label for="inputEmail3" class="col-sm-4 control-label">Link</label>
	                <div class="col-sm-8">
	                    <div class="fg-line">
	                        <input type="text" class="form-control" name="link" id="f-ip" style="width: 170px">
							<strong id="error-link" class="strong-error"></strong>
	                    </div>
	                </div>
              </div>
            </div>

			<table class="table table-responsive" style="width:100%; height: 50%; font-size: 12px">
				
				<tr>
					<td class="first-col"><label>Date:</label></td>
					<td class="padd-left dtp-container fg-line">
						<input type="text" class="date-picker border-height" name="date" id="f-ip" >
						<strong id="error-date" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Time:</label></td>
					<td class="padd-left">
						<input type="text" class="border-height" name="hour" id="f-ip" style="width: 40px">&nbsp;:&nbsp;
						<input type="text" class="border-height" name="minute" id="f-ip" style="width: 40px">&nbsp;&nbsp;
						<select name="time" id="time" class="border-height">
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>
						<strong id="error-time" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Opponent:</label></td>
					<td class="padd-left">
						<select name="opponent" id="opponent" class="border-height" style="width:150px">
							<option value=""></option>
							<option value="0">New Opponent</option>
							@if( $opp->count() > 0 )
								<option value="default" disabled>-------------------------------</option>
								@foreach( $opp as $o )
									<option value="{{$o->id}}">{{$o->name}}</option>
								@endforeach
							@endif
						</select>
						<strong id="error-opponent" class="strong-error"></strong>
					</td>
				</tr>
				<tr id="opp" style="display: none">
					<td class="first-col"><label></label></td>
					<td class="padd-left">
						<table class="table table-bordered" style="background: white; border-radius: 10px; font-size: 12px">
							<tr>
								<td class="first-col"><label>Opponent Name:</label></td>
								<td class="padd-left">
									<input type="text" class="border-height" name="name" id="f-ip" style="width: 170px">
									<strong id="error-name" class="strong-error"></strong>
								</td>
							</tr>
							<tr>
								<td class="first-col"><label>Contact Person:</label></td>
								<td class="padd-left">
									<input type="text" class="border-height" name="contact_person" id="f-ip" style="width: 170px">
									<strong id="error-contact_person" class="strong-error"></strong>
								</td>
							</tr>
							<tr>
								<td class="first-col"><label>Phone:</label></td>
								<td class="padd-left">
									<input type="text" class="border-height" name="phone" id="f-ip" style="width: 170px">
									<strong id="error-phone" class="strong-error"></strong>
								</td>
							</tr>
							<tr>
								<td class="first-col"><label>Email:</label></td>
								<td class="padd-left">
									<input type="text" class="border-height" name="email" id="f-ip" style="width: 170px">
									<strong id="error-email" class="strong-error"></strong>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Result:</label></td>
					<td class="padd-left">
						<input type="text" class="border-height" name="result" id="f-ip">
					</td>
				</tr>

				<!-- Loaction info -->
				<tr>
					<td class="first-col"><label>Loaction:</label></td>
					<td class="padd-left">
						<select name="location" id="location" class="border-height" style="width:150px">
							<option value=""></option>
							<option value="0">New Location</option>
							@if( $loc->count() > 0 )
								<option value="default" disabled>-------------------------------</option>
								@foreach( $loc as $l )
									<option value="{{$l->id}}">{{$l->name}}</option>
								@endforeach
							@endif
						</select>
						<strong id="error-location" class="strong-error"></strong>
					</td>
				</tr>

					<tr id="loc-data8" style="display: none">
						<td class="first-col"><label>Location Detail:</label></td>
						<td class="padd-left">
							<input type="text" class="border-height" name="location_detail" id="f-ip">
							<strong id="error-location_detail" class="strong-error"></strong>
						</td>
					</tr>
					<tr id="loc-data1" style="display: none">
						<td class="first-col"><label></label></td>
						<td class="padd-left">
							<table class="table table-bordered" style="background: white; border-radius: 10px; font-size: 12px">
								<tr>
									<td class="first-col"><label>Location Name:</label></td>
									<td class="padd-left">
										<input type="text" class="border-height" name="loc_name" id="f-ip" style="width: 170px">
										<strong id="error-loc_name" class="strong-error"></strong>
									</td>
								</tr>
								<tr>
									<td class="first-col"><label>Adress:</label></td>
									<td class="padd-left">
										<input type="text" class="border-height" name="address" id="f-ip" style="width: 170px">
										<strong id="error-adress" class="strong-error"></strong>
									</td>
								</tr>
								<tr>
									<td class="first-col"><label>Link:</label></td>
									<td class="padd-left">
										<input type="text" class="border-height" name="link" id="f-ip" style="width: 170px">
										<strong id="error-link" class="strong-error"></strong>
									</td>
								</tr>
							</table>
						</td>
					</tr>

				<!-- End Loaction info -->

				<tr>
					<td colspan="2" style="text-align: center">
						<button type="button" style="border-radius: 5px; background: white; height: 40px; " id="info" onClick="event.preventDefault();">
							&nbsp;<img src="{{url('/')}}/img/down.png" id="info-img" >&nbsp;&nbsp;
							Show optional Game Info
						</button>
					</td>
				</tr>

				<tr id="add-info">
					<td class="first-col"><label>Home or Away::</label></td>
					<td class="padd-left">
						<select name="place" id="place" class="border-height" style="width: 80px">
							<option value=""></option>
							<option value="home">Home</option>
							<option value="away">Away</option>
						</select>
					</td>
				</tr>
				<tr id="add-info">
					<td class="first-col"><label>Uniform:</label></td>
					<td class="padd-left">
						<input type="text" name="uniform" id="f-ip" class="border-height">
					</td>
				</tr>
				<tr id="add-info">
					<td class="first-col"><label>Duration:</label></td>
					<td class="padd-left">
						<input type="text" class="border-height" name="d_hour" id="f-ip" style="width: 40px">&nbsp;:&nbsp;
						<input type="text" class="border-height" name="d_minute" id="f-ip" style="width: 40px">
						<strong id="error-duration" class="strong-error"></strong>
					</td>
				</tr>
			</table>
<div style="align: center">
	<button class="btn btn-warning adjust" type="button" id="cancel">Cancel</button>
	<button class="btn btn-success adjust" type="submit">{{ $submitButton }}</button>
</div>
