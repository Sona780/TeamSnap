<!--[if IE 9 ]><html class="ie9"><![endif]-->
   <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Org4Leagues</title>

        <!-- Vendor CSS -->
        <link href="{{URL::to('/')}}/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">

        <link href="{{URL::to('/')}}/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

        <link href="{{URL::to('/')}}/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/lightgallery/light-gallery/css/lightGallery.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bootgrid/jquery.bootgrid.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/chosen/chosen.min.css" rel="stylesheet">



        <!-- CSS -->
        <link href="{{URL::to('/')}}/css/bootstrap-multiselect.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/css/app.min.1.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/css/app.min.2.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

        <link href='{{url("calendar/css")}}/fullcalendar.min.css' rel='stylesheet' />
        <link href='{{url("calendar/css")}}/fullcalendar.print.min.css' rel='stylesheet' media='print' />


        <!--<link href="{{URL::to('/')}}/css/DataTable/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/css/DataTable/responsive.bootstrap.min.css" rel="stylesheet">
-->



         <style type="text/css">.ctg
    {
      background-color:#4E4C4D;
      margin-top: -1.5em;
      min-height: 4em;

    }
    .ctg > li> a
    {
      color: #fff;
    }
     .ctg > li> a:hover
    {
      color: #FFF;
    }
     .ctg > li.active > a
    {
      color: #FFFF00;
    }
    .ctg > li > a:after
     {
     background: #fff !important;
     height: 0px !important;
    }


    .ctg
    {
      background-color:#4E4C4D;
      margin-top: -1.5em;
      min-height: 4em;

    }
    .ctg > li> a
    {
      color: #fff;
    }
     .ctg > li> a:hover
    {
      color: #FFF;
    }
     .ctg > li.active > a
    {
      color: #FFFF00;
    }
    .ctg > li > a:after
     {
     background: #fff !important;
     height: 0px !important;
    }

            a.disabled {
                text-decoration: none;
                color: black;
                cursor: default;
            }

            #example2-pagination {
                display: none;
            }

            .li-class {
                padding: 0;
            }

            .li-class > li {
                list-style: none;
            }

            .fc-time {
                margin-right: 4px !important;
            }
            @media screen and (min-width: 720px) {
                #calendar, #loading {
                    margin-left: 10%;
                }
            }


            @media (max-width: 768px) {
              .center-xs {
                    text-align: center
                }
            }

            .fc-center {
                margin-top: 0px !important;
            }
            .fc-toolbar:before {
                height: 60px !important;
            }
            .fc-toolbar {
                height: 60px !important;
            }
            .mem-tab {
              font-size: 13px
            }
             .size-new {
                padding: 0px 44px;
             }
            .size-exists {
                padding: 0px 10px;
             }
            .dtr-title {
                width: 150px;
            }
            .icon-style {
              width: 40px;
              padding-left: 10px;
            }
            .border-height {
                border-radius: 5px;
                height: 30px;
            }
            .b-design {
                border-radius: 8px;
                background: white;
                font-size: 12px;
                width: 80%;
            }
            .padd-left {
                padding: 0px 10px;
            }
            .bottom-bord {
                border-bottom: 1px solid grey;
            }
            .top-bord {
                border-top: 1px solid grey;
            }
            .first-col {
                width: 30%;
            }
            .adjust {
                margin-top: 20px;
            }
            .dropdown-basic-demo {
                display: inline-block;
                margin: 0 15px 20px 0;
            }
            .dropdown-basic-demo .dropdown-menu {
                display: block;
                position: relative;
                transform: scale(1);
                opacity: 1;
                filter: alpha(opacity=1);
                z-index: 0;
            }
            .dropdown-btn-demo .dropdown, .dropdown-btn-demo .btn-group, .btn-demo .btn {
                display: inline-block;
                margin: 0 5px 7px 0;
            }
            .modal-preview-demo .modal {
                position: relative;
                display: block;
                z-index: 0;
                background: rgba(0,0,0,0.1);
            }
            .margin-bottom > *{
                margin-bottom: 20px;
            }
            .popover-demo .popover {
                position: relative;
                display: inline-block;
                opacity: 1;
                margin: 0 10px 30px;
                z-index: 0;
            }
            .preloader {
                margin-right: 30px;
            }
            .strong-error {
                color: red;
                font-size: 12px
            }
         </style>

        @yield('header')
    </head>
    <body style="background-color: #FAF6F0">
      <header id="header-2" class="clearfix" style="background-color: @if($teamleague == 'team') {{$first}} @else #03A9F4 @endif"> <!-- Make sure to change both class and data-current-skin when switching sking manually -->
            <ul class="header-inner clearfix" >
                <div style="display: inline-block">
                    @if( $teamleague == 'team' )
                    <div style="display: inline-block">
                        <img src="{{url($logo)}}"  style="width:50px; height:50px; border-radius: 50%;margin-right:5px" >
                    </div>
                    @endif
                    <div style="display: inline-block">
                        <a href='@if( $teamleague == "team" ) {{url($team."/dashboard")}} @else {{url("l/$id/d/$ld/dashboard")}} @endif'><h5 style="text-transform: uppercase">{{$name}}</h5></a>
                    </div>
                </div>

                <li id="menu-trigger" data-trigger=".ha-menu" class="visible-xs">
                    <div class="line-wrap">
                        <div class="line top"></div>
                        <div class="line center"></div>
                        <div class="line bottom"></div>
                    </div>
                </li>

                <li class="logo hidden-xs">

                </li>

                <li class="pull-right hidden-xs" style="margin-right:3%; display: block; display: inline-block">
                    <div class="btn-group">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                My Teams
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" id="teams">
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Account
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li>
                                    <a href="{{ URL::to('/') }}/home">My Home</a>
                                </li>
                                <li>
                                    <a href="{{ url('profile') }}">Profile</a>
                                </li>
                                <li>
                                    <a href="{{ url('password/update') }}">Change Password</a>
                                </li>
                                <li class="divider">
                                <li>
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>

            <nav class="ha-menu">
            @if($team > 0)
                <ul>
                  @if($teamleague == 'league')
                    <li class="waves-effect" id="dashboard"><a href="{{url('l/'.$team.'/d/'.$ld.'/dashboard')}}">Dashboard</a></li>
                  @else
                    <li class="waves-effect" id="dashboard"><a href="{{url($team.'/dashboard')}}">Dashboard</a></li>
                  @endif

                  @if($teamleague == 'league' && (($manager_access == 1) || ($manager_access == 2 && $maccess->division == 1)))
                    <li class="waves-effect" id="detail"><a href="{{url('l/'.$team.'/d/'.$ld.'/detail')}}">Divisions</a></li>
                  @endif

                  @if( ($manager_access == 1 && $teamleague == 'team') || ($manager_access == 2 && $maccess->member == 1) )
                    <li class="waves-effect" id="members"><a href="{{url($team.'/members')}}">Members</a></li>
                  @endif

                  @if( ($manager_access == 0) || ($teamleague == 'team' && (($manager_access == 1) || ($manager_access == 2 && $maccess->schedule == 1)) ) )
                    <li class="waves-effect" id="schedule"><a href="{{url($team.'/schedule')}}">Schedule</a></li>
                  @elseif($teamleague == 'league' && (($manager_access == 1) || ($manager_access == 2 && $maccess->schedule == 1)))
                    <li class="waves-effect" id="schedule"><a href="{{url('l/'.$team.'/d/'.$ld.'/schedule')}}">Schedule</a></li>
                  @endif

                  @if( $teamleague == 'team' && (($manager_access == 1) || ($manager_access == 2 && $maccess->availability == 1)) )
                    <li class="waves-effect" id="availability"><a href="{{url($team.'/availability')}}">Availability</a></li>
                  @endif

                  @if( ($manager_access == 0) || ($teamleague == 'team' && (($manager_access == 1) || ($manager_access == 2 && $maccess->record == 1)) ) )
                    <li class="waves-effect" id="records"><a href="{{url($team.'/records')}}">Records</a></li>
                  @elseif($teamleague == 'league' && (($manager_access == 1) || ($manager_access == 2 && $maccess->record == 1)))
                    <!--<li class="waves-effect" id="records"><a href="{{url('league/'.$team.'/records')}}">Records</a></li>-->
                  @endif

                  @if( ($manager_access == 0) || ($teamleague == 'team' && (($manager_access == 1) || ($manager_access == 2 && $maccess->media == 1)) ) )
                    <li class="waves-effect" id="media"><a href="{{url($team.'/files')}}">Media</a></li>
                  @elseif($teamleague == 'league' && (($manager_access == 1) || ($manager_access == 2 && $maccess->media == 1)))
                    <li class="waves-effect" id="media"><a href="{{url('l/'.$team.'/d/'.$ld.'/files')}}">Media</a></li>
                  @endif

                  @if( ($manager_access == 0) || ($teamleague == 'team' && (($manager_access == 1) || ($manager_access == 2 && $maccess->message == 1)) ) )
                    <li class="waves-effect" id="messages"><a href="{{url($team.'/messages')}}">Messages</a></li>
                  @elseif($teamleague == 'league' && (($manager_access == 1) || ($manager_access == 2 && $maccess->message == 1)))
                    <!--<li class="waves-effect" id="messages"><a href="{{url('league/'.$team.'/messages')}}">Messages</a></li>-->
                  @endif

                  @if( $teamleague == 'team' && (($manager_access == 1) || ($manager_access == 2 && $maccess->setting == 1)) )
                    <li class="waves-effect pull-right hidden-xs" id="settings"><a href="{{url($team.'/settings')}}">Settings</a></li>
                  @elseif($teamleague == 'league' && (($manager_access == 1) || ($manager_access == 2 && $maccess->setting == 1)))
                    <li class="waves-effect pull-right hidden-xs" id="settings"><a href="{{url('l/'.$team.'/d/'.$ld.'/settings')}}">Settings</a></li>
                  @endif

                  @if( ($manager_access == 0) || ($teamleague == 'team' && (($manager_access == 1) || ($manager_access == 2 && $maccess->asset == 1)) ) )
                    <li class="waves-effect pull-right hidden-xs" id="assets"><a href="{{url($team.'/assets')}}">Assets</a></li>
                  @endif
                </ul>
            @endif
            </nav>

        </header>


        <section id="main" data-layout="layout-1">

            <section id="content">
                <div class="container">
                    @yield('content')
                </div>
            </section>
        </section>

        <footer id="footer">
            Copyright &copy; 2017 Kilobyte Technology Partners

            <ul class="f-menu">
                <li><a href="{{url('home')}}">Home</a></li>
                <li><a href="{{url($team.'/dashboard')}}">Dashboard</a></li>
                <li><a href="">Support</a></li>
                <li><a href="">Contact</a></li>
            </ul>
        </footer>

        <!-- Older IE warning message -->
        <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="img/browsers/chrome.png" alt="">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="img/browsers/firefox.png" alt="">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="img/browsers/opera.png" alt="">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="img/browsers/safari.png" alt="">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="img/browsers/ie.png" alt="">
                                <div>IE (New)</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <p>Sorry for the inconvenience!</p>
            </div>
        <![endif]-->

        <!-- Javascript Libraries -->
        <script src="{{URL::to('/')}}/vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <script src="{{URL::to('/')}}/vendors/bower_components/flot/jquery.flot.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/flot/jquery.flot.resize.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/flot.curvedlines/curvedLines.js"></script>
        <script src="{{URL::to('/')}}/vendors/sparklines/jquery.sparkline.min.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

        <script src="{{URL::to('/')}}/vendors/bower_components/moment/min/moment.min.js"></script>


        <script src="{{URL::to('/')}}/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="{{URL::to('/')}}/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
         <script src="{{URL::to('/')}}/vendors/bower_components/lightgallery/light-gallery/js/lightGallery.min.js"></script>
         <script src="{{URL::to('/')}}/vendors/bootgrid/jquery.bootgrid.updated.min.js"></script>

         <script src="{{URL::to('/')}}/vendors/bower_components/chosen/chosen.jquery.min.js"></script>
         <script src="{{URL::to('/')}}/vendors/fileinput/fileinput.min.js"></script>

         <script src='{{url("calendar/js")}}/fullcalendar.min.js'></script>
        <script src='{{url("calendar/js")}}/gcal.min.js'></script>

         <!--<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>-->

