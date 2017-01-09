<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TeamSnap') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body style="background-color: #FAF6F0">
<div id="app">
  <div class="top">
  </div>

   <div class="header">
                         <nav class="navbar navbar-default" >
                  <div class="container-fluid">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>

                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                      <ul class="nav navbar-nav">
                        <li><a href="{{url('myhome')}}" class="active">DASH</a></li>
                        <li><a href="{{url('members')}}">LOCKER ROOM</a></li> 

                        <li><a href="#">SCHEDULE</a></li>
                        <li><a href="#">ASSETS</a></li>
                        <li><a href="#">TEAM STORE</a></li>
                        <li><a href="#">MESSAGES</a></li>
                      </ul>
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">RECORDS</a></li>
                        <li><a href="#">MEDIA</a></li>
                        <li><a href="#">SETTINGS</a></li>
                      </ul>
                    </div>
                  </div>
              </nav>
    </div>
   @yield('content')
</div>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
