<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Pengajuan Di Terima
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Pengajuan Di Terima</li>
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

  function loadtable() {
    var table = '<table class="table table-bordered" id="mytable">'+
    '     <thead>'+
    '     <tr>'+
    '        <th style="width:20px">No</th>'+
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
      ajax: {"url": "<?= base_url('approve_pengajuan/json') ?>", "type": "POST"},
      columns: [
      {"data": "id","orderable": false},
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
</script>