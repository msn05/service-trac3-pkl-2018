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
	<div class="form-group">
		<label class="control-label" for="model_mobil">Model Mobil</label>
		<input type="text" name="model_mobil" class="form-control" id="model_mobil" value="<?=$model_mobil;?>" readonly="">
	</div>
	<div class="form-group">
		<label class="control-label" for="model_mobil">Harga Mobil</label>
		<input type="text" name="harga" class="form-control" id="harga" value="<?=$harga;?>" readonly="">
	</div>
	<div class="form-group">
		<label class="control-label" for="denda">Denda / Hari</label>
		<input type="text" name="denda" class="form-control" id="denda" value="<?=$denda;?>" readonly="">
	</div>
<? } ?>