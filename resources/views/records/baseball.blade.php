@extends('layouts.new', ['team' => $id, 'active' => 'records', 'logo' => $team->team_logo, 'name' => $team->teamname])

@section('header')
  <link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')


  <div class="card">
    <!-- start button to upload new player record -->
      <div class="card-header">
        <span style="font-weight: bold; font-family: italic; font-size: 15px">Statistics</span>

        <div class="pull-right">
          <button  class="btn btn-info" data-toggle="modal" data-target="#player-record-modal">
            New Stat
          </button>
        </div>
      </div>
    <!-- end button to upload new player record -->
    <hr>
    <!-- start show statistics-->
      <div class="card-body">

        <table class="dt-responsive mem-tab nowrap table table-bordered" id='stat-table' cellspacing="0" width="100%">

          <!-- start Head of player stats-->
            <thead>
              <tr>
                <th title='Rank'>RK</th>
                <th class="all">Players</th>
                <th class="all" style="text-align: center">Games</th>
                <th style="text-align: center" title="At Bats">AB</th>
                <th style="text-align: center" title="Runs">R</th>
                <th style="text-align: center" title="Hits">H</th>
                <th style="text-align: center" title="Singles">1B</th>
                <th style="text-align: center" title="Doubles">2B</th>
                <th style="text-align: center" title="Triples">3B</th>
                <th style="text-align: center" title="Home Runs">HR</th>
                <th style="text-align: center" title="Runs Batted In">RBI</th>
                <th style="text-align: center" title="Bases on Balls">BB</th>
                <th style="text-align: center" title="Strike Outs">SO</th>
                <th style="text-align: center" title="Stolen Bases">SB</th>
                <th style="text-align: center" title="Caught Stealing" class="none">CS</th>
                <th class="all" style="text-align: center; color: red" title="Average">AVG</th>
                <th style="text-align: center" title="On Base Percentage">OBP</th>
                <th style="text-align: center" title="Slugging Percentage">SLG</th>
                <th style="text-align: center" title="Hit by Pitch">HBP</th>
                <th style="text-align: center" title="Sacrifice Flies">SF</th>
              </tr>
            </thead>
          <!-- end Head of player stats-->

          <!-- start Body of player stats-->
            <tbody>
              <?php $i = 1; ?>
              @foreach($players as $player)
                <tr style="text-align: center">
                  <td>{{$i}}</td>
                  <td style="text-align: left">{{$player->firstname}} {{$player->lastname}}</td>
                  <td>{{$player->stat['games']}}</td>
                  <td>{{$player->stat['at_bats']}}</td>
                  <td>{{$player->stat['runs']}}</td>
                  <td>{{$player->stat['hits']}}</td>
                  <td>{{$player->stat['singles']}}</td>
                  <td>{{$player->stat['doubles']}}</td>
                  <td>{{$player->stat['triples']}}</td>
                  <td>{{$player->stat['home_runs']}}</td>
                  <td>{{$player->stat['runs_batted_in']}}</td>
                  <td>{{$player->stat['bases_on_balls']}}</td>
                  <td>{{$player->stat['strike_outs']}}</td>
                  <td>{{$player->stat['stolen_bases']}}</td>
                  <td>{{$player->stat['caught_stealing']}}</td>
                  <td style="color: red">{{$player->stat['average']}}</td>
                  <td>{{$player->stat['obp']}}</td>
                  <td>{{$player->stat['slg']}}</td>
                  <td>{{$player->stat['hit_by_pitch']}}</td>
                  <td>{{$player->stat['sacrifice_flies']}}</td>
                </tr>
                <?php $i++ ?>
              @endforeach
            </tbody>
          <!-- end Body of player stats-->
        </table>

      </div>
    <!--end show statistics-->
  </div>

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
            @include ('record-forms.baseball')
          {{Form::close()}}

        </div>
      </div>
    </div>
  <!-- end modal to create new player stat -->

@endsection

@section('footer')

  <script src="{{URL::to('/')}}/js/charts.js"></script>
  <script src="{{URL::to('/')}}/js/DataTable/dataTables.bootstrap.min.js"></script>
  <script src="{{URL::to('/')}}/js/DataTable/responsive.bootstrap.min.js"></script>

	<script type="text/javascript">
    //start load data table on page load
      $(document).ready(function(){
        $('#stat-table').DataTable({"scrollCollapse": true, "scrollX": true, 'aaSorting': []});
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
