<?php 
include('koneksi.php');
$id_mobil 	= $mysqli->escape_string($_POST['id_mobil']); 
if (empty($id_mobil)) {
	exit();
} else {
	$sql=$mysqli->query("SELECT * FROM tbl_mobil where id_mobil='$id_mobil'");
	
	$tampil=$sql->fetch_assoc();
	$model_mobil = $tampil['model_mobil'];
	$harga 	 	 = $tampil['harga'];
	$denda 		 = $tampil['denda'];
	
?>
	<div class="form-group row">
		<label class="col-sm-3 text-right control-label col-form-label" for="model_mobil">Model Mobil</label>
		<div class="col-sm-9">
			<input type="text" name="model_mobil" class="form-control" id="model_mobil" value="<?=$model_mobil;?>" readonly="">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 text-right control-label col-form-label" for="model_mobil">Harga Mobil</label>
		<div class="col-sm-9">
			<input type="text" name="harga" class="form-control" id="harga" value="<?=$harga;?>" readonly="">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 text-right control-label col-form-label" for="denda">Denda / Hari</label>
		<div class="col-sm-9">
			<input type="text" name="denda" class="form-control" id="denda" value="<?=$denda;?>" readonly="">
		</div>
	</div>
<? } ?>