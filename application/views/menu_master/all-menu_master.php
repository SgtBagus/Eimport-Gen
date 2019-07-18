<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Menu Master
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Menu Master</li>
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
    '       <th style="width:20px">No</th>'+'<th>Name</th>'+'<th>Icon</th>'+'<th>Link</th>'+
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
              ajax: {"url": "<?= base_url('menu_master/json?status=') ?>"+status, "type": "POST"},
              columns: [
              {"data": "id","orderable": false},{"data": "name"},{"data": "icon"},{"data": "link"},
              {   "data": "view",
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
            }
          });
           }


           loadtable($("#select-status").val());

           function edit(id) {
            location.href = "<?= base_url('menu_master/edit/') ?>"+id;
          }
        </script>