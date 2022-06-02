 <script type="text/javascript">
    <?php
    $sql = false;  error_reporting(0);

    //PROSES TAMBAH EDIT DAN HAPUS DALAM BENTUK PERCABANGAN
      if (@$_GET['act'] == 'tambah' && !empty($_POST['id_servis'])) {
        // filter inputan [ GOOGLING KALAU TIDAK TAHU ] => REFERENSI : { KERENTANAN SQL Injection }
        $sp = $mysqli->query("SELECT * from tbl_sparepart where id_sp = '$_POST[id_sp]'");
        $spNya = $sp->fetch_array();
    // untuk lihat id_mobile
        $tampil   = $sql->fetch_assoc();
        $id_sp    = $tampil['id_sp'];
        $jumlah_b = $tampil['jumlah_b'];
                      
       if ($_POST[jumlah_b] > $spNya[jumlah_sp]){
           echo 'alert("Maaf Stok Barang yang tersedia tidak mencukupi, Silahkan Ulangi Lagi Ya BRO..");';
       }else{
          $id_servis          = $mysqli->escape_string($_POST ['id_servis']);
          $tgl_masuk          = $mysqli->escape_string($_POST['tgl_masuk']);
          $id_sp              = $mysqli->escape_string($_POST ['id_sp']);
          $kustom_id          = $mysqli->escape_string($_POST['kustom_id']);
          $email              = $mysqli->escape_string($_POST['email']);
          $status_p           = $mysqli->escape_string($_POST['status_p']);
          $harga              = $mysqli->escape_string($_POST['harga']);
          $jumlah_b           = $mysqli->escape_string($_POST['jumlah_b']);
          $total_bayar        = $mysqli->escape_string($_POST['total_bayar']);
          $perkiraan_selesai  = $mysqli->escape_string($_POST['perkiraan_selesai']);
          $id_mnk             = $mysqli->escape_string($_POST['id_mnk']);
          $alamat             = $mysqli->escape_string($_POST['alamat']);
          $status             = $mysqli->escape_string($_POST['status']);
          $model_sp           = $mysqli->escape_string($_POST['model_sp']);
          $id_karyawan        = $mysqli->escape_string($_SESSION['id_karyawan']);

           $sql1= $mysqli->query("INSERT INTO tbl_os (id_servis,id_karyawan,tgl_masuk,kustom_id,email,status_p,id_sp,jumlah_b,model_sp,harga,total_bayar,id_mnk,perkiraan_selesai,status) VALUES ('$id_servis','$id_karyawan','$tgl_masuk','$kustom_id','$email','$status_p','$id_sp','$jumlah_b','$model_sp','$harga','$total_bayar','$id_mnk','$perkiraan_selesai','Dalam proses')");

            $sql2=$mysqli->query("UPDATE tbl_sparepart set jumlah_sp = jumlah_sp  - '$jumlah_b' where id_sp = '$id_sp'");

             if ($sql1 && $sql2){
                  echo 'alert("Data Berhasil Disimpan");';
             }else{
              echo 'alert("data gagal disimpan");';
             }
       }
                     
     }
   ?>
  </script>
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-5 align-self-center">
      <h4 class="page-title">Data Order Servis Sparepart Masyarakat</h4>
    </div>
    <div class="col-7 align-self-center">
      <div class="d-flex align-items-center justify-content-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Data Order Servis Sparepart Masyarakat</li>
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
                <h4 class="modal-title"> Data Order Servis Sparepart Masyarakat</h4>
              <hr>
              <form class="form-horizontal" action="?page=data_osp&act=tambah" method="post" enctype="multipart/form-data" >
               <div class="modal-body">
                  <div class="form-group row">
                   <?php
                  $sql = $mysqli->query("SELECT * FROM tbl_os");

                  // IF INLINE { GOOGLING KALAU BELUM TAHU }
                  $sql->num_rows <> 0 ? $kode = $sql->num_rows + 1 : $kode = 1;
                  
                  $bikin_kode = str_pad($kode, 2, "0", STR_PAD_LEFT);
                  $tahun = date('Ym');
                  $kode_jadi = "KOSS$tahun$bikin_kode";
                  ?>
                    <label class="col-sm-3 text-right control-label col-form-label" for="id_rental">Kode Order Rental</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="id_rental" name="id_rental" value="<?= $kode_jadi ?>" required="" readonly="">
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label" for="nama_mnk">Nama Sparepart</label>
                    <div class="col-sm-9">
                      <select class="id_sp form-control  custom-select" name="id_sp" style="width: 100%; height:36px;" multiple="multiple">
                      </select>
                    </div>
                  </div>  
                  <div id="tampilsparepart"></div>
                  <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label" for="nama_mnk">Nama Pelanggan</label>
                    <div class="col-sm-9">
                      <select class="kustom_id form-control  custom-select" name="kustom_id" style="width: 100%; height:36px;">
                      </select>
                    </div>
                  </div> 
                  <div id="tampilpelanggan"></div>
                  <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label" for="nama_mnk">Nama Mekanik</label>
                    <div class="col-sm-9">
                      <select class="id_mnk form-control  custom-select" name="id_mnk" style="width: 100%; height:36px;">
                      </select>
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label" for="tgl_dirental">Jumlah Barang</label>
                    <div class="col-sm-9">
                      <input type="number" name="jumlah_b" class="form-control" id="jumlah_b">   
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label" for="tgl_dirental">Tanggal Order</label>
                    <div class="col-sm-9">
                      <input type="date" name="tgl_masuk" class="form-control" id="tgl_masuk">   
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label" for="tgl_dirental">Total Bayar</label>
                    <div class="col-sm-9">
                      <input type="number" name="total_bayar" class="form-control" id="total_bayar" readonly="">   
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label" for="tgl_dirental">Perkiraan Selesai</label>
                    <div class="col-sm-9">
                      <input type="date" name="perkiraan_selesai" class="form-control" id="perkiraan_selesai">   
                    </div>
                  </div>
                  <div class="modal-footer">
                    <a href="javascript:history.back()" class="btn btn-info mdi mdi-keyboard-backspace"></i></a>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <input type="submit" class="btn btn-success" value="Simpan"> 
                  </div>
                </div>  
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
   <script type="text/javascript">
    $('.id_sp').select2({
            placeholder: 'Pilih Sparepart Nya',
            ajax: {
              url: 'json_sparepart.php',
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
        
      $('.id_sp').change(function(){
            var id_sp = $(this).val();
            $.ajax({
              type: 'POST',
              url: 'data_sparepart.php',
              data: 'id_sp='+id_sp,
              success:function(msg){
                $("#tampilsparepart").html(msg);                  
              }
            });
    });

     $('.kustom_id').select2({
            placeholder: 'Pilih Nama Pelanggan ',
            ajax: {
              url: 'json_pelangganm.php',
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
            url: 'data_pelangganp.php',
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
      
     $("#jumlah_b").on("input", function() {
        var val = $(this).val();
        var harga = $("#harga").val();
        var total_bayar = val * harga;
        console.log(total_bayar);
        $("#total_bayar").val(total_bayar);

     });
  </script>