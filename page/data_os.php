      <script type="text/javascript">
          
        <?php
        $sql = false;

    //     // PROSES TAMBAH EDIT DAN HAPUS DALAM BENTUK PERCABANGAN
    //     if (@$_GET['act'] == 'tambah' && !empty($_POST['id_servis'])) {
    //       // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
    //       $sp = $mysqli->query("SELECT * from tbl_sparepart where id_sp = '$_POST[id_sp]'");
    //       $spNya = $sp->fetch_array();
    // // untuk lihat id_mobile
    //       // $tampil   = $sql->fetch_assoc();
    //       // $id_sp    = $tampil['id_sp'];
    //       // $jumlah_b = $tampil['jumlah_b'];
                      
    //        if ($_POST[jumlah_b] > $spNya[jumlah_sp]){
    //            echo 'alert("Maaf Stok Barang yang tersedia tidak mencukupi, Silahkan Ulangi Lagi Ya BRO..");';
    //        }else{
    //           $id_servis          = $mysqli->escape_string($_POST ['id_servis']);
    //           $tgl_masuk          = $mysqli->escape_string($_POST['tgl_masuk']);
    //           $id_sp              = $mysqli->escape_string($_POST ['id_sp']);
    //           $kustom_id          = $mysqli->escape_string($_POST['kustom_id']);
    //           $email              = $mysqli->escape_string($_POST['email']);
    //           $status_p              = $mysqli->escape_string($_POST['status_p']);
    //           $harga              = $mysqli->escape_string($_POST['harga']);
    //           $jumlah_b           = $mysqli->escape_string($_POST['jumlah_b']);
    //           $total_bayar        = $mysqli->escape_string($_POST['total_bayar']);
    //           $perkiraan_selesai  = $mysqli->escape_string($_POST['perkiraan_selesai']);
    //           $id_mnk             = $mysqli->escape_string($_POST['id_mnk']);
    //           $alamat             = $mysqli->escape_string($_POST['alamat']);
    //           $status             = $mysqli->escape_string($_POST['status']);
    //           $model_sp           = $mysqli->escape_string($_POST['model_sp']);
    //           $id_karyawan        = $mysqli->escape_string($_SESSION['id_karyawan']);

    //            $sql1= $mysqli->query("INSERT INTO tbl_os (id_servis,id_karyawan,tgl_masuk,kustom_id,email,status_p,id_sp,jumlah_b,model_sp,harga,total_bayar,id_mnk,perkiraan_selesai,status) VALUES ('$id_servis','$id_karyawan','$tgl_masuk','$kustom_id','$email','$status_p','$id_sp','$jumlah_b','$model_sp','$harga','$total_bayar','$id_mnk','$perkiraan_selesai','Dalam proses')");

    //             $sql2=$mysqli->query("UPDATE tbl_sparepart set jumlah_sp = jumlah_sp  - '$jumlah_b' where id_sp = '$id_sp'");

    //              if ($sql1 && $sql2){
    //                   echo 'alert("Data Berhasil Disimpan");';
    //              }else{
    //               echo 'alert("data gagal disimpan");';
    //              }
    //        }
                     
    //     }else 
        if (@$_GET['act'] == 'selesaikan') {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
         $sql = $mysqli->query("SELECT id_sp from tbl_os where id_servis = '$_GET[id]'");
          // untuk lihat id_mobile
            $tampil   = $sql->fetch_assoc();
            $id_sp    = $tampil['id_sp'];
            // update tb oren
         $sql1 = $mysqli->query("UPDATE tbl_os set status='Selesai' WHERE id_servis = '$_GET[id]'");
          
          if ($sql1){
            echo 'alert("Orderan telah selesai");';
          }
        }else if (@$_GET['act'] == 'delete') {
          // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
          $sql = $mysqli->query("SELECT id_sp,jumlah_b from tbl_os where id_servis = '$_GET[id]'");
          // untuk lihat id_mobile
            $tampil   = $sql->fetch_assoc();
            $id_sp    = $tampil['id_sp'];
            $jumlah_b = $tampil['jumlah_b'];
          // update tb oren
          $sql1 = $mysqli->query("UPDATE tbl_os set status='Dibatalkan' WHERE id_servis = '$_GET[id]'");
          // update tb_mobile
          $sql2 = $mysqli->query("UPDATE tbl_sparepart set jumlah_sp = jumlah_sp + '$jumlah_b' where id_sp = '$id_sp'");
          
          if ($sql1 && $sql2){
            echo 'alert("Orderan Berhasil Dibatalkan");';
          }
        }
        ?>
        $(document).on("click", "#form_edit", function(){
          var id_servis     = $(this).data('id_servis');
          var no_polisi     = $(this).data('no_polisi');
          var kustom_nama   = $(this).data('kustom_nama');
          var email         = $(this).data('email');
          var status_p      = $(this).data('status_p');
          var denda         = $(this).data('denda');
          var model_mobil   = $(this).data('model_mobil');
          var tgl_dirental  = $(this).data('tgl_dirental');
          var tgl_kembali   = $(this).data('tgl_kembali');
          var harga         = $(this).data('harga');
          $("  #id_servis").val(id_servis);
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
          document.location='eos.php';
        }
        href=""
      </script>

      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Data Order Servis Sparepart</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Servis Sparepart</li>
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
                 <a href="?page=data_osm&act=tambah" class="btn btn-success btn-sm float-right" type="button">
                  <i class="fa fa-plus"></i> Tambah Order Servis Sparepart Masyarakat
                </a>
                <br><br>
                <a href="?page=data_osp&act=tambah" class="btn btn-success btn-sm float-right" type="button">
                  <i class="fa fa-plus"></i> Tambah Order Servis Sparepart Perusahaan
                </a>
                <div class="table-responsive">
                  <table id="zero_config" class="table table-striped table-bordered">
                    <thead align="center">
                      <tr>
                        <th width="25px">No.</th>
                        <th>Kode Servis</th>
                        <th>Nama Karyawan</th>
                        <th>Tanggal Order</th>
                        <th>Nama Mekanik</th>
                        <th>Nama Pelanggan</th>
                        <th>Email</th>
                        <th>Status Pelanggan</th>
                        <th>Nama Sparepart</th>
                        <th>Model Sparepat</th>
                        <th>Harga</th>
                        <th>Jumlah Barang</th>
                        <th>Total Bayar</th>
                        <th>Perkiraan Selesai</th>
                        <th>Status</th>
                        <th width="25px">Action</th>
                      </tr>
                    </thead>
                    <tbody align="center">
                      <?php
                      // data sparepart
                      $tampil1=$mysqli->query("SELECT * FROM tbl_sparepart");
                      $no = 1;
                      $sparepart = new stdClass();
                      while ($data1=$tampil1->fetch_object()){
                        $id_sp = $data1->id_sp;
                        $sparepart->$id_sp =  $data1->nama_sp;
                      }

                      // data os
                      $tampil=$mysqli->query("SELECT *,tbl_os.status AS status_os FROM tbl_os INNER JOIN kustom ON kustom.kustom_id = tbl_os.kustom_id INNER JOIN tbl_mekanik ON tbl_mekanik.id_mnk = tbl_os.id_mnk inner join users on users.id_karyawan = tbl_os.id_karyawan ORDER BY tbl_os.id_servis");
                      $no = 1;
                      while ($data=$tampil->fetch_object()){
                      ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data->id_servis ?></td>    
                        <td><?= $data->nama ?></td>
                        <td><?= date('d-m-Y',strtotime($data->tgl_masuk)) ?></td>
                        <td><?= $data->nama_mnk ?></td>
                        <td><?= $data->kustom_nama ?></td>
                        <td><?= $data->email ?></td>
                        <td><?= $data->status_p ?></td>
                        <td class="render_sparepart"><?= $data->id_sp ?></td>
                        <td class="render_model_sp"><?= $data->model_sp ?></td>
                        <td class="render_harga"><?= $data->harga?></td>
                        <td class="render_jumlah_b"><?= $data->jumlah_b ?></td>
                        <td><?= $data->total_bayar ?></td>
                        <td><?= date('d-m-Y',strtotime($data->perkiraan_selesai)) ?></td>
                        <td><?= $data->status_os ?></td>
                        <td>

                       
                          <a href="?page=data_os&act=selesaikan&id=<?= $data->id_servis?>&status=selesaikan"><button type="button" class="btn btn-primary " onclick="return confirm('Apakah anda yakin orderan sudah Selesai?');"><i class = "fa fa-check"></i></button></a>
                          <a href="?page=data_os&act=delete&id=<?= $data->id_servis?>&status=batalkan" onclick="return confirm('Apakah anda yakin akan membatalkannya?');" class="btn btn-danger" >
                            <i class="fa fa-times" aria-hidden="true"></i>
                          </a>
                          <a href="print_servis.php?&id=<?=$data->id_servis?>"target="_blank">
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
     <!--  <div id="tambah" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> Tambah Order Servis Sparepart</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="?page=data_os&act=tambah" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <?php
                  $sql = $mysqli->query("SELECT * FROM tbl_os");

                  // IF INLINE { GOOGLING KALAU BELUM TAHU }
                  $sql->num_rows <> 0 ? $kode = $sql->num_rows + 1 : $kode = 1;
                  
                  $bikin_kode = str_pad($kode, 2, "0", STR_PAD_LEFT);
                  $tahun = date('Ym');
                  $kode_jadi = "KOSS$tahun$bikin_kode";
                  ?>
                  <label class="control-label" for="id_servis">Kode Order Servis Sparepart</label>
                  <input type="text" class="form-control" id="id_servis" name="id_servis" value="<?= $kode_jadi ?>" required="" readonly="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="nama_mnk">Nama Sparepart</label>
                  <select class="id_sp form-control  custom-select" name="id_sp" style="width: 100%; height:36px;">
                    </select>
                </div>  
                <div id="tampilsparepart"></div>
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
                    <input type="number" name="jumlah_b" class="form-control" id="jumlah_b" required="">     
                </div>
                <div class="form-group">
                  <label class="control-label" for="tgl_dirental">Tanggal Order</label>
                  <input type="date" name="tgl_masuk" class="form-control" id="tgl_masuk">   
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
      </div> -->
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
                  <input type="text" class="form-control" id="id_servis" name="id_servis" value="" required="" readonly="">
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
                  <label class="control-label" for="denda">Denda / hari</label>
                  <input type="number" name="denda" class="form-control" id="denda" readonly="">
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
                  <label class="control-label" for="denda">Denda / hari</label>
                    <input type="number" name="denda" class="form-control" id="denda" readonly="">     
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
    <script>
      var sparepart = <?= json_encode($sparepart, JSON_PRETTY_PRINT) ?>;
      var sparepartNya = $(".render_sparepart").map(function() {
          id_sp = $(this).text();
          $(this).text('');
          var id = $.parseJSON(id_sp);
          var i = 0;
          for (nama_sp in id) {
            $(this).append(i+1 + ". " + sparepart[id[nama_sp]] + "<br>");
            i++;
          }
      });

      var model_spNya = $(".render_model_sp").map(function() {
          id_sp = $(this).text();
          $(this).text('');
          var id = $.parseJSON(id_sp);
          var i = 0;
          for (nama_sp in id) {
            $(this).append(i+1 + ". " + id[nama_sp] + "<br>");
            i++;
          }
      });

      var hargaNya = $(".render_harga").map(function() {
          id_sp = $(this).text();
          $(this).text('');
          var id = $.parseJSON(id_sp);
          var i = 0;
          for (nama_sp in id) {
            $(this).append(i+1 + ". " + id[nama_sp] + "<br>");
            i++;
          }
      });

      var jumlah_bNya = $(".render_jumlah_b").map(function() {
          id_sp = $(this).text();
          $(this).text('');
          var id = $.parseJSON(id_sp);
          var i = 0;
          for (nama_sp in id) {
            $(this).append(i+1 + ". " + id[nama_sp] + "<br>");
            i++;
          }
      });
    </script>