<?php 
include('koneksi.php');
$kustom_id = $mysqli->escape_string($_POST['kustom_id']); 
if (empty($kustom_id)) {
	exit();
} else {
	$sql=$mysqli->query("SELECT * FROM kustom where kustom_id='$kustom_id'");
	
	$tampil=$sql->fetch_assoc();
	$email 		= $tampil['email'];
	$status_p 	= $tampil['status'];
	
?>
	<div class="form-group row">
		<label class="col-sm-3 text-right control-label col-form-label" for="model_mobil">Email</label>
		<div class="col-sm-9">
			<input type="text" name="email" class="form-control" id="email" value="<?=$email;?>" readonly="">
		</div>
	</div>
	<div class="form-group row">
		<label class="col-sm-3 text-right control-label col-form-label" for="model_mobil">Status Pelanggan</label>
		
		<div class="col-sm-9">
			<input type="text" name="status_p" class="form-control" id="status_p" value="<?=$status_p;?>" readonly="">
		</div>
	</div>
<?php } ?>