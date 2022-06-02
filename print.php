<!DOCTYPE>
<html>
<head>
  <title>Cetak</title>
</head>
<body>
 <link href="dist/css/style.min.css" rel="stylesheet">
</head>
<body onload="window.print()">

<style type="text/css">
 table {
            margin: 0;
        
            font-size: 12px;

        }
        
tr    { box-sizing: content-box; }
td    {  webkit-box-sizing: content-box; }
.style37 { 
    font-size: 20px;
    font-weight: bold;
}
.tulisan_dua{
          text-align: right;
          text-transform: capitalize;
        }
.style38 {font-size: 12px}
.style14 {font-size: 10px}

</style>
<div class="main-grid">
 <div class="agile-grids"> 
  <table style="width: 100%; text-align: center; font-size: 14px">
   <tr>
     <td style="width:7%" rowspan="4"><img src="assets/images/logo3.png" alt="Logo" width="90" height="80"></td>
     <td style="width:93%"> </td>
   </tr>
   <tr>
     <td class="style37">SISTEM APLIKASI PENGOLAHAN DATA ORDER</td>
   </tr>
    <tr>
     <td class="style38">Jl. Soekarno Hatta No.45, Siring Agung, Ilir Bar. I, Kota Palembang, Sumatera Selatan 30153</td>
   </tr>
     <tr>
     <td class="style38">Telp. (0711) 444999</td>
   </tr>
    <tr>
       <td colspan="2"><hr/></td>
   </tr>
  </table>
  <?php
     include('koneksi.php');
     @$jenis = @$_GET['laporan'];
					  if (!empty($_GET['tgl_mulai'])) {
					    $tgl_mulai   = $_GET['tgl_mulai'];
					    $tgl_akhir = $_GET['tgl_akhir'];
					    $jenis = @$_GET['laporan'];
		}?>
		<br>
		<?php if ($_GET['laporan'] == 'rental'): ?>
		<div class="col-sm-4 control-label">Data Order Rental </div></p>
		<hr><br>
  <table id="zero_config" class="table table-striped table-bordered">
   <div>
   	<thead align="center">
		   <tr>
	     <th width="25px">No.</th>
	     <th>Kode Rental</th>
	     <th>Nama Karyawan</th>
	     <th>Nomor Polisi</th>
	     <th>Model Mobil</th>
	     <th>Harga</th>
	     <th>Denda / Hari</th>
	     <th>Nama Pelanggan</th>
	     <th>Email</th>
	     <th>Tanggal Dirental</th>
	     <th>Tanggal Kembali</th>
	     <th>Denda Lain - Lain</th>
	     <th>Tanggal Dikembalikan</th>
	     <th>Total Denda</th>
	     <th>Total</th>
	     <th>Status</th>
		   </tr>
		 </thead>
		 <tbody align="center">
		   <?php
		   $tampil=$mysqli->query("SELECT *,tbl_oren.status AS status_order FROM tbl_oren  INNER JOIN tbl_mobil ON tbl_mobil.id_mobil = tbl_oren.id_mobil INNER JOIN kustom ON kustom.kustom_id = tbl_oren.kustom_id inner join users on users.id_karyawan = tbl_oren.id_karyawan WHERE tbl_oren.tgl_dirental BETWEEN '$tgl_mulai' AND '$tgl_akhir' ORDER BY tbl_oren.id_rental");
		   $no = 1;
		   while ($data=$tampil->fetch_assoc()){
		   ?>
		   <tr>
	     <td><?= $no++ ?></td>
	     <td><?= $data['id_rental'] ?></td>    
	     <td><?= $data['nama'] ?></td>
	     <td><?= $data['no_polisi'] ?></td>
	     <td><?= $data['model_mobil'] ?></td>
	     <td><?= "Rp. ".number_format($data['harga'] )?></td>
	     <td><?= "Rp. ".number_format($data['denda'] )?></td>
	     <td><?= $data['kustom_nama'] ?></td>
	     <td><?= $data['email'] ?></td>
	     <td><?= date('d-m-Y',strtotime($data['tgl_dirental'])) ?></td>
	     <td><?= date('d-m-Y',strtotime($data['tgl_kembali'])) ?></td>
	     <td><?= "Rp. ".number_format($data['denda_lain'] )?></td>
	     <td><?= date('d-m-Y',strtotime($data['tgl_dikembalikan'])) ?></td>
	     <td><?= "Rp. ".number_format($data['total_denda'] )?></td>
	     <td><?= "Rp. ".number_format($data['total'] )?></td>
	     <td><?= $data['status_order'] ?></td>
		   </tr>
		   <?php  } ?>
	  </tbody>
	 </table>
		</div>

  <?php elseif ($_GET['laporan'] == 'sparepart'): ?>
  <div class="col-sm-4 control-label">Data Order Servis Sparepart</div></p>
		<hr><br>
		<table id="zero_config" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>No.</th>
     <th>Kode Servis</th>
     <th>Nama Karyawan</th>
     <th>Nama Sparepart</th>
     <th>Model Sparepat</th>
     <th>Harga</th>
     <th>Nama Mekanik</th>
     <th>Nama Pelanggan</th>
     <th>Email</th>
     <th>Jumlah Barang</th>
     <th>Tanggal Order</th>
     <th>Total Bayar</th>
     <th>Perkiraan Selesai</th>
     <th>Status</th>
				</tr>
			</thead>
		 <tbody>
  	<?php
  		$tampil=$mysqli->query("SELECT *,tbl_os.status AS status_os FROM tbl_os  INNER JOIN tbl_sparepart ON tbl_sparepart.id_sp = tbl_os.id_sp INNER JOIN kustom ON kustom.kustom_id = tbl_os.kustom_id INNER JOIN tbl_mekanik ON tbl_mekanik.id_mnk = tbl_os.id_mnk inner join users on users.id_karyawan = tbl_os.id_karyawan WHERE tbl_os.tgl_masuk BETWEEN '$tgl_mulai' AND '$tgl_akhir' ORDER BY tbl_os.id_servis") ;
		  $no = 1;
		  	while ($data=$tampil->fetch_assoc()){
		 ?>
		 	<tr>
     <td><?= $no++ ?></td>
     <td><?= $data['id_servis'] ?></td>    
     <td><?= $data['nama'] ?></td>
     <td><?= $data['nama_sp'] ?></td>
     <td><?= $data['model_sp'] ?></td>
     <td><?= "Rp. ".number_format($data['harga'] )?></td>
     <td><?= $data['nama_mnk'] ?></td>
     <td><?= $data['kustom_nama'] ?></td>
     <td><?= $data['email'] ?></td>
     <td><?= $data['jumlah_b'] ?> Unit</td>
     <td><?= date('d-m-Y',strtotime($data['tgl_masuk'])) ?></td>
     <td><?= "Rp. ".number_format($data['total_bayar '])?></td>
     <td><?= date('d-m-Y',strtotime($data['perkiraan_selesai'])) ?></td>
     <td><?= $data['status_os'] ?></td>
    </tr>
		  <?php }?>
		 </tbody>
		</table> 
		</div>        
		<?php elseif ($_GET['laporan'] == 'oli'): ?>
		<div class="col-sm-4 control-label">Data Order Servis Oli </div></p>
		<hr><br>
 	<table id="zero_config" class="table table-striped table-bordered">
 		<thead align="center">
	   <tr>
     <th width="25px">No.</th>
     <th>Kode Servis</th>
     <th>Nama Karyawan</th>
     <th>Nama Oli</th>
     <th>Harga</th>
     <th>Nama Mekanik</th>
     <th>Nama Pelanggan</th>
     <th>Email</th>
     <th>Jumlah Barang</th>
     <th>Tanggal Order</th>
     <th>Total Bayar</th>
     <th>Perkiraan Selesai</th>
     <th>Status</th>
     <th width="25px">Action</th>
	   </tr>
	  </thead>
	  <tbody>
  	<?php
  		$tampil=$mysqli->query("SELECT *, tbl_soli.status AS status_s FROM tbl_soli INNER JOIN  tbl_oli ON tbl_oli.id_oli = tbl_soli.id_oli INNER JOIN  tbl_mekanik ON tbl_mekanik.id_mnk = tbl_soli.id_mnk INNER JOIN kustom ON kustom.kustom_id = tbl_soli.kustom_id INNER JOIN users ON users.id_karyawan=tbl_soli.id_karyawan  WHERE tbl_soli.tgl_order BETWEEN '$tgl_mulai' AND '$tgl_akhir' ORDER BY tbl_soli.id_so") ;
  		$no = 1;
  			while ($data=$tampil->fetch_assoc()){
  	?>
			 <tr>
     <td><?= $no++ ?></td>
     <td><?= $data['id_so'] ?></td>    
     <td><?= $data['nama'] ?></td>
     <td><?= $data['nama_oli'] ?></td>
     <td><?= "Rp. ".number_format($data['harga'] )?></td>
     <td><?= $data['nama_mnk'] ?></td>
     <td><?= $data['kustom_nama'] ?></td>
     <td><?= $data['email'] ?></td>
     <td><?= $data['jumlah_o'] ?> Liter</td>
     <td><?= date('d-m-Y',strtotime($data['tgl_order'])) ?></td>
     <td><?= "Rp. ".number_format($data['total_bayar']) ?></td>
     <td><?= date('d-m-Y',strtotime($data['perkiraan_selesai'])) ?></td>
     <td><?= $data['status_s'] ?></td>
    </tr>
    <?php }?>
    <?php else: ?>

    <tr> 
    	<td><center>Tidak Ada Data</center></td>
    </tr>
    <?php endif ?>
   </tbody>
  </table>
  </div>         
   <br><br><br>
   <p class="tulisan_dua" class="col-lg-2 pull-right" style="padding-right: 10%;margin:0;">
     <span >
       Palembang, <?php echo date('d-m-Y') ?>
       <br><br>
       <p class="tulisan_dua" style="padding-right: 14%;">Mengetahui</p>
       <br><br><br>
       <br><br>
     
       <p class="tulisan_dua" style="text-decoration: overline; padding-right: 13%;"><b>Harry Saputra</p>
       <p class="tulisan_dua" style="padding-right: 11%;" >Kepala Divisi FLEET</p></b>
   				</p>
     </span>

		</div>
	</div>
</body>
</html>
             