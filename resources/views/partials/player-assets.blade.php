  <table class="table table-striped mem-tab" id="player-tab" cellspacing="0" width="100%">

  <!-- start Head of outbox table-->
    <thead>
      <tr>
        <th>Player</th>
        @foreach( $games as $game )
          <th>vs. {{$game['name']}}</th>
        @endforeach
      </tr>
    </thead>
  <!-- end Head of outbox table-->


  <!-- start Body of inbox table-->
    <tbody>
      @foreach( $players as $player )
        <tr>
          <td>
            <div class="col-sm-1">
              <img src ="{{url($player->avatar)}}" style="width:35px; height:35px; border-radius: 50%; margin-right:5px"/>
            </div>
            <div class="col-sm-11">
              <B>{{$player->firstname}} {{$player->lastname}}</B><br>{{$player->role}}
            </div>
          </td>
          @foreach( $games as $game )
            <td>
              <input type="checkbox" user-id='{{$player->id}}' game-id='{{$game["id"]}}' @if(array_key_exists($player->id, $pgame) && array_key_exists($game['id'], $pgame[$player->id])) checked @endif>
              <i class="input-helper"></i>
            </td>
          @endforeach
        </tr>
      @endforeach
    </tbody>
  <!-- end Body of inbox table-->

  </table>
