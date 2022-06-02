    <script type="text/javascript">

      <?php
      include('koneksi.php');
        $sql=$mysqli->query("select * from users where username='".$_SESSION['username']."'");
           $tampil = $sql->fetch_assoc();
           $nama      = $tampil['nama'];
           $username  = $tampil['username'];

           if($_SESSION['level']);
                if (isset($_POST['simpan'])){
                $nama = $_POST['nama'];
                $password     = $mysqli->escape_string($_POST['password']);
                $username     = $mysqli->escape_string($_POST['username']);
                $id_karyawan  = $mysqli->escape_string($_POST['id_karyawan']);
                $sql=$mysqli->query("UPDATE users SET nama='$nama',username='$username',password=md5('$_POST[password]') where username='".$_SESSION['username']."'");
                 if ($sql){
                   echo 'alert("Data Berhasil Disimpan");';
              }
            }
      ?>

      window.onload = function () {
      document.getElementById("password1").onchange = validatePassword;
      document.getElementById("password2").onchange = validatePassword;
      }
        function validatePassword(){
        var pass2=document.getElementById("password2").value;
        var pass1=document.getElementById("password1").value;
          if(pass1!=pass2)
          document.getElementById("password2").setCustomValidity("Passwords Tidak Sama");
          else
          document.getElementById("password2").setCustomValidity('');}
    </script>

      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Profile</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Proflie</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <br><br>
                <form class="form-horizontal" method="post" >
                  <div class="form-group row">
                    <label for="id_mobil" class="col-sm-3 text-right control-label col-form-label">Username</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="username" id="username"  value="<?= $username; ?>" required="" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="no_polisi" class="col-sm-3 text-right control-label col-form-label">Nama </label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="nama" id="nama" value="<?=$nama;?>" required="" >
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Password</label>
                    <div class="col-sm-5">
                      <input type="password" id="password1"class="form-control"  name="password" value="">
                      <a class="text-red">*ubah password secara berkala demi menjaga keamanan</a>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-9">
                      <input type="password" id="password2"class="form-control" required="required">
                    </div>
                  </div>
                  <div class="modal-footer">
                  <a href="javascript:history.back()" class="btn btn-info mdi mdi-keyboard-backspace"></i></a> 
                <input type="submit" class="btn btn-success" value="Simpan" name="simpan"> 
               </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
