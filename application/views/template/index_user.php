<div class="content-wrapper">
  <section class="content-header">
    <h1>Dashboard</h1>
    <h5 style="padding-left:1px;">Welcome to SmartSoft Dashboard</h5>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <?php 
        if (isset($_GET['verification'])) { 
          if($_GET['verification']){
            ?>
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong><b>Email Terkirim !<b></strong><br> Mohon melihat Email anda untuk melakukan proses berikutnya !
              </div>
            <?php } else {?>
              <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><b>Terjadi Kesalahan !<b></strong><br> Mohon melakukan pengiriman Email kembali !
                </div>
              <?php } 
            }
            ?>
            <?php if ($user['verification'] != 'TRUE') { ?>
              <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><b>Perhatian !<b></strong><br> Segera lakukan verifikasi Email anda agar mendapatkan notifikasi pembaruan dari emali anda dengan cara <a href=<?= base_url('verification/user/').$user['id']; ?> >Klik link berikut ini</a>
                </div>
              <?php } ?>
            </div>
          </div>
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h5 class="text-uppercase"><strong>New Orders</strong></h5>
                  <h3>150</h3>
                </div>
                <div class="icon">
                  <i class="mdi mdi-shopping"></i>
                </div>
                <a href="#" class="small-box-footer">Detail <i class="mdi mdi-chevron-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h5 class="text-uppercase"><strong>Bounce Rate</strong></h5>
                  <h3>53<sup style="font-size: 20px">%</sup></h3>
                </div>
                <div class="icon">
                  <i class="mdi mdi-chart-areaspline"></i>
                </div>
                <a href="#" class="small-box-footer">Detail <i class="mdi mdi-chevron-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h5 class="text-uppercase"><strong>User Registrations</strong></h5>
                  <h3>44</h3>
                </div>
                <div class="icon">
                  <i class="mdi mdi-account-plus"></i>
                </div>
                <a href="#" class="small-box-footer">Detail <i class="mdi mdi-chevron-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h5 class="text-uppercase"><strong>Unique Visitors</strong></h5>
                  <h3>65</h3>
                </div>
                <div class="icon">
                  <i class="mdi mdi-chart-pie"></i>
                </div>
                <a href="#" class="small-box-footer">Detail <i class="mdi mdi-chevron-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>


        </section>
        <!-- /.content -->
      </div>
  <!-- /.content-wrapper -->