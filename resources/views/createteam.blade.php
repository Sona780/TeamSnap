@extends('layouts.app')

@section('content')

        <div class="row" style="margin-top: -6em;">
        <div class="col-sm-8 col-sm-offset-2">
           <div class="wizard-container">
                <div class="card wizard-card ct-wizard-azzure" id="wizardProfile">
                    

                      <div class="wizard-header">
                          <h3>
                             <b>BUILD</b> YOUR TEAM <br>
                             <small>Input basics, and go on to add players.</small>
                          </h3>
                      </div>
                      <ul>
                            <li><a href="#about" data-toggle="tab">BASICS</a></li>
                            <li><a href="#address" data-toggle="tab">PLAYERS</a></li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane" id="about">
                              <div class="row">
                              <form enctype="multipart/form-data" method="POST" id="teamform" name="teamform">
                                 {!! csrf_field() !!}
                                  <h4 class="info-text"> Let's start with the basic information</h4>
                                  <br>
                                  <div class="col-sm-4 col-sm-offset-1">
                                     <div class="picture-container">
                                       <center>
                                          <div class="picture">
                                              <img src="assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>
                                              <input type="file" name="team_logo" id="wizard-picture" class="team_logo">
                                          </div>
                                          <h6>Choose Team Logo</h6>
                                        </center>
                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                        <label>Team Name <small>(required)</small></label>


                                            <div class="fg-line form-group">
                                              <input type="text" class="form-control input-sm teamname" name="teamname"  placeholder="Prashushi" >
                                            </div>


                                      </div>
                                      <div class="form-group" style="padding-top: 0.75em;">
                                        <label>Sport <small>(required)</small></label>
                                             <select class="selectpicker sport" name="sport" >
                                                    <option value="0">Sport</option>
                                                    <option value="1">Non sport</option>
                                             </select>

                                      </div>
                                  </div>


                                  <div class="col-sm-4 col-sm-offset-1">
                                    <br>
                                      <div class="form-group">
                                          <label>Zip Code</label>
                                            <div class="fg-line form-group">
                                              <input type="text" class="form-control input-sm zipcode" placeholder="Zip Code" name="zipcode">
                                            </div>


                                      </div>
                                  </div>

                                  <div class="col-sm-6">
                                    <br>
                                     <div class="form-group">
                                         <label>Country <small>(required)</small></label>

                                                 <select class="selectpicker country" data-live-search="true" name="country"  >
                                                         <option value="0">United States</option>
                                                         <option value="1">Canada</option>
                                                         <option value="2">France</option>
                                                         <option value="3">Germany</option>
                                                         <option value="4">India</option>
                                                         <option value="5">West Indies</option>
                                                 </select>

                                     </div>
                                 </div>
                                 
                              </div>
                             
                              </form>
                            </div>
                            <div class="tab-pane" id="address">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="info-text"> Add Members in your team </h4>
                                        <br>
                                    </div>

                                    <div class="col-sm-5 col-sm-offset-1">
                                         <div class="form-group">
                                            <labe>First Name</label>
                                            <input type="text" class="form-control" placeholder="Mike" name="firstname">
                                          </div>
                                    </div>
                                    <div class="col-sm-5" style="margin-top: -0.35em;">
                                         <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" placeholder="Williams" name="lastname">
                                          </div>
                                    </div>
                                    <div class="col-sm-10 col-sm-offset-1">
                                         <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" placeholder="mike@mail.com" name="email">
                                          </div>
                                    </div>

                                    <div class="col-sm-10 col-sm-offset-1">
                                         <div class="radio m-b-15">
                                            <label>
                                                <input type="radio"  value="0"  name="optradio">
                                                <i class="input-helper"></i>
                                                Player
                                            </label>
                                        </div>

                                    <div class="radio m-b-15">
                                        <label>
                                            <input type="radio"  value="1" name="optradio">
                                            <i class="input-helper"></i>
                                            Non Player
                                        </label>
                                    </div>

                                    <a href="{{url('createteam')}}">
                                      <button class="btn bgm-red btn-float waves-effect"><i class="zmdi zmdi-plus"></i></button>
                                    </a>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                          <center>
                          <input type='button' class='btn btn-next btn-block waves-effect btn-xs submit1' name="submit" id='next' value='Next' style="background-color: #03A9F4; color: #fff;"/>
                        </center>
                        <br>

                        <input type='button' class='btn btn-previous waves-effect btn-xs col-md-5 ' name='previous' value='Previous' style="background-color: #03A9F4; color: #fff;" />
                        <input type='submit' class='btn btn-finish waves-effect btn-xs col-md-5 col-md-offset-2' name='finish' value='Finish' style="background-color: #03A9F4; color: #fff;"/>

                        <div class="clearfix"></div>
                        
                        </div>
                    </form>
                </div>
            </div> <!-- wizard container -->
        </div>
        </div><!-- end row -->

@endsection

@section('footer')

<script>
$(document).ready(function(){
 
$('.submit1').click(function(e){
     e.preventDefault();
     var url = "{{url('store')}}";
     var data = {
      'team_logo': $('.team_logo').val(),
      'teamname' : $('.teamname').val(),
      'sport'    : $('.sport').val(),
      'zipcode'  : $('.zipcode').val(),
      'country'  : $('.country').val(),
     }; 
      console.log(data);
      $.ajax({
        type: "POST",
        url: url,
        data: data,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(a) {
            console.log("success");
            console.log(a);
            
        }
    })
             
    document.getElementById("teamform").reset();       
  });
});
 

</script>
@endsection
