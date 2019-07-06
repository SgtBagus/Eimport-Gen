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
                      echo '<i class="fa fa-clock-o fa-5x text-yellow"></i> <br> <h3 class="text-yellow">SEDANG DI PROCESS LAPANGAN</h3>';
                    } else if ($pengajuan['approve'] == "ACCEPT") {
                      echo '<i class="fa fa-check-circle-o fa-5x text-blue"></i> <br> <h3 class="text-blue">DITERIMA</h3>';
                    } else if ($pengajuan['approve'] == "REJECT") {
                      echo '<i class="fa fa-ban fa-5x text-red"></i> <br> <h3 class="text-red">DITOLAK</h3>';
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
                <ul class="timeline">  
                  <?php 
                  foreach($historys as $history){ 
                    $date = date('d-m-Y H:i', strtotime($history['created_at']));
                  ?>
                  <li>
                    <?php
                      if($history['history_status'] == 'INFO'){
                    ?>
                    <i class="fa fa-check-circle-o bg-aqua"></i> 
                    <?php
                      } else if($history['history_status'] == 'WARNING'){
                    ?>
                    <i class="fa fa-clock-o bg-yellow"></i> 
                    <?php
                      } else if($history['history_status'] == 'SUCCESS'){
                    ?>
                    <i class="fa fa-check-circle-o bg-green"></i> 
                    <?php
                      } else if($history['history_status'] == 'DANGER'){
                    ?>
                    <i class="fa fa-ban bg-red"></i> 
                    <?php
                    }
                    ?>
                    <div class="timeline-item">
                      <i class="fa fa-calendar"></i> <?= $date?>
                      
                      <div class= "callout callout-<?= strtolower($history['history_status']) ?>" >
                      <h4><?= $history['title'] ?></h4>

                      <p><?= $history['history'] ?></p>
                    </div>
                  </li>
                  <?php 
                    }      
                  ?>
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
                  <?php if($this->session->userdata('role_id') != '24'){ ?>
                  <th>Aksi</th>
                  <?php } ?>
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
                    <a href="<?php echo base_url('pengajuan/').'webfile/'. $d['id']?>" target="_blank" class="btn btn-sm btn-primary">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="<?php echo base_url('pengajuan/').'download/'. $d['id']?>" class="btn btn-sm btn-primary">
                      <i class="fa fa-download"></i>
                    </a>
                  </td>
                  <?php if($this->session->userdata('role_id') != '24'){ ?>
                  <td align="center">
                    <button class="btn btn-sm btn-primary" onclick="#">
                      <i class="fa fa-check-circle-o"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="#">
                      <i class="fa fa-ban"></i>
                    </button>
                  </td>
                  <?php } ?>
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
      </div>
    </form>
  </section>
</div>