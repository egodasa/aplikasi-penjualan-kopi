<?php
  if(!isset($_SESSION['level']))
  {
    header("Location: ".site_url("login"));
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="{{ base_url() }}assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ base_url() }}assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ base_url() }}assets/css/nprogress.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="{{ base_url() }}assets/css/custom.min.css" rel="stylesheet">
    
    <link href="{{ base_url() }}assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
    @section('head')
      <!-- Custom Head -->
    @show
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;padding: 10px;">
              <img src="{{ base_url() }}assets/images/logo2.png" class="img-responsive">
            </div>
        
            <div class="clearfix"></div>
        
            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_info">
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->
        
            <br />
        
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">
                  @section('sidebar_menu')
                    <li><a href="{{ site_url('beranda') }}"><i class="fa fa-home"></i> Beranda</a></li>
                    <?php
                      if($_SESSION['level'] == "Member")
                      {
                    ?>
                      <li><a href="{{ site_url('transaksi') }}"><i class="fa fa-home"></i> Transaksi</a></li>
                      <li><a href="{{ site_url('jadwalkeberangkatan') }}"><i class="fa fa-home"></i> Jadwal Keberangkatan</a></li>
                    <?php
                      }
                      else
                      {
                    ?>
                      <li><a href="{{ site_url('program') }}"><i class="fa fa-home"></i> Program</a></li>
                      <li><a href="{{ site_url('jenisprogram') }}"><i class="fa fa-home"></i> Jenis Program</a></li>
                      <li><a href="{{ site_url('pengguna') }}"><i class="fa fa-home"></i> Pengguna</a></li>
                      <li><a href="{{ site_url('pelanggan') }}"><i class="fa fa-home"></i> Pelanggan</a></li>
                      <li><a href="{{ site_url('transaksi') }}"><i class="fa fa-home"></i> Transaksi</a></li>
                      <li><a href="{{ site_url('jadwalkeberangkatan') }}"><i class="fa fa-home"></i> Jadwal Keberangkatan</a></li>
                    <?php
                      }
                    ?>
                  @show
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>
        

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{ base_url() }}assets/images/@yield('user_image')" alt="">
                    Selamat Datang, <?=$_SESSION['username']?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profil</a></li>
                    <li><a href="{{ site_url('logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
                      @yield('content_title')
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @yield('content')
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
        
      </div>
    </div>
    <!-- jQuery -->
    <script src="{{ base_url() }}assets/js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ base_url() }}assets/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="{{ base_url() }}assets/js/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{ base_url() }}assets/js/nprogress.js"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="{{ base_url() }}assets/js/custom.min.js"></script>
    
    
    <script src="{{ base_url() }}assets/js/jquery.dataTables.min.js"></script>
    <script src="{{ base_url() }}assets/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ base_url() }}assets/js/dataTables.responsive.min.js"></script>
    
    @section('script')
      <!-- Custom Script -->
    @show
    
    <script>
      $('.table').DataTable();
    </script>
    
  </body>
</html>
