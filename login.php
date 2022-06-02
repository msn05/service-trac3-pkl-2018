<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo3.png">
    <title>TRAC ASTRA PALEMBANG</title>
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>
<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="assets/images/logo3.png" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Sign In to Admin</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20"  action="" method="POST">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="username"><i class="ti-user"></i></span>
                                    </div>
                                    <input class="form-control form-control-lg" type="text" name="username" value="Username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="password"><i class="ti-pencil"></i></span>
                                    </div>
                                   <input class="form-control form-control-lg" type="password" name="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
                                </div>
                                    <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button class="btn btn-block btn-lg btn-info" name="login" type="submit">Log In</button>
                                    </div>
                                </div>
                                <div class="row">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    </script>
</body>
</html>
<?php 
error_reporting(0);
    session_start(); 
    include ("koneksi.php");
     if (isset($_POST['login'])) {
          $username = $_POST['username'];
          $password = md5($_POST['password']);

          $sql = $mysqli->query("select * from users where username='$username' and password='$password'");

          $data = $sql->fetch_assoc();

          $ketemu = $sql->num_rows;

          if ($ketemu >=1) {
              session_start();
              
              $_SESSION['id_karyawan'] = $data['id_karyawan'];
              $_SESSION['username'] = $data['username'];
              $_SESSION['nama'] = $data['nama'];
              $_SESSION['level'] = $data['level'];

                  header("location:index.php");
          } else {


        echo "<script>alert('Login Gagal ! Periksa Kembali Username dan Password Anda. Terimakasih.'); location.href='index.php';</script>";    
        }
    }
?>