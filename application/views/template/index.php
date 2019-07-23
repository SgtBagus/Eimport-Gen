<div class="content-wrapper">
  <section class="content-header">
    <h1>Dashboard</h1>
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
              <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong><b>Perhatian !<b></strong><br> Untuk Saai ini verifikasi email masih bermasalah !
                </div>
                <div class="alert alert-warning">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong><b>Perhatian !<b></strong><br> Segera lakukan verifikasi Email anda agar mendapatkan notifikasi pembaruan dari emali anda dengan cara <a href=<?= base_url('verification/user/').$user['id']; ?> >Klik link berikut ini</a>
                  </div>
                <?php } ?>
              </div>
            </div>
            <div class="row" align="center">
              <h1>SELAMAT DATANG DI E-REKOMENDASI IMPORT TEMBAKAU</h1>
            </div>
            <div class="row">
              <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h5 class="text-uppercase"><strong>Pengajuan</strong></h5>
                    <h3><?= $pengajuan_row[0]['pengajuan_row'] ?></h3>
                  </div>
                  <div class="icon">
                    <i class="fa fa-file"></i>
                  </div>
                  <a href="<?= base_url("/pengajuan") ?>" class="small-box-footer">Semua Pengajuan <i class="mdi mdi-chevron-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h5 class="text-uppercase"><strong>Pengajuan Di Proses</strong></h5>
                    <h3><?= $pengajuan_process[0]['pengajuan_row'] ?></h3>
                  </div>
                  <div class="icon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <a href="<?= base_url('/pengajuan') ?>" class="small-box-footer">Semua Pengguna <i class="mdi mdi-chevron-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                  <div class="inner">
                    <h5 class="text-uppercase"><strong>Pengajuan Di Terima</strong></h5>
                    <h3><?= $pengajuan_approve[0]['pengajuan_row'] ?></h3>
                  </div>
                  <div class="icon">
                    <i class="fa fa-check-circle-o"></i>
                  </div>
                  <a href="<?= base_url('/approve_pengajuan') ?>" class="small-box-footer">Semua Pengajuan Diterima <i class="mdi mdi-chevron-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                  <div class="inner">
                    <h5 class="text-uppercase"><strong>Data ditolak</strong></h5>
                    <h3><?= $pengajuan_reject[0]['pengajuan_row'] ?></h3>
                  </div>
                  <div class="icon">
                    <i class="fa fa-ban"></i>
                  </div>
                  <a href="<?= base_url('/pengajuan') ?>" class="small-box-footer">Semua Pengajuan<i class="mdi mdi-chevron-right"></i></a>
                </div>
              </div>
            </div>
            <div class="row" align="center">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title"><b>10 PENGAJUAN TERBARU</b></h3>
                    <div class="box-tools">
                    </div>
                  </div>
                  <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                      <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Note</th>
                        <th></th>
                      </tr>
                      <?php 
                      $no = 1;
                      foreach($pengajuans as $pengajuan){ ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $pengajuan['code'] ?></td>
                        <td><?= $pengajuan['judul'] ?></td>
                        <td><?= $pengajuan['keterangan'] ?></td>
                        <td align="center">
                          <?php
                          if ($pengajuan['approve'] == "PROCESS") {
                            echo '<small class="label pull-left bg-yellow"><i class="fa fa-clock-o"></i> SEDANG DI PROSES</small>';
                          } else if ($pengajuan['approve'] == "PROCESS2") {
                            echo '<small class="label pull-left bg-yellow"><i class="fa fa-clock-o"></i> SEDANG DI PROSES LAPANGAN</small>';
                          } else if ($pengajuan['approve'] == "ACCEPT") {
                            echo '<small class="label pull-left bg-blue"><i class="fa fa-check-circle-o"></i> DITERIMA</small>';
                          } else if ($pengajuan['approve'] == "REJECT") {
                            echo '<small class="label pull-left bg-red"><i class="fa fa-ban"></i>DITOLAK</small>';
                          }
                          ?>
                        </td>
                        <td><?= $pengajuan['note'] ?></td>
                        <td>
                          <a href="<?php echo base_url('pengajuan/').'view/'. $pengajuan['id']?>" class="btn btn-sm btn-info">
                            <i class="fa fa-eye"></i>
                          </a>
                        </td>
                      </tr>
                      <?php $no++; } ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>