@extends('layouts.new')


@section('content')

<div class="container">
 <h2>Member Profile for Kaushal Pandey</h2>    
	<div class="card">
 	    <div class="row">
			<div class="col-sm-3">
				<div id="profile-main">
                        <div class="pm-overview c-overflow">
                            <div class="pmo-pic">
                                <div class="p-relative">
                                    <a href="#">
                                        <img class="img-responsive" src="img/profile-pics/profile-pic-2.jpg" alt=""> 
                                    </a>
                                    <a href="#" class="pmop-edit">
                                        <i class="zmdi zmdi-camera"></i> <span class="hidden-xs">Update Profile Picture</span>
                                    </a>
                                </div>
                                
                               
                            </div>
                            
                            
                            
                        </div>

			</div>
			</div>

			<div class="col-sm-9">
                  
                  <div class="card">
                        <div>
                            <p>Kaushal Pandey</p>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{!! $name !!}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>Alexandra</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td>Alexandra</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>Alexandra</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>Alexandra</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Jersy Number</td>
                                        <td>Alexandra</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td>Alexandra</td>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                      </div>  
                    </div>
                    

    			
			</div>


 	    </div>
	</div>     
</div>


@endsection
