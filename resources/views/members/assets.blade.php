@extends('layouts.new', ['team' => $id, 'active' => 'assets'])

@section('header')
  <link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')

<!-- start member payment and tracking details -->
  <div class="row">

    <!-- start member team fee payment details -->
      <div class=" col-sm-6">
        <div class="card" id="videolink-div">

          <!-- header -->
            <div class="card-header" style="background-color:#4986E7;">
              <span class="c-white f-15 ">
                Fee Payment
              </span>
            </div>
          <!-- end header -->

          <div class="card-body" style="margin-top: 20px">

            @if( $playerfees->count() == 0 )
              <div style="text-align: center">No payement detail available.</div>
            @else
              <table class="table table-hover dt-responsive mem-tab nowrap" style="width:100% !important; font-size: 12px">
                <thead>
                  <tr>
                    <th style="padding-top: 20px">Description</th>
                    <th style="padding-top: 20px">Amount to pay (in $)</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($playerfees as $fee)
                    <tr>
                        <td>{{$fee->description}}</td>
                        <td>
                          @if( $fee->status == 0 )
                            <span style="color: green">paid </span>
                          @elseif( $fee->status == 2 )
                            <span style="color: grey">n/a </span>
                          @else
                            <span style="color: red">${{ $fee->pamount }} </span>
                          @endif
                        </td>
                    </tr>
                  @endforeach
                  <tr class="active" style="font-weight: bold">
                    <td>Total Due amount:</td>
                    <td style="color: red">${{$totalfees}}</td>
                  </tr>
                </tbody>
              </table>
            @endif

          </div>

        </div>
      </div>
    <!-- end member team fee payment details -->

    <!-- start member team item tracking details -->
      <div class=" col-sm-6">
        <div class="card" id="videolink-div">

          <!-- header -->
            <div class="card-header" style="background-color:#4986E7;">
              <span class="c-white f-15 ">
                Item Tracking
              </span>
            </div>
          <!-- end header -->

          <div class="card-body" style="margin-top: 20px">

            @if( $teamitems->count() == 0 )
              <div style="text-align: center">No payement detail available.</div>
            @else
              <table class="table table-hover dt-responsive mem-tab nowrap" style="width:100% !important; font-size: 12px">
                <thead>
                  <tr>
                    <th style="padding-top: 20px">Item Name</th>
                    <th style="padding-top: 20px">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($teamitems as $item)
                    <tr>
                        <td>{{$item->item_name}}</td>
                        <td>
                          @if( $item->check == 1 )
                            <span style="color: green">Available</span>
                          @else
                            <span style="color: red">Not Available</span>
                          @endif
                        </td>
                    </tr>
                  @endforeach
                  <tr class="active" style="font-weight: bold">
                    <td>Total Status</td>
                    <td>
                      {{$iavailable}} available<br>
                      {{$teamitems->count() - $iavailable}} not available
                    </td>
                  </tr>
                </tbody>
              </table>
            @endif

          </div>

        </div>
      </div>
    <!-- end member team item tracking details -->

  </div>
<!-- end member payment and tracking details -->

@endsection

@section('footer')

<script src="{{URL::to('/')}}/js/notify.js"></script>
<script src="{{URL::to('/')}}/js/DataTable/dataTables.bootstrap.min.js"></script>
<script src="{{URL::to('/')}}/js/DataTable/responsive.bootstrap.min.js"></script>

@endsection
