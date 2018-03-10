<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    @yield('title')

    <!-- Styles -->
        <link href="{{ url('/') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="{{ url('/') }}/css/freelancer.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('/') }}/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ url('/') }}/superslide/css/stylesheets/superslides.css">
    <!-- jQuery -->
<script src="{{ url('/') }}/vendor/jquery/jquery.min.js"></script>


@if( is('/enterpreneurs/reg') )

<script type="text/javascript" src="{{ url('/') }}/bower_components/moment/min/moment.min.js"></script>

@endif
<!-- Bootstrap Core JavaScript -->
<script src="{{ url('/') }}/vendor/bootstrap/js/bootstrap.min.js"></script>

    @yield('css')

    <style media="screen">
    .search-form .form-group {
float: right !important;
transition: all 0.35s, border-radius 0s;
width: 32px;
height: 32px;
background-color: #fff;
box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
border-radius: 25px;
border: 1px solid #ccc;
}
.search-form .form-group input.form-control {
padding-right: 20px;
border: 0 none;
background: transparent;
box-shadow: none;
display:block;
}
.search-form .form-group input.form-control::-webkit-input-placeholder {
display: none;
}
.search-form .form-group input.form-control:-moz-placeholder {
/* Firefox 18- */
display: none;
}
.search-form .form-group input.form-control::-moz-placeholder {
/* Firefox 19+ */
display: none;
}
.search-form .form-group input.form-control:-ms-input-placeholder {
display: none;
}
.search-form .form-group:hover,
.search-form .form-group.hover {
width: 100%;
border-radius: 4px 25px 25px 4px;
}
.search-form .form-group span.form-control-feedback {
position: absolute;
top: -1px;
right: -2px;
z-index: 2;
display: block;
width: 34px;
height: 34px;
line-height: 34px;
text-align: center;
color: #3596e0;
left: initial;
font-size: 14px;
}

    </style>
@if( is('/enterpreneurs/reg') )

  <link rel="stylesheet" href="{{ url('/') }}/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />


@endif



    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>



        <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                 <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Circle power') }}
                </a>
            </div>

            <div class="row">


              <div class="col-lg-10">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar">



                    </ul>


                                    <!-- Right Side Of Navbar LARAVEL -->
                    <ul class="nav navbar-nav navbar-right">

                     <li class="hidden">
                            <a href="#page-top"></a>
                        </li>


                        <li class="page-scroll">
                            <a href="{{ url('/') }}/laravel/site_map">Site map</a>
                        </li>


                         @if (Session::has('admin_logged_in'))

                        <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Admin logged in <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/admin/authenticate/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Admin Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/admin/authenticate/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>

     <!-- Right Side Of Navbar LARAVEL -->



                </div>
              </div>
            </div>


            <!-- Collect the nav links, forms, and other content for toggling -->

            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

 <!-- Header -->
    <header style="background-color: white;">

    <br><br><br><br>
    </header>




    @yield('content')


<!-- Footer -->

<footer class="text-center">
<style type="text/css">
    .footer_p{
        line-height: 5px;
        font-size: 13px;
    }
</style>
        <div class="footer-above">
            <div class="container">
                <div class="row" style="text-align:left;">
               <div class="col-lg-3">
                   <h5>About us</h5>
                   <p class="footer_p">Who we are</p>
                   <p class="footer_p">What is crowdpower</p>
                   <p class="footer_p">Our milestones</p>
                   <p class="footer_p">Our goals</p>
                   <p class="footer_p">Change the world</p>
               </div>
               <div class="col-lg-3"><h5>FAQ's</h5>
                     <p class="footer_p">What can I do</p>
                     <p class="footer_p">What are the possibilities</p>
                     <p class="footer_p">How can I start the project</p>
                     <p class="footer_p">Legal boundations & obligations</p>
                     <p class="footer_p">Tenure</p>
               </div>
               <div class="col-lg-3"><h5>Discover</h5>
                    <p class="footer_p">Art</p>
                    <p class="footer_p">Comic</p>
                    <p class="footer_p">Craft</p>
                    <p class="footer_p">Dance</p>
                    <p class="footer_p">Design</p>
               </div>
               <div class="col-lg-3"><h5>Hello</h5>
                    <p class="footer_p">Happenings</p>
                    <p class="footer_p">Comapny blog</p>
                    <p class="footer_p">Engineering blog</p>
                    <p class="footer_p">Meet us</p>
               </div>
                </div>
                <hr>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="pull-left">
                        Copyright &copy; CIRCLEPOWER 2016
                    </div>
                    <div class="pull-right">
                       <div class="row">
                           <div class="col-xs-1"><i class="fa fa-facebook" aria-hidden="true"></i></div>
                           <div class="col-xs-1"><i class="fa fa-google-plus" aria-hidden="true"></i></div>
                           <div class="col-xs-1"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                           <div class="col-xs-1"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
                           <div class="col-xs-1"><i class="fa fa-youtube" aria-hidden="true"></i></div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>



    <!-- Scripts -->


    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="{{ url('/') }}/js/jqBootstrapValidation.js"></script>
    <script src="{{ url('/') }}/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="{{ url('/') }}/js/freelancer.min.js"></script>
  <script src="{{ url('/') }}/superslide/javascripts/jquery.easing.1.3.js"></script>
  <script src="{{ url('/') }}/superslide/javascripts/jquery.animate-enhanced.min.js"></script>
  <script src="{{ url('/') }}/superslide/jquery.superslides.js" type="text/javascript" charset="utf-8"></script>



  @if( is('/enterpreneurs/reg') )
 <!-- ... -->

  <script type="text/javascript" src="{{ url('/') }}/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>


  <script type="text/javascript">

    $(function(){


     $('#datetimepicker1').datetimepicker(

        {
                 format: 'YYYY-MM-DD'
           }
     );
    });
  </script>
@endif
  <script>
    $(function() {


$('#slides').superslides({

    play:true,
    animation_speed: 2000,
    animation : 'fade'
});


    });
  </script>

  @yield('script')
</body>
</html>
