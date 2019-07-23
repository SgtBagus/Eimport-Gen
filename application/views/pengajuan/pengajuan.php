

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengajuan
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pengajuan</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">    
        <?php 
        if (isset($_GET['delete'])) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Perhatian!</h4>
            Pengajuan Berhasil Dihapus
          </div>
        <?php } ?>
        <div class="box">
          <!-- /.box-header -->
          <div class="box-header">
            <div class="row">
              <div class="col-md-6">

              </div>
              <div class="col-md-6">
                <div class="pull-right">
                  <?php if ($this->session->userdata('role_id') == "24")  {?>
                    <a href="<?= base_url('pengajuan/create') ?>">
                      <button type="button" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Pengajuan</button> 
                    </a>
                  <?php } ?>
                </div>
              </div>  
            </div>
          </div>
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

<!-- <div class="modal fade bd-example-modal-sm" tabindex="-1" pengajuan="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-delete">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form id="upload-delete" action="<?= base_url('Pengajuan/delete') ?>">
        <div class="modal-header">
          <h5 class="modal-title">Confirm delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="delete-input">
          <p>Are you sure to delete this data?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-send">Yes, Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>  -->

<div class="modal fade" id="modal-impor">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Impor Pengajuan</h4>
      </div>
      <form action="<?= base_url('fitur/impor/pengajuan') ?>" method="POST"  enctype="multipart/form-data">

        <div class="modal-body">
          <div class="form-group">
            <label for="">File Excel</label>
            <input type="file" class="form-control" id="" name="file" placeholder="Input field">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<script type="text/javascript">

  function loadtable() {
    var table = '<table class="table table-bordered" id="mytable">'+
    '     <thead>'+
    '     <tr>'+
    '        <th style="width:20px">No</th>'+
                   // '        <th>User Id</th>'+
                   '        <th>Kode</th>'+
                   '        <th>Judul</th>'+
                   '        <th>Keterangan</th>'+
                   '        <th>Status</th>'+
                   '        <th>Note</th>'+
                   '        <th style="width:150px"></th>'+
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
              ajax: {"url": "<?= base_url('Pengajuan/json') ?>", "type": "POST"},
              columns: [
              {"data": "id","orderable": false},
                    // {"data": "user_id"},
                    {"data": "code"},
                    {"data": "judul"},
                    {"data": "keterangan"},
                    {"data": "approve"},
                    {"data": "note"},
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


                      if (data.approve == "PROCESS") { 
                        $("td:eq(4)", row).html('<small class="label pull-left bg-yellow"><i class="fa fa-clock-o"></i> SEDANG DI PROSES</small>');
                      } else if (data.approve == "PROCESS2") {
                        $("td:eq(4)", row).html('<small class="label pull-left bg-yellow"><i class="fa fa-clock-o"></i> SEDANG DI PROSES LAPANGAN</small>');
                      } else if (data.approve == "ACCEPT") {
                        $("td:eq(4)", row).html('<small class="label pull-left bg-blue"><i class="fa fa-check-circle-o"></i> DITERIMA</small>');
                      } else if (data.approve == "REJECT") {
                        $("td:eq(4)", row).html('<small class="label pull-left bg-red"><i class="fa fa-ban"></i>DITOLAK</small>');
                      }

                    }
                  });
           }

           loadtable($("#select-status").val());

           function view(id) {
            location.href = "<?= base_url('pengajuan/view/') ?>"+id;
          }

          function edit(id) {
            location.href = "<?= base_url('pengajuan/edit/') ?>"+id;
          }

          function hapus(id) {
            $("#modal-delete").modal('show');
            $("#delete-input").val(id);
            
          }
          $("#upload-delete").submit(function(){
            event.preventDefault();
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
                $(".show_error").slideUp().html("");
              },
              success: function(response, textStatus, xhr) {
               var str = response;
               if (str.indexOf("success") != -1){
                $(".show_error").hide().html(response).slideDown("fast");

                $(".btn-send").removeClass("disabled").html('Yes, Delete it').attr('disabled',false);
              }else{
               setTimeout(function(){ 
                 $("#modal-delete").modal('hide');
               }, 1000);
               $(".show_error").hide().html(response).slideDown("fast");
               $(".btn-send").removeClass("disabled").html('Yes , Delete it').attr('disabled',false);
               loadtable($("#select-status").val());
             }
           },
           error: function(xhr, textStatus, errorThrown) {

           }
         });
            return false; 

          });
        </script>