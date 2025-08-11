<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>KPOINT SAVINGS || Rep Login</title>

  <link rel="shortcut icon" type="image/x-icon" href="./assets/images/small-logo.png">

  <link href="/adminVendor/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="/adminVendor/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="/adminVendor/css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">

  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="brand-logo">
                    <img src="/assets/images/logo.png" width="50px" height="50px" alt="logo"> <strong class="fw-bold text-gray-900">KPoint<span class="color-b"> Solution</span></strong>
                  </div>
                  <div class="text-center">
                    <h1 class="h5 text-gray-900 mb-4">Rep Login</h1>
                  </div>
                  <form class="user" id="myFormId" action="/rep/login" method="post">
                    @csrf
                     @if ($message = Session::get('error'))
                   <b><center><small class="text-danger">
                      {{ $message }}
                    </small></b></center>
                  @endif
                    <div class="form-group">
                      <input type="username" name="username" class="form-control @error('username') is-invalid @enderror" id="exampleInputEmail" value="{{ old('username') }}" aria-describedby="emailHelp"
                        placeholder="Enter your username">
                        @error('username')
                        <p class="text-danger">
                        <strong>{{ $message }}</strong>
                          </p>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password">
                      @error('password')
                    <p class="text-danger">
                    <strong>{{ $message }}</strong>
                      </p>
                    @enderror
                    </div>
                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input bg-success" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div>
                    </div> -->
                    <div class="form-group">
                      <button type="submit" id="myButtonID" class="btn btn-success btn-block">Login</button>
                    </div>

                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">

 $('#myFormId').submit(function(){
     $("#myButtonID", this)
       .html("loging in,Please Wait...")
       .attr('disabled', 'disabled');
     return true;
 });

 </script>

  <!-- Login Content -->
  <script src="/adminVendor/vendor/jquery/jquery.min.js"></script>
  <script src="/adminVendor/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/adminVendor/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="/adminVendor/js/ruang-admin.min.js"></script>


</body>

</html>
