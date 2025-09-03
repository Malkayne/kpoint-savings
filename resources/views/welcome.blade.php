<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kpoint Savings - Daily Savings Platform</title>
     
    <!-- ======= Google Font =======-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;display=swap" rel="stylesheet">
    <!-- End Google Font-->
    
    <!-- ======= Styles =======-->
    <link href="home_assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="home_assets/vendors/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="home_assets/vendors/glightbox/glightbox.min.css" rel="stylesheet">
    <link href="home_assets/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="home_assets/vendors/aos/aos.css" rel="stylesheet">

    <!-- End Styles-->
    <!-- ======= Favicon =======-->
    <link rel="icon" href="home_assets/images/kpoint.png" type="image/png">
    
    <!-- ======= Theme Style =======-->
    <link href="home_assets/css/style.css" rel="stylesheet">
    <!-- End Theme Style-->
    
    <!-- ======= Apply theme =======-->
    <script>
      // Apply the theme as early as possible to avoid flicker
      (function() {
      const storedTheme = localStorage.getItem('theme') || 'light';
      document.documentElement.setAttribute('data-bs-theme', storedTheme);
      })();
    </script>
  </head>
  <body>
    
    
    <!-- ======= Site Wrap =======-->
    <div class="site-wrap">
      
      
      <!-- ======= Header =======-->
      <header class="fbs__net-navbar navbar navbar-expand-lg dark" aria-label="freebootstrap.net navbar">
        <div class="container d-flex align-items-center justify-content-between">
          
          
          <!-- Start Logo-->
          <a class="navbar-brand w-auto" href="index.html">
            <!-- If you use a text logo, uncomment this if it is commented-->
            <!-- Vertex--> 
            
            <!-- ogo dark--><img class="logo dark img-fluid" src="home_assets/images/kpoint.png" alt="kpoint" width="50"> 
                  
                  <!-- logo light--><img class="logo light img-fluid" src="home_assets/images/kpoint.png" alt="kpoint" width="50">
            </a>
          <!-- End Logo-->
          
          <!-- Start offcanvas-->
          <div class="offcanvas offcanvas-start w-75" id="fbs__net-navbars" tabindex="-1" aria-labelledby="fbs__net-navbarsLabel">
            
            
            <div class="offcanvas-header">
              <div class="offcanvas-header-logo">
                <!-- If you use a text logo, uncomment this if it is commented-->
                
                <!-- h5#fbs__net-navbarsLabel.offcanvas-title Vertex-->
                
                <!-- If you plan to use an image logo, uncomment this if it is commented-->
                <a class="logo-link" id="fbs__net-navbarsLabel" href="index.html">
                  
                  
                  <!-- logo dark--><img class="logo dark img-fluid" src="home_assets/images/kpoint.png" alt="kpoint" width="50"> 
                  
                  <!-- logo light--><img class="logo light img-fluid" src="home_assets/images/kpoint.png" alt="kpoint" width="50">
                  </a>
                
              </div>
              <button class="btn-close btn-close-black" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            
            <div class="offcanvas-body align-items-lg-center">
              
              
              <ul class="navbar-nav nav me-auto ps-lg-5 mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link scroll-link active" aria-current="page" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link scroll-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link scroll-link" href="#how-it-works">How It Works</a></li>
                <li class="nav-item"><a class="nav-link scroll-link" href="#services">Services</a></li>
                </li>
                <li class="nav-item"><a class="nav-link scroll-link" href="#contact">Contact</a></li>
              </ul>
              
            </div>
          </div>
          <!-- End offcanvas-->
          
          <div class="ms-auto w-auto">


            <div class="header-social d-flex align-items-center gap-1"><a class="btn btn-primary py-2" href="{{ route('user.login') }}">Get Started</a>

              <button class="fbs__net-navbar-toggler justify-content-center align-items-center ms-auto" data-bs-toggle="offcanvas" data-bs-target="#fbs__net-navbars" aria-controls="fbs__net-navbars" aria-label="Toggle navigation" aria-expanded="false">
                <svg class="fbs__net-icon-menu" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="21" x2="3" y1="6" y2="6"></line>
                  <line x1="15" x2="3" y1="12" y2="12"></line>
                  <line x1="17" x2="3" y1="18" y2="18"></line>
                </svg>
                <svg class="fbs__net-icon-close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M18 6 6 18"></path>
                  <path d="m6 6 12 12"></path>
                </svg>
              </button>
              
            </div>
            
          </div>
        </div>
      </header>
      <!-- End Header-->
      
      <!-- ======= Main =======-->
      <main>
        
        
        <!-- ======= Hero =======-->
