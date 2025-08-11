<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Afolabi Salawu#admin@intellicsolutions.com">

  <title>SMYL || Admin Dashboard</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
 <!-- DataTables -->
 <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-success">

     <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/admin/dashboard" class="nav-link">Home</a>
      </li>

    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ auth::user('admin')->name }}</span>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.profile')}}" class="dropdown-item">
            <i class="fas fa-user mr-2"></i>Profie
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('admin.editProfile',['admin'=>  auth::user('admin')->id ])}}" class="dropdown-item">
            <i class="fas fa-edit mr-2"></i> Edit Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="/admin/logout"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();" class="dropdown-item">
                               <form id="logout-form" action="{{ route('admin.adminLogout') }}" method="POST" style="display: none;">
                                     @csrf
                                 </form>
            <i class="fa fa-power-off mr-2"></i> Sign Out
          </a>

        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-sucess elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link navbar-success">
      <img src="/assets/img/logo.jpeg" alt="admin Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><TT><b>ADMIN PANEL</b></TT></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/assets/img/logo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user('user')->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar  flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item ">
                 <a href="/admin/dashboard" class="nav-link {{ Request::is('/admin/dashboard')?'active':''}}   text-white">
                   <i class="nav-icon fas fa-tachometer-alt"></i>
                   <p> Dashboard</p>
                 </a>
               </li>
               
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
            <i class="fa fa-user-plus nav-icon"></i>
              <p>
                Account
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item ">
                <a href="{{ route('admin.profile')}}" class="nav-link {{ Request::is('/syml/profile')?'active':''}} bg-success text-white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="{{ route('admin.profile')}}" class="nav-link {{ Request::is('/syml/profile')?'active':''}}">
                  <i class="far fa-user nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.editProfile',['admin'=>  auth::user('admin')->id ]) }}" class="nav-link {{ Request::is('/syml/editProfile')?'active':''}}">
                  <i class="far fa-edit nav-icon"></i>
                  <p>Edit Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/logout"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();" class="nav-link">
                                     <form id="logout-form" action="{{ route('admin.adminLogout') }}" method="POST" style="display: none;">
                                           @csrf
                                       </form>
                  <i class="fa fa-power-off nav-icon"></i>
                  <p>Sign Out</p>
                </a>
              </li>
            </ul>
          </li>
          
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
            <i class="fa fa-euro-sign nav-icon"></i>
              <p>
                Bills
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="/admin/productcats" class="nav-link {{ Request::is('/admin/productcats')?'active':''}}">
                  <i class="far fa-calendar nav-icon"></i>
                  <p>Bill Category</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="/admin/products" class="nav-link {{ Request::is('/admin/products')?'active':''}}">
                  <i class="fa fa-money-bill nav-icon"></i>
                  <p>Bill Prices</p>
                </a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.users' )}}" class="nav-link {{ Request::is('/admin/users')?'active':''}}">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.reps' )}}" class="nav-link {{ Request::is('/admin/reps')?'active':''}}">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Reps
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('admin.managers' )}}" class="nav-link {{ Request::is('/admin/managers')?'active':''}}">
              <i class="nav-icon fa fa-users"></i>
              <p>
                Managers
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.transactions' )}}" class="nav-link {{ Request::is('/admin/transactions')?'active':''}}">
              <i class="nav-icon fa fa-retweet"></i>
              <p>
                Transactions
              </p>
            </a>
          </li>

  <li class="nav-item">
            <a href="{{ route('admin.Ptransactions' )}}" class="nav-link {{ Request::is('/admin/Ptransactions')?'active':''}}">
              <i class="nav-icon fa fa-retweet"></i>
              <p>
                Pending Credits
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('admin.usersWallet' )}}" class="nav-link {{ Request::is('/admin/usersWallet')?'active':''}}">
              <i class="nav-icon fa fa-wallet"></i>
              <p>
                Users Wallet
              </p>
            </a>
          </li>
          
           <li class="nav-item">
            <a href="{{ route('admin.sendMessage' )}}" class="nav-link {{ Request::is('/admin/sendMessage')?'active':''}}">
            <i class="fa fa-comments" aria-hidden="true"></i>
              <p>
              Send Notification
              </p>
            </a>
          </li>
          
           <li class="nav-item">
            <a href="{{ route('admin.testSms' )}}" class="nav-link {{ Request::is('/admin/testSms')?'active':''}}">
            <i class="fa fa-comments" aria-hidden="true"></i>
              <p>
              Test SMS
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-success" href="{{ route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">{{ $title ??''}} </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


     @yield('bodyContent')

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer d-flex-justify-content-center">
  <center>  <strong>Copyright &copy; 2021 <a href="#" class="text-success">Bensomed</a>,All Rights Reserved.</strong>
    <br>
    <b>Designed & Developed by <a class="text-success" href="https://intellicsolutions.com">INTELLIC SOLUTIONS</a></b>

  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/plugins/moment/moment.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Admin -->
<script src="/dist/js/adminlte.js"></script>
<!-- admin dashboard  -->
<script src="/dist/js/pages/dashboard.js"></script>
<!-- admin  -->
<script src="/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#setsubdatatable").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
