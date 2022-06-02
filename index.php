<?php 
error_reporting(0);
session_start(); 

  if (@$_SESSION['level']) {?>


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
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo.png">
  <title>TRAC ASTRA PALEMBANG</title>
  <link rel="stylesheet" type="text/css" href="assets/libs/select2/dist/css/select2.min.css">
  <link href="dist/css/style.min.css" rel="stylesheet">
  
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
 </head>
 <link rel="stylesheet" type="text/css" href="assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <script src="assets/libs/select2/dist/js/select2.min.js"></script>
  <script src="dist/js/pages/forms/select2/select2.init.js"></script>
  <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

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
                <img src="assets/images/logo2.png" alt="homepage" class="dark-logo" />
              </b>
              <span class="logo-text">
                <img src="assets/images/logo2.png" class="light-logo" alt="homepage" />
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
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
          <ul class="navbar-nav float-left mr-auto"></ul>
          <ul class="navbar-nav float-right">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="ti-user" alt="user" class="rounded-circle" width="40"></i>
                <span class="m-l-5 font-medium d-none d-sm-inline-block"><?=$_SESSION['username']?><i class="mdi mdi-chevron-down"></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                <span class="with-arrow">
                  <span class="bg-primary"></span>
                </span>
                <div class="profile-dis scrollable">
                  <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="?page=profile">
                      <i class="ti-settings m-r-5 m-l-5"></i>Profile
                    </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="logout.php">
                  <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                  <div class="dropdown-divider"></div>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <?php if ($_SESSION ['level']=="admin") {
     ?>
    <aside class="left-sidebar">
      <div class="scroll-sidebar">
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <!-- <li class="nav-small-cap">
              <i class="mdi mdi-dots-horizontal"></i>
              <span class="hide-menu">Home</span>
            </li> -->
            <li class="sidebar-item">
              <a href="?page=dashboard" class="sidebar-link">
                <i class="mdi mdi-av-timer"></i>
                <span class="hide-menu">Dashboard </span>
                <span class="badge badge-pill badge-info ml-auto m-r-15"></span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi-view-list"></i>
                <span class="hide-menu">Data Pabarikan </span>
              </a>
              <ul aria-expanded="false" class="collapse  first-level">
                <li class="sidebar-item">
                  <a href="?page=brand" class="sidebar-link">
                    <i class="mdi-source-branch"></i>
                    <span class="hide-menu">Brand </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="?page=tipe" class="sidebar-link">
                    <i class="mdi-source-branch"></i>
                    <span class="hide-menu"> Tipe </span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-file-document-box"></i>
                <span class="hide-menu">Aseet</span>
              </a>
              <ul aria-expanded="false" class="collapse  first-level">
                <li class="sidebar-item">
                  <a href="?page=data_karyawan" class="sidebar-link">
                    <i class="ti-user"></i>
                    <span class="hide-menu"> Data Karyawan</span>
                  </a>
                </li> 
                <li class="sidebar-item">
                  <a href="?page=data_mekanik" class="sidebar-link">
                    <i class="mdi mdi-seat-recline-normal"></i>
                    <span class="hide-menu"> Data Mekanik</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="?page=data_mobil" class="sidebar-link">
                    <i class="mdi mdi-car"></i>
                    <span class="hide-menu"> Data Mobil </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="?page=data_sparepart" class="sidebar-link">
                    <i class="mdi mdi-cart-outline"></i>
                    <span class="hide-menu"> Data SparePart </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="?page=data_oli" class="sidebar-link">
                    <i class="mdi mdi-car-battery"></i>
                    <span class="hide-menu"> Data Oli </span>
                  </a>
                </li>
              </ul>
            </li>
            <!-- <li class="nav-small-cap">
              <i class="mdi mdi-dots-horizontal"></i>
              <span class="hide-menu">Data Pelanggan</span>
            </li> -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="?page=data_pelanggan" aria-expanded="false">
                <i class="fas fa-users"></i>
                <span class="hide-menu">Pelanggan </span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="mdi mdi-dots-horizontal"></i>
              <span class="hide-menu">Data Order</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-collage"></i>
                <span class="hide-menu">Order Rental</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="?page=data_or" class="sidebar-link">
                    <i class="far fa-file"></i>
                    <span class="hide-menu">Data Order Rental</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="?page=pengambilan" class="sidebar-link">
                    <i class="far fa-caret-square-right"></i>
                    <span class="hide-menu">Pengambilan Mobil</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="?page=pengembalian" class="sidebar-link">
                    <i class="far fa-caret-square-left"></i>
                    <span class="hide-menu">Pengembalian Mobil</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                    <i class="mdi mdi-collage"></i>
                    <span class="hide-menu">Order Servis</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                        <a href="?page=data_os" class="sidebar-link">
                            <i class="mdi mdi-vector-difference-ba"></i>
                            <span class="hide-menu"> Spare Part</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=data_o" class="sidebar-link">
                            <i class="mdi mdi-file-document-box"></i>
                            <span class="hide-menu"> Oli</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-code-equal"></i>
                <span class="hide-menu">Histori Order</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="?page=hor" class="sidebar-link">
                    <i class="mdi mdi-export"></i>
                    <span class="hide-menu"> Rental</span>
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
            </li>
            <li class="nav-small-cap">
              <i class="mdi mdi-dots-horizontal"></i>
              <span class="hide-menu"> --</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="?page=laporan" aria-expanded="false">
                <i class="mdi mdi-content-paste"></i>
                <span class="hide-menu">Laporan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="logout.php" aria-expanded="false">
                <i class="mdi mdi-directions"></i>
                <span class="hide-menu">Log Out</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <?php }?> 
    <?php if ($_SESSION ['level']=="pimpinan") {
     ?>
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
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi-view-list"></i>
                <span class="hide-menu">Data Pabarikan </span>
              </a>
              <ul aria-expanded="false" class="collapse  first-level">
                <li class="sidebar-item">
                  <a href="?page=brand" class="sidebar-link">
                    <i class="mdi-source-branch"></i>
                    <span class="hide-menu">Brand </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="?page=tipe" class="sidebar-link">
                    <i class="mdi-source-branch"></i>
                    <span class="hide-menu"> Tipe </span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-file-document-box"></i>
                <span class="hide-menu">Aseet</span>
              </a>
              <ul aria-expanded="false" class="collapse  first-level">
                <li class="sidebar-item">
                  <a href="?page=data_karyawan" class="sidebar-link">
                    <i class="ti-user"></i>
                    <span class="hide-menu"> Data Karyawan</span>
                  </a>
                </li> 
                <li class="sidebar-item">
                  <a href="?page=data_mekanik" class="sidebar-link">
                    <i class="mdi mdi-seat-recline-normal"></i>
                    <span class="hide-menu"> Data Mekanik</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="?page=data_mobil" class="sidebar-link">
                    <i class="mdi mdi-car"></i>
                    <span class="hide-menu"> Data Mobil </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="?page=data_sparepart" class="sidebar-link">
                    <i class="mdi mdi-cart-outline"></i>
                    <span class="hide-menu"> Data SparePart </span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="?page=data_oli" class="sidebar-link">
                    <i class="mdi mdi-car-battery"></i>
                    <span class="hide-menu"> Data Oli </span>
                  </a>
                </li>
              </ul>
            </li>
            <!-- <li class="nav-small-cap">
              <i class="mdi mdi-dots-horizontal"></i>
              <span class="hide-menu">Data Pelanggan</span>
            </li> -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="?page=data_pelanggan" aria-expanded="false">
                <i class="fas fa-users"></i>
                <span class="hide-menu">Pelanggan </span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="mdi mdi-dots-horizontal"></i>
              <span class="hide-menu">Data Order</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                <i class="mdi mdi-collage"></i>
                <span class="hide-menu">Order Rental</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                  <a href="?page=data_or" class="sidebar-link">
                    <i class="far fa-file"></i>
                    <span class="hide-menu">Data Order Rental</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="?page=pengambilan" class="sidebar-link">
                    <i class="far fa-caret-square-right"></i>
                    <span class="hide-menu">Pengambilan Mobil</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="?page=pengembalian" class="sidebar-link">
                    <i class="far fa-caret-square-left"></i>
                    <span class="hide-menu">Pengembalian Mobil</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                    <i class="mdi mdi-collage"></i>
                    <span class="hide-menu">Order Servis</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                        <a href="?page=data_os" class="sidebar-link">
                            <i class="mdi mdi-vector-difference-ba"></i>
                            <span class="hide-menu"> Spare Part</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=data_o" class="sidebar-link">
                            <i class="mdi mdi-file-document-box"></i>
                            <span class="hide-menu"> Oli</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="?page=laporan" aria-expanded="false">
                <i class="mdi mdi-content-paste"></i>
                <span class="hide-menu">Laporan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark sidebar-link" href="logout.php" aria-expanded="false">
                <i class="mdi mdi-directions"></i>
                <span class="hide-menu">Log Out</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <?php }?>
    <div class="page-wrapper">
      <?php
      include('koneksi.php');

      @$page = $_GET['page'];
      $validpage = array("hitung","brand","tipe","data_karyawan","data_mekanik","data_mobil","data_pelanggan","ubah_mobil","data_sparepart","ubah_sparepart","data_oli","ubah_oli","data_or","pengambilan","pengembalian","data_os","data_o","hor","hos","ho","laporan","profile","data_orm","data_osp","data_osm");
      if (in_array($page, $validpage)){
        include "page/".$page.".php";
      } else {
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
  <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- apps -->
  <script src="dist/js/app.min.js"></script>
  <script src="dist/js/app.init.mini-sidebar.js"></script>
  <script src="dist/js/app-style-switcher.js"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="assets/extra-libs/sparkline/sparkline.js"></script>
  <!--Wave Effects -->
  <script src="dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <script src="dist/js/sidebarmenu.js"></script>
  <!--Custom JavaScript -->
  <script src="dist/js/custom.min.js"></script>
  <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
  <script src="dist/js/pages/datatable/datatable-basic.init.js"></script>
  <script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
    // Date Picker
    jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    </script>

 </body>
</html><?php } else { header("location:login.php"); } ?>