<section class="hero__v6 section" id="home">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <div class="row">
          <div class="col-lg-11">
            <span class="hero-subtitle text-uppercase" data-aos="fade-up" data-aos-delay="0">Daily Savings Made Simple</span>
            <h1 class="hero-title mb-3" data-aos="fade-up" data-aos-delay="100">Join and Grow with Trusted Ajo Contributions</h1>
            <p class="hero-description mb-4 mb-lg-5" data-aos="fade-up" data-aos-delay="200">Easily save daily, build discipline, and access funds quickly with our secure digital contribution platform.</p>
            <div class="cta d-flex gap-2 mb-4 mb-lg-5" data-aos="fade-up" data-aos-delay="300">
              <a class="btn" href="{{ route('user.login') }}">Start Saving Today</a>
              <!--<a class="btn btn-white-outline" href="#">Learn How It Works-->
              <!--  <svg class="lucide lucide-arrow-up-right" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">-->
              <!--    <path d="M7 7h10v10"></path>-->
              <!--    <path d="M7 17 17 7"></path>-->
              <!--  </svg>-->
              <!--</a>-->
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="hero-img"><img class="img-main img-fluid rounded-4" src="home_assets/images/hero-img-1-min.jpg" alt="Hero Image" data-aos="fade-in" data-aos-delay="500"></div>
      </div>
    </div>
  </div>
