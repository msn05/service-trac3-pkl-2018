      <script type="text/javascript">
          
        <?php
        $sql = false;  error_reporting(0);

        // PROSES TAMBAH EDIT DAN HAPUS DALAM BENTUK PERCABANGAN
        if (@$_GET['act'] == 'tambah' && !empty($_POST['id_so'])) {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $sp = $mysqli->query("SELECT * from tbl_oli where id_oli = '$_POST[id_oli]'");
          $spNya = $sp->fetch_array();
    // untuk lihat id_mobile
          // $tampil   = $sql->fetch_assoc();
          // $id_oli    = $tampil['id_oli'];
          // $jumlah_b = $tampil['jumlah_b'];
                      
           if ($_POST[jumlah_b] > $spNya[jumlah_sp]){
               echo 'alert("Maaf Stok Barang yang tersedia tidak mencukupi, Silahkan Ulangi Lagi Ya BRO..");';
           }else{
              $id_so              = $mysqli->escape_string($_POST ['id_so']);
              $tgl_order          = $mysqli->escape_string($_POST['tgl_order']);
              $id_oli             = $mysqli->escape_string($_POST ['id_oli']);
              $kustom_id          = $mysqli->escape_string($_POST['kustom_id']);
              $email              = $mysqli->escape_string($_POST['email']);
              $status_p              = $mysqli->escape_string($_POST['status_p']);
              $harga              = $mysqli->escape_string($_POST['harga']);
              $jumlah_o           = $mysqli->escape_string($_POST['jumlah_o']);
              $total_bayar        = $mysqli->escape_string($_POST['total_bayar']);
              $perkiraan_selesai  = $mysqli->escape_string($_POST['perkiraan_selesai']);
              $id_mnk             = $mysqli->escape_string($_POST['id_mnk']);
              $status             = $mysqli->escape_string($_POST['status']);
              $id_karyawan        = $mysqli->escape_string($_SESSION['id_karyawan']);

               $sql1= $mysqli->query("INSERT INTO tbl_soli (id_so,id_karyawan,tgl_order,kustom_id,email,status_p,id_oli,jumlah_o,harga,total_bayar,id_mnk,perkiraan_selesai,status) VALUES ('$id_so','$id_karyawan','$tgl_order','$kustom_id','$email','$status_p','$id_oli','$jumlah_o','$harga','$total_bayar','$id_mnk','$perkiraan_selesai','Dalam Proses')");

                $sql2=$mysqli->query("UPDATE tbl_oli set jmlh_oli = jmlh_oli  - '$jumlah_o' where id_oli = '$id_oli'");

                 if ($sql1 && $sql2){
                      echo 'alert("Data Berhasil Disimpan");';
                 }else{
                  echo 'alert("data gagal disimpan");';
                 }
           }
                     
        }else if (@$_GET['act'] == 'selesaikan') {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
         $sql = $mysqli->query("SELECT id_oli from tbl_soli where id_so = '$_GET[id]'");
          // untuk lihat id_mobile
            $tampil   = $sql->fetch_assoc();
            $id_oli    = $tampil['id_oli'];
            // update tb oren
         $sql1 = $mysqli->query("UPDATE tbl_soli set status='Selesai' WHERE id_so = '$_GET[id]'");
          
          if ($sql1){
            echo 'alert("Orderan telah selesai");';
          }
        }else if (@$_GET['act'] == 'delete') {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $sql = $mysqli->query("SELECT id_oli,jumlah_o from tbl_soli where id_so = '$_GET[id]'");
          // untuk lihat id_mobile
            $tampil   = $sql->fetch_assoc();
            $id_oli    = $tampil['id_oli'];
            $jumlah_o = $tampil['jumlah_o'];
          // update tb oren
          $sql1 = $mysqli->query("UPDATE tbl_soli set status='Dibatalkan' WHERE id_so = '$_GET[id]'");
          // update tb_mobile
          $sql2 = $mysqli->query("UPDATE tbl_oli set jmlh_oli = jmlh_oli + '$jumlah_o' where id_oli = '$id_oli'");
          
          if ($sql1 && $sql2){
            echo 'alert("Orderan Berhasil Dibatalkan");';
          }
        }
        ?>
        $(document).on("click", "#form_edit", function(){
          var id_so     = $(this).data('id_so');
          var no_polisi     = $(this).data('no_polisi');
          var kustom_nama   = $(this).data('kustom_nama');
          var email         = $(this).data('email');
          var status_p      = $(this).data('status_p');
          var denda         = $(this).data('denda');
          var model_mobil   = $(this).data('model_mobil');
          var tgl_dirental  = $(this).data('tgl_dirental');
          var tgl_kembali   = $(this).data('tgl_kembali');
          var harga         = $(this).data('harga');
          $("  #id_so").val(id_so);
          $("  #kustom_nama").val(kustom_nama);  
          $("  #no_polisi").val(no_polisi);
          $("  #denda").val(denda);
          $("  #model_mobil").val(model_mobil);
          $("  #harga").val(harga);
          $("  #email").val(email);
          $("  #status_p").val(status_p);
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
          document.location='eoo.php';
        }
        href=""
      </script>

      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Data Order Servis Oli</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Servis Oli</li>
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
                  <i class="fa fa-plus"></i> Tambah Order Servis Oli
                </button>
                <br><br>
                <div class="table-responsive">
                  <table id="zero_config" class="table table-striped table-bordered">
                    <thead align="center">
                      <tr>
                        <th width="25px">No.</th>
                        <th>Kode Servis</th>
                        <th>Nama Karyawan</th>
                        <th>Nama Oli</th>
                        <th>Harga</th>
                        <th>Nama Mekanik</th>
                        <th>Nama Pelanggan</th>
                        <th>Email</th>
                        <th>Status Pelanggan</th>
                        <th>Jumlah Barang</th>
                        <th>Tanggal Order</th>
                        <th>Total Bayar</th>
                        <th>Perkiraan Selesai</th>
                        <th>Status</th>
                        <th width="25px">Action</th>
                      </tr>
                    </thead>
                    <tbody align="center">
                      <?php
                      $tampil=$mysqli->query("SELECT *, tbl_soli.status AS status_s FROM tbl_soli INNER JOIN  tbl_oli ON tbl_oli.id_oli = tbl_soli.id_oli INNER JOIN  tbl_mekanik ON tbl_mekanik.id_mnk = tbl_soli.id_mnk INNER JOIN kustom ON kustom.kustom_id = tbl_soli.kustom_id INNER JOIN users ON users.id_karyawan=tbl_soli.id_karyawan ORDER BY tbl_soli.id_so");
                      $no = 1;
                      while ($data=$tampil->fetch_object()){
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->id_so ?></td>    
                        <td><?= $data->nama ?></td>
                        <td><?= $data->nama_oli ?></td>
                        <td><?= "Rp. ".number_format($data->harga )?></td>
                        <td><?= $data->nama_mnk ?></td>
                        <td><?= $data->kustom_nama ?></td>
                        <td><?= $data->email ?></td>
                        <td><?= $data->status_p ?></td>
                        <td><?= $data->jumlah_o ?> Liter</td>
                        <td><?= date('d-m-Y',strtotime($data->tgl_order)) ?></td>
                        <td><?= "Rp. ".number_format($data->total_bayar) ?></td>
                        <td><?= date('d-m-Y',strtotime($data->perkiraan_selesai)) ?></td>
                        <td><?= $data->status_s ?></td>
                        <td>

                       
                          <a href="?page=data_o&act=selesaikan&id=<?= $data->id_so?>&status=selesaikan"><button type="button" class="btn btn-primary " onclick="return confirm('Apakah anda yakin orderan sudah Selesai?');"><i class = "fa fa-check"></i></button></a>
                          <a href="?page=data_o&act=delete&id=<?= $data->id_so?>&status=batalkan" onclick="return confirm('Apakah anda yakin akan membatalkannya?');" class="btn btn-danger" >
                            <i class="fa fa-times" aria-hidden="true"></i>
                          </a>
                          <a href="print_servis_oli.php?&id=<?=$data->id_so?>"target="_blank">
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
      <div id="tambah" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Tambah Order Servis Oli</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=data_o&act=tambah" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <?php
                  $sql = $mysqli->query("SELECT * FROM tbl_soli");

                  // IF INLINE { GOOGLING KALAU BELUM TAHU }
                  $sql->num_rows <> 0 ? $kode = $sql->num_rows + 1 : $kode = 1;
                  
                  $bikin_kode = str_pad($kode, 2, "0", STR_PAD_LEFT);
                  $tahun = date('Ym');
                  $kode_jadi = "KSO$tahun$bikin_kode";
                  ?>
                  <label class="control-label" for="id_so">Kode Order Servis Oli</label>
                  <input type="text" class="form-control" id="id_so" name="id_so" value="<?= $kode_jadi ?>" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="nama_mnk">Nama Oli</label>
                  <select class="id_oli form-control  custom-select" name="id_oli" style="width: 100%; height:36px;">
                    </select>
                </div>  
                <div id="tampiloli"></div>
                <div class="form-group">
                  <label class="control-label" for="nama_mnk">Nama Mekanik</label>
                  <select class="id_mnk form-control  custom-select" name="id_mnk" style="width: 100%; height:36px;">
                    </select>
                </div> 
                <div class="form-group">
                  <label class="control-label" for="nama_mnk">Nama Pelanggan</label>
                  <select class="kustom_id form-control  custom-select" name="kustom_id" style="width: 100%; height:36px;">
                    </select>
                </div> 
                <div id="tampilpelanggan"></div>
                <div class="form-group">
                  <label class="control-label" for="denda">Jumlah Barang</label>
                    <input type="number" name="jumlah_o" class="form-control" id="jumlah_o" required="">     
                </div>
                <div class="form-group">
                  <label class="control-label" for="tgl_dirental">Tanggal Order</label>
                  <input type="date" name="tgl_order" class="form-control" id="tgl_order">   
                </div> 
                <div class="form-group">
                  <label class="control-label" for="denda">Total Bayar</label>
                    <input type="number" name="total_bayar" class="form-control" id="total_bayar" readonly="">     
                </div>
                <div class="form-group">
                  <label class="control-label" for="tgl_dirental">Perkiraan Selesai</label>
                  <input type="date" name="perkiraan_selesai" class="form-control" id="perkiraan_selesai">   
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
        $('.id_oli').select2({
                placeholder: 'Pilih Oli Nya',
                ajax: {
                  url: 'json_oli.php',
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
            
          $('.id_oli').change(function(){
                var id_oli = $(this).val();
                $.ajax({
                  type: 'POST',
                  url: 'data_oli.php',
                  data: 'id_oli='+id_oli,
                  success:function(msg){
                    $("#tampiloli").html(msg);                  
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

         $('.id_mnk').select2({
                placeholder: 'Pilih Nama Mekanik ',
                ajax: {
                  url: 'json_mekanik.php',
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
          
         $("#jumlah_o").on("input", function() {
            var val = $(this).val();
            var harga = $("#harga").val();
            var total_bayar = val * harga;
            console.log(total_bayar);
            $("#total_bayar").val(total_bayar);

         });
      </script>