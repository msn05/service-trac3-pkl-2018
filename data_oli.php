<?php 
include('koneksi.php');
$id_oli = $mysqli->escape_string($_POST['id_oli']); 
if (empty($id_oli)) {
	exit();
} else {
	$sql=$mysqli->query("SELECT * FROM tbl_oli where id_oli='$id_oli'");
	
	$tampil=$sql->fetch_assoc();
	$harga 			 = $tampil['harga'];
	
?>
				
	<div class="form-group">
		<label class="control-label" for="model_mobil">Harga Mobil</label>
		<input type="text" name="harga" class="form-control" id="harga" value="<?=$harga;?>" readonly="">
	</div>
<? } ?>