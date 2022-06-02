<?php 
include('koneksi.php');
$id_sp = $mysqli->escape_string($_POST['id_sp']); 
if (empty($id_sp)) {
	exit();
} else {
	$where = '';
	$param = explode(",",$id_sp);
	foreach ($param as $key => $value) {
		$where .= "OR id_sp='$value' "; 
	}
	// echo substr($where, 2);
	// query get any data with multiple param for get total data
	// echo "SELECT SUM(`harga`) FROM tbl_sparepart where $where";
	$where = substr($where, 2);
	// echo "SELECT SUM(`harga`) AS total_harga FROM tbl_sparepart where $where";
	$sql=$mysqli->query("SELECT SUM(`harga`) AS total_harga FROM tbl_sparepart where $where");
	
	$tampil=$sql->fetch_assoc();
	$harga 	  = $tampil['total_harga'];
	
	$i=1;
	foreach ($param as $key => $value) {
		// get data model
		$sql=$mysqli->query("SELECT * FROM tbl_sparepart where id_sp='$value'");
	
		$tampil=$sql->fetch_assoc();
		$model_sp = $tampil['model_sp'];
?>
	<div class="form-group row">
		<label  class="col-sm-3 text-right control-label col-form-label" for="model_sp"><?= $tampil['nama_sp'] ?></label>
		<div class="col-sm-2">
			<input type="text" class="form-control id_sp" value="<?=$value?>" disabled="">
		</div>
		<div class="col-sm-2">
			<input type="text" name="model_sp[]" class="form-control" value="<?=$model_sp?>" readonly="">
		</div>
		<div class="col-sm-2">
			<input type="text" name="harga[]" class="form-control harga" value="<?= $tampil['harga'] ?>" data-code="<?=$model_sp;?>" readonly="">
		</div>
		<div class="col-sm-1">
			<input type="number" class="form-control jumlah_b" name="jumlah_b[]" data-code="<?=$model_sp;?>" max="<?= $tampil['jumlah_sp'] ?>" min="0" required="">
		</div>
		<div class="col-sm-2">
			<input type="text" class="form-control jumlah_bayar" name="jumlah_bayar[]" data-code="<?=$model_sp;?>" readonly="" value="0">
		</div>

	</div>
<?php } ?>
	<div class="form-group row">
		<label  class="col-sm-3 text-right control-label col-form-label" for="model_sp">Total Bayar </label>
		<div class="col-sm-9">
			<input type="text" name="total_bayar" class="form-control" id="total_bayar" value="0" readonly="">
		</div>
	</div>
<?php } ?>
<script type="text/javascript">
 $(".jumlah_b").on("input", function() {
    var id_sp = $(this).parent('div').parent('div').find(".id_sp").val();
    var model_sp = $(this).parent('div').parent('div').find(".model_sp").val();
    var harga = $(this).parent('div').parent('div').find(".harga").val();
    var jumlah_b = $(this).parent('div').parent('div').find(".jumlah_b").val();

    var jumlah_bayar = harga * jumlah_b;
    console.log(harga);
    $(this).parent('div').parent('div').find(".jumlah_bayar").val(jumlah_bayar);
    total_bayar();
    
 });
 function total_bayar(){
 		var sum = 0;
		$("input[class *= 'jumlah_bayar']").each(function(){
    	sum += +$(this).val();
    });

    $("#total_bayar").val(sum);
 }
</script>