</section>

        
      <section class="about__v4 section" id="about">
  <div class="container">
    <div class="row">
      <div class="col-md-6 order-md-2">
        <div class="row justify-content-end">
          <div class="col-md-11 mb-4 mb-md-0">
            <span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-aos-delay="0">About Us</span>
            <h2 class="mb-4" data-aos="fade-up" data-aos-delay="100">Empowering communities through secure and flexible daily savings</h2>
            <div data-aos="fade-up" data-aos-delay="200">
              <p>We are a fintech company focused on digitizing traditional daily savings (Ajo, Esusu, Thrift). Our platform brings structure, transparency, and trust to community contribution systems.</p>
              <p>With real-time tracking, automated collection, and group management features, we help users save effortlessly and build financial stability together.</p>
            </div>
            <h4 class="small fw-bold mt-4 mb-3" data-aos="fade-up" data-aos-delay="300">What Drives Us</h4>
            <ul class="d-flex flex-row flex-wrap list-unstyled gap-3 features" data-aos="fade-up" data-aos-delay="400">
              <li class="d-flex align-items-center gap-2"><span class="icon rounded-circle text-center"><i class="bi bi-check"></i></span><span class="text">Community Trust</span></li>
              <li class="d-flex align-items-center gap-2"><span class="icon rounded-circle text-center"><i class="bi bi-check"></i></span><span class="text">Financial Inclusion</span></li>
              <li class="d-flex align-items-center gap-2"><span class="icon rounded-circle text-center"><i class="bi bi-check"></i></span><span class="text">Easy Contribution Tracking</span></li>
              <li class="d-flex align-items-center gap-2"><span class="icon rounded-circle text-center"><i class="bi bi-check"></i></span><span class="text">Security & Transparency</span></li>
              <li class="d-flex align-items-center gap-2"><span class="icon rounded-circle text-center"><i class="bi bi-check"></i></span><span class="text">Savings Discipline</span></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-6"> 
        <div class="img-wrap position-relative">
          <img class="img-fluid rounded-4" src="home_assets/images/about_2-min.jpg" alt="About image" data-aos="fade-up" data-aos-delay="0">
          <div class="mission-statement p-4 rounded-4 d-flex gap-4" data-aos="fade-up" data-aos-delay="100">
            <div class="mission-icon text-center rounded-circle"><i class="bi bi-lightbulb fs-4"></i></div>
            <div>
              <h3 class="text-uppercase fw-bold">Our Mission</h3>
              <p class="fs-5 mb-0">To simplify daily savings for individuals and groups by offering a reliable, transparent, and digital contribution system.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

        
   <section class="section features__v2" id="features">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-lg-flex p-5 rounded-4 content" data-aos="fade-in" data-aos-delay="0">
          <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="0">
              <div class="row"> 
                <div class="col-lg-11">
                  <div class="h-100 flex-column justify-content-between d-flex">
                    <div>
                      <h2 class="mb-4">Why Save With Us</h2>
                      <p class="mb-5">Join a smarter way to manage daily savings. Whether you're part of a group or saving solo, our platform makes the process secure, transparent, and stress-free.</p>
                    </div>
                    <!--<div class="align-self-start">-->
                    <!--  <a class="glightbox btn btn-play d-inline-flex align-items-center gap-2" href="https://www.youtube.com/watch?v=DQx96G4yHd8" data-gallery="video">-->
                    <!--    <i class="bi bi-play-fill"></i> See How It Works-->
                    <!--  </a>-->
                    <!--</div>-->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="row justify-content-end">
                <div class="col-lg-11">
                  <div class="row">
                    <div class="col-sm-6" data-aos="fade-up" data-aos-delay="0">
                      <div class="icon text-center mb-4"><i class="bi bi-person-check fs-4"></i></div>
                      <h3 class="fs-6 fw-bold mb-3">Simple to Use</h3>
                      <p>Clean dashboard and easy tracking of daily contributions.</p>
                    </div>
                    <div class="col-sm-6" data-aos="fade-up" data-aos-delay="100">
                      <div class="icon text-center mb-4"><i class="bi bi-graph-up fs-4"></i></div>
                      <h3 class="fs-6 fw-bold mb-3">Real-time Monitoring</h3>
                      <p>See your savings grow daily with live updates and records.</p>
                    </div>
                    <div class="col-sm-6" data-aos="fade-up" data-aos-delay="200">
                      <div class="icon text-center mb-4"><i class="bi bi-headset fs-4"></i></div>
                      <h3 class="fs-6 fw-bold mb-3">Reliable Support</h3>
                      <p>We're here to help you resolve issues anytime you need us.</p>
                    </div>
                    <div class="col-sm-6" data-aos="fade-up" data-aos-delay="300">
                      <div class="icon text-center mb-4"><i class="bi bi-shield-lock fs-4"></i></div>
                      <h3 class="fs-6 fw-bold mb-3">Safe & Secure</h3>
                      <p>Encrypted transactions and trusted disbursement processes.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

      
        
        
       <!-- ======= How it works =======-->
