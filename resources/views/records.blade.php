@extends('layouts.new')
@section('header')

@endsection
@section('content')
<div role="tabpanel">
	         <ul class="tab-nav tab-nav-right" role="tablist">
	           <li class="active"><a href="#home1" aria-controls="home1" role="tab" data-toggle="tab">Home</a></li>
	           <li role="presentation"><a href="#profile1" aria-controls="profile1" role="tab" data-toggle="tab">Profile</a></li>
	           <li role="presentation"><a href="#messages1" aria-controls="messages1" role="tab" data-toggle="tab">Messages</a></li>
	           <li role="presentation"><a href="#settings1" aria-controls="settings1" role="tab" data-toggle="tab">Settings</a></li>
	         </ul>
	        <div class="tab-content">
	            <div role="tabpanel" class="tab-pane active" id="home1">
	                <div class="card p-15" >
	                   <strong>Manager</strong>
	                   <a href="/{{$team_name}}/records/list_stats"><button class="btn bgm-red waves-effect">Manage Stats </button></a>
	                   <button class="btn bgm-red waves-effect">Enter Stats </button>
	                </div>
	            </div>
	            <div role="tabpanel" class="tab-pane" id="profile1">
	                <div class="card p-15" >
	                   <strong>Manager</strong>
	                   <button class="btn bgm-red waves-effect">Add New Member </button>
	                   <button class="btn bgm-red waves-effect">Add New Member </button>
	                </div>
	            </div>
	            <div role="tabpanel" class="tab-pane" id="profile1">
		            <div class="card p-15" >
	                   <strong>Manager</strong>
	                   <button class="btn bgm-red waves-effect">Add New Member </button>
	                   <button class="btn bgm-red waves-effect">Add New Member </button>
	                </div>
	            </div>
		        <div role="tabpanel" class="tab-pane" id="messages1">
			            <p>Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nulla sit amet est. Praesent ac massa at ligula laoreet iaculis.
			            </p>
		        </div>
		        <div role="tabpanel" class="tab-pane" id="settings1">
			            <p>Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nulla sit amet est. Praesent ac massa at ligula laoreet iaculis.
			            </p>
		        </div>
	        </div>
</div>
 
@endsection