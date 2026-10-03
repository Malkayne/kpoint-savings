<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Superadmin') | KPoint</title>
    <link href="/adminVendor/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/adminVendor/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    @include('partials.ghost-banner')
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('superadmin.dashboard') }}">KPoint platform</a>
            <div>
                <a class="btn btn-sm btn-outline-light" href="{{ route('superadmin.orgs') }}">Organisations</a>
                <form action="{{ route('superadmin.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-warning">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container pb-5">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>