<!--
         <script src="{{URL::to('/')}}/js/DataTable/jquery.dataTables.min.js"></script>
         <script src="{{URL::to('/')}}/js/DataTable/dataTables.bootstrap4.min.js"></script>
-->
        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->

        <script src="{{URL::to('/')}}/js/flot-charts/curved-line-chart.js"></script>
        <script src="{{URL::to('/')}}/js/flot-charts/line-chart.js"></script>
        <script src="{{URL::to('/')}}/js/charts.js"></script>
        <script src="{{URL::to('/')}}/js/bootstrap-multiselect.js"></script>

        <script src="{{URL::to('/')}}/js/functions.js"></script>

        <script src="{{URL::to('/')}}/js/jquery.paginate.min.js"></script>

        <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <!--<script src="{{URL::to('/')}}/js/DataTable/dataTables.bootstrap.min.js"></script>-->
        <script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
        <!--<script src="{{URL::to('/')}}/js/DataTable/responsive.bootstrap.min.js"></script>-->





        <script src="{{URL::to('/')}}/js/demo.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                active = '{{$active}}';
                $('.ha-menu').find('ul').find('li').removeClass('active');
                $('.ha-menu').find('ul').find('#'+ active).addClass('active');
                team = {{$team}};

                url = '{{url("/")}}/get/teams';
                $.get(url, function(data){
                    t = data;
                    content = '';
                    for( i = 0; i < t.length; i++ )
                    {
                        target = '{{url("/")}}/'+ t[i]['id'] +'/dashboard';
                        @if( $teamleague == 'team' )
                            if( t[i]['id'] == team )
                                content += '<li class="active"><a style="font-weight: bold" href="'+ target +'">'+ t[i]['teamname'] +'</a></li>';
                            else
                                content += '<li><a href="'+ target +'">'+ t[i]['teamname'] +'</a></li>';
                        @else
                            content += '<li><a href="'+ target +'">'+ t[i]['teamname'] +'</a></li>';
                        @endif
                    }
                    target = '{{url("/")}}/team/create';
                    if( content != '' )
                        content += '<li class="divider"></li>';
                    @if( $manager_access == 1 )
                        content += '<li><a href="'+ target +'">Create a New Team</a></li>'
                    @endif
                    $('#teams').html(content);
                });
            });
        </script>

        @yield('footer')
    </body>
  </html>
