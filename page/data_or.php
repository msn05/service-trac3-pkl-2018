      <script type="text/javascript">
          
         
        <?php
        $sql = false;  error_reporting(0);

        // PROSES TAMBAH EDIT DAN HAPUS DALAM BENTUK PERCABANGAN
        if (@$_GET['act'] == 'tambahp' && !empty($_POST['id_rental'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $id_rental      = $mysqli->escape_string($_POST['id_rental']);
          $id_mobil       = $mysqli->escape_string($_POST['id_mobil']);
          $model_mobil    = $mysqli->escape_string($_POST['model_mobil']);
          $harga          = $mysqli->escape_string($_POST['harga']);
          $kustom_id      = $mysqli->escape_string($_POST['kustom_id']);
          $tgl_kembali    = $mysqli->escape_string($_POST['tgl_kembali']);
          $tgl_dirental   = $mysqli->escape_string($_POST['tgl_dirental']);
          $email          = $mysqli->escape_string($_POST['email']);
          $status_p       = $mysqli->escape_string($_POST['status_p']);
          $denda          = $mysqli->escape_string($_POST['denda']);
          $status         = $mysqli->escape_string($_POST['status']);
          $id_karyawan    = $mysqli->escape_string($_SESSION['id_karyawan']);

          $sql= $mysqli->query("INSERT INTO tbl_oren (id_karyawan,id_rental,kustom_id,harga,id_mobil,tgl_kembali,denda,tgl_dirental,email,status_p,model_mobil,status) VALUES('$id_karyawan','$id_rental','$kustom_id','$harga','$id_mobil','$tgl_kembali','$denda','$tgl_dirental','$email','$status_p','$model_mobil','Di Rental')");

           $sql=$mysqli->query("UPDATE tbl_mobil set status = 'Di Rental ya om'
                               where id_mobil = '$_POST[id_mobil]'");
          if ($sql){
            echo 'alert("Data Berhasil Disimpan");';
          }
        } else if (@$_GET['act'] == 'edit' && !empty($_POST['id_rental'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
         	$id_rental 				= $mysqli->escape_string($_POST['id_rental']);
          $tgl_dikembalikan= $mysqli->escape_string($_POST['tgl_dikembalikan']);
          $denda_lain= $mysqli->escape_string($_POST['denda_lain'] == null ? 0 : $_POST['denda_lain']);
          $total_denda = $mysqli->escape_string($_POST['total_denda']);
          $total= $mysqli->escape_string($_POST['total']);
  
           $sql = $mysqli->query("UPDATE tbl_oren SET tgl_dikembalikan='$tgl_dikembalikan', denda_lain='$denda_lain', total_denda='$total_denda', total='$total' where id_rental='$id_rental'");
                    if ($sql){
            echo 'alert("Data Berhasil Diubah");';
          }
        } else if (@$_GET['act'] == 'delete') {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
            $sql = $mysqli->query("SELECT id_mobil from tbl_oren where id_rental = '$_GET[id]'");
            // untuk lihat id_mobile
            $tampil   = $sql->fetch_assoc();
            $id_mobil = $tampil['id_mobil'];
            // update tb oren
           if (@$_GET['status'] == 'Di Rental') {
              $sql1 = $mysqli->query("UPDATE tbl_oren set status='Dibatalkan' WHERE id_rental = '$_GET[id]'");
            // update tb_mobile
              $sql2 = $mysqli->query("UPDATE tbl_mobil set status = 'Tersedia' where id_mobil = '$id_mobil'");
              
              if ($sql1 && $sql2){
                echo 'alert("Data Telah Dibatalkan");';
              }else{
              }
           }else{
              echo 'alert("data gagal disimpan");';

           }
          
        }else if (@$_GET['act'] == 'selesaikan') {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $sql = $mysqli->query("SELECT id_mobil from tbl_oren where id_rental = '$_GET[id]'");
          // untuk lihat id_mobile
          $tampil   = $sql->fetch_assoc();
          $id_mobil = $tampil['id_mobil'];
          // update tb oren
          $sql1 = $mysqli->query("UPDATE tbl_oren set status='Selesai' WHERE id_rental = '$_GET[id]'");
          // update tb_mobile
          $sql2 = $mysqli->query("UPDATE tbl_mobil set status = 'Tersedia' where id_mobil = '$id_mobil'");
          
          if ($sql1 && $sql2){
            echo 'alert("Orderan telah selesai");';
          }
        }
        ?>
        $(document).on("click", "#form_edit", function(){
          var id_rental     = $(this).data('id_rental');
          var no_polisi     = $(this).data('no_polisi');
          var kustom_nama   = $(this).data('kustom_nama');
          var email         = $(this).data('email');
          var denda         = $(this).data('denda');
          var model_mobil   = $(this).data('model_mobil');
          var tgl_dirental  = $(this).data('tgl_dirental');
          var tgl_kembali   = $(this).data('tgl_kembali');
          var harga         = $(this).data('harga');
          $("  #id_rental").val(id_rental);
          $("  #kustom_nama").val(kustom_nama);  
          $("  #no_polisi").val(no_polisi);
          $("  #denda").val(denda);
          $("  #model_mobil").val(model_mobil);
          $("  #harga").val(harga);
          $("  #email").val(email);
          $("  #tgl_dirental").val(tgl_dirental);
          $("  #tgl_kembali").val(tgl_kembali);
          start_rental      = $(this).data('tgl_dirental');
          end_rental        = $(this).data('tgl_kembali');
          lama_rental       = parseInt(selisih_hari(new Date(start_rental), new Date(end_rental)));
          denda_perhari     = $(this).data('denda');
          harga_perhari     = $(this).data('harga');
          hitung_biaya();       
        });
        function exportpdf(){
          document.location='er.php';
        }
        href=""
      </script>

      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Data Order Rental Mobil</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Rental</li>
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
                <a href="?page=data_orm&act=tambah" class="btn btn-success btn-sm float-right" type="button">
                  <i class="fa fa-plus"></i> Tambah Order Rental Masyarakat
                </a>
                <br><br>
                <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#tambahp">
                  <i class="fa fa-plus"></i> Tambah Order Rental Perusahaan
                </button>
                <br><br>
                <div class="table-responsive">
                  <table id="zero_config" class="table table-striped table-bordered">
                    <thead align="center">
                      <tr>
                        <th width="25px">No.</th>
                        <th>Kode Rental</th>
                        <th>Nama Karyawan</th>
                        <th>Nomor Polisi</th>
                        <th>Model Mobil</th>
                        <th>Harga</th>
                        <th>Denda / Hari</th>
                        <th>Nama Pelanggan</th>
                        <th>Email</th>
                        <th>Status Pelanggan</th>
                        <th>Tanggal Dirental</th>
                        <th>Tanggal Kembali</th>
                        <th>Denda Lain - Lain</th>
                        <th>Tanggal Dikembalikan</th>
                        <th>Total Denda</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th width="100px">Action</th>
                      </tr>
                    </thead>
                    <tbody align="center">
                      <?php
                      $tampil=$mysqli->query("SELECT *,tbl_oren.status AS status_order FROM tbl_oren  INNER JOIN tbl_mobil ON tbl_mobil.id_mobil = tbl_oren.id_mobil INNER JOIN kustom ON kustom.kustom_id = tbl_oren.kustom_id inner join users on users.id_karyawan = tbl_oren.id_karyawan ORDER BY tbl_oren.id_rental DESC");
                      $no = 1;
                      while ($data=$tampil->fetch_object()){
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->id_rental ?></td>    
                        <td><?= $data->nama ?></td>
                        <td><?= $data->no_polisi ?></td>
                        <td><?= $data->model_mobil ?></td>
                        <td><?= "Rp. ".number_format($data->harga )?></td>
                        <td><?= "Rp. ".number_format($data->denda )?></td>
                        <td><?= $data->kustom_nama ?></td>
                        <td><?= $data->email ?></td>
                        <td><?= $data->status_p ?></td>
                        <td><?= date('d-m-Y',strtotime($data->tgl_dirental)) ?></td>
                        <td><?= date('d-m-Y',strtotime($data->tgl_kembali)) ?></td>
                        <td><?= "Rp. ".number_format($data->denda_lain )?></td>
                        <td><?= date('d-m-Y',strtotime($data->tgl_dikembalikan)) ?></td>
                        <td><?= "Rp. ".number_format($data->total_denda )?></td>
                        <td><?= "Rp. ".number_format($data->total )?></td>
                        <td><?= $data->status_order ?></td>
                        <td>

                        <a id="form_edit" data-toggle="modal" data-target="#edit"
                            data-id_rental="<?= $data->id_rental ?>"
                            data-no_polisi="<?= $data->no_polisi ?>" 
                            data-model_mobil="<?= $data->model_mobil ?>" 
                            data-harga="<?= $data->harga ?>" 
                            data-harga="<?= $data->harga ?>" 
                            data-denda="<?= $data->denda ?>" 
                            data-kustom_nama="<?=$data->kustom_nama?>"
                            data-email="<?=$data->email?>"
                            data-status_p="<?=$data->status_p?>"
                            data-tgl_dirental="<?=$data->tgl_dirental?>"
                            data-tgl_kembali="<?=$data->tgl_kembali?>"
                            class="btn btn-warning" title="Edit">
                          <i class="fa fa-cart-plus"></i></a>
                          <a href="?page=data_or&act=selesaikan&id=<?= $data->id_rental?>&status=selesaikan"><button type="button" class="btn btn-primary " onclick="return confirm('Apakah anda yakin orderan sudah Selesai?');"><i class = "fa fa-check"></i></button></a>
                          <a href="?page=data_or&act=delete&id=<?= $data->id_rental?>&status=batalkan" onclick="return confirm('Apakah anda yakin akan membatalkannya?');" class="btn btn-danger" >
                            <i class="mdi mdi-delete" aria-hidden="true"></i>
                          </a>
                          <a href="print_rental.php?&id=<?=$data->id_rental?>"target="_blank">
                            <button type="button" class="btn btn-success"><i class="fa fa-print"></i></button></a>
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
      <div id="tambahp" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Tambah Order Rental Perusahaan</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=data_or&act=tambahp" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <?php
                  $sql = $mysqli->query("SELECT * FROM tbl_oren");

                  // IF INLINE { GOOGLING KALAU BELUM TAHU }
                  $sql->num_rows <> 0 ? $kode = $sql->num_rows + 1 : $kode = 1;
                  
                  $bikin_kode = str_pad($kode, 2, "0", STR_PAD_LEFT);
                  $tahun = date('Ym');
                  $kode_jadi = "KOR$tahun$bikin_kode";
                  ?>
                  <label class="control-label" for="id_rental">Kode Order Rental</label>
                  <input type="text" class="form-control" id="id_rental" name="id_rental" value="<?= $kode_jadi ?>" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="nama_mnk">Nomor Polisi</label>
                  <select class="id_mobil form-control  custom-select" name="id_mobil" style="width: 100%; height:36px;">
                    </select>
                </div>  
                <div id="tampilmobil"></div>
                <div class="form-group">
                  <label class="control-label" for="nama_mnk">Nama Pelanggan</label>
                  <select class="kustom_id form-control  custom-select" name="kustom_id" style="width: 100%; height:36px;">
                    </select>
                </div> 
                <div id="tampilpelanggan"></div>
                <div class="form-group">
                  <label class="control-label" for="tgl_dirental">Tanggal Dirental</label>
                  <input type="date" name="tgl_dirental" class="form-control" id="tgl_dirental" value="-">   
                </div> 
                <div class="form-group">
                  <label class="control-label" for="tgl_dirental">Tanggal Kembali</label>
                  <input type="date" name="tgl_kembali" class="form-control" id="tgl_kembali">   
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
              <h4 class="modal-title"> Edit Data Rental</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=data_or&act=edit" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label class="control-label" for="id_brand">Kode Rental </label>
                  <input type="text" class="form-control" id="id_rental" name="id_rental" value="" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="brand">Nomor Polisi</label>
                  <input type="text" name="no_polisi"  class="form-control" id="no_polisi" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="model_mobil">Model Mobil</label>
                  <input type="text" name="model_mobil" class="form-control" id="model_mobil" value="<?=$model_mobil;?>" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="model_mobil">Harga Mobil</label>
                  <input type="text" name="harga" class="form-control" id="harga" value="<?=$harga;?>" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="model_mobil">Denda / Hari</label>
                  <input type="text" name="denda" class="form-control" id="denda" value="<?=$denda;?>" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="model_mobil">Nama Pelanggan</label>
                  <input type="text" name="kustom_nama" class="form-control" id="kustom_nama" value="<?=$kustom_nama;?>" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="model_mobil">Email</label>
                  <input type="text" name="email" class="form-control" id="email" value="<?=$email;?>" readonly="">
                </div>
                <div class="form-group">
                  <label>Tanggal Dirental</label>
                  <input type="date" name="tgl_dirental" class="form-control" readonly id="tgl_dirental">
                </div>
                <div class="form-group">
                  <label>Tanggal Kembali</label>
                  <input type="date" name="tgl_kembali" class="form-control" readonly id="tgl_kembali">
                </div>
                <div class="form-group">
                  <label>Tanggal Dikembalikan</label>
                  <input type="date" name="tgl_dikembalikan" class="form-control" id="tgl2" value="<?= date('Y-m-d'); ?>">
                </div>
        
                <div class="form-group">
                  <label>Lewat Masa Tenggang (Hari)</label>
                  <input type="number" name="" id="selisih" class="form-control" readonly="" value="0">
                </div>
                <div class="form-group">
                  <label>Denda Lain</label>
                  <input type="number" name="denda_lain" class="form-control" id="denda_lain" required="" value="0">
                </div>
                <div class="form-group">
                  <label>Total Denda</label>
                  <input type="number" name="total_denda" class="form-control" id="total-denda" value="0" readonly="">
                </div>
                <div class="form-group">
                  <label>Total</label>
                  <input type="text" name="total" class="form-control" id="total" >
                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-danger">Reset</button>
                  <input type="submit" class="btn btn-success" name="edit" value="Simpan"> 
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
          <!-- END MODAL UNTUK EDIT -->
      <script type="text/javascript">
        $('.id_mobil').select2({
                placeholder: 'Pilih Mobilnya',
                ajax: {
                  url: 'json_mobil.php',
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
          
        $('.id_mobil').change(function(){
              var id_mobil = $(this).val();
              $.ajax({
                type: 'POST',
                url: 'data_mobil.php',
                data: 'id_mobil='+id_mobil,
                success:function(msg){
                  $("#tampilmobil").html(msg);                  
                }
              });
        });

         $('.kustom_id').select2({
                placeholder: 'Pilih Nama Pelanggan ',
                ajax: {
                  url: 'json_pelanggan.php',
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
         $('.kustom_id').change(function(){
          var kustom_id = $(this).val();
          $.ajax({
            type: 'POST',
            url: 'data_pelanggan.php',
            data: 'kustom_id='+kustom_id,
            success:function(msg){
              $("#tampilpelanggan").html(msg);                  
            }
          });
        });
          
        $("#total").keyup(function(){
          var val = $(this).val();
          var harga = $("#harga").val();
          $("#total").val(total);
        });

          function selisih_hari(diffstart, diffend){
            var total   = diffend-diffstart;
            var days    = total/1000/60/60/24;
            return days;
          }

          $('#tgl2, #denda_lain').on("input", function() {
            hitung_biaya();
          });

          function hitung_biaya(){
            var start       = end_rental;
            var end         = $("#tgl2").val();
            var denda       = denda_perhari; // 
            var denda_lain  = $("#denda_lain").val();
            var diffstart   = new Date(start);
            var diffend     = new Date(end);

            // get days
            var days  = parseInt(selisih_hari(diffstart, diffend));
            // alert(days);
            // console.log("Denda Lain : " + denda_lain);
            // console.log("Hari : " + days);
            // console.log("Denda : " + denda);
            // console.log("Biaya Rental : " + (lama_rental*harga_perhari));

            if (days <= 0) {
              var t = (lama_rental*harga_perhari) + 0 + parseInt(denda_lain);
              $("#selisih").val(0);
              $("#total").val(t);
            } else {
              var t = (lama_rental*harga_perhari) + (denda* days) + parseInt(denda_lain);
              $("#total-denda").val(denda*days);
              $("#selisih").val(days);
              $("#total").val(t);
              }
            }
      </script>