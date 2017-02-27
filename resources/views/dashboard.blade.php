@extends('layouts.new')


@section('header')

@endsection

@section('content')

<div class="block-header">

</div>

<div class="mini-charts">
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="mini-charts-item bgm-cyan">
                <div class="clearfix">
                    <div class="chart stats-bar"></div>
                    <div class="count">
                        <small>Total Members </small>
                        <h2>25</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="mini-charts-item bgm-lightgreen">
                <div class="clearfix">
                    <div class="chart stats-bar-2"></div>
                    <div class="count">
                        <small>Events</small>
                        <h2>9</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="mini-charts-item bgm-orange">
                <div class="clearfix">
                    <div class="chart stats-line"></div>
                    <div class="count">
                        <small>Games Played</small>
                        <h2>15</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="mini-charts-item bgm-bluegray">
                <div class="clearfix">
                    <div class="chart" style="padding-left: 3em; color: #fff;"><i class="zmdi zmdi-cloud-circle" style="font-size: 3.5em;"></i></div>
                    <div class="count" style="padding-left: 3em;">
                        <small>Weather</small>
                        <h2>47</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dash-widgets">
    <div class="row">

        <div class="col-md-9 col-sm-12">
            <div id="pie-charts" class="dash-widget-item bgm-pink" style="min-height: 260px;">
                <div class="bgm-pink">
                    <div class="dash-widget-header">
                        <div class="dash-widget-title f-20">Team Info</div>
                    </div>

                    <div class="clearfix"></div>

                    <div class=" p-20 m-t-25" style="color: #fff;">
                      The uniform contians the following:
             
             {{$team_name}}
             {{$team_logo}}
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-3 col-sm-12">
            <div id="site-visits" class="dash-widget-item bgm-teal card" style="min-height: 20px;">
                <div class="card-header" style="padding-top: 3em;">
                    <div class="dash-widget-title">Public URL :
                      <div class="pull-right">
                        <div class="toggle-switch" data-ts-color="lime" >
                              <input id="ts2" type="checkbox"  hidden="hidden">
                              <label for="ts2" class="ts-helper" ></label>
                          </div>
                      </div>
                      <br>
                       <a href="http://{{$teamname}}.org4teams.com" class="c-white f-400">http://{{$teamname}}.org4teams.com</a></div>

                </div>

                <div class="p-20">

                    <small>Page Views</small>
                    <h3 class="m-0 f-400">6,536</h3>

                    <br/>

                    <small>Site Visitors</small>
                    <h3 class="m-0 f-400">5,799</h3>

                    <br/>

                    <small>Total Clicks</small>
                    <h3 class="m-0 f-400">13,965</h3>
                </div>
            </div>
        </div>


    </div>
</div>

<div class="row">
    <div class="col-sm-6">
      <div class="card">
              <div class="card-header bgm-bluegray m-b-20">
                  <h2>Announcements <small>Don't miss latest team updates</small></h2>


                  <button class="btn bgm-blue btn-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus"></i></button>
              </div>

              <div class="card-body">
                  <div class="listview">
                      <a class="lv-item" href="">
                          <div class="media">
                              <div class="media-body">
                                  <div class="lv-title">David Belle</div>
                                  <small class="lv-small">Cum sociis natoque penatibus et magnis dis parturient montes</small>
                              </div>
                          </div>
                      </a>
                      <a class="lv-item" href="">
                          <div class="media">
                              <div class="media-body">
                                  <div class="lv-title">Jonathan Morris</div>
                                  <small class="lv-small">Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</small>
                              </div>
                          </div>
                      </a>
                      <a class="lv-item" href="">
                          <div class="media">
                              <div class="media-body">
                                  <div class="lv-title">Fredric Mitchell Jr.</div>
                                  <small class="lv-small">Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</small>
                              </div>
                          </div>
                      </a>
                      <a class="lv-item" href="">
                          <div class="media">
                              <div class="media-body">
                                  <div class="lv-title">Glenn Jecobs</div>
                                  <small class="lv-small">Ut vitae lacus sem ellentesque maximus, nunc sit amet varius dignissim, dui est consectetur neque</small>
                              </div>
                          </div>
                      </a>
                      <a class="lv-item" href="">
                          <div class="media">
                              <div class="media-body">
                                  <div class="lv-title">Bill Phillips</div>
                                  <small class="lv-small">Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet vel ante placerat</small>
                              </div>
                          </div>
                      </a>
                      <a class="lv-footer" href="">View All</a>
                  </div>
              </div>
          </div>

    </div>

    <div class="col-sm-6">
        <!-- Calendar -->
        <div id="calendar-widget"></div>

    </div>
</div>

@endsection

@section('footer')
<script>

 $(document).ready(function() {
   $("#a").addClass("active");

   function notify(message, type){
       $.growl({
           message: message
       },{
           type: type,
           allow_dismiss: false,
           label: 'Cancel',
           className: 'btn-xs btn-inverse',
           placement: {
               from: 'top',
               align: 'right'
           },
           delay: 2000,
           animate: {
                   enter: 'animated fadeIn',
                   exit: 'animated fadeOut'
           },
           offset: {
               x: 20,
               y: 135
           }
       });
   };

   if (!$('.login-content')[0]) {
       notify('Welcome to Team : {{$teamname}} dashboard', 'inverse');
   }

 });

</script>
@endsection
