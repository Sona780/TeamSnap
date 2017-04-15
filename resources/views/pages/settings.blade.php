@extends('layouts.new', ['team' => $id, 'active' => 'settings', 'logo' => $team->team_logo, 'name' => $team->teamname])

@section('header')
  <link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">
  <style type="text/css">
  	.a-active {
  	  background-color: cyan;
  	  font-size: 15;
  	}
  </style>
@endsection

@section('content')

@if(Session::has('success'))
<div class="alert alert-success alert-dismissable" id='alert'>
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>{{ Session::get('success') }}</strong>
</div>
@endif

<div role="tabpanel">

  <!-- start tabs for different setting categories -->
	  <ul class="tab-nav" role="tablist" id="myTab">
	    <li class="active"><a href="#account" role="tab" data-toggle="tab">Account</a></li>
	    <li role="presentation"><a href="#team" role="tab" data-toggle="tab">Team</a></li>
	  </ul>
  <!-- end tabs for different setting categories -->

  <!-- start tab contents for different setting categories -->
	  <div class="tab-content">

	    <!-- start tab for account setting -->
		    <div role="tabpanel" class="tab-pane active" id="account">
		      <div class="col-sm-3">
				<a class="col-sm-12 a-active" href='#'>Change Password</a>
			  </div>

			  <!-- start password change -->
			  <div class="col-sm-4 col-sm-offset-1">
				<div class="card">
					<div class="card-header ch-alt">
						<h2>Change Password</h2>
					</div>
					<div class="card-body card-padding">
						{{ Form::open(['method' => 'post', 'url' => $id.'/change/password', 'id' => 'password-form']) }}
			                <div class="form-group fg-line">
			                	<label for="current">Current password</label>
			                    <input type="password" class="form-control input-sm" name="current" autofocus>
			               	</div>
			               	@if ($errors->has('current'))
			                    <span class="help-block">
			                    	<strong style="color: red">{{ $errors->first('current') }}</strong>
			                	</span>
			                @endif
			                @if(Session::has('pass'))
			                    <span class="help-block">
			                    	<strong style="color: red">{{ Session::get('pass') }}</strong>
			                	</span>
			                @endif
			                <br>
			               	<div class="form-group fg-line">
			                	<label for="new">New password</label>
			                    <input type="password" class="form-control input-sm" name="password">
			               	</div>
			               	@if ($errors->has('password'))
			                    <span class="help-block">
			                    	<strong style="color: red">{{ $errors->first('password') }}</strong>
			                	</span>
			                @endif
			               	<br>
			               	<div class="form-group fg-line">
			                	<label for="confirm">Confirm new password</label>
			                    <input type="password" class="form-control input-sm" name="password_confirmation">
			               	</div>
			               	<br>
			               	<button class="col-xs-12 col-sm-12 btn btn-success">Update</button>
			               	<br>
			            {{Form::close()}}
					</div>
				</div>
			  </div>
			  <!-- end password change -->

		    </div>
	    <!-- stop tab for account setting -->

	    <!-- start tab for team settings -->
		    <div role="tabpanel" class="tab-pane" id="team">

		      <div class="col-sm-3">
		      	<a class="col-sm-12 a-active" href='#' id='a-access'>Access Setting</a><br>
		      	<a class="col-sm-12" href='#' id='a-manager'>Manager Setting</a>
		      </div>

		      <!-- start manage access permissions -->
		      <div class="col-md-6" id='access-detail'>
				<div class="card">
				  <div class="card-body">

				    <div role="tabpanel">

				      <!-- start tabs for different access categories -->
				    	<ul class="tab-nav tn-justified tn-icon" role="tablist" id="myTab">
				    	  <li class="active"><a class="col-xs-4" href="#public" role="tab" data-toggle="tab">Public Access</a></li>
				      	  <li><a class="col-xs-4" href="#manager" role="tab" data-toggle="tab">Manager Access</a></li>
				      	</ul>
				      <!-- end tabs for different access categories -->

				      <!-- start tab contents for different access categories -->
				    	<div class="tab-content" id="access-tabs">

				    	  <!-- start public public view access -->
				    		<div role="tabpanel" class="tab-pane active" id="public">
				    		  <div class="card table-responsive" id='public-div'>
				    		    @include('partials.access-permission-table', ['formURL' => '/public/access/update', 'buttonKey' => 'public', 'access' => $public, 'ch' => 'team'])
				    		  </div>
				    		</div>
				    	  <!-- stop public public view access -->

				    	  <!-- start manager view access -->
				    		<div role="tabpanel" class="tab-pane" id="manager">
				    		  <div class="card table-responsive" id='manager-div'>
				    		  	@include('partials.access-permission-table', ['formURL' => '/manager/access/update', 'buttonKey' => 'manager', 'access' => $manage, 'ch' => 'team'])
				    		  </div>
				    		</div>
				    	  <!-- stop manager view access -->

				    	</div>
				      <!-- end tab contents for different access categories -->

				    </div>

				  </div>
				</div>
			  </div>
			  <!-- end manage access permissions -->

			  <!-- start manage managers -->
		    <div class="col-sm-6" id='managers-detail' style="display: none">
				<div class="card">
				  <div class="card-header">
				  	<span style="font-weight: bold; font-family: italic; font-size: 15px">Manager(s)</span>

	                <div class="pull-right">
	                  <button  class="btn btn-info" data-toggle="modal" data-target="#manager-modal">
	                    Add Manager
	                  </button>
	                </div>
				  </div>
				  <hr>

				  <div class="card-body table-responsive" id='manager-card'>
				  	@if( $managers->count() == 0 )
				  		<div style="text-align: center">No team manager(s) available.</div>
				  	@else
				  	  <table class="table table-hover dt-responsive mem-tab nowrap">
				  	  	<thead>
				  	  	  <th>Name</th>
				  	  	  <th>Email</th>
				  	  	  <th style="text-align: center">Actions</th>
				  	  	</thead>
				  	  	<tbody id='all-managers'>
				  	  	  @foreach($managers as $manager)
				  	  	  	<tr>
				  	  	      <td>{{$manager->firstname}} {{$manager->lastname}}</td>
				  	  	      <td>{{$manager->email}}</td>
				  	  	      <td style="text-align: center">
				  	  	      	<a id="delete" key="{{$manager->id}}"><img class="icon-style" src='{{url("/")}}/img/delete.png'></a>
				  	  	      </td>
				  	  	  	</tr>
				  	  	  @endforeach
				  	  	</tbody>
				  	  </table>
				  	@endif
				  </div>
				</div>
			  </div>
			  <!-- end manage managers -->

		    </div>
	    <!-- end tab for team settings -->

	  </div>
  <!-- end tab contents for different setting categories -->