<section class="section howitworks__v1" id="how-it-works">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-6 text-center mx-auto">
        <span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-aos-delay="0">How it works</span>
        <h2 data-aos="fade-up" data-aos-delay="100">Getting Started is Easy</h2>
        <p data-aos="fade-up" data-aos-delay="200">With just a few simple steps, you can start saving daily and growing your money securely with your group or as an individual.</p>
      </div>
    </div>
    <div class="row g-md-5">
      <div class="col-md-6 col-lg-3">
        <div class="step-card text-center h-100 d-flex flex-column justify-content-start position-relative" data-aos="fade-up" data-aos-delay="0">
          <div data-aos="fade-right" data-aos-delay="500">
            <img class="arch-line" src="home_assets/images/arch-line.svg" alt="Step line">
          </div>
          <span class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">1</span>
          <div>
            <h3 class="fs-5 mb-4">Create an Account</h3>
            <p>Register on our website or mobile app with your name and phone number to start your savings journey.</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
        <div class="step-card reverse text-center h-100 d-flex flex-column justify-content-start position-relative">
          <div data-aos="fade-right" data-aos-delay="1100">
            <img class="arch-line reverse" src="home_assets/images/arch-line-reverse.svg" alt="Step line">
          </div>
          <span class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">2</span>
          <h3 class="fs-5 mb-4">Join or Create a Thrift Group</h3>
          <p>Decide whether to save solo or with others. Join an existing group or start your own.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1200">
        <div class="step-card text-center h-100 d-flex flex-column justify-content-start position-relative">
          <div data-aos="fade-right" data-aos-delay="1700">
            <img class="arch-line" src="home_assets/images/arch-line.svg" alt="Step line">
          </div>
          <span class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">3</span>
          <h3 class="fs-5 mb-4">Start Saving Daily</h3>
          <p>Contribute your agreed amount daily and monitor your savings in real time from your dashboard.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1800">
        <div class="step-card last text-center h-100 d-flex flex-column justify-content-start position-relative">
          <span class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">4</span>
          <div>
            <h3 class="fs-5 mb-4">Withdraw or Rotate Collection</h3>
            <p>Access your total savings at the end of the cycle or collect in turns with others in your group.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

        
      <!-- ======= Stats =======-->
