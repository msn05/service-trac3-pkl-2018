      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title">Dashboard</h4>
          </div>
          <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="#">Home</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
        <?php if ($_SESSION['level'] ==pimpinan): ?>
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="page-breadcrumb">
                  <h4><b>TRAC ASTRA PALEMBANG</b></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif?>
      <div class="container-fluid">
        <div class="row">
           <?php if ($_SESSION['level'] ==admin): ?>
          <div class="col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-7">
                    <i class="mdi mdi-emoticon font-20 text-info"></i>
                    <p class="font-16 m-b-5">Total Pelanggan</p>
                  </div>
                  <div class="col-5">
                    <h1 class="font-light text-right mb-0">
                      <?php
                        $sql=$mysqli->query( "SELECT * FROM kustom");
                        
                        $count = mysqli_num_rows($sql);
                        echo  $count ;
                      ?>
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-7">
                    <i class="mdi mdi-image font-20 text-success"></i>
                    <p class="font-16 m-b-5">Mobil</p>
                  </div>
                  <div class="col-5">
                    <h1 class="font-light text-right mb-0">
                      <?php
                        $sql=$mysqli->query( "SELECT * FROM tbl_mobil");
                        
                        $count = mysqli_num_rows($sql);
                        echo  $count ;
                      ?>
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-7">
                    <i class="mdi mdi-currency-eur font-20 text-purple"></i>
                    <p class="font-16 m-b-5">Sparepart</p>
                  </div>
                  <div class="col-5">
                    <h1 class="font-light text-right mb-0">
                      <?php
                        $sql=$mysqli->query( "SELECT * FROM tbl_sparepart");
                        
                        $count = mysqli_num_rows($sql);
                        echo  $count ;
                      ?>
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-7">
                    <i class="mdi mdi-poll font-20 text-danger"></i>
                    <p class="font-16 m-b-5">Oli</p>
                  </div>
                  <div class="col-5">
                    <h1 class="font-light text-right mb-0">
                      <?php
                        $sql=$mysqli->query( "SELECT * FROM tbl_oli");
                        
                        $count = mysqli_num_rows($sql);
                        echo  $count ;
                      ?>
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-7">
                    <i class="mdi mdi-poll font-20 text-danger"></i>
                    <p class="font-16 m-b-5">Karyawan</p>
                  </div>
                  <div class="col-5">
                    <h1 class="font-light text-right mb-0">
                      <?php
                        $sql=$mysqli->query( "SELECT * FROM data_karyawan");
                        
                        $count = mysqli_num_rows($sql);
                        echo  $count ;
                      ?>
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-7">
                    <i class="mdi mdi-poll font-20 text-danger"></i>
                    <p class="font-16 m-b-5">Mekanik</p>
                  </div>
                  <div class="col-5">
                    <h1 class="font-light text-right mb-0">
                      <?php
                        $sql=$mysqli->query( "SELECT * FROM tbl_mekanik");
                        
                        $count = mysqli_num_rows($sql);
                        echo  $count ;
                      ?>
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-7">
                    <i class="mdi mdi-poll font-20 text-danger"></i>
                    <p class="font-16 m-b-5">Rental</p>
                  </div>
                  <div class="col-5">
                    <h1 class="font-light text-right mb-0">
                     <?php
                        $sql=$mysqli->query( "SELECT * FROM tbl_oren");
                        $count = mysqli_num_rows($sql);
                        echo  $count ;
                      ?>
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-7">
                    <i class="mdi mdi-poll font-20 text-danger"></i>
                    <p class="font-16 m-b-5">Service Sparepart</p>
                  </div>
                  <div class="col-5">
                    <h1 class="font-light text-right mb-0">
                     <?php
                        $sql=$mysqli->query( "SELECT * FROM tbl_os");
                        $count = mysqli_num_rows($sql);
                        echo  $count ;
                      ?>
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="card">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-7">
                    <i class="mdi mdi-poll font-20 text-danger"></i>
                    <p class="font-16 m-b-5">Service Oli</p>
                  </div>
                  <div class="col-5">
                    <h1 class="font-light text-right mb-0">
                    <?php
                        $sql=$mysqli->query( "SELECT * FROM tbl_soli");
                        $count = mysqli_num_rows($sql);
                        echo  $count ;
                      ?>  
                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endif?>
        </div>
      </div>
