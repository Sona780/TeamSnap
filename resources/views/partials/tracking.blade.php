<table class="table table-bordered mem-tab" id='p-table' cellspacing="0" width="100%" style="text-align: center">

  <!-- start Head of player tracking table-->
    <thead>
      <tr>
        <th>Players</th>
        @foreach( $items as $item )
          <th style="text-align: center">
            <a key='{{$item->id}}' id='item-manage' data-toggle="modal" href="#item-manage-modal">{{$item->item_name}}</a>
          </th>
        @endforeach
      </tr>
    </thead>
  <!-- end Head of player tracking table-->

  <!-- start Body of player tracking table-->
    <tbody>
      @foreach( $players as $player )
        <tr>
          <td style="text-align: left">
            <div style="display: inline-block">
              <img src ="{{url($player->avatar)}}" style="width:35px; height:35px; border-radius: 50%; margin-right:5px"/>
            </div>
            <div style="display: inline-block;">
              <B>{{$player->firstname}} {{$player->lastname}}</B>
            </div>
          </td>

          @foreach( $items as $item )
            <td>
              <input type="checkbox" user-id='{{$player->id}}' item-id='{{$item->id}}' @if(array_key_exists($player->id, $pitems) && array_key_exists($item->id, $pitems[$player->id])) checked @endif>
              <i class="input-helper"></i>
            </td>
          @endforeach
        </tr>
      @endforeach

      @if( $staffs->count() == 0 )
        <tr>
          <td><B>Item Status</B></td>
          @foreach( $items as $item )
            <td>
              <B>
                <span id='total{{$item->id}}'>{{$item->count}}</span> <img src ="{{url('img/tick.png')}}"><br>
                {{$players->count()}} Total
              </B>
            </td>
          @endforeach
        </tr>
      @endif
    </tbody>
  <!-- end Body of player tracking table-->
</table>

<br><br>

@if( $staffs->count() > 0 )
<table class="table table-bordered mem-tab" id='np-table' cellspacing="0" width="100%" style="text-align: center">

  <!-- start Head of non player tracking table-->
    <thead>
      <tr>
        <th>Non-Players</th>
        @foreach( $items as $item )
          <th style="text-align: center">
            <a key='{{$item->id}}' id='item-manage' data-toggle="modal" href="#item-manage-modal">{{$item->item_name}}</a>
          </th>
        @endforeach
      </tr>
    </thead>
  <!-- end Head of non player tracking table-->


  <!-- start Body of non player tracking table-->
    <tbody>
      @foreach( $staffs as $staff )
        <tr>
          <td style="text-align: left">
            <div style="display: inline-block">
              <img src ="{{url($staff->avatar)}}" style="width:35px; height:35px; border-radius: 50%; margin-right:5px"/>
            </div>
            <div style="display: inline-block;">
              <B>{{$staff->firstname}} {{$staff->lastname}}</B>
            </div>
          </td>

          @foreach( $items as $item )
            <td>
              <input type="checkbox" user-id='{{$staff->id}}' item-id='{{$item->id}}' @if(array_key_exists($staff->id, $pitems) && array_key_exists($item->id, $pitems[$staff->id])) checked @endif>
              <i class="input-helper"></i>
            </td>
          @endforeach
        </tr>
      @endforeach
      <tr>
        <td><B>Item Status</B></td>
        @foreach( $items as $item )
          <td>
            <B>
              <span id='total{{$item->id}}'>{{$item->count}}</span> <img src ="{{url('img/tick.png')}}"><br>
              {{$players->count() + $staffs->count()}} Total
            </B>
          </td>
        @endforeach
      </tr>
    </tbody>
  <!-- end Body of non player tracking table-->

</table>
@endif
