<!DOCTYPE html>
<html>
<head>
    <title>Org4leagues</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style type="text/css">

        .row
        {
            margin: 0px;
            padding: 0px;
        }
        
        .roboto
        {
            font-family: 'Roboto', sans-serif;
        }
        .roboto-slab
        {
            font-family: 'Roboto Slab', serif;
        }
        a:focus, a:hover 
        {
            color: #23527c;
            text-decoration: none;
        }
        .top-banner
        {
            background:url(./img/landing/header.jpg); 
            background-color:transparent;
            background-position: center;
            background-size: cover;
            color: #fff;
            height: 100vh;

        }
        .top-banner-content 
        {
            margin-top: 80px;
            margin-bottom: 80px;
            position: relative;
        }
        .top-banner-content h1 
        {
            font-size: 50px;
            margin-bottom: 20px;
            margin-top: 1.3em;
            font-weight: 400;
            text-shadow: 2px 2px 6px #000;
            
        }
        .top-banner-content h2 
        {
            font-family: "Roboto Slab", "arial", sans-serif;
            font-weight: 300;
            font-style: normal;
            font-size: 25px;
            line-height: 45px;
            text-shadow: 1px 1px 8px #000;
        }
        #top-banner-discription
        {
            font-size: 1.38em;
        }

        .quote
        {
           background: #f9f9f9; 
        }
        .top-banner-content img 
        {
            margin-top: 10em;
            width: 700px;
        }
        .p-t-20
        {
            padding-top: 20px;
        }
        .m-t-50
        {
            margin-top: 50px;
        }
        .m-t-10
        {
            padding-top: 10px;
        }
        .m-l-20
        {
           text-align: center;
        }
        .gl_icon 
        {
           font-size: 80px;
           align-items: center;
           left: 30%;
        }
        .features
        {
            background-color: #FCFDFF;
            padding-bottom: 5em;
        }
        .features h3
        {
            margin-left: 1.6em;
        }
        .feature_line_1
        {
            margin-top: 4em;
        }
        .feature_heading
        {
            line-height: 1.5em;
        }
        .get_start
        {
            padding-top:2.3em;
            padding-bottom: 5em;
        }
        .get_start_content
        {
            font-size: 17px;
            line-height: 1.9em;
        }
        }
       .get_start_img
        {
            height: 21em;
            padding-left: 3em;
            

        }
        .footer
        {
            background-color: black;
            color:white;
            margin-top: -1.2em
        }
        .tcb-quote-carousel
        {
              background: #f9f9f9;
              padding-top: 30px;
              margin-top: 40px;
              width: 100%;
        }
        .tcb-quote-carousel .quote 
        {
              color: rgba(0, 0, 0, 0.1);
              text-align: center;
              margin-bottom: 30px;
        }
        .tcb-quote-carousel .carousel 
        {
              padding-bottom: 60px;
        }
        .tcb-quote-carousel .carousel .carousel-indicators > li 
        {
              background-color: #e84a64;
              border: none;
        }
        .tcb-quote-carousel blockquote 
        {
          margin-top: 15px;
          text-align: center;
          border: none;
        }
        .tcb-quote-carousel .profile-circle 
        {
          width: 100px;
          height: 100px;
          margin: 0 auto;
          overflow: hidden;
          border-radius: 100px;
        }
        .carousel-fade .carousel-inner .item 
        {
          transition-property: opacity;
        }
        .carousel-fade .carousel-inner .item,
        .carousel-fade .carousel-inner .active.left,
        .carousel-fade .carousel-inner .active.right 
        {
          opacity: 0;
        }
        .carousel-fade .carousel-inner .active,
        .carousel-fade .carousel-inner .next.left,
        .carousel-fade .carousel-inner .prev.right 
        {
          opacity: 1;
        }
        .carousel-fade .carousel-inner .next,
        .carousel-fade .carousel-inner .prev,
        .carousel-fade .carousel-inner .active.left,
        .carousel-fade .carousel-inner .active.right 
        {
          left: 0;
          transform: translate3d(0, 0, 0);
        }
        .social:hover
        {
             -webkit-transform: scale(1.1);
             -moz-transform: scale(1.1);
             -o-transform: scale(1.1);
        }
        .social
         {
             color: #fff;
             -webkit-transform: scale(0.8);
             -moz-transform: scale(0.8);
             -o-transform: scale(0.8);
             -webkit-transition-duration: 0.5s;
             -moz-transition-duration: 0.5s;
             -o-transition-duration: 0.5s;
         }
        #social-fb:hover 
         {
             color: #3B5998;
         }
         #social-tw:hover
         {
             color: #4099FF;
         }
         #social-gp:hover 
         {
             color: #d34836;
         }
         #social-em:hover
         {
             color: #f39c12;
         }




      
       
        
    </style>
