      <?php
        @$jenis = @$_GET['laporan'];

        if (!empty($_GET['tgl_mulai'])) {
          $tgl_mulai   = $_GET['tgl_mulai'];
          $tgl_akhir = $_GET['tgl_akhir'];
          $jenis = @$_GET['laporan'];
        }

      ?>
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Laporan</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Laporan</li>
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
                <br><br>
                <div class="table-responsive">
                  <?php if (empty($_GET['tgl_mulai'])): ?>
                  <form  action="index.php?page=laporan" method="GET">
                    <input type="hidden" name="page" value="laporan">
                      <table id="zero_config" class="table table-striped table-bordered">
                        <tr>
                          <th class="control-label">Tanggal Mulai </th>
                          <td class="form-group"><input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai" required=""></td>
                        </tr>
                        <tr>
                          <th class="control-label">Tanggal Akhir </th>
                          <td class="form-group"><input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" required="">  
                          </td>
                        </tr>
                        <tr>
                          <th class="control-label">Jenis Laporan </th>
                          <td class="form-group">
                            <select class="form-control" name="laporan">
                              <option value="">--Pilih Laporan--</option>
                              <option value="rental">Rental</option>
                              <option value="sparepart">Servis SparePart</option>
                              <option value="oli">Servis Oli</option>
                            </select>
                          </td>
                        </tr>
                         <div class="modal-footer">
                          <input type="submit" class="btn btn-success" name="cari" value="Cari">
                        </div>
                      </table>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- ini tok filter tanggal kalo nak meleh -->
      <?php else: ?>
        <?php 
        if ($_GET['tgl_mulai']!=null) {
            $tgl_mulai = $_GET['tgl_mulai'];
            $tgl_akhir = $_GET['tgl_akhir'];
            $tgl = '?tgl_mulai='.$tgl_mulai.'&tgl_akhir='.$tgl_akhir.'&laporan='.$_GET['laporan'];
        }
        else{
          $tgl = '';
        } 

      ?>

        <a href="print.php<?php echo $tgl ?>" target="_blank" class="btn btn-warning mdi mdi-printer"> Cetak</a>&nbsp;&nbsp;&nbsp;  
   <!--      <a href="pdf.php<?php echo $tgl ?>" target="_blank" class="btn btn-primary mdi mdi-file-pdf-box"> Print PDF</a>&nbsp;&nbsp;&nbsp;  -->
        <a href="javascript:history.back()" class="btn btn-info mdi mdi-keyboard-backspace"></i></a> 
        <br><br>
          
          <?php if ($_GET['laporan'] == 'rental'): ?>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
              <thead>
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
                while ($data=$tampil->fetch_object()){
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $data->id_rental ?></td>    
                  <td><?= $data->nama ?></td>
                  <td><?= $data->no_polisi ?></td>
                  <td><?= $data->model_mobil ?></td>
                  <td><?= "Rp. ".number_format($data->harga )?></td>
                  <td><?= "Rp. ".number_format($data->denda )?></td>
                  <td><?= $data->kustom_nama ?></td>
                  <td><?= $data->email ?></td>
                  <td><?= date('d-m-Y',strtotime($data->tgl_dirental)) ?></td>
                  <td><?= date('d-m-Y',strtotime($data->tgl_kembali)) ?></td>
                  <td><?= "Rp. ".number_format($data->denda_lain )?></td>
                  <td><?= date('d-m-Y',strtotime($data->tgl_dikembalikan)) ?></td>
                  <td><?= "Rp. ".number_format($data->total_denda )?></td>
                  <td><?= "Rp. ".number_format($data->total )?></td>
                  <td><?= $data->status_order ?></td>
                </tr>
                  <?php } ?>
              </tbody>
            </table>
          </div>

          <?php elseif ($_GET['laporan'] == 'sparepart'): ?>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
              <thead align="center">
                <tr>
                  <th width="25px">No.</th>
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
              <tbody align="center">
                <?php
                $tampil=$mysqli->query("SELECT *,tbl_os.status AS status_os FROM tbl_os  INNER JOIN tbl_sparepart ON tbl_sparepart.id_sp = tbl_os.id_sp INNER JOIN kustom ON kustom.kustom_id = tbl_os.kustom_id INNER JOIN tbl_mekanik ON tbl_mekanik.id_mnk = tbl_os.id_mnk inner join users on users.id_karyawan = tbl_os.id_karyawan WHERE tbl_os.tgl_masuk BETWEEN '$tgl_mulai' AND '$tgl_akhir'ORDER BY tbl_os.id_servis");
                $no = 1;
                while ($data=$tampil->fetch_object()){
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $data->id_servis ?></td>    
                  <td><?= $data->nama ?></td>
                  <td><?= $data->nama_sp ?></td>
                  <td><?= $data->model_sp ?></td>
                  <td><?= "Rp. ".number_format($data->harga )?></td>
                  <td><?= $data->nama_mnk ?></td>
                  <td><?= $data->kustom_nama ?></td>
                  <td><?= $data->email ?></td>
                  <td><?= $data->jumlah_b ?> Unit</td>
                  <td><?= date('d-m-Y',strtotime($data->tgl_masuk)) ?></td>
                  <td><?= $data->total_bayar ?></td>
                  <td><?= date('d-m-Y',strtotime($data->perkiraan_selesai)) ?></td>
                  <td><?= $data->status_os ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table> 
          </div>

            <?php elseif ($_GET['laporan'] == 'oli'): ?>
            <div class="table-responsive">
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
                  </tr>
                </thead>
                <tbody align="center">
                  <?php
                  $tampil=$mysqli->query("SELECT *, tbl_soli.status AS status_s FROM tbl_soli INNER JOIN  tbl_oli ON tbl_oli.id_oli = tbl_soli.id_oli INNER JOIN  tbl_mekanik ON tbl_mekanik.id_mnk = tbl_soli.id_mnk INNER JOIN kustom ON kustom.kustom_id = tbl_soli.kustom_id INNER JOIN users ON users.id_karyawan=tbl_soli.id_karyawan WHERE tbl_soli.tgl_order BETWEEN '$tgl_mulai' AND '$tgl_akhir' ORDER BY tbl_soli.id_so");
                  $no = 1;
                  while ($data=$tampil->fetch_object()){
                  ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data->id_so ?></td>    
                    <td><?= $data->nama ?></td>
                    <td><?= $data->nama_oli ?></td>
                    <td><?= "Rp. ".number_format($data->harga )?></td>
                    <td><?= $data->nama_mnk ?></td>
                    <td><?= $data->kustom_nama ?></td>
                    <td><?= $data->email ?></td>
                    <td><?= $data->jumlah_o ?> Liter</td>
                    <td><?= date('d-m-Y',strtotime($data->tgl_order)) ?></td>
                    <td><?= "Rp. ".number_format($data->total_bayar) ?></td>
                    <td><?= date('d-m-Y',strtotime($data->perkiraan_selesai)) ?></td>
                    <td><?= $data->status_s ?></td>
                  </tr>
                    <?php } ?>

                    <?php else: ?>
                      <tr> 
                        <td><center>Tidak Ada Data</center></td>
                      </tr>
                      <?php endif ?>
                  </tbody>
                </table>
                <?php endif ?> 
              </div>
  