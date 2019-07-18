<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Log Aktifitas <?php $role = $this->mymodel->selectWhere('role',array('id'=>$this->session->userdata('role_id'))); echo $role[0]['role']; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Log Aktifitas <?php $role = $this->mymodel->selectWhere('role',array('id'=>$this->session->userdata('role_id'))); echo $role[0]['role']; ?> </li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <div class="show_error"></div>
            <div class="table-responsive">
              <div id="load-table"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">

  function loadtable(status) {
    var table = '<table class="table table-bordered" id="mytable">'+
    '     <thead>'+
    '     <tr>'+
    '       <th style="width:20px">No</th>'+
    '       <th>Tanggal Jam</th>'+ 
    '       <th>Nama</th>'+ 
    <?php if($this->session->userdata('role_id') == '17'){ 
      echo" 
      '       <th>Role</th>'+ 
      "; 
    } ?>
    '       <th>Kode</th>'+
    '       <th>Judul Pengajuan</th>'+
    '       <th>History</th>'+
    '       <th id="historystatus">Status</th>'+
    '       <th style="width:150px"></th>'+
    '     </tr>'+
    '     </thead>'+
    '     <tbody>'+
    '     </tbody>'+
    ' </table>';
             // body...
             $("#load-table").html(table)

             var t = $("#mytable").dataTable({
              initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                  if (e.keyCode == 13) {
                    api.search(this.value).draw();
                  }
                });
              },
              oLanguage: {
                sProcessing: "loading..."
              },
              processing: true,
              serverSide: true,
              ajax: {"url": "<?= base_url('logactivity/json') ?>", "type": "POST"},
              columns: [
              {"data": "id","orderable": false},
              {"data": "date"},
              {"data": "name"},
              <?php if($this->session->userdata('role_id') == '17'){ 
                echo' 
                {"data": "role"},
                '; 
              } ?>
              {"data": "code"},
              {"data": "judul"},
              {"data": "history"},
              {"data": "history_status"},
              {   
                "data": "view",
                "orderable": false
              }
              ],
              order: [[1, 'asc']],


              
              rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);

                <?php 
                if($this->session->userdata('role_id') == '17'){ 
                  ?>
                  if (data.history_status == "INFO") { 
                    $("td:eq(7)", row).html('<small class="label pull-left bg-blue">INFO</small>');
                  } else if (data.history_status == "WARNING") {
                    $("td:eq(7)", row).html('<small class="label pull-left bg-yellow">WARNING</small>');
                  } else if (data.history_status == "SUCCESS") {
                    $("td:eq(7)", row).html('<small class="label pull-left bg-green">SUCCESS</small>');
                  } else if (data.history_status == "DANGER") {
                    $("td:eq(7)", row).html('<small class="label pull-left bg-red">DANGER</small>');
                  } 
                  <?php 
                } else {
                  ?>
                  if (data.history_status == "INFO") { 
                    $("td:eq(6)", row).html('<small class="label pull-left bg-blue">INFO</small>');
                  } else if (data.history_status == "WARNING") {
                    $("td:eq(6)", row).html('<small class="label pull-left bg-yellow">WARNING</small>');
                  } else if (data.history_status == "SUCCESS") {
                    $("td:eq(6)", row).html('<small class="label pull-left bg-green">SUCCESS</small>');
                  } else if (data.history_status == "DANGER") {
                    $("td:eq(6)", row).html('<small class="label pull-left bg-red">DANGER</small>');
                  }
                  <?php  
                }
                ?>
              }
            });
           }

           loadtable($("#select-status").val());

           function view(id) {
            location.href = "<?= base_url('pengajuan/view/') ?>"+id;
          }
        </script>