      <script type="text/javascript">
          
         
        <?php
        $sql = false;  

        // PROSES TAMBAH EDIT DAN HAPUS DALAM BENTUK PERCABANGAN
        if (@$_GET['act'] == 'tambah' && !empty($_POST['id_oli'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id_oli      = $mysqli->escape_string($_POST['id_oli']);    
          $nama_oli    = $mysqli->escape_string($_POST['nama_oli']);
          $id_brand    = $mysqli->escape_string($_POST['id_brand']);
          $id_tipe     = $mysqli->escape_string($_POST['id_tipe']);
          $harga       = $mysqli->escape_string($_POST['harga']);
          $tgl_doli    = $mysqli->escape_string($_POST['tgl_doli']);
          $jmlh_oli    = $mysqli->escape_string($_POST['jmlh_oli']);
          $status      = $mysqli->escape_string($_POST['status']);

          $sql      = $mysqli->query("INSERT INTO tbl_oli ( id_oli,nama_oli,id_brand,id_tipe,harga,jmlh_oli,tgl_doli,status) VALUES ('$id_oli','$nama_oli','$id_brand','$id_tipe','$harga','$jmlh_oli','$tgl_doli','Tersedia')");
          if ($sql){
            echo 'alert("Data Berhasil Disimpan");';
          }
        // } else if (@$_GET['act'] == 'edit' && !empty($_POST['id_oli'])) {
        //   // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
        //  	$id_oli 				= $mysqli->escape_string($_POST['id_oli']);
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
        } else if (@$_GET['act'] == 'delete' && !empty($_GET['id'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id_oli = $mysqli->escape_string($_GET['id']);
          $sql      = $mysqli->query("DELETE FROM tbl_oli WHERE id_oli='$id_oli'");
          if ($sql){
            echo 'alert("Data Telah Terhapus");';
          }
        }
        ?>
        function exportpdf(){
          document.location='eo.php';
        }
        href=""
      </script>

      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Data Oli</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Oli</li>
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
                  <i class="fa fa-plus"></i> Tambah Oli
                </button>
                <br><br>
                <div class="table-responsive">
                  <table id="zero_config" class="table table-striped table-bordered">
                    <thead align="center">
                      <tr>
                        <th width="25px">No.</th>
                        <th width="25px">Kode Oli</th>
                        <th>Nama Oli</th>
                        <th>Brand</th>
                        <th>Tipe</th>
                        <th>Harga</th>
                        <th>Jumlah Oli</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                        <th width="100px">Action</th>
                      </tr>
                    </thead>
                    <tbody align="center">
                      <?php
                      $tampil=$mysqli->query("SELECT * FROM tbl_oli  INNER JOIN brandm ON brandm.id_brand = tbl_oli.id_brand INNER JOIN merk_b ON merk_b.id_tipe = tbl_oli.id_tipe ORDER BY tbl_oli.id_oli");
                      $no = 1;
                      while ($data=$tampil->fetch_object()){
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->id_oli ?></td>    
                        <td><?= $data->nama_oli ?></td>
                        <td><?= $data->brand ?></td>
                        <td><?= $data->tipe ?></td>
                        <td><?= "Rp. ".number_format($data->harga )?></td>
                        <td><?= $data->jmlh_oli ?> Liter</td>
                        <td><?= date('d-m-Y',strtotime($data->tgl_doli)) ?></td>
                        <td><?= $data->status ?></td>
                        <td>

                          <a href="?page=ubah_oli&aksi=edit&id=<?= $data->id_oli?>" class="btn btn-info mdi mdi-pencil"></a>
                          <a href="?page=data_oli&act=delete&id=<?= $data->id_oli?>" onclick="return confirm('Apakah anda yakin akan menghapusnya?');" class="btn btn-danger" title="Hapus">
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
              <h4 class="modal-title"> Tambah Oli</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=data_oli&act=tambah" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <?php
                  $sql = $mysqli->query("SELECT * FROM tbl_oli");

                  // IF INLINE { GOOGLING KALAU BELUM TAHU }
                  $sql->num_rows <> 0 ? $kode = $sql->num_rows + 1 : $kode = 1;
                  
                  $bikin_kode = str_pad($kode, 2, "0", STR_PAD_LEFT);
                  $tahun = date('Ym');
                  $kode_jadi = "KO$tahun$bikin_kode";
                  ?>
                  <label class="control-label" for="id_oli">Kode Oli</label>
                  <input type="text" class="form-control" id="id_oli" name="id_oli" value="<?= $kode_jadi ?>" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="nama_mnk">Nama Oli</label>
                  <input type="text" name="nama_oli" placeholder="Masukkan Nama Oli nya Apa" class="form-control" id="nama_oli" required="">
                </div>  
                <div class="form-group">
                  <label class="control-label" for="brand">Brand</label>
                  <select class="id_brand form-control  custom-select" name="id_brand" style="width: 100%; height:36px;">
                    </select>
                </div>  
                <div class="form-group">
                  <label class="control-label" for="tipe">Tipe</label>
                  <select class="id_tipe form-control  custom-select" name="id_tipe" style="width: 100%; height:36px;">
                    </select>
                </div> 
                <div class="form-group">
                  <label class="control-label" for="harga">Harga</label>
                  <input type="number" name="harga" class="form-control"  id="harga" required="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="lokasi_mbl">Jumlah Oli</label>
                  <input type="number" name="jmlh_oli" class="form-control" id="jmlh_oli" required="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="tgl_masuk">Tanggal Masuk</label>
                  <div class="input-group date">
                    <input type="text" class="form-control" name="tgl_doli"  id="tgl_doli"> 
                    <span class="input-group-addon input-group-text"><i class="icon-calender"></i></span>
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
          <!-- END MODAL UNTUK EDIT -->
      <script type="text/javascript">
         $('.id_brand').select2({
                placeholder: 'Pilih Brandnya',
                ajax: {
                  url: 'json_brand.php',
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
           
         $('.id_tipe').select2({
                placeholder: 'Pilih Brandnya',
                ajax: {
                  url: 'json_tipe.php',
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