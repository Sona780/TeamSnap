<!--[if IE 9 ]><html class="ie9"><![endif]-->
   <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Org4Leagues</title>

        <!-- Vendor CSS -->
        <link href="{{URL::to('/')}}/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">

        <link href="{{URL::to('/')}}/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

        <link href="{{URL::to('/')}}/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/lightgallery/light-gallery/css/lightGallery.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bootgrid/jquery.bootgrid.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/farbtastic/farbtastic.css" rel="stylesheet">

        <!-- CSS -->
        <link href="{{URL::to('/')}}/css/app.min.1.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/css/app.min.2.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

        <style type="text/css">
            @media (min-width: 768px) and (max-width: 1080px) {
                .set-width {
                    display: block;
                }

                .team-card {
                     height: 20%;
                }
            }

            @media (min-width: 1080px) {
                .set-width {
                    width: 100px;
                    display: inline-block;
                }

                .team-card {
                     height: 15%;
                }
            }

            @media (max-width: 767px) {
                .set-width {
                    display: inline-block;
                }
            }
        </style>

        @yield('header')
    </head>
    <body style="background-color: #FAF6F0">
        @if( !Auth::guest() )


        <header id="header" class="clearfix" data-current-skin="blue">
            <ul class="header-inner">
                <li class="logo ">
                    <a href="home">Org4leagues</a>
                </li>
                 <li class="pull-right" style="margin-right: 20px">
                    <ul class="top-menu">
                        @if (Auth::guest())
                        <li class="logo"><a href="{{ url('/login') }}" style="font-size: 15px;">Login</a></li>
                        <li class="logo"><a href="{{ url('/register') }}" style="font-size: 15px;">Register</a></li>
                         @else

                        <li class="dropdown">

                            <a data-toggle="dropdown" href=""><img src ="{{url($user_detail->avatar)}}" style="height:40px; width: 40px; border-radius:50%; margin-right: 10px"/>
                                {{Auth::user()->name}}
                            </a>
                            <ul class="dropdown-menu dm-icon pull-right">
                                <li>
                                    <a href="{{ URL::to('/') }}/home"> My Home</a>
                                </li>
                                <li>

                                    <a href="{{ URL::to('profile') }}"> Profile</a>
                                </li>
                                <li class="divider">
                                <li>
                                      <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </header>

        @endif



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
                <li><a href="{{URL::to('home')}}">Home</a></li>
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
        <script src="{{URL::to('/')}}/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js "></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="{{URL::to('/')}}/vendors/bootstrap-growl/bootstrap-growl.min.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.min.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="{{URL::to('/')}}/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
         <script src="{{URL::to('/')}}/vendors/bower_components/lightgallery/light-gallery/js/lightGallery.min.js"></script>
         <script src="{{URL::to('/')}}/vendors/bootgrid/jquery.bootgrid.updated.min.js"></script>
       <script src="{{URL::to('/')}}/vendors/farbtastic/farbtastic.min.js"></script>
       <script src="{{URL::to('/')}}/vendors/fileinput/fileinput.min.js"></script>
        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->

        <script src="{{URL::to('/')}}/js/flot-charts/curved-line-chart.js"></script>
        <script src="{{URL::to('/')}}/js/flot-charts/line-chart.js"></script>
        <script src="{{URL::to('/')}}/js/charts.js"></script>

        <script src="{{URL::to('/')}}/js/functions.js"></script>

        <!-- <script src="{{URL::to('/')}}/js/demo.js"></script> -->

        @yield('footer')
    </body>
  </html>
