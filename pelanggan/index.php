<?php 
session_start(); 

?>


<!DOCTYPE html>
<html dir="ltr" lang="en">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo.png">
  <title>TRAC ASTRA PALEMBANG</title>
  <link rel="stylesheet" type="text/css" href="../assets/libs/select2/dist/css/select2.min.css">
  <link href="../dist/css/style.min.css" rel="stylesheet">
  
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
 </head>
 <link rel="stylesheet" type="text/css" href="../assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <script src="../assets/libs/select2/dist/js/select2.min.js"></script>
  <script src="../dist/js/pages/forms/select2/select2.init.js"></script>
  <link href="../assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

 <body>
  <div class="preloader">
      <div class="lds-ripple">
          <div class="lds-pos"></div>
          <div class="lds-pos"></div>
      </div>
  </div>
  <div id="main-wrapper">
    <header class="topbar">
      <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
            <i class="ti-menu ti-close"></i>
          </a>
          <div class="navbar-brand">
            <a href="index.php" class="logo">
              <b class="logo-icon">
                <img src="../assets/images/logo2.png" alt="homepage" class="dark-logo" />
              </b>
              <span class="logo-text">
                <img src="../assets/images/logo2.png" class="light-logo" alt="homepage" />
              </span>
              <span><b>ASTRA PALEMBANG</b></span>
            </a>
            <a class="sidebartoggler d-none d-md-block" href="javascript:void(0)" data-sidebartype="mini-sidebar">
              <i class="mdi mdi-toggle-switch mdi-toggle-switch-off font-20"></i>
            </a>
          </div>
          <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="ti-more"></i>
          </a>
        </div>
      </nav>
    </header>
    <aside class="left-sidebar">
      <div class="scroll-sidebar">
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li class="sidebar-item">
              <a href="?page=dashboard" class="sidebar-link">
                <i class="mdi mdi-av-timer"></i>
                <span class="hide-menu">Dashboard </span>
                <span class="badge badge-pill badge-info ml-auto m-r-15"></span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="?page=hor" aria-expanded="false">
                <i class="mdi mdi-content-paste"></i>
                <span class="hide-menu">Order Rental</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a href="?page=hos" class="sidebar-link">
                <i class="mdi mdi-crop"></i>
                <span class="hide-menu"> Servis Sparepart</span>
              </a>
            </li>
             <li class="sidebar-item">
              <a href="?page=ho" class="sidebar-link">
                <i class="mdi mdi-crosshairs-gps"></i>
                <span class="hide-menu"> Servis Oli</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <div class="page-wrapper">
      <?php
      include('../koneksi.php');

      @$page = $_GET['page'];
      $validpage = array("hor","hos","ho");
      if (in_array($page, $validpage)){
        include "page/".$page.".php";
      }else{
        include "page/home.php";
      }
      ?>
      <footer class="footer text-center">
        Muhammad Satrio Nugroho
        <a target="_blank" href="https://www.facebook.com/msatrio.nugroho.5"><i class="mdi mdi-facebook"></i></a>.
      </footer>
    </div>
  </div>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- apps -->
  <script src="../dist/js/app.min.js"></script>
  <script src="../dist/js/app.init.mini-sidebar.js"></script>
  <script src="../dist/js/app-style-switcher.js"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
  <!--Wave Effects -->
  <script src="../dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="../dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="../dist/js/custom.min.js"></script>
  <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>
  <script src="../dist/js/pages/datatable/datatable-basic.init.js"></script>
  <script src="../assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

 </body>
</html>