
<?php
  //men nak ngambek definisike dulu variable nyo
  $id_rental = $_GET['id_rental'];

  //men nak manggel tabel nyo
  $sql=$mysqli->query("SELECT * FROM tbl_oren  INNER JOIN tbl_mobil ON tbl_mobil.id_mobil = tbl_oren.id_mobil INNER JOIN kustom ON kustom.kustom_id = tbl_oren.kustom_id WHERE id_rental='$_GET[id]'");

  $tampil = $sql->fetch_assoc();

    // ini isi dari tabel yang nak ditampilke
    $id_rental    = $tampil['id_rental'];
    $id_mobil   = $tampil ['id_mobil'];
    $no_polisi   = $tampil ['no_polisi'];
    $model_mobil   = $tampil ['model_mobil'];
    $harga    = $tampil ['harga'];
    $kustom_id       = $tampil ['kustom_id'];
    $kustom_nama       = $tampil ['kustom_nama'];
    $email     = $tampil ['email'];
    $tipe        = $tampil ['tgl_dirental'];
    $tgl_kembali   = $tampil ['tgl_kembali'];
    $tgl_dirental   = $tampil ['tgl_dirental'];
    $denda    = $tampil['denda'];
        
?>


 <div class="page-breadcrumb">
  <div class="row">
    <div class="col-5 align-self-center">
      <h4 class="page-title">Data Order Rental</h4>
    </div>
    <div class="col-7 align-self-center">
      <div class="d-flex align-items-center justify-content-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Rental Mobil</li>
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
                <h4 class="modal-title"> Edit Data Rental</h4>
              <hr>
              <form class="form-horizontal" method="post" >
              <div class="form-group row">
              	<label for="id_mobil" class="col-sm-3 text-right control-label col-form-label">Kode Rental</label>
              	<div class="col-sm-9">
              		<input type="text" class="form-control" name="id_rental" id="id_rental"  value="<?= $id_rental; ?>" readonly="" >
              	</div>
              </div>
              <div class="form-group row">
                <label for="no_polisi" class="col-sm-3 text-right control-label col-form-label">Nomor Polisi</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="no_polisi" id="no_polisi" value="<?=$no_polisi;?>" readonly="" >
                </div>
              </div> 
              <div class="form-group row">
                <label for="no_polisi" class="col-sm-3 text-right control-label col-form-label">Model Mobil</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="model_mobil" id="model_mobil" value="<?=$model_mobil;?>" readonly="" >
                </div>
              </div>
              <div class="form-group row">
               <label for="harga" class="col-sm-3 text-right control-label col-form-label">Harga</label>
               <div class="col-sm-9">
                <input type="number" class="form-control" name="harga" id="harga" value="<?=$harga;?>" readonly="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="model_mobil" class="col-sm-3 text-right control-label col-form-label">Model Mobil</label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="model_mobil" id="model_mobil"  value="<?= $model_mobil; ?>" readonly="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="tgl_masuk" class="col-sm-3 text-right control-label col-form-label">Nama Pelanggan</label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="kustom_nama" id="kustom_nama"  value="<?= $kustom_nama; ?>" readonly="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="lokasi_mbl" class="col-sm-3 text-right control-label col-form-label">Email</label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="email" id="email" value="<?=$email;?>" readonly="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="tgl_masuk" class="col-sm-3 text-right control-label col-form-label">Tanggal Dirental</label>
               <div class="col-sm-9">
                <input type="date" class="form-control" name="tgl_dirental" id="tgl_dirental"  value="<?= $tgl_dirental; ?>" readonly="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="lokasi_mbl" class="col-sm-3 text-right control-label col-form-label">Tanggal Kembali</label>
               <div class="col-sm-9">
                <input type="date" class="form-control" name="tgl_kembali" id="tgl_kembali" value="<?=$tgl_kembali;?>" readonly="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="lokasi_mbl" class="col-sm-3 text-right control-label col-form-label">Denda / hari</label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="denda" id="denda" value="<?=$denda;?>" readonly="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="lokasi_mbl" class="col-sm-3 text-right control-label col-form-label">Tanggal Dikembalikan</label>
               <div class="col-sm-9">
                <input type="date" class="form-control" name="" id="tgl2" value="<?= date('Y-m-d'); ?>" required="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="lokasi_mbl" class="col-sm-3 text-right control-label col-form-label">Lewat Masa Tenggang / hari</label>
               <div class="col-sm-9">
                <input type="number" class="form-control" name="" id="selisih" value="0" readonly="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="lokasi_mbl" class="col-sm-3 text-right control-label col-form-label">Denda Lain - lain</label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="denda_lain" id="denda_lain" value="0" required="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="lokasi_mbl" class="col-sm-3 text-right control-label col-form-label">Total Denda</label>
               <div class="col-sm-9">
                <input type="number" class="form-control" name="total_denda" id="total-denda" value="0" readonly="" >
               </div>
              </div>
               <div class="form-group row">
               <label for="lokasi_mbl" class="col-sm-3 text-right control-label col-form-label">Total</label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="total" id="total" value="" readonly="" >
               </div>
              </div>
               <div class="modal-footer">
                	<a href="javascript:history.back()" class="btn btn-info mdi mdi-keyboard-backspace"></i></a> 
                <input type="submit" class="btn btn-success" value="Simpan" name="simpan"> 
               </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  			<script type="text/javascript">
          $(document).on("click",  function(){
            start_rental  = $(this).data('tgl_dirental');
            end_rental    = $(this).data('tgl_kembali');
            lama_rental   = parseInt(selisih_hari(new Date(start_rental), new Date(end_rental)));
            denda_perhari = $(this).data('denda');
            harga_perhari = $(this).data('harga');
            hitung_biaya();       
          });
      //ini javascript untuk nampilke hasil dari pilihan yang pake select2
           $('.id_brand').select2({
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

             $('.id_brand').empty().append('<option selected value="<?= $id_brand ?>"><?= $brand ?></option>');
              $('.id_brand').select2('data', {
                  id: '<?= $id_brand ?>',
                  label: '<?= $brand ?>'
              });
              $('.id_brand').trigger('change'); 

              $('.id_tipe').select2({
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

           $('.id_tipe').empty().append('<option selected value="<?= $id_tipe ?>"><?= $tipe ?></option>');
              $('.id_tipe').select2('data', {
                  id: '<?= $id_tipe ?>',
                  label: '<?= $tipe ?>'
              });
              $('.id_tipe').trigger('change');

             $(document).ready(function(){

    $("#total").keyup(function(){
      var val = $(this).val();
      var harga = $("#harga").val();
      $("#total").val(total);
    });
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
          // $(document).ready(function(){
          //   $("#total").keyup(function(){
          //       var val = $(this).val();
          //       var harga = $("#harga").val();
          //     $("#total").val(total);

          //   });  
          // });  

          //     function selisih_hari(diffstart, diffend){
          //     var total   = diffend-diffstart;
          //     var days    = total/1000/60/60/24;
          //     return days;
          //   }

          //   $('#tgl2, #denda_lain').on("input", function() {
          //     hitung_biaya();
          //   });

          //   function hitung_biaya(){
          //     var start       = end_rental;
          //     var end         = $("#tgl2").val();
          //     var denda       = denda_perhari; // 
          //     var denda_lain  = $("#denda_lain").val();
          //     var diffstart   = new Date(start);
          //     var diffend     = new Date(end);

          //     // get days
          //     var days  = parseInt(selisih_hari(diffstart, diffend));
          //     // alert(days);
          //     // console.log("Denda Lain : " + denda_lain);
          //     // console.log("Hari : " + days);
          //     // console.log("Denda : " + denda);
          //     // console.log("Biaya Rental : " + (lama_rental*harga_perhari));

          //     if (days <= 0) {
          //       var t = (lama_rental*harga_perhari) + 0 + parseInt(denda_lain);
          //       $("#selisih").val(0);
          //       $("#total").val(t);
          //     } else {
          //       var t = (lama_rental*harga_perhari) + (denda* days) + parseInt(denda_lain);
          //       $("#total-denda").val(denda*days);
          //       $("#selisih").val(days);
          //       $("#total").val(t);
          //     }
          //   }

          //   $(document).on("click", function(){
          //       start_rental  = $(this).data('tgl_dirental');
          //       end_rental    = $(this).data('tgl_kembali');
          //       lama_rental   = parseInt(selisih_hari(new Date(start_rental), new Date(end_rental)));
          //       denda_perhari = $(this).data('denda');
          //       harga_perhari = $(this).data('harga');
          //       hitung_biaya();       
          //   });

        </script>


<?php

if (isset($_POST['simpan'])) {
 $sql = $mysqli->query("UPDATE tbl_mobil SET no_polisi='$_POST[no_polisi]',id_brand='$_POST[id_brand]', id_tipe='$_POST[id_tipe]',model_mobil='$_POST[model_mobil]',harga='$_POST[harga]',tgl_masuk='$_POST[tgl_masuk]',lokasi_mbl='$_POST[lokasi_mbl]' where id_mobil='$_GET[id]' ");

  if ($sql){

  ?>
   <script type="text/javascript">
     
     alert ("Data Berhasil Diubah");
          window.location.href="?page=data_mobil";


   </script>
   <?php 
  }

}
?>