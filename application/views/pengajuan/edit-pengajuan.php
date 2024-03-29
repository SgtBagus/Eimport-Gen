<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Pengajuan
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">master</a></li>
      <li class="active">Pengajuan</li>
    </ol>
  </section>
  <section class="content">
    <form method="POST" action="<?= base_url('Pengajuan/update') ?>" id="upload-create" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $pengajuan['id'] ?>">


      <div class="row">
        <div class="col-xs-8">
          <div class="box">
            <div class="box-header">
              <h5 class="box-title">
                Edit Pengajuan
              </h5>
            </div>
            <div class="box-body">
              <div class="show_error"></div><div class="form-group">
              </div><div class="form-group">
                <label for="form-judul">Judul</label>
                <input type="text" class="form-control" id="form-judul" placeholder="Masukan Judul" name="dt[judul]" value="<?= $pengajuan['judul'] ?>">
              </div><div class="form-group">
                <label for="form-keterangan">Keterangan</label>
                <input type="text" class="form-control" id="form-keterangan" placeholder="Masukan Keterangan" name="dt[keterangan]" value="<?= $pengajuan['keterangan'] ?>">
              </div><div class="form-group">
                <label for="form-approve">Approve</label>
                <input type="text" class="form-control" id="form-approve" placeholder="Masukan Approve" name="dt[approve]" value="<?= $pengajuan['approve'] ?>">
              </div><div class="form-group">
                <label for="form-note">Note</label>
                <input type="text" class="form-control" id="form-note" placeholder="Masukan Note" name="dt[note]" value="<?= $pengajuan['note'] ?>">
              </div></div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-send" ><i class="fa fa-save"></i> Save</button>
                <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Reset</button>

              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
  </div>
  <script type="text/javascript">
    $("#upload-create").submit(function(){
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
          form.find(".show_error").slideUp().html("");
        },
        success: function(response, textStatus, xhr) {
                    // alert(mydata);
                    var str = response;
                    if (str.indexOf("success") != -1){
                      form.find(".show_error").hide().html(response).slideDown("fast");
                      setTimeout(function(){ 
                       window.location.href = "<?= base_url('Pengajuan') ?>";
                     }, 1000);
                      $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled',false);


                    }else{
                      form.find(".show_error").hide().html(response).slideDown("fast");
                      $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled',false);

                    }
                  },
                  error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr);
                    $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled',false);
                    form.find(".show_error").hide().html(xhr).slideDown("fast");

                  }
                });
      return false;

    });
  </script>