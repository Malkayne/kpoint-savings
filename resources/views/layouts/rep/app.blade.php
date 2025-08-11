<!doctype html>
<html lang="en" dir="ltr" data-bs-theme="light" data-bs-theme-color="theme-color-default">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | KPOINT SAVINGS REPS</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('./assets/images/small-logo.png') }}">
    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{ asset('./assets/css/core/libs.min.css') }}">
    <!-- Aos Animation Css -->
    <link rel="stylesheet" href="{{ asset('./assets/vendor/aos/dist/aos.css') }}">
    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="{{ asset('./assets/css/hope-ui.min.css?v=5.0.0') }}">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('./assets/css/custom.min.css?v=5.0.0') }}">
    <!-- Customizer Css -->
    <link rel="stylesheet" href="{{ asset('./assets/css/customizer.min.css?v=5.0.0') }}">
    <!-- RTL Css -->
    <link rel="stylesheet" href="{{ asset('./assets/css/rtl.min.css?v=5.0.0') }}">
    <!-- Font Awesome Malkayne -->
    <script src="https://kit.fontawesome.com/87567a16b5.js" crossorigin="anonymous"></script>
  </head>

  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body">
          </div>
      </div>    
    </div>
    <!-- loader END -->

    @include('layouts.rep.aside')

    <main class="main-content">

      <div class="position-relative iq-banner">
        <!--Nav Start-->
        @include('layouts.rep.nav')
        
        @include('layouts.rep.header')
        <!--Nav End-->
      </div>

      {{-- Alert Messages --}}
      <div style="position: fixed; top: 30px; left: 50%; transform: translateX(-50%); z-index: 1055; min-width: 350px; max-width: 90%;">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show shadow" role="alert" id="alert-success">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if(session('warning'))
          <div class="alert alert-warning alert-dismissible fade show shadow" role="alert" id="alert-warning">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show shadow" role="alert" id="alert-error">
            <i class="fas fa-times-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      </div>
      {{-- End Alert Messages --}}

      @yield('content')

      <div class="modal fade" id="logout-modal" tabindex="-1" aria-labelledby="logout-modal-label" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="logout-modal-label">Logout Confirmation</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="text-center">
                          <i class="fa fa-sign-out-alt text-primary" style="font-size: 4rem;"></i>
                          <p class="mt-3">Are you sure you want to logout?</p>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <form action="{{ route('logout') }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-primary">Logout</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>

      @include('layouts.rep.footer')

    </main>

    <!-- Library Bundle Script -->
    <script src="{{ asset('./assets/js/core/libs.min.js') }}"></script>
    <!-- External Library Bundle Script -->
    <script src="{{ asset('./assets/js/core/external.min.js') }}"></script>
    <!-- Widgetchart Script -->
    <script src="{{ asset('./assets/js/charts/widgetcharts.js') }}"></script>
    <!-- mapchart Script -->
    <script src="{{ asset('./assets/js/charts/vectore-chart.js') }}"></script>
    <script src="{{ asset('./assets/js/charts/dashboard.js') }}"></script>
    <!-- fslightbox Script -->
    <script src="{{ asset('./assets/js/plugins/fslightbox.js') }}"></script>
    <!-- Settings Script -->
    <script src="{{ asset('./assets/js/plugins/setting.js') }}"></script>
    <!-- Slider-tab Script -->
    <script src="{{ asset('./assets/js/plugins/slider-tabs.js') }}"></script>
    <!-- Form Wizard Script -->
    <script src="{{ asset('./assets/js/plugins/form-wizard.js') }}"></script>
    <!-- AOS Animation Plugin-->
    <script src="{{ asset('./assets/vendor/aos/dist/aos.js') }}"></script>
    <!-- App Script -->
    <script src="{{ asset('./assets/js/hope-ui.js') }}" defer></script>
    <script>
      // Auto close alerts after 5 seconds
      document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
          let alertSuccess = document.getElementById('alert-success');
          if (alertSuccess) {
            let bsAlert = bootstrap.Alert.getOrCreateInstance(alertSuccess);
            bsAlert.close();
          }
          let alertWarning = document.getElementById('alert-warning');
          if (alertWarning) {
            let bsAlert = bootstrap.Alert.getOrCreateInstance(alertWarning);
            bsAlert.close();
          }
          let alertError = document.getElementById('alert-error');
          if (alertError) {
            let bsAlert = bootstrap.Alert.getOrCreateInstance(alertError);
            bsAlert.close();
          }
        }, 5000);
      });
    </script>
  </body>
</html>
