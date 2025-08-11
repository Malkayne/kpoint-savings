<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Afolabi Salawu#admin@intellicsolutions.com">

  <title>KPOINT SAVINGS || Dashboard</title>

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
        <a href="/smyl/dashboard" class="nav-link">Home</a>
      </li>
    <li class="nav-item d-none d-sm-inline-block">
        <a href="/smyl/contact" class="nav-link">Contact</a>
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
          <span class="dropdown-item dropdown-header">{{ auth::user('user')->firstName.' '.auth::user('user')->lastName}}</span>
          <div class="dropdown-divider"></div>
          <a href="{{ route('smyl.profile')}}" class="dropdown-item">
            <i class="fas fa-user mr-2"></i>Profie
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('smyl.editProfile',['user'=>  auth::user('user')->id ])}}" class="dropdown-item">
            <i class="fas fa-edit mr-2"></i> Edit Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="logout"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();" class="dropdown-item">
                               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
    <a href="#" class="brand-link navbar-success">
      <img src="/assets/img/logo.jpeg" alt="KPOINT Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><TT><b>KPOINT DASHBOARD</b></TT></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= Auth::user('user')->imgLink?'/public/Images/Users/'.Auth::user('user')->imgLink : '/public/Images/Users/default.jpeg' ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user('user')->firstName.' '.Auth::user('user')->lastName}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar  flex-column" data-widget="treeview" role="menu">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item ">
                 <a href="/smyl/dashboard" class="nav-link {{ Request::is('/smyl/dashboard')?'active':''}}   text-white">
                   <i class="nav-icon fas fa-tachometer-alt"></i>
                   <p> Dashboard</p>
                 </a>
               </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link ">
            <i class="far fa-circle nav-icon"></i>
              <p>
                Account
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item ">
                <a href="{{ route('smyl.profile')}}" class="nav-link {{ Request::is('/syml/profile')?'active':''}} bg-success text-white">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="{{ route('smyl.profile')}}" class="nav-link {{ Request::is('/syml/profile')?'active':''}}">
                  <i class="far fa-user nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('smyl.editProfile',['user'=>  auth::user('user')->id ]) }}" class="nav-link {{ Request::is('/syml/editProfile')?'active':''}}">
                  <i class="far fa-edit nav-icon"></i>
                  <p>Edit Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="logout"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();" class="nav-link">
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                           @csrf
                                       </form>
                  <i class="fa fa-power-off nav-icon"></i>
                  <p>Sign Out</p>
                </a>
              </li>
            </ul>
          </li>
          
          <!--<li class="nav-item has-treeview ">-->
          <!--  <a href="" class="nav-link ">-->
          <!--  <i class="far fa-credit-card nav-icon"></i>-->
          <!--    <p>-->
          <!--      Pay Bills-->
          <!--      <i class="right fas fa-angle-left"></i>-->
          <!--    </p>-->
          <!--  </a>-->
          <!--  <ul class="nav nav-treeview">-->
                
          <!--    <li class="nav-item ">-->
          <!--      <a href="airtime" class="nav-link  text-white">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Airtime</p>-->
          <!--      </a>-->
          <!--    </li> -->
              
          <!--    <li class="nav-item">-->
          <!--      <a href="data" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Data</p>-->
          <!--      </a>-->
          <!--    </li>-->
              
          <!--    <li class="nav-item">-->
          <!--      <a href="phcn" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>PHCN</p>-->
          <!--      </a>-->
          <!--    </li>-->
              
          <!--    <li class="nav-item">-->
          <!--      <a href="tvsub" class="nav-link">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>TV SUB</p>-->
          <!--      </a>-->
          <!--    </li>-->

          <!--    <li class="nav-item">-->
          <!--      <a href="bankTransfer" class="nav-link ">-->
          <!--        <i class="far fa-circle nav-icon"></i>-->
          <!--        <p>Bank Transfer</p>-->
          <!--      </a>-->
          <!--    </li>-->
              
          <!--  </ul>-->
          <!--</li>-->
          
          <li class="nav-item">
            <a href="{{ route('smyl.transactions' )}}" class="nav-link {{ Request::is('/syml/transactions')?'active':''}}">
              <i class="nav-icon fa fa-retweet"></i>
              <p>
                Transactions
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('smyl.wallet' )}}" class="nav-link {{ Request::is('/syml/transactions')?'active':''}}">
              <i class="nav-icon fa fa-wallet"></i>
              <p>
                Wallet
              </p>
            </a>
          </li>

          <li class="nav-header">OTHERS</li>
          <!--<li class="nav-item">-->
          <!--  <a href="#" class="nav-link {{ Request::is('/syml/documentation')?'active':''}}">-->
          <!--    <i class="nav-icon fas fa-file"></i>-->
          <!--    <p>Documentation</p>-->
          <!--  </a>-->
          <!--</li>-->


          <li class="nav-item">
            <a href="{{ route('smyl.contact') }}" class="nav-link {{ Request::is('/syml/contact')?'active':''}}">
              <i class="nav-icon fa fa-phone text-info"></i>
              <p>Contact</p>
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
            <h1 class="m-0 text-dark">Smyl Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a class="text-success" href="{{ route('smyl.dashboard')}}">Home</a></li>
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

        @if ($message = Session::get('success'))
              <center>
              <div class="row d-flex justify-content-center" style="margin-top:5px">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                  <div class="alert alert-success alert-dismissble">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ $message }}
                  </div>
                </div>
                <div class="col-md-3">
                </div>
              </div>
            </center>
            @endif

            @if ($message = Session::get('error'))
                  <center>
                  <div class="row d-flex justify-content-center" style="margin-top:5px">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-6">
                      <div class="alert alert-danger alert-dismissble">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ $message }}
                      </div>
                    </div>
                    <div class="col-md-3">
                    </div>
                  </div>
                </center>
                @endif

     @yield('bodyContent')

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer d-flex-justify-content-center">
  <center>  <strong>Copyright &copy; 2025 <a href="#" class="text-success">Kpoint Savings</a>,All Rights Reserved.</strong>
    <br>
    <b>Designed & Developed by <a class="text-success" href="https://intellicsolutions.org">INTELLIC SOLTIONS</a></b>

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
