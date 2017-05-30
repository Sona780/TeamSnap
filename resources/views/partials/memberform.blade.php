 {!! csrf_field() !!}
 <input type="hidden" name="teamid" value="{{$id}}">
   <div class="modal-body">
      <div class="row">
           <div class="col-sm-5">
                <input type="hidden" name="profile_img">
                <div class="fileinput fileinput-new" data-provides="fileinput" id="file-field">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="padding:0px 0px">
                        <img id="preview">
                    </div>
                    <div>
                        <span class="btn btn-info btn-file">
                            <span class="fileinput-new size-new">Select image</span>
                            <span class="fileinput-exists size-exists">Change</span>
                            <input type="file" name="file" id="{{$bid}}">
                        </span>
                        <a href="#" class="btn btn-danger fileinput-exists" style="width: 99px" data-dismiss="fileinput" id="remove_img">Remove</a>
                    </div>
                </div>
                <strong id="error-img" class="strong-error"></strong>
           </div>

           <div class="col-sm-7">
                  <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label for="firstname">First Name</label>
                        <input type="text" id="f-ip" class="form-control input-sm" name="firstname" placeholder="Member first name..." autofocus>
                    </div>
                    <strong id="error-first" class="strong-error"></strong>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="f-ip" class="form-control input-sm" name="lastname" placeholder="Member middle and last name...">
                    </div>
                    <strong id="error-last" class="strong-error"></strong>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label for="email">Email</label>
                        <input type="email" id="f-ip" class="form-control input-sm" name="email" placeholder="Member email address...">
                    </div>
                    <strong id="error-email" class="strong-error"></strong>
                  </div>
           </div>
      </div>

     <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12">
                <div class="form-group fg-line">
                    <label for="phone">Phone number</label>
                    <input type="text" id="f-ip" class="form-control input-sm" name="mobile" placeholder="Member mobile no...">
                </div>
            </div>

            <div class="col-sm-12">
                <label for="gender" style="padding-right: 75px">Gender</label>
                <div class=" radio radio-inline">
                    <label class="m-r-20 p-r-5">
                        <input type="radio"  value="0"  name="gender" id="gender" class="optradio" checked>
                        <i class="input-helper"></i>
                        Male
                    </label>
                    <label>
                        <input type="radio"  value="1" name="gender" id="gender" class="optradio">
                        <i class="input-helper"></i>
                        Female
                    </label>
                </div>
            </div>

            <div class="col-sm-12 p-t-10">
                <label for="optradio" style="padding-right: 88px">Type</label>
                <div class="radio radio-inline" >
                    <label class="m-r-20">
                        <input type="radio"  value="1" name="optradio" id="member-type" class="optradio" checked>
                        <i class="input-helper"></i>
                        Player
                    </label>
                    <label style="padding-right: 8px">
                        <input type="radio"  value="0"  name="optradio" id="member-type" class="optradio">
                        <i class="input-helper"></i>
                        Non Player
                    </label>
                </div>
            </div>

            <div class="form-group col-sm-12" style="padding-top: 13px">
                <label for="categories" style="padding-right: 53px">Categories</label>
                <select name="categories[]" id="categories"  multiple="multiple" title='Choose Categories..'>
                    @foreach($ctgs as $ctg)
                        <option value="{{$ctg->id}}">{{$ctg->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-sm-12">
                <label for="birthday">Birthday</label>
                <div class="dtp-container fg-line">
                   <input type='text' id="f-ip" class="form-control birthday" name="birthday" placeholder="Member birth date">
                </div>
                <strong id="error-birth" class="strong-error"></strong>
            </div>

            <div class="col-sm-12">
                <div class="form-group fg-line">
                    <label for="phone">Role(s)</label>
                    <input type="text" id="f-ip" class="form-control input-sm role" name="role" placeholder="Member role in team">
                </div>
            </div>

            <div class="col-sm-12">
            <div class="form-group fg-line">
                <label for="phone">City(s)</label>
                <input type="text" id="f-ip" class="form-control input-sm city" name="city" placeholder="Member domicile city">
            </div>
            </div>

            <div class="col-sm-12">
            <div class="form-group fg-line">
                <label for="phone">State</label>
                <input type="text" id="f-ip" class="form-control input-sm state" name="state" placeholder="Member domicile state">
            </div>
            </div>
        </div>
     </div>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-info">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>

