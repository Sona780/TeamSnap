<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>Org4Leagues</title>

        <!-- Vendor CSS -->
        <link href="{{URL::to('/')}}/vendors/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/bootstrap-sweetalert/lib/sweet-alert.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet">

        <link href="{{URL::to('/')}}/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/vendors/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">

        <!-- CSS -->
        <link href="{{URL::to('/')}}/css/app.min.1.css" rel="stylesheet">
        <link href="{{URL::to('/')}}/css/app.min.2.css" rel="stylesheet">



        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">
       

@yield('header')
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body style="background-color: #FAF6F0">
         <header id="header" class="clearfix" data-current-skin="blue">
            <ul class="header-inner">
                <li class="logo ">
                    <a href="/">Org4leagues</a>
                </li>
                 <li class="pull-right">
                    <ul class="top-menu">
                        @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                         @else
                        <li class="dropdown">
                            <a data-toggle="dropdown" href=""><img src ="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:40px; height:40px;  border-radius: 50%;" />{{Auth::user()->name}}</a>
                            <ul class="dropdown-menu dm-icon pull-right">
                                <li>
                                    <a href="{{ URL::to('/') }}/home"><i class="zmdi zmdi-settings"></i> My Home</a>
                                </li>
                                <li>

                                    <a href="{{ URL::to(Auth::user()->id.'/userprofile') }}"><i class="zmdi zmdi-settings"></i> Profile</a>
                                </li>
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

        <section id="main" data-layout="layout-1">
           <section id="content">
                <div class="container">
                     @yield('content')
                </div>
           </section>
        </section>

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

        <script src="{{URL::to('/')}}/js/flot-charts/curved-line-chart.js"></script>
        <script src="{{URL::to('/')}}/js/flot-charts/line-chart.js"></script>
        <script src="{{URL::to('/')}}/js/charts.js"></script>

        <script src="{{URL::to('/')}}/js/charts.js"></script>
        <script src="{{URL::to('/')}}/js/functions.js"></script>
    <!-- Scripts -->
    <script src="/js/app.js"></script>

  

 @yield('footer')
</body>
</html>
