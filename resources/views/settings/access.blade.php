@extends('layouts.new', ['team' => $id, 'active' => 'settings', 'logo' => $team->team_logo, 'name' => $team->teamname])

@section('header')
	<link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="col-md-6 col-md-offset-3">
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
    	  <div class="tab-content">

    	    <!-- start public public view access -->
    		  <div role="tabpanel" class="tab-pane active" id="public">
    		    <div class="card table-responsive" id='public-div'>
    		  	  @include('partials.access-permission-table', ['formURL' => '/public/access/update', 'buttonKey' => 'public', 'access' => $public])
    		    </div>
    		  </div>
    	    <!-- stop public public view access -->

    	    <!-- start manager view access -->
    		  <div role="tabpanel" class="tab-pane" id="manager">
    		    <div class="card table-responsive" id='manager-div'>
    		  	  @include('partials.access-permission-table', ['formURL' => '/manager/access/update', 'buttonKey' => 'manager', 'access' => $manager])
    		    </div>
    		  </div>
    	    <!-- stop manager view access -->

    	  </div>
        <!-- end tab contents for different access categories -->

      </div>

    </div>
  </div>
</div>

@endsection

@section('footer')
  <script src="{{URL::to('/')}}/js/DataTable/dataTables.bootstrap.min.js"></script>
  <script src="{{URL::to('/')}}/js/DataTable/responsive.bootstrap.min.js"></script>
  <script type="text/javascript">
  	views = ['member', 'schedule', 'availability', 'record', 'media', 'message', 'asset', 'setting'];

  	$('.tab-content').on('click', '#edit', function(){
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

  	$('.tab-content').on('click', '#cancel', function(){
  		key  = $(this).attr('key');
  		if( key == 'public' )
  		{
  			div  = $('#public-div');
  			data = ['{{$public->member}}', '{{$public->schedule}}', '{{$public->availability}}', '{{$public->record}}', '{{$public->media}}', '{{$public->message}}', '{{$public->asset}}', '{{$public->setting}}'];
  		}
  		else
  		{
  			div  = $('#manager-div')
  			data = ['{{$manager->member}}', '{{$manager->schedule}}', '{{$manager->availability}}', '{{$manager->record}}', '{{$manager->media}}', '{{$manager->message}}', '{{$manager->asset}}', '{{$manager->setting}}'];
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