<section class="stats__v3 section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-flex flex-wrap content rounded-4" data-aos="fade-up" data-aos-delay="0">
          <div class="rounded-borders">
            <div class="rounded-border-1"></div>
            <div class="rounded-border-2"></div>
            <div class="rounded-border-3"></div>
          </div>

          <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0 text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-item">
              <h3 class="fs-1 fw-bold">
                <span class="purecounter" data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="2">0</span><span>K+</span>
              </h3>
              <p class="mb-0">Active Daily Savers</p>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0 text-center" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-item">
              <h3 class="fs-1 fw-bold">
                <span class="purecounter" data-purecounter-start="0" data-purecounter-end="95" data-purecounter-duration="2">0</span><span>%</span>
              </h3>
              <p class="mb-0">Payout Success Rate</p>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0 text-center" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-item">
              <h3 class="fs-1 fw-bold">
                <span class="purecounter" data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="2">0</span><span>M+</span>
              </h3>
              <p class="mb-0">Total Contributions Processed</p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

    <!-- ======= How It Works =======-->
    <section class="section howitworks__v1" id="how-it-works">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-6 text-center mx-auto">
            <span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-aos-delay="0">Simple Steps</span>
            <h2 data-aos="fade-up" data-aos-delay="100">Start Saving in Minutes</h2>
            <p data-aos="fade-up" data-aos-delay="200">
              Join thousands of Nigerians growing their savings through trusted group contributions.
            </p>
          </div>
        </div>
        <div class="row g-md-5">
          <div class="col-md-6 col-lg-3">
            <div class="step-card text-center h-100 d-flex flex-column justify-content-start position-relative" data-aos="fade-up" data-aos-delay="0">
              <div data-aos="fade-right" data-aos-delay="500">
                <img class="arch-line" src="home_assets/images/arch-line.svg" alt="">
              </div>
              <span class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">1</span>
              <div>
                <h3 class="fs-5 mb-4">Create/Join Group</h3>
                <p>Start a new savings circle or join an existing one with friends/family.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="600">
            <div class="step-card reverse text-center h-100 d-flex flex-column justify-content-start position-relative">
              <div data-aos="fade-right" data-aos-delay="1100">
                <img class="arch-line reverse" src="home_assets/images/arch-line-reverse.svg" alt="">
              </div>
              <span class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">2</span>
              <h3 class="fs-5 mb-4">Set Contribution Plan</h3>
              <p>Choose amount (₦200-₦50,000/day) and duration (10-365 days).</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1200">
            <div class="step-card text-center h-100 d-flex flex-column justify-content-start position-relative">
              <div data-aos="fade-right" data-aos-delay="1700">
                <img class="arch-line" src="home_assets/images/arch-line.svg" alt="">
              </div>
              <span class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">3</span>
              <h3 class="fs-5 mb-4">Automate Savings</h3>
              <p>Daily amounts debit automatically from your Kpoint wallet.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="1800">
            <div class="step-card last text-center h-100 d-flex flex-column justify-content-start position-relative">
              <span class="step-number rounded-circle text-center fw-bold mb-5 mx-auto">4</span>
              <div>
                <h3 class="fs-5 mb-4">Receive Payout</h3>
                <p>Get your lump sum when it's your turn in the rotation.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ======= Group Types =======-->
    <section class="section services__v3" id="services">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-8 mx-auto text-center">
            <span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-aos-delay="0">Savings Options</span>
            <h2 class="mb-3" data-aos="fade-up" data-aos-delay="100">Choose Your Contribution Style</h2>
          </div>
        </div>
        <div class="row g-4">
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
            <div class="service-card p-4 rounded-4 h-100 d-flex flex-column justify-content-between gap-5">
              <div>
                <span class="icon mb-4">
                  <i class="bi bi-people-fill fs-4"></i>
                </span>
                <h3 class="fs-5 mb-3">Traditional Esusu</h3>
                <p class="mb-4">
                  Fixed-order payouts. Perfect for trusted groups where members agree on payout sequence upfront.
                </p>
              </div>
              <a class="special-link d-inline-flex gap-2 align-items-center text-decoration-none" href="#">
                <span class="icons">
                  <i class="icon-1 bi bi-arrow-right-short"></i>
                  <i class="icon-2 bi bi-arrow-right-short"></i>
                </span>
                <span>Start Group</span>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="service-card p-4 rounded-4 h-100 d-flex flex-column justify-content-between gap-5">
              <div>
                <span class="icon mb-4">
                  <i class="bi bi-shuffle fs-4"></i>
                </span>
                <h3 class="fs-5 mb-3">Random Rotation</h3>
                <p class="mb-4">
                  Algorithm randomly selects payout order each cycle. Great for fair distribution.
                </p>
              </div>
              <a class="special-link d-inline-flex gap-2 align-items-center text-decoration-none" href="#">
                <span class="icons">
                  <i class="icon-1 bi bi-arrow-right-short"></i>
                  <i class="icon-2 bi bi-arrow-right-short"></i>
                </span>
                <span>Start Group</span>
              </a>
            </div>
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="service-card p-4 rounded-4 h-100 d-flex flex-column justify-content-between gap-5">
              <div>
                <span class="icon mb-4">
                  <i class="bi bi-auction fs-4"></i>
                </span>
                <h3 class="fs-5 mb-3">Bid-Based Ajo</h3>
                <p class="mb-4">
                  Members bid for early payouts. Earn interest when others bid higher for earlier positions.
                </p>
              </div>
              <a class="special-link d-inline-flex gap-2 align-items-center text-decoration-none" href="#">
                <span class="icons">
                  <i class="icon-1 bi bi-arrow-right-short"></i>
                  <i class="icon-2 bi bi-arrow-right-short"></i>
                </span>
                <span>Start Group</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ======= Testimonials =======-->
    <section class="section testimonials__v2" id="testimonials">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-5 mx-auto text-center">
            <span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-aos-delay="0">Success Stories</span>
            <h2 class="mb-3" data-aos="fade-up" data-aos-delay="100">What Our Members Say</h2>
            <p data-aos="fade-up" data-aos-delay="200">Real stories from Nigerians using Kpoint Groups</p>
          </div>
        </div>
        <div class="row g-4" data-masonry="{&quot;percentPosition&quot;: true }">
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
            <div class="testimonial rounded-4 p-4">
              <blockquote class="mb-3">
                "Saved ₦150,000 in 3 months with my market women group. The automated deductions made it painless!"
              </blockquote>
              <div class="testimonial-author d-flex gap-3 align-items-center">
                <div class="author-img">
                  <img class="rounded-circle img-fluid" src="home_assets/images/person-sq-2-min.jpg" alt="Mama Nkechi">
                </div>
                <div class="lh-base">
                  <strong class="d-block">Mama Nkechi</strong>
                  <span>Trader, Onitsha Market</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="testimonial rounded-4 p-4">
              <blockquote class="mb-3">
                "As a freelancer, Kpoint Groups helps me save consistently. Got my payout right when client payments were delayed."
              </blockquote>
              <div class="testimonial-author d-flex gap-3 align-items-center">
                <div class="author-img">
                  <img class="rounded-circle img-fluid" src="home_assets/images/person-sq-1-min.jpg" alt="Tunde">
                </div>
                <div class="lh-base">
                  <strong class="d-block">Tunde Adeleke</strong>
                  <span>Graphic Designer</span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="testimonial rounded-4 p-4">
              <blockquote class="mb-3">
                "Our staff cooperative of 12 saved ₦2.4M in 6 months. The transparency features eliminated all the usual doubts about who paid when."
              </blockquote>
              <div class="testimonial-author d-flex gap-3 align-items-center">
                <div class="author-img">
                  <img class="rounded-circle img-fluid" src="home_assets/images/person-sq-5-min.jpg" alt="Mrs. Johnson">
                </div>
                <div class="lh-base">
                  <strong class="d-block">Mrs. Johnson</strong>
                  <span>Office Administrator</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ======= Security =======-->
    <section class="section about__v4" id="security">
      <div class="container">
        <div class="row">
          <div class="col-md-6 order-md-2">
            <div class="row justify-content-end">
              <div class="col-md-11 mb-4 mb-md-0">
                <span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-aos-delay="0">Your Money is Safe</span>
                <h2 class="mb-4" data-aos="fade-up" data-aos-delay="100">Bank-Grade Security</h2>
                <div data-aos="fade-up" data-aos-delay="200">
                  <p>
                    All group funds are held in licensed financial institution escrow accounts. 
                    Not even Kpoint can access these funds outside the agreed payout schedule.
                  </p>
                  <p>
                    Every transaction is encrypted and recorded on immutable logs. 
                    Members receive instant notifications for all group financial activities.
                  </p>
                </div>
                <h4 class="small fw-bold mt-4 mb-3" data-aos="fade-up" data-aos-delay="300">Certifications & Compliance</h4>
                <ul class="d-flex flex-row flex-wrap list-unstyled gap-3 features" data-aos="fade-up" data-aos-delay="400">
                  <li class="d-flex align-items-center gap-2">
                    <span class="icon rounded-circle text-center"><i class="bi bi-check"></i></span>
                    <span class="text">NDIC Insured</span>
                  </li>
                  <li class="d-flex align-items-center gap-2">
                    <span class="icon rounded-circle text-center"><i class="bi bi-check"></i></span>
                    <span class="text">PCI DSS Compliant</span>
                  </li>
                  <li class="d-flex align-items-center gap-2">
                    <span class="icon rounded-circle text-center"><i class="bi bi-check"></i></span>
                    <span class="text">CBN Licensed</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6"> 
            <div class="img-wrap position-relative">
              <img class="img-fluid rounded-4" src="home_assets/images/about_2-min.jpg" alt="Security illustration" data-aos="fade-up" data-aos-delay="0">
              <div class="mission-statement p-4 rounded-4 d-flex gap-4" data-aos="fade-up" data-aos-delay="100">
                <div class="mission-icon text-center rounded-circle">
                  <i class="bi bi-shield-lock fs-4"></i>
                </div>
                <div>
                  <h3 class="text-uppercase fw-bold">Our Promise</h3>
                  <p class="fs-5 mb-0">
                    Your contributions are protected with the same security as bank deposits. 
                    We never touch your money - it goes directly to escrow.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- ======= FAQ =======-->
    <section class="section faq__v2" id="faq">
      <div class="container">
        <div class="row mb-4">
          <div class="col-md-6 col-lg-7 mx-auto text-center">
            <span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-aos-delay="0">Need Help?</span>
            <h2 class="h2 fw-bold mb-3" data-aos="fade-up" data-aos-delay="0">Frequently Asked Questions</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8 mx-auto" data-aos="fade-up" data-aos-delay="200">
            <div class="faq-content">
              <div class="accordion custom-accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                      What happens if a member misses a contribution?
                    </button>
                  </h2>
                  <div class="accordion-collapse collapse show" id="panelsStayOpen-collapseOne">
                    <div class="accordion-body">
                      The group admin sets rules for missed payments. Options include:
                      <ul>
                        <li>Automatic catch-up deductions with penalty</li>
                        <li>Temporary suspension from payout rotation</li>
                        <li>Group vote on consequences</li>
                      </ul>
                      All rules are visible before joining any group.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                      How are payouts disbursed?
                    </button>
                  </h2>
                  <div class="accordion-collapse collapse" id="panelsStayOpen-collapseTwo">
                    <div class="accordion-body">
                      Payouts are automatically sent to the member's Kpoint wallet on their scheduled date. 
                      Funds can then be withdrawn to any Nigerian bank account or used for bills/transfers within the app.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                      Is there a limit to group size?
                    </button>
                  </h2>
                  <div class="accordion-collapse collapse" id="panelsStayOpen-collapseThree">
                    <div class="accordion-body">
                      Groups can have 2-50 members. Larger groups (>20 members) require ID verification for all participants.
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                      Can I leave a group early?
                    </button>
                  </h2>
                  <div class="accordion-collapse collapse" id="panelsStayOpen-collapseFour">
                    <div class="accordion-body">
                      Early exit is possible but subject to group rules. Typically:
                      <ul>
                        <li>You receive your contributed amount minus penalties</li>
                        <li>Forfeit any expected interest</li>
                        <li>May require group approval</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

     <section class="section contact__v2" id="contact">
          <div class="container">
            <div class="row mb-5">
              <div class="col-md-6 col-lg-7 mx-auto text-center"><span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-aos-delay="0">Contact</span>
                <h2 class="h2 fw-bold mb-3" data-aos="fade-up" data-aos-delay="0">Contact Us</h2>
                <p data-aos="fade-up" data-aos-delay="100">Utilize our tools to develop your concepts and bring your vision to life. Once complete, effortlessly share your creations.</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="d-flex gap-5 flex-column">
                  <div class="d-flex align-items-start gap-3" data-aos="fade-up" data-aos-delay="0">
                    <div class="icon d-block"><i class="bi bi-telephone"></i></div><span> <span class="d-block">Phone</span><strong>+234 7073549960</strong></span>
                  </div>
                  <div class="d-flex align-items-start gap-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon d-block"><i class="bi bi-send"></i></div><span> <span class="d-block">Email</span><strong>kpointsavings@gmail.com</strong></span>
                  </div>
