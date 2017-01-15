@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                       <p>create your own team </p>
    
   <form action="{{url('store')}}" method="POST">
    {!! csrf_field() !!}
      TeamName:<input type="text" name="teamname" required="required" class="form-control" /><br/>
      Sport:<input type="text" name="sport" required="required" class="form-control"/><br/>
      country:<input type="text" name="country" required="required" class="form-control"/><br/>
      Zipcode:<input type="text" name="zip" required="required" class="form-control"/><br/>
      <input type="submit" value="submit">

    </form>
    <br/>

                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container">
        <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
           <div class="wizard-container"> 
                <div class="card wizard-card ct-wizard-orange" id="wizardProfile">
                    <form enctype="multipart/form-data" action="{{url('store')}}" method="POST">
                             {!! csrf_field() !!}
                
                      <div class="wizard-header">
                          <h3>
                             <b>BUILD</b> YOUR TEAM <br>
                             <small>This information will let us know more about you.</small>
                          </h3>
                      </div>
                      <ul>
                            <li><a href="#about" data-toggle="tab">About</a></li>
                            <li><a href="#address" data-toggle="tab">Address</a></li>
                        </ul>
                        
                        <div class="tab-content">
                            <div class="tab-pane" id="about">
                              <div class="row">
                                  <h4 class="info-text"> Let's start with the basic information</h4>
                                  <div class="col-sm-4 col-sm-offset-1">
                                     <div class="picture-container">
                                          <div class="picture">
                                              <img src="assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>
                                              <input type="file" name="team_logo" id="wizard-picture">
                                          </div>
                                          <h6>Choose Picture</h6>
                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                        <label>Team Name <small>(required)</small></label>
                                        
                                         
                                            <div class="fg-line form-group">
                                              <input type="text" class="form-control input-sm" name="teamname" placeholder="Prashushi">
                                            </div>
                                         

                                      </div>
                                      <div class="form-group">
                                        <label>Sport <small>(required)</small></label>
                                             <select class="selectpicker" name="sport">
                                                    <option value="0">Sport</option>
                                                    <option value="1">Non sport</option>
                                                    
                                              </select>
                                        
                                      </div>
                                  </div>
                                   <div class="col-sm-10 col-sm-offset-1">
                                      <div class="form-group">
                                          <label>Country <small>(required)</small></label>
                                           
                                                  <select class="selectpicker" data-live-search="true" name="country">
                                                          <option value="0">Mustard</option>
                                                          <option value="1">Ketchup</option>
                                                          <option value="2">Relish</option>
                                                          <option value="3">Tent</option>
                                                          <option value="4">Flashlight</option>
                                                          <option value="5">Toilet Paper</option>
                                                  </select>
                                                  
                                      </div>
                                  </div>
                                  <div class="col-sm-10 col-sm-offset-1">
                                      <div class="form-group">
                                          <label>Zip Code <small>(required)</small></label>
                                            <div class="fg-line form-group">
                                              <input type="text" class="form-control input-sm" placeholder="Zip Code" name="zipcode">
                                            </div>   
                                    
                                                
                                      </div>
                                  </div>
                                 
                              </div>
                            </div>
                            <div class="tab-pane" id="address">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="info-text"> Add Members in your team </h4>
                                    </div>
                                    <div class="col-sm-5 col-sm-offset-1">
                                         <div class="form-group">
                                            <labe>First Name</label>
                                            <input type="text" class="form-control" placeholder="5h Avenue" name="firstname">
                                          </div>
                                    </div>
                                    <div class="col-sm-5">
                                         <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" placeholder="242" name="lastname">
                                          </div>
                                    </div>
                                    <div class="col-sm-10 col-sm-offset-1">
                                         <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" placeholder="New York..." name="email">
                                          </div>
                                    </div>

                                    <div class="col-sm-10 col-sm-offset-1">
                                         <div class="radio m-b-15">
                                            <label>
                                                <input type="radio" name="sample" value="1"  name="optradio">
                                                <i class="input-helper"></i>
                                                Player
                                            </label>
                                        </div>
                            
                                    <div class="radio m-b-15">
                                        <label>
                                            <input type="radio" name="sample"  value="0" name="optradio1">
                                            <i class="input-helper"></i>
                                            Non Player
                                        </label>
                                    </div>

                                    </div>
                                       
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Next' />
                                <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' name='finish' value='Finish' />
        
                            </div>
                            
                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                            </div>
                            <div class="clearfix"></div>
                        </div>  
                    </form>
                </div>
            </div> <!-- wizard container -->
        </div>
        </div><!-- end row -->
    </div>
@endsection
