      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Histori Order Rental Mobil</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Rental</li>
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
                        <th>Kode Rental</th>
                        <th>Nama Karyawan</th>
                        <th>Nomor Polisi</th>
                        <th>Model Mobil</th>
                        <th>Harga</th>
                        <th>Denda / Hari</th>
                        <th>Nama Pelanggan</th>
                        <th>Email</th>
                        <th>Status Pelanggan</th>
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
                      $tampil=$mysqli->query("SELECT *,tbl_oren.status AS status_order FROM tbl_oren  INNER JOIN tbl_mobil ON tbl_mobil.id_mobil = tbl_oren.id_mobil INNER JOIN kustom ON kustom.kustom_id = tbl_oren.kustom_id inner join users on users.id_karyawan = tbl_oren.id_karyawan ORDER BY tbl_oren.id_rental");
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
                        <td><?= $data->status_p ?></td>
                        <td><?= date('d-m-Y',strtotime($data->tgl_dirental)) ?></td>
                        <td><?= date('d-m-Y',strtotime($data->tgl_kembali)) ?></td>
                        <td><?= "Rp. ".number_format($data->denda_lain )?></td>
                        <td><?= date('d-m-Y',strtotime($data->tgl_dikembalikan)) ?></td>
                        <td><?= "Rp. ".number_format($data->total_denda )?></td>
                        <td><?= "Rp. ".number_format($data->total )?></td>
                        <td><?= $data->status_order ?></td>
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
    