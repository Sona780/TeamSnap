
   {!! csrf_field() !!}
        <div class="row">
                <div class="col-sm-4">
                 <h4> First Name:</h4>
                </div>
                <div class="col-sm-8">
                    <div class="fg-line form-group">
                        <input type="text" id="f-ip" class="form-control input-sm firstname" name="firstname" placeholder="Prashushi">
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
              <h4> Last Name:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" id="f-ip" class="form-control input-sm lastname" name="lastname" placeholder="Prashushi">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> Email:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" id="f-ip" class="form-control input-sm email" name="email" placeholder="Prashushi">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> Phone number:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" id="f-ip" class="form-control input-sm mobile" name="mobile" placeholder="Prashushi">
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
              <h4>Type:</h4>
          </div>
          <div class="col-sm-8"> 
             <div class="radio m-b-15" id="member-type">
                <label>
                    <input type="radio"  value="1"  name="optradio" class="optradio" checked>
                    <i class="input-helper"></i>
                    Player
                </label>
            
                <label>
                    <input type="radio"  value="0" name="optradio" class="optradio">
                    <i class="input-helper"></i>
                    Non Player
                </label>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4>Categories:</h4>
            </div>
            <div class="col-sm-8">
                <select name="categories[]" id="categories"  multiple="multiple" title='Choose Categories..'>
                    @foreach($ctgs as $ctg)
                        <option value="{{$ctg->id}}">{{$ctg->name}}</option>
                    @endforeach
                </select>
             </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> Birthday:</h4>
            </div>
            <div class="col-sm-8">
                <div class="input-group form-group">
                    <div class="dtp-container fg-line">
                       <input type='text' id="f-ip" class="form-control date-picker birthday" name="birthday" placeholder="Click here...">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> Role(s):</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" id="f-ip" class="form-control input-sm role" name="role" placeholder="Prashushi">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> City:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" id="f-ip" class="form-control input-sm city" name="city" placeholder="Prashushi">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> State:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" id="f-ip" class="form-control input-sm state" name="state" placeholder="Prashushi">
                </div>
            </div>
        </div>
