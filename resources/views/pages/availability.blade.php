@extends('layouts.new', ['team' => $id, 'active' => 'availability'])

@section('header')
  <link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">

  <style type="text/css">
    .tab-nav
    {
      box-shadow: inset 0 0px 0 0 #eeeeee;
    }
    div.dataTables_wrapper div.dataTables_length label
    {
    padding: 10px !important;
   }
   .card .card-header:not(.ch-alt) {
    padding: 0px ;
   }
  </style>
@endsection

@section('content')

<div role="tabpanel">

  <!-- start tabs name for player & staff availability -->
  <ul class="tab-nav tab-nav" role="tablist" id="myTab">
    <li class="active"><a href="#players" aria-controls="home1" role="tab" data-toggle="tab">Players</a></li>
    <li role="presentation"><a href="#staff" aria-controls="staff" role="tab" data-toggle="tab">Staff</a>
    </li>
  </ul>
  <!-- end tabs name for player & staff availability -->

  <!-- start tab contents for player & staff availability -->
  <div class="tab-content">

    <!-- start player availability -->
    <div role="tabpanel" class="tab-pane active" id="players">
      <div class="card table-responsive p-10 p-t-0" id="player-div">
        <div class="card-header">
        </div>
        <div class="card-body">
          @include('partials.player-assets')
        </div>
      </div>
    </div>
    <!-- stop player availability -->


    <!-- start player availability -->
    <div role="tabpanel" class="tab-pane" id="staff">
      <div class="card table-responsive p-10" id="staff-div">
        <div class="card-header">
        </div>
        <div class="card-body">
          @include('partials.staff-assets')
        </div>
      </div>
    </div>
    <!-- stop player availability -->

  </div>
  <!-- start tab contents for player & staff availability -->

</div>

@endsection

@section('footer')

  <script src="{{URL::to('/')}}/js/DataTable/dataTables.bootstrap.min.js"></script>
    <script src="{{URL::to('/')}}/js/DataTable/responsive.bootstrap.min.js"></script>
    <script src="{{URL::to('/')}}/js/notify.js"></script>

    <script type="text/javascript">
      // do stuff on page loading
      $(document).ready(function(){
        $('table').DataTable({'bInfo': false, 'aaSorting': []});
      });
      // do stuff on page loading

      $('#player-div, #staff-div').on('click', 'input[type="checkbox"]', function(){
        tuser = $(this).attr('user-id');
        game  = $(this).attr('game-id');

        ch    = ( $(this).prop('checked') ) ? 1 : 0;
        url   = '{{url("availability/update")}}';

        $.post(url, {tuid: tuser, gid: game, ch: ch}, function(){
          notify('top', 'right', 'inverse', 'The availability of the member has been updated.');
        });
      });
    </script>

@endsection
