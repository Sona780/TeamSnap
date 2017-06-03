@extends('layouts.new', ['team' => $id, 'active' => 'settings', 'logo' => $team->team_logo, 'name' => $team->teamname, 'first' => $team->team_color_first])

@section('header')
  <link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">
  <style type="text/css">
  	.a-active {
  	  background-color: cyan;
  	  font-size: 15;
  	}
    .tab-nav
    {
          box-shadow: inset 0 0px 0 0 #eeeeee;
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
      <li @if(!Session::has('active') || (Session::has('active') && Session::get('active') == 11)) class="active" @endif>
        <a href="#access-settings" role="tab" data-toggle="tab">Access Setting</a>
      </li>
      <li @if(Session::has('active') && Session::get('active') == 2)) class="active" @endif role="presentation">
        <a href="#manager-settings" role="tab" data-toggle="tab">Manager Setting</a>
      </li>
    </ul>
  <!-- end tabs for different setting categories -->

  <!-- start tab contents for different setting categories -->
	  <div class="tab-content">
      <!-- start tab for access settings -->
		    <div role="tabpanel" class="tab-pane @if(!Session::has('active') || (Session::has('active') && Session::get('active') != 2)) active @endif" id="access-settings">
          <div role="tabpanel" class="col-sm-6 col-sm-offset-3 card">
            <!-- start tabs for different access categories -->
              <ul class="tab-nav tn-justified tn-icon" role="tablist" id="myTab">
                <li class=" @if(!Session::has('active') || (Session::has('active') && Session::get('active') != 12)) active @endif"><a class="col-xs-4" href="#public" role="tab" data-toggle="tab">Public Access</a></li>
                <li class="@if(Session::has('active') && Session::get('active') == 12) active @endif"><a class="col-xs-4" href="#manager" role="tab" data-toggle="tab">Manager Access</a></li>
              </ul>
            <!-- end tabs for different access categories -->

            <!-- start tab contents for different access categories -->
              <div class="tab-content" id="access-tabs">

              <!-- start public public view access -->
                <div role="tabpanel" class="tab-pane @if(!Session::has('active') || (Session::has('active') && Session::get('active') != 12)) active @endif" id="public">
                  <div class="card table-responsive" id='public-div'>
                    @include('partials.access-permission-table', ['formURL' => '/public/access/update', 'buttonKey' => 'public', 'access' => $public, 'ch' => 'team'])
                  </div>
                </div>
              <!-- stop public public view access -->

              <!-- start manager view access -->
                <div role="tabpanel" class="tab-pane @if(Session::has('active') && Session::get('active') == 12) active @endif" id="manager">
                  <div class="card table-responsive" id='manager-div'>
                    @include('partials.access-permission-table', ['formURL' => '/manager/access/update', 'buttonKey' => 'manager', 'access' => $manage, 'ch' => 'team'])
                  </div>
                </div>
              <!-- stop manager view access -->

            </div>
            <!-- end tab contents for different access categories -->
          </div>
        </div>
      <!-- end tab for access settings -->

      <!-- start tab for manager settings -->
        <div role="tabpanel" class="tab-pane @if(Session::has('active') && Session::get('active') == 2)) active @endif" id="manager-settings">
          <div class="col-sm-6 col-sm-offset-3 card">
            <div class="card-header">
              <span style="font-weight: bold; font-family: italic; font-size: 15px">Manager(s)</span>
              <div class="pull-right">
                <button  class="btn btn-info" data-toggle="modal" data-target="#manager-modal">Add Manager</button>
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
      <!-- end tab for manager settings -->
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
  <script src="{{URL::to('/')}}/js/settings.js"></script>
  <script type="text/javascript">
  	cnt = {{$managers->count()}};

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
          if( uid > 0 )
          {
            $('#manager-modal').find('input[type="text"]').val('');
            $('#manager-modal').modal('hide');
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
          else
            $('#manager-error').html('<br>'+name+' can\'t become manager of this team.');
        });
      }
    });
  	// end validate and save new manager

  	// start confirm & delete manager
    	$('#manager-card').on('click', '#delete', function(){
    		id = $(this).attr('key');
        showDeleteDialog('{{url("team/m/d")}}/'+id);
    	});
  	// end confirm & delete manager

  	// start hide access edit view
      $('#access-tabs').on('click', '#cancel', function(){
        key = $(this).attr('key');

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

        cancelEdit(div, data, $(this));
      });
    // end hide access edit view
  </script>


@endsection
