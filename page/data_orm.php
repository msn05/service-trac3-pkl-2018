 <script type="text/javascript">
    <?php
    $sql = false;  error_reporting(0);

    // PROSES TAMBAH EDIT DAN HAPUS DALAM BENTUK PERCABANGAN
    if (@$_GET['act'] == 'tambah' && !empty($_POST['id_rental'])) {
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
        echo 'alert("Data Berhasil Disimpan"); location.href="?page=data_or"';
      }
    }
    ?>
  </script>
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-5 align-self-center">
      <h4 class="page-title">Data Order Rental Masyarakat</h4>
    </div>
    <div class="col-7 align-self-center">
      <div class="d-flex align-items-center justify-content-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Data Order Rental Masyarakat</li>
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
                <h4 class="modal-title"> Data Order Rental Masyarakat</h4>
              <hr>
              <form class="form-horizontal" action="?page=data_orm&act=tambah" method="post" enctype="multipart/form-data" >
               <div class="modal-body">
                  <div class="form-group row">
                    <?php
                    $sql = $mysqli->query("SELECT * FROM tbl_oren");

                    // IF INLINE { GOOGLING KALAU BELUM TAHU }
                    $sql->num_rows <> 0 ? $kode = $sql->num_rows + 1 : $kode = 1;
                    
                    $bikin_kode = str_pad($kode, 2, "0", STR_PAD_LEFT);
                    $tahun = date('Ym');
                    $kode_jadi = "KOR$tahun$bikin_kode";
                    ?>
                    <label class="col-sm-3 text-right control-label col-form-label" for="id_rental">Kode Order Rental</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="id_rental" name="id_rental" value="<?= $kode_jadi ?>" required="" readonly="">
                      </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label" for="nama_mnk">Nomor Polisi</label>
                    <div class="col-sm-9">
                      <select class="id_mobil form-control  custom-select" name="id_mobil" style="width: 100%; height:36px;">
                      </select>
                    </div>
                  </div>  
                  <div id="tampilmobil"></div>
                  <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label" for="nama_mnk">Nama Pelanggan</label>
                    <div class="col-sm-9">
                      <select class="kustom_id form-control  custom-select" name="kustom_id" style="width: 100%; height:36px;">
                      </select>
                    </div>
                  </div> 
                  <div id="tampilpelanggan"></div>
                  <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label" for="tgl_dirental">Tanggal Dirental</label>
                    <div class="col-sm-9">
                      <input type="date" name="tgl_dirental" class="form-control" id="tgl_dirental" value="-">   
                    </div>
                  </div> 
                  <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label" for="tgl_dirental">Tanggal Kembali</label>
                    <div class="col-sm-9">
                      <input type="date" name="tgl_kembali" class="form-control" id="tgl_kembali">   
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
        $('.id_mobil').select2({
                placeholder: 'Pilih Mobilnya',
                ajax: {
                  url: 'json_mobilm.php',
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
                url: 'data_mobilm.php',
                data: 'id_mobil='+id_mobil,
                success:function(msg){
                  $("#tampilmobil").html(msg);                  
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
            url: 'data_pelangganm.php',
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