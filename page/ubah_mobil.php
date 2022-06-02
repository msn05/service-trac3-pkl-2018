<?php
error_reporting(0);
  //men nak ngambek definisike dulu variable nyo
  $id_mobil = $_GET['id_mobil'];

  //men nak manggel tabel nyo
  $sql=$mysqli->query("SELECT * FROM tbl_mobil  INNER JOIN brandm ON brandm.id_brand = tbl_mobil.id_brand INNER JOIN merk_b ON merk_b.id_tipe = tbl_mobil.id_tipe WHERE id_mobil='$_GET[id]'");

  $tampil = $sql->fetch_assoc();

    // ini isi dari tabel yang nak ditampilke
    $id_mobil    = $tampil['id_mobil'];
    $no_polisi   = $tampil ['no_polisi'];
    $id_brand    = $tampil ['id_brand'];
    $brand       = $tampil ['brand'];
    $id_tipe     = $tampil ['id_tipe'];
    $tipe        = $tampil ['tipe'];
    $model_mobil = $tampil ['model_mobil'];
    $harga       = $tampil ['harga'];
    $denda   = $tampil ['denda'];
    $tgl_masuk   = $tampil ['tgl_masuk'];
    $lokasi_mbl  = $tampil ['lokasi_mbl'];
    
?>


 <div class="page-breadcrumb">
  <div class="row">
    <div class="col-5 align-self-center">
      <h4 class="page-title">Data Mobil</h4>
    </div>
    <div class="col-7 align-self-center">
      <div class="d-flex align-items-center justify-content-end">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Mobil</li>
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
                <h4 class="modal-title"> Edit Data Mobil</h4>
              <hr>
              <form class="form-horizontal" method="post" >
              <div class="form-group row">
              	<label for="id_mobil" class="col-sm-3 text-right control-label col-form-label">Kode Mobil</label>
              	<div class="col-sm-9">
              		<input type="text" class="form-control" name="id_mobil" id="id_mobil"  value="<?= $id_mobil; ?>" readonly="" >
              	</div>
              </div>
              <div class="form-group row">
              	<label for="no_polisi" class="col-sm-3 text-right control-label col-form-label">Nomor Polisi</label>
              	<div class="col-sm-9">
              		<input type="text" class="form-control" name="no_polisi" id="no_polisi" value="<?=$no_polisi;?>" required="" >
              	</div>
              </div>
              <div class="form-group row">
               <label for="brand" class="col-sm-3 text-right control-label col-form-label">Brand</label>
               <div class="col-sm-9">
                <select class="id_brand form-control custom-select" name="id_brand" id="id_brand" style="width: 100%; height:36px;" required=""></select>
               </div>
              </div>
              <div class="form-group row">
              	<label for="id_mobil" class="col-sm-3 text-right control-label col-form-label">Tipe</label>
              	<div class="col-sm-9">
              	 <select class="id_tipe form-control custom-select" name="id_tipe" id="id_tipe" style="width: 100%; height:36px;" required=""></select>
              	</div>
              </div>
              <div class="form-group row">
               <label for="model_mobil" class="col-sm-3 text-right control-label col-form-label">Model Mobil</label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="model_mobil" id="model_mobil"  value="<?= $model_mobil; ?>" required="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="harga" class="col-sm-3 text-right control-label col-form-label">Harga</label>
               <div class="col-sm-9">
                <input type="number" class="form-control" name="harga" id="harga" value="<?=$harga;?>" required="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="denda" class="col-sm-3 text-right control-label col-form-label">Denda / Hari</label>
               <div class="col-sm-9">
                <input type="number" class="form-control" name="denda" id="denda" value="<?=$denda;?>" required="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="tgl_masuk" class="col-sm-3 text-right control-label col-form-label">Tanggal Masuk</label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="tgl_masuk" id="tgl_masuk"  value="<?= $tgl_masuk; ?>" required="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="lokasi_mbl" class="col-sm-3 text-right control-label col-form-label">Lokasi Mobil</label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="lokasi_mbl" id="lokasi_mbl" value="<?=$lokasi_mbl;?>" required="" >
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

        </script>


<?php

if (isset($_POST['simpan'])) {
 $sql = $mysqli->query("UPDATE tbl_mobil SET no_polisi='$_POST[no_polisi]',id_brand='$_POST[id_brand]', id_tipe='$_POST[id_tipe]',model_mobil='$_POST[model_mobil]',harga='$_POST[harga]',denda='$_POST[denda]',tgl_masuk='$_POST[tgl_masuk]',lokasi_mbl='$_POST[lokasi_mbl]' where id_mobil='$_GET[id]' ");

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