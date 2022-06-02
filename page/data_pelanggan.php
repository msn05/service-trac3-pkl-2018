      <script type="text/javascript">
        <?php
        $sql = false;  error_reporting(0);

        // PROSES TAMBAH EDIT DAN HAPUS DALAM BENTUK PERCABANGAN
        if (@$_GET['act'] == 'tambahpum' && !empty($_POST['kustom_id'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $kustom_id    = $mysqli->escape_string($_POST['kustom_id']);
          $kustom_nama  = $mysqli->escape_string($_POST['kustom_nama']);
          $no_ktp       = $mysqli->escape_string($_POST['no_ktp']);
          $alamat       = $mysqli->escape_string($_POST['alamat']);
          $kustom_jk    = $mysqli->escape_string($_POST['kustom_jk']);
          $kustom_hp    = $mysqli->escape_string($_POST['kustom_hp']);
          $email        = $mysqli->escape_string($_POST['email']);
          $status        = $mysqli->escape_string($_POST['status']);

          $sql      = $mysqli->query("INSERT INTO kustom(kustom_id,kustom_nama,no_ktp, alamat,kustom_jk,kustom_hp,email,status) VALUES('$kustom_id','$kustom_nama','$no_ktp', '$alamat','$kustom_jk','$kustom_hp','$email','Masyarakat')");
          if ($sql){
            echo 'alert("Data Berhasil Disimpan");';
          }
        }else if (@$_GET['act'] == 'tambahp' && !empty($_POST['kustom_id'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $kustom_id 	  = $mysqli->escape_string($_POST['kustom_id']);
          $kustom_nama  = $mysqli->escape_string($_POST['kustom_nama']);
          $alamat   		= $mysqli->escape_string($_POST['alamat']);
          $kustom_hp    = $mysqli->escape_string($_POST['kustom_hp']);
          $email        = $mysqli->escape_string($_POST['email']);
          $no_ktp       = $mysqli->escape_string($_POST['no_ktp']);
          $kustom_jk    = $mysqli->escape_string($_POST['kustom_jk']);
          $status  	    = $mysqli->escape_string($_POST['status']);

          $sql      = $mysqli->query("INSERT INTO kustom(kustom_id,kustom_nama,no_ktp,alamat,kustom_jk,kustom_hp,email,status) VALUES('$kustom_id','$kustom_nama','-','$alamat','-','$kustom_hp','$email','Perusahaan')");
          if ($sql){
            echo 'alert("Data Berhasil Disimpan");';
          }
        } else if (@$_GET['act'] == 'edit' && !empty($_POST['kustom_id'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
         	$kustom_id 				= $mysqli->escape_string($_POST['kustom_id']);
          $kustom_nama   		= $mysqli->escape_string($_POST['kustom_nama']);
          $alamat   	      = $mysqli->escape_string($_POST['alamat']);
          $kustom_hp        = $mysqli->escape_string($_POST['kustom_hp']);
          $email  	        = $mysqli->escape_string($_POST['email']);

          $sql      = $mysqli->query("UPDATE `kustom` SET 
          																	 `kustom_nama` = '$kustom_nama',
          																	 `alamat`      = '$alamat' , 
                                             `email` 	     = '$email' ,
          																	 `kustom_hp`   = '$kustom_hp' 
                                             WHERE kustom_id='$kustom_id'");
          if ($sql){
            echo 'alert("Data Berhasil Diubah");';
          }
        } else if (@$_GET['act'] == 'delete' && !empty($_GET['id'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $kustom_id = $mysqli->escape_string($_GET['id']);
          $sql      = $mysqli->query("DELETE FROM kustom WHERE kustom_id='$kustom_id'");
          if ($sql){
            echo 'alert("Data Telah Terhapus");';
          }
        }
        ?>
        $(document).on("click", "#form_edit", function(){
          var kustom_id 	= $(this).data('kustom_id');
          var kustom_nama = $(this).data('kustom_nama');
          var no_ktp 			= $(this).data('no_ktp');
          var alamat 			= $(this).data('alamat');
          var kustom_jk   = $(this).data('kustom_jk');
          var kustom_hp   = $(this).data('kustom_hp');
          var email       = $(this).data('email');
          var status 			= $(this).data('status');
          $(" #edit #kustom_id").val(kustom_id);
          $(" #edit #kustom_nama").val(kustom_nama);
          $(" #edit #no_ktp").val(no_ktp);
          $(" #edit #alamat").val(alamat);
          $(" #edit #kustom_jk").val(kustom_jk);
          $(" #edit #kustom_hp").val(kustom_hp);
          $(" #edit #email").val(email);
          $(" #edit #status").val(status);
        });
        function exportpdf(){
          document.location='ep.php';
        }
        href=""
      </script>

      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Data Pelanggan</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
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
                <button onclick="exportpdf()" type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-file-excel"></i> Export Excel</button>
                <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#tambahpum">
                  <i class="fa fa-plus"></i> Tambah Pelanggan ( Masyarakat )
                </button>
                <br><br>
                <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#tambahp">
                  <i class="fa fa-plus"></i> Tambah Pelanggan ( Perusahaan )
                </button>
                <br><br>
                <div class="table-responsive">
                  <table id="zero_config" class="table table-striped table-bordered">
                    <thead align="center">
                      <tr>
                        <th width="25px">No.</th>
                        <th width="25px">Kode Pelanggan</th>
                        <th width="30pc">Nama Pelanggan / Nama Perusahaan</th>
                        <th width="25px">Jenis Kelamin</th>
                        <th >Nomor Ktp</th>
                        <th>Alamat</th>
                        <th>No Telephone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th width="100px">Action</th>
                      </tr>
                    </thead>
                    <tbody align="center">
                      <?php
                      $tampil=$mysqli->query("SELECT * FROM kustom");
                      $no = 1;
                      while ($data=$tampil->fetch_object()){
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->kustom_id ?></td>    
                        <td><?= $data->kustom_nama ?></td>
                        <td><?= $data->kustom_jk ?></td>
                        <td><?= $data->no_ktp ?></td>
                        <td><?= $data->alamat ?></td>
                        <td><?= $data->kustom_hp ?></td>
                        <td><?= $data->email ?></td>
                        <td><?= $data->status ?></td>
                        <td>
                          <a id="form_edit" data-toggle="modal" data-target="#edit"
                            data-kustom_id="<?= $data->kustom_id ?>"
                            data-kustom_nama="<?= $data->kustom_nama ?>"
                            data-no_ktp="<?= $data->no_ktp ?>"
                            data-alamat="<?= $data->alamat ?>"
                            data-kustom_jk="<?= $data->kustom_jk ?>"
                            data-kustom_hp="<?= $data->kustom_hp ?>"
                            data-email="<?= $data->email ?>"
                            data-status="<?= $data->status ?>"
                             class="btn btn-warning" title="Edit">
                          <i class="mdi mdi-pencil"></i></a>
                          <a href="?page=data_pelanggan&act=delete&id=<?= $data->kustom_id?>" onclick="return confirm('Apakah anda yakin akan menghapusnya?');" class="btn btn-danger" title="Hapus">
                            <i class="mdi mdi-delete" aria-hidden="true"></i>
                          </a>
                        </td>
                      </tr>
                      <?php  } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- START MODAL UNTUK TAMBAH -->
      <div id="tambahpum" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Tambah Pelanggan ( Masyarakat )</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=data_pelanggan&act=tambahpum" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <?php
                  $sql = $mysqli->query("SELECT * FROM kustom");

                  // IF INLINE { GOOGLING KALAU BELUM TAHU }
                  $sql->num_rows <> 0 ? $kode = $sql->num_rows + 1 : $kode = 1;
                  
                  $bikin_kode = str_pad($kode, 2, "0", STR_PAD_LEFT);
                  $tahun = date('Ym');
                  $kode_jadi = "KP$tahun$bikin_kode";
                  ?>
                  <label class="control-label" for="kode_kustom">Kode Perusahaan</label>
                  <input type="text" class="form-control" id="kustom_id" name="kustom_id" value="<?= $kode_jadi ?>" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="kustom_nama">Nama Pelanggan</label>
                  <input type="text" name="kustom_nama" placeholder="Masukkan Nama" class="form-control" id="kustom_nama" pattern="[A-Za-z- ]+" title="Huruf Bae" required />
                </div>  
                 <div class="form-group">
                  <label class="control-label" for="kustom_jk">Jenis Kelamin</label>
                    <select name="kustom_jk" id="kustom_jk" class = "form-control"> 
                      <option value = "-"> -</option>
                      <option value = "Laki-Laki"> Laki-Laki</option>
                      <option value = "Perempuan"> Perempuan </option>
                    </select>
                </div>  
                <div class="form-group">
                  <label class="control-label" for="kustom_nama">Nomor Ktp</label>
                  <input type="text" name="no_ktp" placeholder="Masukkan Nama" class="form-control" value="" id="no_ktp" required title="16  Hanya Angka" pattern="[0-9]{16,16}" maxlength="16" />
                </div>  
                <div class="form-group">
                  <label class="control-label" for="alamat_mnk">alamat</label>
                  <input type="text" name="alamat" placeholder="Masukkan alamat" class="form-control" id="alamat" required="">
                </div>  
                <div class="form-group">
                  <label class="control-label" for="kustom_hp">Nomor Telephone</label>
                  <input type="text" name="kustom_hp" placeholder="Masukkan Nomor Telephone" class="form-control" id="kustom_hp" required title="11 atau 14  Hanya Angka" pattern="[0-9]{11,14}"  minlength="11" />
                </div>
                <div class="form-group">
                  <label class="control-label" for="kustom_hp">Email</label>
                  <input type="text" name="email" placeholder="Masukkan Nomor Telephone" class="form-control" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="xyz@something.com" required />
                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-danger">Reset</button>
                  <input type="submit" class="btn btn-success" value="Simpan"> 
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div id="tambahp" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Tambah Pelanggan ( Perusahaan )</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=data_pelanggan&act=tambahp" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <?php
                  $sql = $mysqli->query("SELECT * FROM kustom");

                  // IF INLINE { GOOGLING KALAU BELUM TAHU }
                  $sql->num_rows <> 0 ? $kode = $sql->num_rows + 1 : $kode = 1;
                  
                  $bikin_kode = str_pad($kode, 2, "0", STR_PAD_LEFT);
                  $tahun = date('Ym');
                  $kode_jadi = "KP$tahun$bikin_kode";
                  ?>
                  <label class="control-label" for="kode_kustom">Kode Perusahaan</label>
                  <input type="text" class="form-control" id="kustom_id" name="kustom_id" value="<?= $kode_jadi ?>" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="kustom_nama">Nama Pelanggan</label>
                  <input type="text" name="kustom_nama" placeholder="Masukkan Nama" class="form-control" id="kustom_nama" required="">               
                </div>  
                <div class="form-group">
                  <label class="control-label" for="alamat_mnk">alamat</label>
                  <input type="text" name="alamat" placeholder="Masukkan alamat" class="form-control" id="alamat" required="">
                </div>  
                <div class="form-group">
                  <label class="control-label" for="kustom_hp">Nomor Telephone</label>
                  <input type="number" name="kustom_hp" placeholder="Masukkan Nomor Telephone" class="form-control" id="kustom_hp" required="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="kustom_hp">Email</label>
                  <input type="text" name="email" placeholder="Masukkan Nomor Telephone" class="form-control" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="xyz@something.com" required />
                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-danger">Reset</button>
                  <input type="submit" class="btn btn-success" value="Simpan"> 
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- END MODAL UNTUK TAMBAH -->
      <!-- START MODAL UNTUK EDIT -->
        <div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Edit Data Pelanggan</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=data_pelanggan&act=edit" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label class="control-label" for="id">Kode Mekanik</label>
                  <input type="hidden" class="form-control" id="kustom_id" name="kustom_id" value="" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="kustom_nama">Nama Pelanggan</label>
                  <input type="text" name="kustom_nama" placeholder="Masukkan Nama" class="form-control" id="kustom_nama" required="">
                </div>  
                 <div class="form-group">
                  <label class="control-label" for="kustom_jk">Jenis Kelamin</label>
                    <select name="kustom_jk" id="kustom_jk" class = "form-control" value="-"> 
                      <option value = "Laki-Laki" <?php if(isset($_GET['sql'])){if ($data ['kustom_jk']=="Laki - laki"){echo "selected=selected"; }} ?>> Laki-Laki</option>
                      <option value = "Perempuan" <?php if(isset($_GET['sql'])){if ($data ['kustom_jk']=="Perempuan"){echo "selected=selected"; }} ?>> Perempuan </option>
                    </select>
                </div>  
                <div class="form-group">
                  <label class="control-label" for="kustom_nama">Nomor Ktp</label>
                  <input type="text" name="no_ktp" placeholder="Masukkan Nama" class="form-control" id="no_ktp" required="">
                </div>  
                <div class="form-group">
                  <label class="control-label" for="alamat_mnk">alamat</label>
                  <input type="text" name="alamat" placeholder="Masukkan alamat" class="form-control" id="alamat" required="">
                </div>  
                <div class="form-group">
                  <label class="control-label" for="kustom_hp">Nomor Telephone</label>
                  <input type="number" name="kustom_hp" placeholder="Masukkan Nomor Telephone" class="form-control" id="kustom_hp" required="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="kustom_hp">Email</label>
                  <input type="text" name="email" placeholder="Masukkan Nomor Telephone" class="form-control" id="email" required="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="kustom_hp">Status Pelanggan</label>
                  <input type="text" name="status" class="form-control" id="status" readonly="">
                </div>
                 <div class="modal-footer">
                  <button type="cancel" class="btn btn-danger">cancel</button>
                  <input type="submit" class="btn btn-success" value="Simpan"> 
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- END MODAL UNTUK EDIT -->