</div>

<div id="manager-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" style="text-align: center">Create new manager</h5>
        <h6 class="modal-title" id='manager-error' style="text-align: center; color: red"></h6>
      </div>

      	<div class="modal-body">
          <input type="hidden" id="teamleague" value="team">
      	  <div class="form-group fg-line">
            <label for="firstname">First Name <small style="color: red">(required)</small></label>
      	    <input type="text" id="firstname" class="form-control input-sm" name="firstname" autofocus>
          </div>

          <div class="form-group fg-line">
            <label for="lastname">Last Name</label>
      	    <input type="text" id="lastname" class="form-control input-sm" name="lastname">
          </div>

          <div class="form-group fg-line">
            <label for="firstname">Email <small style="color: red">(required)</small></label>
      	    <input type="text" id="email" class="form-control input-sm" name="email">
          </div>
     	</div>
     	<div class="modal-footer">
     	  <button type="button" class="btn btn-info" id='manager-button'>Submit</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     	</div>

  	</div>
  </div>
</div>

@endsection

@section('footer')
  <script src="{{URL::to('/')}}/js/DataTable/dataTables.bootstrap.min.js"></script>
  <script src="{{URL::to('/')}}/js/DataTable/responsive.bootstrap.min.js"></script>
  <script src="{{URL::to('/')}}/js/notify.js"></script>
  <script type="text/javascript">
  	cnt = {{$managers->count()}};
  	// start script to load on page load
  	$(document).ready(function(){
	  $("#alert").fadeTo(2000, 500).slideUp(500, function(){
	    $("#success-alert").slideUp(500);
	  });
	});
	// end script to load on page load

	// start validate and save new manager
  	$('#manager-button').click(function(){
      name  = $('#firstname').val();
      email = $('#email').val();
      var re = /\S+@\S+\.\S+/;
      if( name == '' || email == '' )
        $('#manager-error').html('<br>Required fields shouldn\'t be empty.');
      else if(!re.test(email))
        $('#manager-error').html('<br>Invalid email address.');
      else
      {
        lname = $('#lastname').val();
        teamleague  = $('#manager-modal').find('#teamleague').val();
        url   = '{{url($id."/new/manager")}}';
        $.post(url, {fname: name, lname: lname, email: email, teamleague: teamleague}, function(uid){
          $('#manager-modal').find('input[type="text"]').val('');
          $('#manager-modal').modal('hide');
          if( uid > 0 )
          {
            if( cnt == 0 )
            {
              content = '<table class="table table-hover dt-responsive mem-tab nowrap"><thead><th>Name</th><th>Email</th><th style="text-align: center">Actions</th></thead><tbody id="all-managers"><tr><td>'+ name +' '+ lname +'</td><td>'+ email +'</td><td style="text-align: center"><a id="delete" key="'+ uid +'"><img class="icon-style" src="{{url("/")}}/img/delete.png"></a></td></tr></tbody></table>';
              $('#manager-card').html(content);
              cnt++;
            }
            else
            {
              $('#all-managers').append('<tr><td>'+ name +' '+ lname +'</td><td>'+ email +'</td><td style="text-align: center"><a id="delete" key="'+ uid +'"><img class="icon-style" src="{{url("/")}}/img/delete.png"></a></td></tr>');
            }
          }
        });
      }
    });
  	// end validate and save new manager

  	// start confirm & delete manager
  	$('#manager-card').on('click', '#delete', function(){
  		id = $(this).attr('key');
  		swal({
              title: "Are you sure?",
              text: "Selected team member will be deleted permanently!!!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: true
              }, function(){
                  window.location.href = '{{url($id."/manager/delete")}}/team/'+id;
          });
  	});
  	// end confirm & delete manager

  	$('#a-access').click(function(){
  		toggleClasses($(this), $('#a-manager'), $('#access-detail'), $('#managers-detail'));
  	});

  	$('#a-manager').click(function(){
  		toggleClasses($(this), $('#a-access'), $('#managers-detail'), $('#access-detail'));
  	});

  	function toggleClasses(active, deactive, showdiv, hidediv)
  	{
  		deactive.removeClass('a-active');
  		active.addClass('a-active');
  		showdiv.show();
  		hidediv.hide();
  	}
  </script>

  <script type="text/javascript">
  	views = ['member', 'schedule', 'availability', 'record', 'media', 'message', 'asset', 'setting'];

  	$('#access-tabs').on('click', '#edit', function(){
  		key = $(this).attr('key');
  		div = (key == 'public') ? $('#public-div') : $('#manager-div');
  		div.find('#submit').show();
  		div.find('#cancel').show();
  		$(this).hide();

  		div.find('#dropdown-li').removeClass('open');
  		div.find('#menu-dots').attr('aria-expanded', false);

  		for( i = 0; i < views.length; i++ )
  		{
  		  data = div.find('#'+views[i]);
  	      ch = (data.find('span').html() == 'Granted') ? 1 : 0;
  		  //content = '<select name="'+ views[i] +'" class="" title="Assign permission..">';

		  content = '<div class=" radio radio-inline">';
          if( ch == 1 )
          	content += '<label class="m-r-20 p-r-5"><input type="radio" value="1" name="'+views[i]+'" class="optradio" checked><i class="input-helper"></i>Yes</label><label><input type="radio"  value="0" name="'+views[i]+'" class="optradio"><i class="input-helper"></i>No</label></div>';
          else
          	content += '<label class="m-r-20 p-r-5"><input type="radio" value="1" name="'+views[i]+'" class="optradio"><i class="input-helper"></i>Yes</label><label><input type="radio"  value="0" name="'+views[i]+'" class="optradio" checked><i class="input-helper"></i>No</label></div>';

          data.html(content);
  		}
  	});

  	$('#access-tabs').on('click', '#cancel', function(){
  		key  = $(this).attr('key');
  		if( key == 'public' )
  		{
  			div  = $('#public-div');
  			data = ['{{$public->member}}', '{{$public->schedule}}', '{{$public->availability}}', '{{$public->record}}', '{{$public->media}}', '{{$public->message}}', '{{$public->asset}}', '{{$public->setting}}'];
  		}
  		else
  		{
  			div  = $('#manager-div')
  			data = ['{{$manage->member}}', '{{$manage->schedule}}', '{{$manage->availability}}', '{{$manage->record}}', '{{$manage->media}}', '{{$manage->message}}', '{{$manage->asset}}', '{{$manage->setting}}'];
  		}

  		div.find('#dropdown-li').removeClass('open');
  		div.find('#menu-dots').attr('aria-expanded', false);
      	div.find('#submit').hide();
  		div.find('#edit').show();
  		$(this).hide();

  		for( i = 0; i < views.length; i++ )
  		{
  			color  = 'green';
  			access = 'Granted';

  			if( data[i] == 0 )
  			{
  				color  = 'red';
  				access = 'Not Granted';
  			}

  			div.find('#'+views[i]).html('<span style="color: '+ color +'">'+ access +'</span>');
  		}
  	});
  </script>
@endsection
