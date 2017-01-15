@extends('layouts.app')

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
                        <small>Total Members</small>
                        <h2>23</h2>
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
            <div id="pie-charts" class="dash-widget-item">
                <div class="bgm-pink">
                    <div class="dash-widget-header">
                        <div class="dash-widget-title">Email Statistics</div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="text-center p-20 m-t-25">
                        <div class="easy-pie main-pie" data-percent="75">
                            <div class="percent">45</div>
                            <div class="pie-title">Total Emails Sent</div>
                        </div>
                    </div>
                </div>

                <div class="p-t-20 p-b-20 text-center">
                    <div class="easy-pie sub-pie-1" data-percent="56">
                        <div class="percent">56</div>
                        <div class="pie-title">Bounce Rate</div>
                    </div>
                    <div class="easy-pie sub-pie-2" data-percent="84">
                        <div class="percent">84</div>
                        <div class="pie-title">Total Opened</div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-3 col-sm-12">
            <div id="site-visits" class="dash-widget-item bgm-teal">
                <div class="dash-widget-header">
                    <div class="p-20">
                        <div class="dash-widget-visits"></div>
                    </div>

                    <div class="dash-widget-title">Public URL : <a href="http://{{$teamname}}.org4teams.com" class="c-white f-400">http://{{$teamname}}.org4teams.com</a></div>

                </div>

                <div class="p-20">

                    <small>Page Views</small>
                    <h3 class="m-0 f-400">47,896,536</h3>

                    <br/>

                    <small>Site Visitors</small>
                    <h3 class="m-0 f-400">24,456,799</h3>

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
        <!-- Todo Lists -->
        <div id="todo-lists">
            <div class="tl-header">
                <h2>Announcements</h2>
                <small>Latest announcemnts, tips and fun!</small>
            </div>

            <div class="clearfix"></div>

            <div class="tl-body">
                <div id="add-tl-item">
                    <i class="add-new-item zmdi zmdi-plus"></i>

                    <div class="add-tl-body">
                        <textarea placeholder="What is the next big thing..."></textarea>

                        <div class="add-tl-actions">
                            <a href="" data-tl-action="dismiss"><i class="zmdi zmdi-close"></i></a>
                            <a href="" data-tl-action="save"><i class="zmdi zmdi-check"></i></a>
                        </div>
                    </div>
                </div>

                <div class="media">
                    <div class="media-body">
                        <label>
                            <span>No Game this weekend !</span>
                        </label>
                    </div>
                </div>

                <div class="media">
                    <div class="media-body">
                        <label>
                            <span>Kudos! Keep it up!</span>
                        </label>
                    </div>
                </div>

                <div class="media">
                    <div class="media-body">
                        <label>
                            <span>No Game this weekend !</span>
                        </label>
                    </div>
                </div>
                <div class="media">
                    <div class="media-body">
                        <label>
                            <span>No Game this weekend !</span>
                        </label>
                    </div>
                </div>

                <div class="media">
                    <div class="media-body">
                        <label>
                            <span>No Game this weekend !</span>
                        </label>
                    </div>
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
       notify('Welcome !', 'inverse');
   }

 });

</script>
@endsection
