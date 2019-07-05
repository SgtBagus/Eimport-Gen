<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Pengajuan
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pengajuan</li>
    </ol>
  </section>
  <section class="content">
    <form method="" action="" id="upload-create" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $pengajuan['id'] ?>">
      <div class="row">
        <div class="col-xs-8">
          <div class="box">
            <div class="box-header">
              <h5 class="box-title">
                Pengajuan : <?= $pengajuan['judul'] ?>
              </h5>
            </div>
            <div class="row">
              <div class="col-xs-7">
                <div class="box-body">
                  <div class="show_error"></div><div class="form-group">
                  </div>
                  <div class="form-group">
                    <label for="form-judul">Tanggal Dibuat : </label>
                    <br>
                    <label><?= date('d-m-Y', strtotime($pengajuan['created_at'])); ?></label>
                  </div>
                  <div class="form-group">
                    <label for="form-keterangan">Keterangan : </label>
                    <p><?= $pengajuan['keterangan'] ?></p>
                  </div>
                  <div class="form-group">
                    <label for="form-note">Catatan : </label>
                    <p><?= $pengajuan['note'] ?></p>
                  </div>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="form-group">
                  <label for="form-approve">Status</label> <br>
                  <div class="row" align="center">
                    <?php
                    if($pengajuan['approve'] == "PROCESS"){
                      echo '<i class="fa fa-clock-o fa-5x text-yellow"></i> <br> <h3 class="text-yellow">SEDANG DI PROCESS</h3>';
                    } else if ($pengajuan['approve'] == "PROCESS2") {
                      echo '<i class="fa fa-clock-o fa-5x" text-yellow></i> <br> <h3 class="text-yellow">SEDANG DI PROCESS LAPANGAN</h3>';
                    } else if ($pengajuan['approve'] == "ACCEPT") {
                      echo '<i class="fa fa-check-circle-o fa-5x" text-blue></i> <br> <h3 class="text-blue">DITERIMA</h3>';
                    } else if ($pengajuan['approve'] == "REJECT") {
                      echo '<i class="fa fa-ban fa-5x" text-red></i> <br> <h3 class="text-red">DITOLAK</h3>';
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-4">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">History</h3>
            </div>
            <div class="box-body">
              <div class="direct-chat-messages">
                <div class="col-md-12">
                </div>
                <ul class="timeline">
                  <li class="time-label">
                    <span class="bg-blue">
                      24 Jan. 2018
                    </span>
                  </li>
                  <li>
                    <i class="fa fa-check-circle-o bg-blue"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 11:00</span>
                      <h3 class="timeline-header"><b>Admin</b> Menerima pengajuan anda</h3>
                    </div>
                  </li>
                  <li>
                    <i class="fa fa-edit bg-blue"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 08:15</span>

                      <h3 class="timeline-header">Melakukan Perubahan pengajuan</h3>
                    </div>
                  </li>
                  <li class="time-label">
                    <span class="bg-blue">
                      23 Jan. 2018
                    </span>
                  </li>
                  <li>
                    <i class="fa fa-comments bg-green"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 14:05</span>
                      <h3 class="timeline-header"><b>Admin</b> mengirim pesan</h3>
                      <div class="timeline-body">
                        File nomor 3 tidak sesuai format default, mohon segera di perbaiki
                      </div>
                    </div>
                  </li>
                  <li>
                    <i class="fa fa-clock-o bg-yellow"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 10:05</span>
                      <h3 class="timeline-header"><b>Admin</b> sedang memperoses pengajuan anda</h3>
                    </div>
                  </li>
                  <li class="time-label">
                    <span class="bg-blue">
                      3 Jan. 2018
                    </span>
                  </li>
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                      <h3 class="timeline-header"><b>Pengajuan Dibuat</b></h3>
                    </div>
                  </li>
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data File</h3>
              <div class="box-tools">
              </div>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>File</th>
                  <th>Catatan</th>
                  <th>Diterima</th>
                  <th>Diterima Di Lapangan</th>
                  <th>Download</th>
                  <th>Aksi</th>
                </tr>
                <?php 
                $no = 1;
                foreach($detail as $d){ 
                ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $d['created_at'] ?></td>
                  <td><?php echo $d['file'] ?></td>
                  <td><?php echo $d['note'] ?></td>
                  <td align="center">
                    <?php echo $d['approve'] ?>
                  </td>
                  <td align="center">
                    <?php echo $d['approve2'] ?>
                  </td>
                  <td align="center">
                    <a href="<?php echo base_url('pengajuan/').'download/'. $d['id']?>" class="btn btn-sm btn-warning">
                      <i class="fa fa-download"></i>
                    </a>
                  </td>
                  <td align="center">
                    <button class="btn btn-sm btn-primary" onclick="#">
                      <i class="fa fa-check-circle-o"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="#">
                      <i class="fa fa-ban"></i>
                    </button>
                  </td>
                </tr>
                <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row" align="center">
        <a href="javascript:history.back()" type="button" class="btn btn-primary btn-info">
          <i class="fa fa-arrow-left"></i> Back
        </a>
        <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Reset</button>
      </div>
    </form>
  </section>
</div>