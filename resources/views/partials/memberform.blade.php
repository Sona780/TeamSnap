   {!! csrf_field() !!}
        <div class="row">
                <div class="col-sm-4">
                 <h4> First Name:</h4>
                </div>
                <div class="col-sm-8">
                    <div class="fg-line form-group">
                        <input type="text" class="form-control input-sm firstname" name="firstname" >
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
              <h4> Last Name:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" class="form-control input-sm lastname" name="lastname" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> Email:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" class="form-control input-sm email" name="email" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> Phone number:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" class="form-control input-sm mobile" name="mobile" >
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
              <h4>Type:</h4>
          </div>
          <div class="col-sm-8"> 
             <div class="radio m-b-15">
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
             <h4> ctg:</h4>
            </div>
            <div class="col-sm-8">
                @foreach($ctgs as $ctg)
                <label class="checkbox checkbox-inline m-r-20">
                    <input type="checkbox" value="{{$ctg->id}}" name="ctg{{$ctg->id}}" id="ctg{{$ctg->id}}">
                    <i class="input-helper"></i>    
                   {{$ctg->name}}
                 </label>
                 @endforeach
                
             </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> Birthday:</h4>
            </div>
            <div class="col-sm-8">
                <div class="input-group form-group">
                  <span class="input-group-addon"></span>
                    <div class="dtp-container fg-line">
                       <input type='text' class="form-control date-picker birthday" name="birthday" >
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
                    <input type="text" class="form-control input-sm role" name="role">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> City:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" class="form-control input-sm city" name="city" >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
             <h4> State:</h4>
            </div>
            <div class="col-sm-8">
                <div class="fg-line form-group">
                    <input type="text" class="form-control input-sm state" name="state" >
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-sm-4">
             <h4> Manager Access:</h4>
            </div>
            <div class="col-sm-8">
               <label class="checkbox checkbox-inline m-r-20">
                    <input type="checkbox" value="hello" name="manager_access" id="manager_access">
                    <i class="input-helper"></i>    
                   Yes
                 </label>
                                 
             </div>
        </div>
   