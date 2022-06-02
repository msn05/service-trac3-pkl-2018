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

          $tampil=$mysqli->query("SELECT *,tbl_oren.status AS status_order FROM tbl_oren  INNER JOIN tbl_mobil ON tbl_mobil.id_mobil = tbl_oren.id_mobil INNER JOIN kustom ON kustom.kustom_id = tbl_oren.kustom_id inner join users on users.id_karyawan = tbl_oren.id_karyawan where id_rental = '$_GET[id]'") ;
            while ($data=$tampil->fetch_object()){
              
        ?>
        <p><div class="col-sm-4 control-label">Data Order Rental </div></p>
        <br>
        <br>
        <table id="zero_config" class="table table-striped table-bordered">
          <div>
          <tr>
            <td>Kode Rental</td><td><?=$data->id_rental; ?></td>
          </tr>
          <tr>
            <td>Nama Pelanggan</td><td><?=$data->kustom_nama; ?></td>
          </tr> 
          <tr>
            <td>Email</td><td><?=$data->email; ?></td>
          </tr>
          <tr>
            <td>Nomor Polisi</td><td><?=$data->no_polisi; ?></td>
          </tr> 
          <tr>
            <td>Model Mobil</td><td><?=$data->model_mobil; ?></td>
          </tr> 
          <tr>
            <td>Harga</td><td><?="Rp. ".number_format($data->harga); ?></td>
          </tr> 
          <tr>
            <td>Denda / hari</td><td><?="Rp. ".number_format($data->denda); ?></td>
          </tr>
          <tr>
            <td>Tanggal Dirental</td><td><?=date('d-m-Y',strtotime($data->tgl_dirental)); ?></td>
          </tr> 
          <tr>
            <td>Tanggal Kembali</td><td><?=date('d-m-Y',strtotime($data->tgl_kembali)); ?></td>
          </tr>
          <tr>
            <td>Denda Lain - lain </td><td><?="Rp. ".number_format($data->denda_lain); ?></td>
          </tr>
          <tr>
            <td>Tanggal Dikembalikan</td><td><?=date('d-m-Y',strtotime($data->tgl_dikembalikan)); ?></td>
          </tr>
          <tr>
            <td>Total Denda </td><td><?="Rp. ".number_format($data->total_denda); ?></td>
          </tr>
          <tr>
            <td>Total </td><td><?="Rp. ".number_format($data->total); ?></td>
          </tr>
          <tr>
            <td>Status </td><td><?=$data->status_order; ?></td>
          </tr>
        </table>
           <?php
         }
         ?>
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
          </span>
        </p>

   </div>
 </div>
</body>
</body>
</html>
             