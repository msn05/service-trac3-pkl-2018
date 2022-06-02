      <script type="text/javascript">
        <?php
        $sql = false;

        // PROSES TAMBAH EDIT DAN HAPUS DALAM BENTUK PERCABANGAN
        if (@$_GET['act'] == 'tambah' && !empty($_POST['id_tipe'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id_tipe = $mysqli->escape_string($_POST['id_tipe']);
          $tipe    = $mysqli->escape_string($_POST['tipe']);

          $sql      = $mysqli->query("INSERT INTO merk_b(id_tipe,tipe) VALUES('$id_tipe','$tipe')");
          if ($sql){
            echo 'alert("Data Berhasil Disimpan");';
          }
        } else if (@$_GET['act'] == 'edit' && !empty($_POST['id_tipe'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id_tipe = $mysqli->escape_string($_POST['id_tipe']);
          $tipe    = $mysqli->escape_string($_POST['tipe']);

          $sql      = $mysqli->query("UPDATE `merk_b` SET `tipe` = '$tipe' WHERE id_tipe='$id_tipe'");
          if ($sql){
            echo 'alert("Data Berhasil Diubah");';
          }
        } else if (@$_GET['act'] == 'delete' && !empty($_GET['id'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id_tipe = $mysqli->escape_string($_GET['id']);
          $sql      = $mysqli->query("DELETE FROM merk_b WHERE id_tipe='$id_tipe'");
          if ($sql){
            echo 'alert("Data Telah Terhapus");';
          }
        }
        ?>
        $(document).on("click", "#form_edit", function(){
          var id_tipe = $(this).data('id_tipe');
          var tipe = $(this).data('tipe');
          $(" #edit #id_tipe").val(id_tipe);
          $(" #edit #tipe").val(tipe);
        });
      </script>

      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Data Tipe</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Tipe</li>
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
                  <i class="fa fa-plus"></i> Tambah Tipe
                </button>
                <br><br>
                <div class="table-responsive">
                  <table id="zero_config" class="table table-striped table-bordered">
                    <thead align="center">
                      <tr>
                        <th width="25px">No.</th>
                        <th width="100px">Kode tipe</th>
                        <th>Tipe</th>
                        <th width="100px">Action</th>
                      </tr>
                    </thead>
                    <tbody align="center">
                      <?php
                      $tampil=$mysqli->query("SELECT * FROM merk_b");
                      $no = 1;
                      while ($data=$tampil->fetch_object()){
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->id_tipe ?></td>    
                        <td><?= $data->tipe ?></td>
                        <td>
                          <a id="form_edit" data-toggle="modal" data-target="#edit"
                            data-id_tipe="<?= $data->id_tipe ?>"
                            data-tipe="<?= $data->tipe ?>" class="btn btn-warning" title="Edit">
                          <i class="mdi mdi-pencil"></i></a>
                          <a href="?page=tipe&act=delete&id=<?= $data->id_tipe?>" onclick="return confirm('Apakah anda yakin akan menghapusnya?');" class="btn btn-danger" title="Hapus">
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
              <h4 class="modal-title"> Tambah tipe</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=tipe&act=tambah" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <?php
                  $sql = $mysqli->query("SELECT * FROM merk_b");

                  // IF INLINE { GOOGLING KALAU BELUM TAHU }
                  $sql->num_rows <> 0 ? $kode = $sql->num_rows + 1 : $kode = 1;
                  
                  $bikin_kode = str_pad($kode, 2, "0", STR_PAD_LEFT);
                  $tahun = date('Ym');
                  $kode_jadi = "KT$tahun$bikin_kode";
                  ?>
                  <label class="control-label" for="id_tipe">Kode tipe</label>
                  <input type="text" class="form-control" id="id_tipe" name="id_tipe" value="<?= $kode_jadi ?>" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="tipe">tipe</label>
                  <input type="text" name="tipe" placeholder="Masukkan Nama tipe" class="form-control" id="tipe" required="">
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
              <h4 class="modal-title"> Edit tipe</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=tipe&act=edit" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label class="control-label" for="id_tipe">Kode tipe</label>
                  <input type="text" class="form-control" id="id_tipe" name="id_tipe" value="" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="tipe">tipe</label>
                  <input type="text" name="tipe" placeholder="Masukkan Nama tipe" class="form-control" id="tipe" required="">
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
