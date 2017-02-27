@extends('layouts.new')
@section('header')

@endsection
@section('content')
<div role="tabpanel">
	         <ul class="tab-nav tab-nav-right" role="tablist">
	           <li class="active"><a href="#stats_list" aria-controls="stats_list" role="tab" data-toggle="tab">Stats List</a></li>
	           <li role="presentation"><a href="#start_group" aria-controls="start_group" role="tab" data-toggle="tab">Start Group</a></li>
	         </ul>
	        <div class="tab-content">

	            <div role="tabpanel" class="tab-pane active" id="stats_list">
	                <div class="card p-15" >
	                    <button class="btn bgm-red waves-effect" data-toggle="modal" data-target="#new_stats">New Stats </button>
	                    <button class="btn bgm-red waves-effect">Enter Stats</button>
	                </div>    
	                    <div class="card">
                        <div class="card-header">
                            <h2>Stats List </h2>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Statistic Name</th>
                                        <th>Acronym</th>
                                        <th>Formula</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($stats as $stat)
                                    <tr>
                                        <td>{{$stat->stats_name}}</td>
                                        <td>{{$stat->acronym_name}}</td>
                                        <td>{{$stat->formula}}</td>
                                        <td></td>
                                    </tr>
                                 @endforeach   
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

	                
	            </div>
	            <div role="tabpanel" class="tab-pane" id="start_group">
	                <div class="card p-15" >
	                    <button class="btn bgm-red waves-effect">New Stats </button>
	                    <button class="btn bgm-red waves-effect">Enter Stats</button>
	                </div>
	                <div class="card">
                        <div class="card-header">
                            <h2>Stats List </h2>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Group Name</th>
                                        <th>Statistics in this Group</th>
                                        <th>Manager</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($stats as $stat)
                                    <tr>
                                        <td>{{$stat->stats_group}}</td>
                                        <td>{{$stat->acronym_name}}</td>
                                        <td></td>
                                    </tr>
                                 @endforeach   
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
	            </div>

	        </div>

	       <!--modal body for New stats-->
	       <!-- Modal -->
			<div id="new_stats" class="modal fade" role="dialog">
			  <div class="modal-dialog">
                   <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">New Stats</h4>
				      </div>
				      <div class="modal-body">
				        <form action="{{url($team_name.'/records/list_stats/store')}}" method="POST" >
				         {!! csrf_field() !!}
					         <div class="form-group">
					                <label>Full Name of Statistics <small>(required)</small></label>                     
					                <div class="input-group">
					                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
					                        <div class="fg-line">
					                             <input type="text" class="form-control" placeholder="Statstics Name" name="stats_name">
					                        </div>
					                </div>
	                         </div>
	                         <br/>
	                         <div class="form-group">
					                <label>Acronym <small>(required)</small></label>                     
					                <div class="input-group">
					                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
					                        <div class="fg-line">
					                             <input type="text" class="form-control" placeholder="Acronym name" name="acronym_name">
					                        </div>
					                </div>
	                         </div>
	                         <br/>
	                         <div class="form-group">
					                <label>Formula <small>(optional)</small></label>                     
					                <div class="input-group">
					                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
					                        <div class="fg-line">
					                             <input type="text" class="form-control" placeholder="Formula" name="formula">
					                        </div>
					                </div>
	                         </div>
	                         <br/>
	                         <div class="form-group">
					                <label>Stat Group <small>(optional)</small></label>                     
					                <div class="input-group">
					                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
					                        <div class="fg-line">
					                             <input type="text" class="form-control" placeholder="Full Name" name="stats_group">
					                        </div>
					                </div>
	                         </div>
	                         <br/>
	                          <button type="submit" class="btn btn-info">Submit</button>
	                     </form>    

				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

			  </div>
			</div>
</div>
 
@endsection