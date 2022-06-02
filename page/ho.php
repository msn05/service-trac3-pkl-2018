      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Histori Order Servis Oli</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Servis Oli</li>
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
                      $tampil=$mysqli->query("SELECT *, tbl_soli.status AS status_s FROM tbl_soli INNER JOIN  tbl_oli ON tbl_oli.id_oli = tbl_soli.id_oli INNER JOIN  tbl_mekanik ON tbl_mekanik.id_mnk = tbl_soli.id_mnk INNER JOIN kustom ON kustom.kustom_id = tbl_soli.kustom_id INNER JOIN users ON users.id_karyawan=tbl_soli.id_karyawan ORDER BY tbl_soli.id_so");
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
                      <?php  } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- START MODAL UNTUK TAMBAH -->
      <!-- END MODAL UNTUK TAMBAH -->
      <!-- START MODAL UNTUK EDIT -->
      <!-- END MODAL UNTUK EDIT -->
     