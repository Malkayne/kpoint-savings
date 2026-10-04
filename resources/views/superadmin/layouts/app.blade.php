<!doctype html>
<html lang="en" dir="ltr" data-bs-theme="light" data-bs-theme-color="theme-color-default">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Platform') | KPoint</title>
    <link rel="shortcut icon" href="{{ asset('./assets/images/small-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('./assets/css/core/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/css/hope-ui.min.css?v=5.0.0') }}">
    <link rel="stylesheet" href="{{ asset('./assets/css/custom.min.css?v=5.0.0') }}">
    <link rel="stylesheet" href="{{ asset('./assets/css/customizer.min.css?v=5.0.0') }}">
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/87567a16b5.js" crossorigin="anonymous"></script>
    <style>
        .iq-navbar-header .iq-container { position: relative; z-index: 2; }
        .iq-navbar-header h1 { font-size: 1.75rem; line-height: 1.2; margin-bottom: .35rem; }
        .iq-navbar-header p { max-width: 42rem; margin-bottom: 0; }
        .content-inner { padding-bottom: 2rem; }
        .sa-gap { margin-bottom: 1.5rem; }
        .content-inner .row.g-4 {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 1.5rem;
        }
    </style>
</head>
<body>
    <aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all">
        <div class="sidebar-header d-flex align-items-center justify-content-start">
            <a href="{{ route('superadmin.dashboard') }}" class="navbar-brand">
                <div class="logo-main">
                    <div class="logo-normal">
                        <img src="{{ asset('./assets/images/small-logo.png') }}" style="width:30px" class="img-fluid" alt="KPoint">
                    </div>
                </div>
                <h4 class="logo-title">KPOINT</h4>
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </i>
            </div>
        </div>
        <div class="sidebar-body pt-0 data-scrollbar">
            <div class="sidebar-list">
                <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Platform</span>
                            <span class="mini-icon">P</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('superadmin.dashboard') }}" class="nav-link {{ Request::is('superadmin/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <span class="item-name">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('superadmin.orgs') }}" class="nav-link {{ (Request::is('superadmin/organisations') || (Request::is('superadmin/organisations/*') && !Request::is('superadmin/organisations/create'))) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <span class="item-name">Organisations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('superadmin.orgs.create') }}" class="nav-link {{ Request::is('superadmin/organisations/create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <span class="item-name">New organisation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('superadmin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <span class="item-name">Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </aside>

    <main class="main-content">
        <div class="position-relative iq-banner">
            <nav class="nav navbar navbar-expand-xl navbar-light iq-navbar">
                <div class="container-fluid navbar-inner">
                    <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                        <i class="icon">
                            <svg width="20" class="icon-20" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                            </svg>
                        </i>
                    </div>
                    <h4 class="mb-0 ms-2">Platform</h4>
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <span class="badge bg-primary">Superadmin</span>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="iq-navbar-header" style="height: 215px;">
                <div class="container-fluid iq-container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div>
                                    <h1>@yield('content-header', 'Platform')</h1>
                                    <p>@yield('content-header-description')</p>
                                </div>
                                @yield('header-action')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="iq-header-img">
                    <img src="{{ asset('./assets/images/dashboard/top-header.jpg') }}" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                </div>
            </div>
        </div>

        <div class="container-fluid content-inner mt-n5 py-0">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </main>

    <script src="{{ asset('./assets/js/core/libs.min.js') }}"></script>
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('./assets/js/hope-ui.js') }}"></script>
    <script>
        (function () {
            if (window.jQuery && jQuery.fn.DataTable) {
                jQuery('[data-toggle="data-table"]').each(function () {
                    if (!jQuery.fn.DataTable.isDataTable(this)) {
                        jQuery(this).DataTable({
                            dom: '<"row align-items-center"<"col-md-6" l><"col-md-6" f>><"table-responsive border-bottom my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">'
                        });
                    }
                });
            }
            if (window.bootstrap && bootstrap.Tooltip) {
                document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
                    try {
                        if (!bootstrap.Tooltip.getInstance(el)) {
                            new bootstrap.Tooltip(el);
                        }
                    } catch (e) {}
                });
            }
        })();
    </script>
    @stack('scripts')
</body>
</html>
