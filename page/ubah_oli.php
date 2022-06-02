<?php
  //men nak ngambek definisike dulu variable nyo
  $id_oli = $_GET['id_oli'];

  //men nak manggel tabel nyo
  $sql=$mysqli->query("SELECT * FROM tbl_oli  INNER JOIN brandm ON brandm.id_brand = tbl_oli.id_brand INNER JOIN merk_b ON merk_b.id_tipe = tbl_oli.id_tipe WHERE id_oli='$_GET[id]'");

  $tampil = $sql->fetch_assoc();

    // ini isi dari tabel yang nak ditampilke
    $id_oli      = $tampil['id_oli'];
    $nama_oli    = $tampil ['nama_oli'];
    $id_brand   = $tampil ['id_brand'];
    $brand      = $tampil ['brand'];
    $id_tipe    = $tampil ['id_tipe'];
    $tipe       = $tampil ['tipe'];
    $model_sp   = $tampil ['model_sp'];
    $harga      = $tampil ['harga'];
    $tgl_doli    = $tampil ['tgl_doli'];
    $jmlh_oli  = $tampil ['jmlh_oli'];
    
?>


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
                <h4 class="modal-title"> Edit Data Oli</h4>
              <hr>
              <form class="form-horizontal" method="post" >
              <div class="form-group row">
              	<label for="id_mobil" class="col-sm-3 text-right control-label col-form-label">Kode Oli</label>
              	<div class="col-sm-9">
              		<input type="text" class="form-control" name="id_oli" id="id_oli"  value="<?= $id_oli; ?>" readonly="" >
              	</div>
              </div>
              <div class="form-group row">
              	<label for="no_polisi" class="col-sm-3 text-right control-label col-form-label">Nama Oli</label>
              	<div class="col-sm-9">
              		<input type="text" class="form-control" name="nama_oli" id="nama_oli" value="<?=$nama_oli;?>" required="" >
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
               <label for="tgl_masuk" class="col-sm-3 text-right control-label col-form-label">Tanggal Masuk</label>
               <div class="col-sm-9">
                <input type="text" class="form-control" name="tgl_doli" id="tgl_doli"  value="<?= $tgl_doli; ?>" required="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="lokasi_mbl" class="col-sm-3 text-right control-label col-form-label">Jumlah Oli</label>
               <div class="col-sm-9">
                <input type="number" class="form-control" name="jmlh_oli" id="jmlh_oli" value="<?=$jmlh_oli;?>" required="" >
               </div>
              </div>
              <div class="form-group row">
               <label for="harga" class="col-sm-3 text-right control-label col-form-label">Harga</label>
               <div class="col-sm-9">
                <input type="number" class="form-control" name="harga" id="harga" value="<?=$harga;?>" required="" >
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
 $sql = $mysqli->query("UPDATE tbl_oli SET nama_oli='$_POST[nama_oli]', id_brand='$_POST[id_brand]', id_tipe='$_POST[id_tipe]',tgl_doli='$_POST[tgl_doli]', jmlh_oli='$_POST[jmlh_oli]',harga='$_POST[harga]' where id_oli='$_GET[id]' ");

  if ($sql){

  ?>
   <script type="text/javascript">
     
     alert ("Data Berhasil Diubah");
          window.location.href="?page=data_oli";


   </script>
   <?php 
  }

}
?>