<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Platform login | KPoint</title>
    <link rel="shortcut icon" href="{{ asset('./assets/images/small-logo.png') }}">
    <link href="/adminVendor/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/adminVendor/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/adminVendor/css/ruang-admin.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-login">
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="login-form">
                            <div class="brand-logo text-center mb-3">
                                <img src="{{ asset('./assets/images/logo.png') }}" width="50" height="50" alt="KPoint">
                                <strong class="fw-bold text-gray-900">KPoint Solution</strong>
                            </div>
                            <div class="text-center">
                                <h1 class="h5 text-gray-900 mb-1">Platform login</h1>
                                <p class="text-muted mb-4">Sign in to manage organisations.</p>
                            </div>
                            <form method="POST" action="{{ route('superadmin.loginPost') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" placeholder="Username" required autofocus>
                                    @error('username')
                                        <p class="text-danger mb-0"><strong>{{ $message }}</strong></p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                                    @error('password')
                                        <p class="text-danger mb-0"><strong>{{ $message }}</strong></p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                        <label class="custom-control-label" for="remember">Remember me</label>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success btn-block">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
