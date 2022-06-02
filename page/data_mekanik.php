      <script type="text/javascript">
        <?php
        $sql = false; 
         error_reporting(0);
        // PROSES TAMBAH EDIT DAN HAPUS DALAM BENTUK PERCABANGAN
        if (@$_GET['act'] == 'tambah' && !empty($_POST['id_mnk'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id_mnk         = $mysqli->escape_string($_POST['id_mnk']);
          $nama_mnk   		= $mysqli->escape_string($_POST['nama_mnk']);
          $alamat_mnk   	= $mysqli->escape_string($_POST['alamat_mnk']);
          $no_telephone  	= $mysqli->escape_string($_POST['no_telephone']);

          $sql      = $mysqli->query("INSERT INTO tbl_mekanik(id_mnk,nama_mnk,alamat_mnk,no_telephone) VALUES('$id_mnk','$nama_mnk','$alamat_mnk','$no_telephone')");
          if ($sql){
            echo 'alert("Data Berhasil Disimpan");';
          }
        } else if (@$_GET['act'] == 'edit' && !empty($_POST['id_mnk'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
         	$id_mnk 				= $mysqli->escape_string($_POST['id_mnk']);
          $nama_mnk   		= $mysqli->escape_string($_POST['nama_mnk']);
          $alamat_mnk   	= $mysqli->escape_string($_POST['alamat_mnk']);
          $no_telephone  	= $mysqli->escape_string($_POST['no_telephone']);

          $sql      = $mysqli->query("UPDATE `tbl_mekanik` SET 
          																	 `nama_mnk` 		= '$nama_mnk',
          																	 `alamat_mnk` 	= '$alamat_mnk' ,
          																	 `no_telephone` = '$no_telephone' WHERE id_mnk='$id_mnk'");
          if ($sql){
            echo 'alert("Data Berhasil Diubah");';
          }
        } else if (@$_GET['act'] == 'delete' && !empty($_GET['id'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id_mnk = $mysqli->escape_string($_GET['id']);
          $sql      = $mysqli->query("DELETE FROM tbl_mekanik WHERE id_mnk='$id_mnk'");
          if ($sql){
            echo 'alert("Data Telah Terhapus");';
          }
        }
        ?>
        $(document).on("click", "#form_edit", function(){
          var id_mnk 						= $(this).data('id_mnk');
          var nama_mnk 					= $(this).data('nama_mnk');
          var alamat_mnk 				= $(this).data('alamat_mnk');
          var no_telephone 			= $(this).data('no_telephone');
          $(" #edit #id_mnk").val(id_mnk);
          $(" #edit #nama_mnk").val(nama_mnk);
          $(" #edit #alamat_mnk").val(alamat_mnk);
          $(" #edit #no_telephone").val(no_telephone);
        });
        function exportpdf(){
          document.location='emnk.php';
        }
        href=""
      </script>

      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Data Mekanik</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Mekanik</li>
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
                <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#tambah">
                  <i class="fa fa-plus"></i> Tambah Mekanik
                </button>
                <br><br>
                <div class="table-responsive">
                  <table id="zero_config" class="table table-striped table-bordered">
                    <thead align="center">
                      <tr>
                        <th width="25px">No.</th>
                        <th width="25px">Kode Mekanik</th>
                        <th>Nama Mekanik</th>
                        <th>Alamat Email</th>
                        <th>No Telephone</th>
                        <th width="100px">Action</th>
                      </tr>
                    </thead>
                    <tbody align="center">
                      <?php
                      $tampil=$mysqli->query("SELECT * FROM tbl_mekanik ORDER BY id_mnk DESC");
                      $no = 1;
                      while ($data=$tampil->fetch_object()){
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->id_mnk ?></td>    
                        <td><?= $data->nama_mnk ?></td>
                        <td><?= $data->alamat_mnk ?></td>
                        <td><?= $data->no_telephone ?></td>
                        <td>
                          <a id="form_edit" data-toggle="modal" data-target="#edit"
                            data-id_mnk="<?= $data->id_mnk ?>"
                            data-nama_mnk="<?= $data->nama_mnk ?>"
                            data-alamat_mnk="<?= $data->alamat_mnk ?>"
                            data-no_telephone="<?= $data->no_telephone ?>"
                             class="btn btn-warning" title="Edit">
                          <i class="mdi mdi-pencil"></i></a>
                          <a href="?page=data_mekanik&act=delete&id=<?= $data->id_mnk?>" onclick="return confirm('Apakah anda yakin akan menghapusnya?');" class="btn btn-danger" title="Hapus">
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
      <div id="tambah" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Tambah Mekanik</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=data_mekanik&act=tambah" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <?php
                  $sql = $mysqli->query("SELECT * FROM tbl_mekanik");

                  // IF INLINE { GOOGLING KALAU BELUM TAHU }
                  $sql->num_rows <> 0 ? $kode = $sql->num_rows + 1 : $kode = 1;
                  
                  $bikin_kode = str_pad($kode, 2, "0", STR_PAD_LEFT);
                  $tahun = date('Ym');
                  $kode_jadi = "KM$tahun$bikin_kode";
                  ?>
                  <label class="control-label" for="id_mnk">Kode Mekanik</label>
                  <input type="text" class="form-control" id="id_mnk" name="id_mnk" value="<?= $kode_jadi ?>" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="nama_mnk">Nama Mekanik</label>
                  <input type="text" name="nama_mnk" placeholder="Masukkan Nama" class="form-control" id="nama_mnk" pattern="[A-Za-z- ]+" title="Huruf Bae" required />
                </div>  
                <div class="form-group">
                  <label class="control-label" for="alamat_mnk">alamat</label>
                  <input type="text" name="alamat_mnk" placeholder="Masukkan alamat" class="form-control" id="alamat_mnk" required="">
                </div>  
                <div class="form-group">
                  <label class="control-label" for="no_telephone">Nomor Telephone</label>
                  <input type="text" name="no_telephone" placeholder="Masukkan Nomor Telephone" class="form-control" id="no_telephone" required title="11 atau 14  Hanya Angka" pattern="[0-9]{11,14}"  minlength="11" />
                </div>
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
              <h4 class="modal-title"> Edit Data Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=data_mekanik&act=edit" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label class="control-label" for="id">Kode Mekanik</label>
                  <input type="text" class="form-control" id="id_mnk" name="id_mnk" value="" required="" readonly="">
                </div>
               <div class="form-group">
                  <label class="control-label" for="nama_mnk">Nama Mekanik</label>
                  <input type="text" name="nama_mnk" placeholder="Masukkan Nama" class="form-control" id="nama_mnk" required="">
                </div>    
               <div class="form-group">
                  <label class="control-label" for="alamat_mnk">alamat email</label>
                  <input type="text" name="alamat_mnk" placeholder="Masukkan alamat" class="form-control" id="alamat_mnk" required="">
               </div>  
               <div class="form-group">
                  <label class="control-label" for="no_telephone">Nomor Telephone</label>
                  <input type="number" name="no_telephone" placeholder="Masukkan Nomor Telephone" class="form-control" id="no_telephone" required="">
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
      <!-- END MODAL UNTUK EDIT -->
