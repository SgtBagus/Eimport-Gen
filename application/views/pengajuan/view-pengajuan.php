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
    <div id="show_error"></div>
    <form method="POST" action="<?= base_url('pengajuan/approve/').$pengajuan['id'] ?>" id="approve-create" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $pengajuan['id'] ?>">
      <div class="row">
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#pengajuan" data-toggle="tab" aria-expanded="true">Pengajuan</a></li>
              <li class=""><a href="#history" data-toggle="tab" aria-expanded="false">History</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="pengajuan">
                <div class="box-header">
                  <h1>
                    <b><?= $pengajuan['judul'] ?></b>
                    <?php 
                    $pengaju = $this->mymodel->selectWhere('user', array('id' => $pengajuan['user_id']));
                    ?>
                    <small> <?= $pengaju[0]['name'] ?> </small>
                  </h1>
                  <label><?= $pengajuan['code'] ?></label>
                </div>
                <div class="row">
                  <div class="col-xs-7">
                    <div class="box-body">
                      <input type="hidden" name="dt[user_id]" value="<?= $pengajuan['user_id'] ?>">
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
                        <?php if($this->session->userdata('role_id') != '24'){
                          ?>
                          <textarea class="form-control" rows="3" placeholder="Masukan Catatan ..." name="dt[note]"><?= $pengajuan['note'] ?></textarea>
                          <?php
                        } else {
                          ?>
                          <?php if(!$pengajuan['note']){?>
                            <p class="help-block">*Catatan Di Berikan Oleh Admin</p>
                          <?php } else { 
                            echo "<p>".$pengajuan['note']."</p>";
                          } 
                        }
                        ?>
                      </div>
                      <?php 
                      if($this->session->userdata('role_id') != '24') { 
                        ?>
                        <div class="form-group">
                          <label for="form-note">Konfirmasi Pengajuan : </label>
                          <?php if($this->session->userdata('role_id') == '17'){ 
                            if($pengajuan['approve'] == 'PROCESS'){ ?>
                              <select class="form-control" name="dt[approve]">
                                <option value="PROCESS2" <?php if($pengajuan['approve'] == 'PROCESS2'){ echo "selected"; } ?> > Terima File</option>
                                <option value="REJECT" <?php if($pengajuan['approve'] == 'REJECT'){ echo "selected"; } ?> > Tidak Terima File</option>
                              </select>
                            <?php } else { ?>
                              <p class="help-block">*Dokumen Telah Di Kirim Di Lapangan</p>
                            <?php }
                          } else { 
                            if($pengajuan['approve'] == 'PROCESS'){ ?>
                              <p class="help-block">*Dokumen Masih Diproses ! </p>
                            <?php } else { ?>
                              <select class="form-control" name="dt[approve]">
                                <option value="ACCEPT" <?php if($pengajuan['approve'] == 'ACCEPT'){ echo "selected"; } ?> > Terima File</option>
                                <option value="REJECT" <?php if($pengajuan['approve'] == 'REJECT'){ echo "selected"; } ?> > Tidak Terima File</option>
                              </select>
                            <?php }
                          }
                          ?>
                        </div>
                      <?php } 
                      ?>
                    </div>
                  </div>
                  <div class="col-xs-5">
                    <div class="form-group">
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
              <div class="tab-pane" id="history">
                <ul class="timeline">  
                  <?php 
                  foreach($historys as $history){ 
                    if( (date('Y-m-d', strtotime($history['created_at']))) == (date('Y-m-d')) ){
                      $date = date('H:i', strtotime($history['created_at']));
                    } else {
                      $date = date('Y-m-d', strtotime($history['created_at']));
                    }
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
                    <th>Diterima</th>
                    <th>Diterima Di Lapangan</th>
                    <th></th>
                    <th>Catatan</th>
                  </tr>
                  <?php 
                  $no = 1;
                  foreach($detail as $d){ 
                    ?>
                    <tr>
                      <td><?= $no ?><input type="hidden" name="dtd[pengajuan_<?= $no ?>]" value=<?= $d['id'] ?>></td>
                      <td><?= date('d-m-Y', strtotime($d['created_at'])); ?></td>
                      <td><?= $d['file'] ?></td>
                      <td align="center">
                        <?php
                        if ($d['approve'] == "PROCESS") {
                          echo '<small class="label pull-left bg-yellow"><i class="fa fa-clock-o"></i> SEDANG DI PROSES</small>';
                        } else if ($d['approve'] == "ACCEPT") {
                          echo '<small class="label pull-left bg-blue"><i class="fa fa-check-circle-o"></i> DITERIMA</small>';
                        } else if ($d['approve'] == "REJECT") {
                          echo '<small class="label pull-left bg-red"><i class="fa fa-ban"></i>DITOLAK</small>';
                        }
                        ?>
                      </td>
                      <td align="center">
                        <?php
                        if ($d['approve2'] == "PROCESS") {
                          echo '<small class="label pull-left bg-yellow"><i class="fa fa-clock-o"></i> SEDANG DI PROSES</small>';
                        } else if ($d['approve2'] == "ACCEPT") {
                          echo '<small class="label pull-left bg-blue"><i class="fa fa-check-circle-o"></i> DITERIMA</small>';
                        } else if ($d['approve2'] == "REJECT") {
                          echo '<small class="label pull-left bg-red"><i class="fa fa-ban"></i>DITOLAK</small>';
                        }
                        ?>
                      </td>
                      <td>
                        <?php
                          $file = $this->mymodel->selectWhere('file', array('table' => 'pengajuan_detail', 'table_id' => $d['id']));
                        ?>
                        <a href="<?php echo base_url($file[0]['dir']) ?>" target="_blank" class="btn btn-sm btn-info">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="<?php echo base_url('pengajuan/').'download/'. $d['id']?>" class="btn btn-sm btn-primary">
                          <i class="fa fa-download"></i>
                        </a>
                      </td>
                      <td>
                        <?php if($this->session->userdata('role_id') != '24'){ ?>
                          <div class="row">
                            <div class="col-xs-8">
                              <textarea class="form-control" rows="2" placeholder="Masukan Catatan..." name="dtd[note_detail_<?= $no ?>]"><?= $d['note'] ?></textarea>
                            </div>
                            <div class="col-xs-4">
                              <select class="form-control" name="dtd[approve_detail_<?= $no ?>]">
                                <option value="ACCEPT" <?php if($d['approve'] == 'ACCEPT'){ echo "selected"; } ?> > Terima File</option>
                                <option value="REJECT" <?php if($d['approve'] == 'REJECT'){ echo "selected"; } ?> > Tidak Terima File</option>
                              </select>
                            </div>
                          </div>
                        <?php }  else  { ?>
                          <?php if(!$d['note']){?>
                            <p class="help-block">*Catatan Di Berikan Oleh Admin</p>
                          <?php } else { 
                            echo $d['note'];
                          } ?>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php $no++; } ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row" align="center">
            <a href="javascript:history.back()" type="button" class="btn btn-primary btn-info">
              <i class="fa fa-arrow-left"></i> BACK
            </a>
            <?php 
            if(($pengajuan['approve'] != 'ACCEPT') && ($pengajuan['approve'] != 'REJECT')) {
              if($this->session->userdata('role_id') == '17') { 
                if($pengajuan['approve'] == 'PROCESS') { ?>
                  <button type="submit" class="btn btn-primary btn-send" ><i class="fa fa-save"></i> Simpan</button>
                <?php } 
              } else if ($this->session->userdata('role_id') == '23') { 
                if($pengajuan['approve'] == 'PROCESS2') { ?>
                  <button type="submit" class="btn btn-primary btn-send" ><i class="fa fa-save"></i> Simpan</button>
                <?php } 
              } 
            } else { ?>
          <!-- <a href="<?= base_url('pengajuan/delete/'.$pengajuan['id'])?>">
            <button type="button" class="btn btn-danger">
              <i class="fa fa-trash"></i> HAPUS
            </button>
          </a> -->
        <?php } ?>
      </div>
    </form>
  </section>
</div>
<script type="text/javascript">
  $("#approve-create").submit(function(){
    var form = $(this);
    var mydata = new FormData(this);
    $.ajax({
      type: "POST",
      url: form.attr("action"),
      data: mydata,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend : function(){
        $(".btn-send").addClass("disabled").html("<i class='la la-spinner la-spin'></i>  Processing...").attr('disabled',true);
        $("#show_error").slideUp().html("");
      },

      success: function(response, textStatus, xhr) {
        var str = response;
        console.log(str);
        if (str.indexOf("success") != -1){
          $("#show_error").html(response).slideDown("fast");
          $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Simpan').attr('disabled',false);
          location.reload(); 
        }else{
          $("#show_error").html(response).slideDown("fast");
          $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Simpan').attr('disabled',false);
          location.reload(); 
        }
      },
      error: function(xhr, textStatus, errorThrown) {
        console.log(xhr);
        $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Simpan').attr('disabled',false);
        $("#show_error").html(xhr).slideDown("fast");

      }
    });
    return false;
  });
</script>