<!--                  <div class="d-flex align-items-start gap-3" data-aos="fade-up" data-aos-delay="200">-->
<!--                    <div class="icon d-block"><i class="bi bi-geo-alt"></i></div><span> <span class="d-block">Address</span>-->
<!--                      <address class="fw-bold">369 pine st 527-->
<!--san francisco,-->
<!--CA 94104, USA</address></span>-->
<!--                  </div>-->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-wrapper" data-aos="fade-up" data-aos-delay="300">
                  <form id="contactForm">
                    <div class="row gap-3 mb-3">
                      <div class="col-md-12">
                        <label class="mb-2" for="name">Name</label>
                        <input class="form-control" id="name" type="text" name="name" required="">
                      </div>
                      <div class="col-md-12">
                        <label class="mb-2" for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" required="">
                      </div>
                    </div>
                    <div class="row gap-3 mb-3">
                      <div class="col-md-12">
                        <label class="mb-2" for="subject">Subject</label>
                        <input class="form-control" id="subject" type="text" name="subject">
                      </div>
                    </div>
                    <div class="row gap-3 gap-md-0 mb-3">
                      <div class="col-md-12">
                        <label class="mb-2" for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required=""></textarea>
                      </div>
                    </div>
                    <button class="btn btn-primary fw-semibold" type="submit">Send Message</button>
                  </form>
                  <div class="mt-3 d-none alert alert-success" id="successMessage">Message sent successfully!</div>
                  <div class="mt-3 d-none alert alert-danger" id="errorMessage">Message sending failed. Please try again later.</div>
                </div>
              </div>
            </div>
          </div>
        </section>


    <!-- ======= Footer =======-->
    <footer class="footer pt-5 pb-5">
      <div class="container">
        <div class="row mb-5 pb-4">
          <div class="col-md-7">
            <h2 class="fs-5">Join Our Community</h2>
            <p>Get tips on group savings and exclusive offers</p>
          </div>
          <div class="col-md-5">
            <form class="d-flex gap-2">
              <input class="form-control" type="email" placeholder="Your email" required="">
              <button class="btn btn-primary fs-6" type="submit">Subscribe</button>
            </form>
          </div>
        </div>
        <div class="row justify-content-between mb-5 g-xl-5">
          <div class="col-md-4 mb-5 mb-lg-0">
            <h3 class="mb-3">Kpoint Groups</h3>
            <p class="mb-4">
              Modernizing traditional savings circles with technology. 
              Our mission is financial inclusion for every Nigerian.
            </p>
          </div>
          <div class="col-md-7">
            <div class="row g-2">
              <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                <h3 class="mb-3">Company</h3>
                <ul class="list-unstyled">
                  <li><a href="#about">About Us</a></li>
                  <li><a href="#faq">FAQ</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                <h3 class="mb-3">Support</h3>
                <ul class="list-unstyled">
                  <li><a href="#contact">Help Center</a></li>
                  <li><a href="#contact">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-4 mb-4 mb-lg-0 quick-contact">
                <h3 class="mb-3">Contact</h3>
                <p class="d-flex mb-3">
                  <i class="bi bi-geo-alt-fill me-3"></i>
                  <span> 21 isikwuatu street okpoko , Onitsha Anambra state </span>
                </p>
                <a class="d-flex mb-3" href="mailto:groups@kpoint.com">
                  <i class="bi bi-envelope-fill me-3"></i>
                  <span>kpointsavings@gmail.com</span>
                </a>
                <a class="d-flex mb-3" href="tel:+2348005551234">
                  <i class="bi bi-telephone-fill me-3"></i>
                  <span>+234 7073549960</span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row credits pt-3">
          <div class="col-xl-8 text-center text-xl-start mb-3 mb-xl-0">
            &copy; <script>document.write(new Date().getFullYear());</script> Kpoint Financial Technologies Ltd. All rights reserved.
          </div>
        </div>
      </div>
    </footer>

        
   
        
        
      </main>
    </div>
    
    <!-- ======= Back to Top =======-->
    <button id="back-to-top"><i class="bi bi-arrow-up-short"></i></button>
    <!-- End Back to top-->
    
    <!-- ======= Javascripts =======-->
    <script src="home_assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="home_assets/vendors/gsap/gsap.min.js"></script>
    <script src="home_assets/vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="home_assets/vendors/isotope/isotope.pkgd.min.js"></script>
    <script src="home_assets/vendors/glightbox/glightbox.min.js"></script>
    <script src="home_assets/vendors/swiper/swiper-bundle.min.js"></script>
    <script src="home_assets/vendors/aos/aos.js"></script>
    <script src="home_assets/vendors/purecounter/purecounter.js"></script>
    <script src="home_assets/js/custom.js"></script>
    <script src="home_assets/js/send_email.js"></script>
    <!-- End JavaScripts-->
  </body>
</html>