</head>
<body>

      <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                  </button>
                  <a class="navbar-brand" href="#">Org4leagues</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Login</a></li>
                    <li><a href="#">Sign Up</a></li>
                  </ul>
                </div>
          </div>
      </nav>
        
      <div class="row top-banner">
         <div class="container">
             <div class="col-sm-12 top-banner-content">
                <div class="col-sm-6">
                   <h1 class="roboto-slab">Sports Websites Made Easy</h1>
                   
                        <div id="top-banner-discription" class="roboto-slab">
                            <p>Org4Teams is a web and phone based team management platform
                            where teams stay organized and communicate better.
                            Org4Teams keeps everyone updated
                            regarding team schedule and activities.</p>
                        </div>
                       
                     <!-- <button class="btn btn-info">Take a Tour</button> -->
                </div> 
                <div class="col-sm-6">
                  <img src="{{url('/img/landing/1.png')}}" class="img-responsive">
                </div>            
             </div>
         </div>
      </div>

      
     <section class="features">
        <div class="container">
             <h2 class="text-center p-t-20 roboto-slab feature_heading">A Simple App With Powerful Team Management Features Try It Free, and Discover How Much Time You'll Save Each Week</h2>
             <div class="row feature_line_1">
                    <div class="col-sm-4">
                       <span class="glyphicon glyphicon-envelope gl_icon"></span>
                       <h3 >
                           <a href="#">Contact Information</a>
                       </h3>
                       <div class="col-sm-10 co-sm-offset-1">
                         <p class="text-center">View the roster. Use customized fields to edit each member’s personal information.</p>
                       </div>
                    </div>
                    <div class="col-sm-4">
                       <span class="glyphicon glyphicon-envelope gl_icon"></span>
                       <h3>
                           <a href="#">Contact Information</a>
                       </h3>
                       <div class="col-sm-10 co-sm-offset-1">
                         <p class="text-center">View the roster. Use customized fields to edit each member’s personal information.</p>
                       </div>
                    </div>
                    <div class="col-sm-4">
                       <span class="glyphicon glyphicon-envelope gl_icon"></span>
                       <h3>
                           <a href="#">Contact Information</a>
                       </h3>
                       <div class="col-sm-10 co-sm-offset-1">
                         <p class="text-center">View the roster. Use customized fields to edit each member’s personal information.</p>
                       </div>
                    </div>
             </div>
             <div class="row m-t-50">
                    <div class="col-sm-4">
                       <span class="glyphicon glyphicon-envelope gl_icon"></span>
                       <h3>
                           <a href="#">Contact Information</a>
                       </h3>
                       <div class="col-sm-10 co-sm-offset-1">
                         <p class="text-center">View the roster. Use customized fields to edit each member’s personal information.</p>
                       </div>
                    </div>
                    <div class="col-sm-4">
                       <span class="glyphicon glyphicon-envelope gl_icon"></span>
                       <h3>
                           <a href="#">Contact Information</a>
                       </h3>
                       <div class="col-sm-10 co-sm-offset-1">
                         <p class="text-center">View the roster. Use customized fields to edit each member’s personal information.</p>
                       </div>
                    </div>
                    <div class="col-sm-4">
                       <span class="glyphicon glyphicon-envelope gl_icon"></span>
                       <h3>
                           <a href="#">Contact Information</a>
                       </h3>
                       <div class="col-sm-10 co-sm-offset-1">
                         <p class="text-center">View the roster. Use customized fields to edit each member’s personal information.</p>
                       </div>
                    </div>
             </div>
        </div>
     </section>
    
     <section class="get_start">
         <div class="container">
             <h2 class="p-t-20 text-center roboto-slab">Get Started Today</h2>
             <div class="row p-t-20">
                <div class="col-sm-5 col-sm-offset-1">
                  <h3 class="text-center"><a href="#">Teams</a></h3><br/>
                  <div class="text-justify get_start_content">
                     <p>Org4leagues is the No. 1 sports team management software for coaches, managers and organizers to save time organizing their teams and groups online. Our sports apps and tools will make you snap your fingers and do a happy dance because they are that simple to use.</p>
                  </div>
                </div>
                <div class="col-sm-5 col-sm-offset-1">
                  <h3 class="text-center"><a href="#">Leagues, Clubs & Organizations</a></h3><br/>
                  <div class="text-justify get_start_content">
                     <p>Org4leagues is the No. 1 sports team management software for coaches, managers and organizers to save time organizing their teams and groups online. Our sports apps and tools will make you snap your fingers and do a happy dance because they are that simple to use.</p>
                  </div>
                </div>
                
             </div>
         </div>
     </section>

     <section class="quote">
         <div class="container">
            <div class="row">
                <div>
                    <div class="tcb-quote-carousel">
                        <div class="quote"><i class=" fa fa-quote-left fa-4x"></i></div>
                        <div class="carousel slide carousel-fade" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
                            <!-- Carousel indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#fade-quote-carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
                            </ol>
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="profile-circle"><img class="img-responsive " src="https://s3.amazonaws.com/uifaces/faces/twitter/mantia/128.jpg" alt=""></div>
                                    <blockquote>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                    </blockquote>
                                </div>
                                <div class="item">
                                    <div class="profile-circle"><img class="img-responsive " src="https://s3.amazonaws.com/uifaces/faces/twitter/adhamdannaway/128.jpg" alt=""></div>
                                    <blockquote>
                                        <p>Lorem sf sdfsd fipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi. Impedit temporibus nisi accusamus.</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
     </section>

     <section class="footer">
         <div class="footer-block">
                <div class="text-center center-block">
                    <h3 class="roboto-slab m-t-10">Org4Leagues</h3>
                    <address class="roboto-slab">
                       560 Beatty St 
                       Suite L211 Vancouver British 
                       Columbia Canada V6B 2L3
                    </address>
                    <a href="https://www.facebook.com/bootsnipp"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
                    <a href="https://twitter.com/bootsnipp"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>
                    <a href="https://plus.google.com/+Bootsnipp-page"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
                </div>
    

         </div>
     </section>
      


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</body>
</html>