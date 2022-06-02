      <script type="text/javascript">
        <?php
        $sql = false;  
         error_reporting(0);
        // PROSES TAMBAH EDIT DAN HAPUS DALAM BENTUK PERCABANGAN
        if (@$_GET['act'] == 'tambah' && !empty($_POST['id'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id 			= $mysqli->escape_string($_POST['id']);
          $karyawan   	= $mysqli->escape_string($_POST['karyawan']);
          $jk    		= $mysqli->escape_string($_POST['jk']);
          $alamat   	= $mysqli->escape_string($_POST['alamat']);
          $no_telphone  = $mysqli->escape_string($_POST['no_telphone']);

          $sql      = $mysqli->query("INSERT INTO data_karyawan(id,karyawan,jk,alamat,no_telphone) VALUES('$id','$karyawan','$jk','$alamat','$no_telphone')");
          if ($sql){
            echo 'alert("Data Berhasil Disimpan");';
          }
        } else if (@$_GET['act'] == 'edit' && !empty($_POST['id'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id 					= $mysqli->escape_string($_POST['id']);
          $karyawan    	= $mysqli->escape_string($_POST['karyawan']);
          $jk    				= $mysqli->escape_string($_POST['jk']);
          $alamat   		= $mysqli->escape_string($_POST['alamat']);
          $no_telphone  = $mysqli->escape_string($_POST['no_telphone']);

          $sql      = $mysqli->query("UPDATE `data_karyawan` SET 
          																	 `karyawan` 		= '$karyawan',
          																	 `jk` 					= '$jk' ,
          																	 `alamat` 			= '$alamat' ,
          																	 `no_telphone` 	= '$no_telphone' WHERE id='$id'");
          if ($sql){
            echo 'alert("Data Berhasil Diubah");';
          }
        } else if (@$_GET['act'] == 'delete' && !empty($_GET['id'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id = $mysqli->escape_string($_GET['id']);
          $sql      = $mysqli->query("DELETE FROM data_karyawan WHERE id='$id'");
          if ($sql){
            echo 'alert("Data Telah Terhapus");';
          }
        }
        ?>
        $(document).on("click", "#form_edit", function(){
          var id 					= $(this).data('id');
          var karyawan 		= $(this).data('karyawan');
          var jk 					= $(this).data('jk');
          var alamat 			= $(this).data('alamat');
          var no_telphone = $(this).data('no_telphone');
          $(" #edit #id").val(id);
          $(" #edit #karyawan").val(karyawan);
          $(" #edit #jk").val(jk);
          $(" #edit #alamat").val(alamat);
          $(" #edit #no_telphone").val(no_telphone);
        });
        function exportpdf(){
          document.location='export_karyawan.php';
        }
        href=""
      </script>

      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Data karyawan</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">karyawan</li>
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
                  <i class="fa fa-plus"></i> Tambah karyawan
                </button>
                <br><br>
                <div class="table-responsive">
                  <table id="zero_config" class="table table-striped table-bordered">
                    <thead align="center">
                      <tr>
                        <th width="25px">No.</th>
                        <th width="25px">Kode Karyawan</th>
                        <th>Nama Karyawan</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No Telephone</th>
                        <th width="100px">Action</th>
                      </tr>
                    </thead>
                    <tbody align="center">
                      <?php
                      $tampil=$mysqli->query("SELECT * FROM data_karyawan ORDER BY id DESC");
                      $no = 1;
                      while ($data=$tampil->fetch_object()){
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->id ?></td>    
                        <td><?= $data->karyawan ?></td>
                        <td><?= $data->jk ?></td>
                        <td><?= $data->alamat ?></td>
                        <td><?= $data->no_telphone ?></td>
                        <td>
                          <a id="form_edit" data-toggle="modal" data-target="#edit"
                            data-id="<?= $data->id ?>"
                            data-karyawan="<?= $data->karyawan ?>"
                            data-jk="<?= $data->jk ?>"
                            data-alamat="<?= $data->alamat ?>"
                            data-no_telphone="<?= $data->no_telphone ?>"
                             class="btn btn-warning" title="Edit">
                          <i class="mdi mdi-pencil"></i></a>
                          <a href="?page=data_karyawan&act=delete&id=<?= $data->id?>" onclick="return confirm('Apakah anda yakin akan menghapusnya?');" class="btn btn-danger" title="Hapus">
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
              <h4 class="modal-title"> Tambah Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=data_karyawan&act=tambah" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <?php
                  $sql = $mysqli->query("SELECT * FROM data_karyawan");

                  // IF INLINE { GOOGLING KALAU BELUM TAHU }
                  $sql->num_rows <> 0 ? $kode = $sql->num_rows + 1 : $kode = 1;
                  
                  $bikin_kode = str_pad($kode, 2, "0", STR_PAD_LEFT);
                  $tahun = date('Ym');
                  $kode_jadi = "KKT$tahun$bikin_kode";
                  ?>
                  <label class="control-label" for="id">Kode karyawan</label>
                  <input type="text" class="form-control" id="id" name="id" value="<?= $kode_jadi ?>" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="karyawan">Nama karyawan</label>
                  <input type="text" name="karyawan" placeholder="Masukkan Nama karyawan" class="form-control" id="karyawan" pattern="[A-Za-z- ]+" title="Huruf Bae" required />
                </div>  
                <div class="form-group">
                  <label class="control-label" for="jk">Jenis Kelamin</label>
                  	<select name="jk" id="jk" class = "form-control"> 
											<option value = "Laki-Laki"> Laki-Laki</option>
											<option value = "Perempuan"> Perempuan </option>
										</select>
                </div>  
                <div class="form-group">
                  <label class="control-label" for="alamat">Alamat</label>
                  <input type="text" name="alamat" placeholder="Masukkan Alamat" class="form-control" id="alamat" required="">
                </div>  
                <div class="form-group">
                  <label class="control-label" for="no_telphone">Nomor Telephone</label>
                  <input type="text" name="no_telphone" placeholder="Masukkan Nomor Telephone" class="form-control" id="no_telphone" required title="11 atau 14  Hanya Angka" pattern="[0-9]{11,14}"  minlength="11" />
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
            <form action="?page=data_karyawan&act=edit" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label class="control-label" for="id">Kode Karyawan</label>
                  <input type="text" class="form-control" id="id" name="id" value="" required="" readonly="">
                </div>
               <div class="form-group">
                  <label class="control-label" for="karyawan">Nama karyawan</label>
                  <input type="text" name="karyawan"  class="form-control" id="karyawan" required="">
                </div>  
               <div class="form-group">
               	<label class="control-label" for="jk">Jenis Kelamin</label>
                	<select name="jk" id="jk" class = "form-control"> 
										<option value = "Laki-Laki" <?php if(isset($_GET['sql'])){if ($data ['jk']=="Laki - laki"){echo "selected=selected"; }}?>> Laki-Laki</option>
										<option value = "Perempuan" <?php if(isset($_GET['sql'])){if ($data ['jk']=="Perempuan"){echo "selected=selected"; }}?>> Perempuan </option>
									</select>
               </div>  
               <div class="form-group">
                <label class="control-label" for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" id="alamat" required="">
               </div>  
               <div class="form-group">
                <label class="control-label" for="no_telphone">Nomor Telephone</label>
                <input type="number" name="no_telphone"  class="form-control" id="no_telphone" required="">
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
