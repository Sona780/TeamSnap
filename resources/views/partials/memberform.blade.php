
   {!! csrf_field() !!}
   <div class="modal-body">
        <input type="hidden" name="profile_img">


        <div class="fileinput fileinput-new" data-provides="fileinput" id="file-field">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="padding:0px 0px">
                <img id="preview">
            </div>
            <div>
                <span class="btn btn-info btn-file">
                    <span class="fileinput-new size-new">Select image</span>
                    <span class="fileinput-exists size-exists">Change</span>
                    <input type="file" name="file">
                </span>
                <a href="#" class="btn btn-danger fileinput-exists" style="width: 99px" data-dismiss="fileinput" id="remove_img">Remove</a>
            </div>
        </div>


        <div class="col-sm-6">

            <div class="form-group col-sm-12">
                <label for="firstname">First Name</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="firstname" placeholder="Member first name...">
                <strong id="error-first" class="strong-error"></strong>
            </div>

            <div class="form-group col-sm-12">
                <label for="lastname">Last Name</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="lastname" placeholder="Member middle and last name...">
                <strong id="error-last" class="strong-error"></strong>
            </div>

            <div class="form-group col-sm-12">
                <label for="email">Email</label>
                <input type="email" id="f-ip" class="form-control input-sm" name="email" placeholder="Member email address...">
            </div>

        </div>

        <div class="col-sm-12">

            <div class="form-group col-sm-12">
                <label for="phone">Phone number</label>
                <input type="text" id="f-ip" class="form-control input-sm" name="mobile" placeholder="Member mobile no...">
            </div>

            <div class="form-inline col-sm-12">

                <label for="gender" style="padding-right: 75px">Gender</label>
                <label style="padding-right: 5px">
                    <input type="radio"  value="0"  name="gender" id="gender" class="optradio" checked>
                    Male
                </label>

                <label>
                    <input type="radio"  value="1" name="gender" id="gender" class="optradio">
                    Female
                </label>
            </div>

            <div class="form-inline col-sm-12" style="padding-top: 13px">
                <label for="optradio" style="padding-right: 88px">Type</label>
                <label>
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
                   <input type='text' id="f-ip" class="form-control date-picker birthday" name="birthday" placeholder="Member birth date">
                </div>
                <strong id="error-birth" class="strong-error"></strong>
            </div>

            <div class="form-group col-sm-12">
                <label for="phone">Role(s)</label>
                <input type="text" id="f-ip" class="form-control input-sm role" name="role" placeholder="Member role in team">
            </div>

            <div class="form-group col-sm-12">
                <label for="phone">City(s)</label>
                <input type="text" id="f-ip" class="form-control input-sm city" name="city" placeholder="Member domicile city">
            </div>

            <div class="form-group col-sm-12">
                <label for="phone">State</label>
                <input type="text" id="f-ip" class="form-control input-sm state" name="state" placeholder="Member domicile state">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
