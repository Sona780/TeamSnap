@extends('layouts.new')

@section('content')
<div class="container">
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
</div>


<!--  <div class="container">
    <div class="card">
                        <div class="card-header">
                            <h2>Wizard <small>This twitter bootstrap plugin builds a wizard out of a formatter tabbable structure. It allows to build a wizard functionality using buttons to go through the different wizard steps and using events allows to hook into each step individually.</small></h2>
                        </div>
                        
                        <div class="card-body card-padding">
                            <div class="form-wizard-basic fw-container">
                                <ul class="tab-nav text-center">
                                    <li><a href="#tab1" data-toggle="tab">Create Team</a></li>
                                    <li><a href="#tab2" data-toggle="tab">Add Members</a></li>
                                    
                                </ul>
                                
                                <div class="tab-content ">
                                    

                                    <div class="tab-pane active in fade" id="tab1">                                        
                                         <div class="container">
                                             <div class="row">
                                                  <div class="col-sm-4">
                                                  <p class="f-500 c-black m-b-20">Team Logo</p>
                            
                                                            <div class="fileinput fileinput-new" data-provides="fileinput" style="margin-left: 12em">
                                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                                                                <div>
                                                                    <span class="btn btn-info btn-file">
                                                                        <span class="fileinput-new">Select image</span>
                                                                        <span class="fileinput-exists">Change</span>
                                                                        <input type="file" name="...">
                                                                    </span>
                                                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                                </div>
                                                            </div>
                                                            
                                                            <br/>
                                                            <br/>
                                                            
                                                  </div>
                                                  <div class="col-sm-8">
                                                      <div class="container" style="margin-top: 5em">
                                                            <div class="row">
                                                              <div class="col-xs-6">
                                                                <div class="input-group fg-float">
                                                                      <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                                      <div class="fg-line">
                                                                          <input type="text" class="form-control">
                                                                          <label class="fg-label">Team Name</label>
                                                                      </div>
                                                                 </div>
                                                              </div>
                                                            </div>
                                                            <br/><br/>
                                                            <div class="row">
                                                              <div class="col-xs-6">
                                                                <div class="input-group fg-float">
                                                                      <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                                      <div class="fg-line">
                                                                          <input type="text" class="form-control">
                                                                          <label class="fg-label">Sport</label>
                                                                      </div>
                                                                 </div>
                                                              </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="row">
                                                <br/><br/>
                                                    <div class="col-sm-10 m-b-25">
                                                      <p class="f-500 m-b-15 c-black">Serach Option</p>
                                                      
                                                      <select class="selectpicker" data-live-search="true">
                                                          <option>Mustard</option>
                                                          <option>Ketchup</option>
                                                          <option>Relish</option>
                                                          <option>Tent</option>
                                                          <option>Flashlight</option>
                                                          <option>Toilet Paper</option>
                                                      </select>
                                                  </div>


                                             </div>
                                             <div class="row">
                                             <br/><br/>
                                                  <div class="input-group fg-float col-xs-10">
                                                                      <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                                      <div class="fg-line">
                                                                          <input type="text" class="form-control">
                                                                          <label class="fg-label">ZipCode</label>
                                                                      </div>
                                                  </div>

                                             </div>
                                          </div>
                                          <div class="btn-colors btn-demo">
                                          <a href="#tab2" data-toggle="tab"> <button class="btn bgm-cyan">Next</button></a>
                                          </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab2">
                                        <div class="container">
                                             <div class="row">
                                                  <div class="col-md-4">
                                                        <div class="input-group fg-float">
                                                              <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                                <div class="fg-line">
                                                                          <input type="text" class="form-control">
                                                                          <label class="fg-label">Sport</label>
                                                                </div>
                                                        </div>
                                                  </div>
                                                  <div class="col-md-4">
                                                        <div class="input-group fg-float">
                                                              <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                                <div class="fg-line">
                                                                          <input type="text" class="form-control">
                                                                          <label class="fg-label">Sport</label>
                                                                </div>
                                                        </div>
                                                  </div>
                                                  <div class="col-md-4">
                                                        <div class="input-group fg-float">
                                                              <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                                                                <div class="fg-line">
                                                                          <input type="text" class="form-control">
                                                                          <label class="fg-label">Sport</label>
                                                                </div>
                                                        </div>
                                                  </div>
                                             </div>
                                        </div>
                                    </div>
                                    
                                    
                                        
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    


 </div> -->

@endsection
