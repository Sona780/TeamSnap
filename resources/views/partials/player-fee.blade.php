@if( $players->count() > 0 )
  <table class="table table-bordered mem-tab" id='p-table' cellspacing="0" width="100%">

    <!-- start Head of player fee table-->
      <thead>
        <tr>
          <th>Players</th>
          @foreach( $fees as $fee )
            <th style="text-align: center">
              <a key='{{$fee->id}}' id='fee-manage' data-toggle="modal" href="#fee-manage-modal">{{$fee->description}}</a>
              <br>
              {{$fee->amount}} $ per person
            </th>
          @endforeach
          <th style="text-align: center">Total Balance</th>
        </tr>
      </thead>
    <!-- end Head of player fee table-->

    <!-- start Body of player fee table-->
      <tbody>
        @foreach($players as $player)
          <tr>
            <td class='center-xs'>
              <div style="display: inline-block">
                <img src ="{{url($player->avatar)}}" style="width:35px; height:35px; border-radius: 50%; margin-right:5px"/>
              </div>
              <div style="display: inline-block">
                <B>{{$player->firstname}} {{$player->lastname}}</B><br>{{$player->role}}
              </div>
            </td>
            @foreach($player['fees'] as $fee)
              <td style="text-align: center">
                <span id='amt{{$fee->team_fees_id}}{{$fee->team_users_id}}' style="cursor: pointer; color: @if($fee->status == 0) green @elseif($fee->status == 1) red @else grey @endif" title='{{$fee->transaction_note}}'>
                  @if( $fee->status == 0 )
                    paid
                  @elseif( $fee->status == 1 )
                    ${{$fee->pamount}}
                  @else
                    n/a
                  @endif
                </span> &nbsp;
                <img src ="{{url('img/editPen.png')}}" uname='{{$player->firstname}} {{$player->lastname}}' fee-id='{{$fee->team_fees_id}}' id="edit" data-toggle="modal" href="#user-fee-details" uid='{{$fee->team_users_id}}' type='p'/>
              </td>
            @endforeach
            <td style="color: red; text-align: center" id='player{{$player->id}}'>${{$player->total}}</td>
          </tr>
        @endforeach

        @if( $staffs->count() == 0 )
          <tr>
            <td style="text-align: center"><B>Total team balance</B></td>
            @foreach($fees as $fee)
              <td style="color: red; text-align: center" id='pfee{{$fee->id}}'>${{$fee->total}}</td>
            @endforeach
            <td style="color: red; text-align: center" id='pteam-total'>${{$total}}</td>
          </tr>
        @endif
      </tbody>
    <!-- end Body of player fee table-->
  </table>
@endif

<br><br>

@if( $staffs->count() > 0 )
  <table class="table table-bordered mem-tab" id='np-table' cellspacing="0" width="100%">

    <!-- start Head of outbox table-->
      <thead>
        <tr>
          <th>Non-Players</th>
          @foreach( $fees as $fee )
            <th style="text-align: center">
              <a key='{{$fee->id}}' id='fee-manage' data-toggle="modal" href="#fee-manage-modal">{{$fee->description}}</a>
              <br>
              {{$fee->amount}} $ per person
            </th>
          @endforeach
          <th style="text-align: center">Total Balance</th>
        </tr>
      </thead>
    <!-- end Head of outbox table-->


    <!-- start Body of inbox table-->
      <tbody>
        @foreach($staffs as $staff)
          <tr>
            <td class='center-xs'>
              <div style="display: inline-block">
                <img src ="{{url($staff->avatar)}}" style="width:35px; height:35px; border-radius: 50%; margin-right:5px"/>
              </div>
              <div style="display: inline-block">
                <B>{{$staff->firstname}} {{$staff->lastname}}</B><br>{{$staff->role}}
              </div>
            </td>
            @foreach($staff['fees'] as $fee)
              <td style="text-align: center">
                <span id='amt{{$fee->team_fees_id}}{{$fee->team_users_id}}' style="color: @if($fee->status == 0) green @elseif($fee->status == 1) red @else grey @endif">
                  @if( $fee->status == 0 )
                    paid
                  @elseif( $fee->status == 1 )
                    ${{$fee->pamount}}
                  @else
                    n/a
                  @endif
                </span> &nbsp;
                <img src ="{{url('img/editPen.png')}}" uname='{{$staff->firstname}} {{$staff->lastname}}' fee-id='{{$fee->team_fees_id}}' id="edit" data-toggle="modal" href="#user-fee-details" uid='{{$fee->team_users_id}}' type='np'/>
              </td>
            @endforeach
            <td style="color: red; text-align: center" id='nplayer{{$staff->id}}'>${{$staff->total}}</td>
          </tr>
        @endforeach

        <tr>
          <td  style="text-align: center"><B>Total team balance</B></td>
          @foreach($fees as $fee)
            <td style="color: red; text-align: center" id='npfee{{$fee->id}}'>${{$fee->total}}</td>
          @endforeach
          <td style="color: red; text-align: center" id='npteam-total'>${{$total}}</td>
        </tr>
      </tbody>
    <!-- end Body of inbox table-->
  </table>
@endif
