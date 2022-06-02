      <script type="text/javascript">
          
         
        <?php
        $sql = false;  error_reporting(0);

        // PROSES TAMBAH EDIT DAN HAPUS DALAM BENTUK PERCABANGAN
        if (@$_GET['act'] == 'tambah' && !empty($_POST['id_pgb'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id_pgb    = $mysqli->escape_string($_POST['id_pgb']);    
          $id_rental  = $mysqli->escape_string($_POST['id_rental']);
          $id         = $mysqli->escape_string($_POST['id']);
          $status    = $mysqli->escape_string($_POST['status']);

          $sql      = $mysqli->query("INSERT INTO pengembalian(id_pgb,id,id_rental,status) VALUES('$id_pgb','$id','$id_rental','$status')");
          if ($sql){
            echo 'alert("Data Berhasil Disimpan");';
          }
        // } else if (@$_GET['act'] == 'edit' && !empty($_POST['id_mobil'])) {
        //   // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
        //  	$id_mobil 				= $mysqli->escape_string($_POST['id_mobil']);
        //  	$no_polisi 			= $mysqli->escape_string($_POST['no_polisi']);
        //   $nama_mnk   		= $mysqli->escape_string($_POST['nama_mnk']);
        //   $alamat_mnk   	= $mysqli->escape_string($_POST['alamat_mnk']);
        //   $no_telephone  	= $mysqli->escape_string($_POST['no_telephone']);

        //   $sql      = $mysqli->query("UPDATE `tbl_mekanik` SET 
        //   																	 `nama_mnk` 		= '$nama_mnk',
        //   																	 `alamat_mnk` 	= '$alamat_mnk' ,
        //   																	 `no_telephone` = '$no_telephone' WHERE id_mnk='$id_mnk'");
        //   if ($sql){
        //     echo 'alert("Data Berhasil Diubah");';
        //   }
        
        }
        ?>
      </script>

      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Data Pengembalian Mobil</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Pengembalian Mobil</li>
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
                <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#tambah">
                  <i class="fa fa-plus"></i> Tambah pengembalian Mobil
                </button>
                <br><br>
                <div class="table-responsive">
                  <table id="zero_config" class="table table-striped table-bordered">
                    <thead align="center">
                      <tr>
                        <th width="25px">No.</th>
                        <th>Kode Pengembalian Mobil</th>
                        <th>Kode Rental</th>
                        <th>Nama Karyawan</th>
                        <th>Tanggal Dikembalikan</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody align="center">
                      <?php
                        $tampil=$mysqli->query("SELECT *,pengembalian.status AS statuss FROM pengembalian INNER JOIN data_karyawan ON data_karyawan.id=pengembalian.id INNER JOIN tbl_oren ON tbl_oren.id_rental=pengembalian.id_rental order by pengembalian.id_pgb ");
                        $no = 1;
                         while ($data=$tampil->fetch_object()){
                       ?>
                     <tr>
                      <td align="center"><?=$no++ ?></td>
                      <td align="center"><?=$data->id_pgb ?></td>
                      <td align="center"><?=$data->id_rental ?></td>
                      <td align="center"><?=$data->karyawan ?></td>    
                      <td align="center"><?=date('d-m-Y',strtotime($data->tgl_dikembalikan)); ?></td>
                      <td align="center"><?=$data->statuss ?></td>
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
              <h4 class="modal-title"> Tambah Data Pengembalian Mobil</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=pengembalian&act=tambah" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <?php
                  $sql = $mysqli->query("SELECT * FROM pengembalian");

                  // IF INLINE { GOOGLING KALAU BELUM TAHU }
                  $sql->num_rows <> 0 ? $kode = $sql->num_rows + 1 : $kode = 1;
                  
                  $bikin_kode = str_pad($kode, 2, "0", STR_PAD_LEFT);
                  $tahun = date('Ym');
                  $kode_jadi = "KPM$tahun$bikin_kode";
                  ?>
                  <label class="control-label" for="id_mobil">Kode pengembalian Mobil</label>
                  <input type="text" class="form-control" id="id_pgb" name="id_pgb" value="<?= $kode_jadi ?>" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="brand">Kode Rental</label>
                  <select class="id_rental form-control  custom-select" name="id_rental" style="width: 100%; height:36px;">
                    </select>
                </div>  
                <div class="form-group">
                  <label class="control-label" for="brand">Nama Karyawan</label>
                  <select class="id form-control  custom-select" name="id" style="width: 100%; height:36px;">
                    </select>
                </div>  
                <div class="form-group">
                  <label class="control-label" for="status">Status</label>
                    <select type="text" name="status" class="form-control" id="status" >
                      <option value="Sudah Dikembalikan">Sudah Dikembalikan</option>
                      <option value="Belum Dikembalikan">Belum Dikembalikan</option>
                    </select>
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
          <!-- END MODAL UNTUK EDIT -->
      <script type="text/javascript">
         $('.id_rental').select2({
                placeholder: 'Pilih Kode Rentalnya',
                ajax: {
                  url: 'json_rental.php',
                  dataType: 'json',
                  delay: 250,
                  processResults: function (data) {
                    return {
                      results: data
                    };
                  },
                  cache: true
                }
              });

         $('.id').select2({
                placeholder: 'Pilih Nama Karyawan',
                ajax: {
                  url: 'json_karyawan.php',
                  dataType: 'json',
                  delay: 250,
                  processResults: function (data) {
                    return {
                      results: data
                    };
                  },
                  cache: true
                }
              });
           
      </script>