{!! csrf_field() !!}
			<table class="table table-bordered" style="width:100%; height: 50%; border-radius: 10px; font-size: 12px">
				<tr>
					<td class="first-col"><label>Name of the Event:</label></td>
					<td class="padd-left">
						<input type="text" class="border-height" name="name" id="f-ip">
						<strong id="error-name" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Short Label:</label></td>
					<td class="padd-left">
						<input type="text" class="border-height" name="label" id="f-ip">
						<strong id="error-label" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Date:</label></td>
					<td class="padd-left dtp-container fg-line">
						<input type="text" class="date-picker border-height" name="date" id="f-ip" style="width: 90px">
						<strong id="error-date" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Time:</label></td>
					<td class="padd-left">
						<input type="text" class="border-height" style="width: 40px" name="hour" id="f-ip">&nbsp;:&nbsp;
						<input type="text" class="border-height" style="width: 40px" name="minute" id="f-ip">&nbsp;&nbsp;
						<select name="time" id="time" class="border-height">
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>
						<strong id="error-time" class="strong-error"></strong>
					</td>
				</tr>
				<tr>
					<td class="first-col"><label>Repeat:</label></td>
					<td class="padd-left">
						<select name="repeat" id="repeat" class="border-height">
							<option value="0">Does Not Repeat</option>
							<option value="1">Weekly</option>
							<option value="2">Monthly</option>
							<option value="3">Yearly</option>
						</select>
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

					<tr id="loc-data" style="display: none">
						<td class="first-col"><label>Location Detail:</label></td>
						<td class="padd-left">
							<input type="text" class="border-height" name="location_detail" id="f-ip">
							<strong id="error-location_detail" class="strong-error"></strong>
						</td>
					</tr>
					<tr id="loc-data" style="display: none">
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
			</table>
			<button class="btn btn-warning adjust" type="button" id="cancel">Cancel</button>
			<button class="btn btn-success adjust" type="submit">{{ $submitButton }}</button>
