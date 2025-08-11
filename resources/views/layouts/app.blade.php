<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <title>KPOINT SAVINGS</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="Author" content="Afolabi Salawu#afolabisalawu.com">

  <!-- Favicons  -->
<link href="./assets/images/small-logo.png" rel="icon">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap CSS File -->
  <link href="/assets-home/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="/assets-home/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="/assets-home/lib/animate/animate.min.css" rel="stylesheet">
  <link href="/assets-home/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="/assets-home/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="/assets-home/css/style.css" rel="stylesheet">
    <style>
    .servicec{
      border:2px solid #1cc88a;
      padding:0px;
    }
    </style>
<script async src="https://www.google.com/recaptcha/api.js"></script>

</head>

<body>


  <!--/ Nav Star /-->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">


    <div class="container">


      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
        aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand  d-none d-md-block" href="/"><img src="/assets-home/img/logo.png" width="50px" height="50px" alt="besomed-nigeria-enterprise logo"> Kpoint<span class="color-b"> Savings.</span></a>
      <a class="navbar-brand text-brand d-md-none" href="/">Kpoint<span class="color-b"> Savings</span></a>
          <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('/')?'active':'' }}" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/register">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/login">Sign In</a>
          </li>
        </ul>
      </div>

    </div>


  </nav>
  <!--/ Nav End /-->

       @yield('carousel')

       @yield('intro')

       @yield('bodyContent')

  <!--/ footer Start /-->
  <section class="section-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">Kpoint NIG. ENT.</h3>
            </div>
            <div class="w-body-a">
              <p class="w-text-a color-text-a">
                KPOINT SAVINGS, a company you can trust, for she gears efforts towards customers' satisfaction.
               We are known to be benevolent.
              </p>
            </div>
            <div class="w-footer-a">
              <ul class="list-unstyled">
                <li class="color-a">
                  <span class="color-text-a">Phone .</span> 081111111111</li>
                <li class="color-a">
                  <span class="color-text-a">Email .</span> support@kpointsavings.com</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3">
           <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand"> Services</h3>
            </div>
            <div class="w-body-a">
              <div class="w-body-a">
                <ul class="list-unstyled">
                  <li class="item-list-a">
                  <a >Timely Savings</a>
                  </li>
                 
                  <li class="item-list-a">
                    <a >Fixed Saving</a>
                  </li>
                  <li class="item-list-a">
                   <a >Target Savings</a>
                  </li>
                 

                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">Quick Links</h3>
            </div>
            <div class="w-body-a">
              <ul class="list-unstyled">
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="/">Home</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="{{ route('user.login') }}">Login</a>
                </li>
                <li class="item-list-a">
                  <i class="fa fa-angle-right"></i> <a href="{{ route('user.register') }}">Register</a>
                </li>

            


              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!-- <nav class="nav-footer">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="#">Home</a>
              </li>
              <li class="list-inline-item">
                <a href="#">About</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Property</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Bs Account</a>
              </li>

            </ul>
          </nav>-->
          <!-- <div class="socials-a">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-whatsapp" aria-hidden="true"></i>
                </a>
              </li>

            </ul>
          </div> -->
          <div class="copyright-footer">
            <p class="copyright color-text-a">
            COPYRRIGHT   &copy; <script> document.write(new Date().getFullYear());</script> </span>
              <span class="color-a">KPOINT SAVINGS<br> All RIGHTS RESERVED
            </p>
          </div>

          <div class="credits">

          Powered by <a href="https://kpoint.com.ng" target="_blank">KPOINT</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <script src="/assets-home/lib/jquery/jquery-migrate.min.js"></script>
  <!--/ Footer End /-->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- <div id="preloader"></div> -->

  <!-- JavaScript Libraries -->
  <script src="/assets-home/lib/jquery/jquery.min.js"></script>
  <script src="/assets-home/lib/popper/popper.min.js"></script>
  <script src="/assets-home/lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="/assets-home/lib/easing/easing.min.js"></script>
  <script src="/assets-home/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="/assets-home/lib/scrollreveal/scrollreveal.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="asset/contactform/contactform.js"></script>


  <!-- Template Main Javascript File -->
  <script src="/assets-home/js/main.js"></script>

</body>
</html>
