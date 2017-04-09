@extends('layouts.new', ['team' => $id, 'active' => 'records', 'logo' => $team->team_logo, 'name' => $team->teamname])

@section('header')
  <link href="{{URL::to('/')}}/css/dt-fixed.css" rel="stylesheet">
  <link href="{{URL::to('/')}}/css/fixedColumn.css" rel="stylesheet">

@endsection

@section('content')


  <div class="card">
    @if( $user->manager_access == 1 )
      <!-- start button to upload new player record -->
        <div class="card-header">
          <span style="font-weight: bold; font-family: italic; font-size: 15px">Statistics</span>


          <div class="pull-right">
            <div class="btn-group m-r-20">
              <button  class="btn btn-info" data-toggle="modal" data-target="#player-record-modal">
                New Stat
              </button>
            </div>
          </div>
        </div>
        <div role="tabpanel">
          <ul class="tab-nav main_tab" role="tablist">
            <li class="active"><a href="#player-stats" role="tab" data-toggle="tab">Player stats</a></li>
            <li><a href="#match-stats" role="tab" data-toggle="tab">Match stats</a></li>
            <li><a href="#match-player-stats" role="tab" data-toggle="tab">Match Player stats</a></li>
          </ul>
        </div>
      <!-- end button to upload new player record -->

      <!-- start show player total statistics-->
        <div class="card-body">

          <div class="card">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="player-stats">
                <table class="mem-tab table table-bordered" id='stat-table' cellspacing="0" width="100%">
                  @include ('record_partials.baseball-table', ['results' => $players, 'type' => 'Games', 'stat_type' => 'Player'])
                </table>
              </div>

              <div role="tabpanel" class="tab-pane" id="match-stats">
                <table class="mem-tab table table-bordered" id='match-stat-table' cellspacing="0" width="100%">
                  @include ('record_partials.baseball-table', ['results' => $games, 'type' => 'Result', 'stat_type' => 'Team'])
                </table>
              </div>

              <div role="tabpanel" class="tab-pane" id="match-player-stats">

                <!-- start create tab for each opponent -->
                  <ul class="tab-nav ctg" role="tablist">
                    <?php $i = 0; ?>
                    @foreach($gpstats as $game)
                      <li class="@if($i==0) active @endif"><a href="#match{{$game['game']['id']}}" role="tab" data-toggle="tab" >{{$game['game']['name']}}</a></li>
                      <?php $i =1 ?>
                    @endforeach
                  </ul>
                <!-- end create tab for each opponent -->


                <div class="tab-content p-10">

                  <?php $i = 0; ?>
                  <!-- table for members of each category -->
                  @foreach($gpstats as $game)
                    <div role="tabpanel" class="tab-pane @if($i == 0) active @endif" id="match{{$game['game']['id']}}" >
                      <table class="mem-tab table table-bordered" id='match-stat-table' cellspacing="0" width="100%">
                        @include ('record_partials.baseball-table', ['results' => $game['stats'], 'type' => '', 'stat_type' => 'Player'])
                      </table>
                    </div>
                    <?php $i = 1 ?>
                  @endforeach
                  <!-- table for members of each category -->

                </div>
              </div>
            </div>
          </div>

        </div>
      <!--end show player total statistics-->
    @else
      <!-- start header for member view -->
        <div class="card-header">
          <span style="font-weight: bold; font-family: italic; font-size: 15px">Statistics</span>
        </div>
      <!-- end header for member view -->
      <!-- start body for member view -->
        <div class="card-body">
          <table class="mem-tab table table-bordered" id='match-stat-table' cellspacing="0" width="100%">
            @include ('record_partials.baseball-table', ['results' => $games, 'type' => 'Result', 'stat_type' => 'Team'])
          </table>
        </div>
      <!-- end body for member view -->
    @endif
  </div>

  @if( $user->manager_access == 1 )
    <!-- start modal to create new player stat -->
    	<div id="player-record-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- start Modal header -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center">Statistics<br>
                  <strong style="color: red;" id='record-error'></strong>
                </h4>
              </div>
            <!-- end Modal header -->

            {{ Form::open(['method' => 'post', 'url' => $id.'/player/record/save', 'files' => 'true', 'id' => 'player-record-form']) }}
              @include ('record_partials.baseball')
            {{Form::close()}}

          </div>
        </div>
      </div>
    <!-- end modal to create new player stat -->
  @endif

@endsection

@section('footer')

  <script src="{{URL::to('/')}}/js/charts.js"></script>
  <script src="{{URL::to('/')}}/js/dt-fixed.js"></script>

  <script src="{{url('js/fixedColumn.js')}}"></script>

	<script type="text/javascript">

    //start load data table on page load
      $(document).ready(function(){
        $('.card-body').find('table').DataTable({"scrollCollapse": true, "scrollX": true, 'aaSorting': [], fixedColumns: {
          leftColumns: 2
        }});
      });
    //end load data table on page load

    // start load all the games of selected player
  		$('#player').change(function() {
  			id = $(this).val();

        url = '{{url("player/games")}}/'+id;

        $.get(url, function(games){
          content = '';

          for( i = 0; i < games.length; i++ )
          {
            content += '<option value="'+ games[i]['id'] +'">'+ games[i]['name'] +' ('+ games[i]['date'] +')</option>';
          }

          $('#opponent').html(content).selectpicker('refresh');
        });
  		});
    // end load all the games of selected player

    // start validate new stat form
      $('#player-record-form').submit(function(e){
        e.preventDefault();

        user = $(this).find('#player').val();
        game = $(this).find('#opponent').val();

        if( user == '' || game == '' )
          $('#record-error').html('Select a player and game to save record.');
        else
          this.submit();
      });
    // end validate new stat form
	</script>
@endsection
