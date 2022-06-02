      <script type="text/javascript">
        <?php
        $sql = false;  
        error_reporting(0);
        // PROSES TAMBAH EDIT DAN HAPUS DALAM BENTUK PERCABANGAN
        if (@$_GET['act'] == 'tambah' && !empty($_POST['id_brand'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id_brand = $mysqli->escape_string($_POST['id_brand']);
          $brand    = $mysqli->escape_string($_POST['brand']);

          $sql      = $mysqli->query("INSERT INTO brandm(id_brand,brand) VALUES('$id_brand','$brand')");
          if ($sql){
            echo 'alert("Data Berhasil Disimpan");';
          }
        } else if (@$_GET['act'] == 'edit' && !empty($_POST['id_brand'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id_brand = $mysqli->escape_string($_POST['id_brand']);
          $brand    = $mysqli->escape_string($_POST['brand']);

          $sql      = $mysqli->query("UPDATE `brandm` SET `brand` = '$brand' WHERE id_brand='$id_brand'");
          if ($sql){
            echo 'alert("Data Berhasil Diubah");';
          }
        } else if (@$_GET['act'] == 'delete' && !empty($_GET['id'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id_brand = $mysqli->escape_string($_GET['id']);
          $sql      = $mysqli->query("DELETE FROM brandm WHERE id_brand='$id_brand'");
          if ($sql){
            echo 'alert("Data Telah Terhapus");';
          }
        }
        ?>
        $(document).on("click", "#form_edit", function(){
          var id_brand = $(this).data('id_brand');
          var brand = $(this).data('brand');
          $(" #edit #id_brand").val(id_brand);
          $(" #edit #brand").val(brand);
        });
      </script>

      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Data Brand</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Brand</li>
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
                  <i class="fa fa-plus"></i> Tambah Brand
                </button>
                <br><br>
                <div class="table-responsive">
                  <table id="zero_config" class="table table-striped table-bordered">
                    <thead align="center">
                      <tr>
                        <th width="25px">No.</th>
                        <th width="100px">Kode Brand</th>
                        <th>Brand</th>
                        <th width="100px">Action</th>
                      </tr>
                    </thead>
                    <tbody align="center">
                      <?php
                      $tampil=$mysqli->query("SELECT * FROM brandm");
                      $no = 1;
                      while ($data=$tampil->fetch_object()){
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->id_brand ?></td>    
                        <td><?= $data->brand ?></td>
                        <td>
                          <a id="form_edit" data-toggle="modal" data-target="#edit"
                            data-id_brand="<?= $data->id_brand ?>"
                            data-brand="<?= $data->brand ?>" class="btn btn-warning" title="Edit">
                          <i class="mdi mdi-pencil"></i></a>
                          <a href="?page=brand&act=delete&id=<?= $data->id_brand?>" onclick="return confirm('Apakah anda yakin akan menghapusnya?');" class="btn btn-danger" title="Hapus">
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
              <h4 class="modal-title"> Tambah Brand</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=brand&act=tambah" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <?php
                  $sql = $mysqli->query("SELECT * FROM brandm");

                  // IF INLINE { GOOGLING KALAU BELUM TAHU }
                  $sql->num_rows <> 0 ? $kode = $sql->num_rows + 1 : $kode = 1;
                  
                  $bikin_kode = str_pad($kode, 2, "0", STR_PAD_LEFT);
                  $tahun = date('Ym');
                  $kode_jadi = "KB$tahun$bikin_kode";
                  ?>
                  <label class="control-label" for="id_brand">Kode Brand</label>
                  <input type="text" class="form-control" id="id_brand" name="id_brand" value="<?= $kode_jadi ?>" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="brand">Brand</label>
                  <input type="text" name="brand" placeholder="Masukkan Nama Brand" class="form-control" id="brand" required="">
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
              <h4 class="modal-title"> Edit Brand</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=brand&act=edit" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label class="control-label" for="id_brand">Kode Brand</label>
                  <input type="text" class="form-control" id="id_brand" name="id_brand" value="" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="brand">Brand</label>
                  <input type="text" name="brand" placeholder="Masukkan Nama Brand" class="form-control" id="brand" required="">
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
