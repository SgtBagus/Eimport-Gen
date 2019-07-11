<div class="content-wrapper">
  <section class="content-header">
    <h1>
      <?= $page_name ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href=<?= base_url(); ?>><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Profill</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-4">

        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="<?= base_url('webfile/').$image ?>" alt="User profile picture">

            <h3 class="profile-username text-center"><?= $user['name'] ?></h3>

            <p class="text-muted text-center"><?= $role ?></p> 

            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Data Terkirim</b> <a class="pull-right"><?= $pengajuan ?></a>
              </li>
              <li class="list-group-item">
                <b>Data Yang Diterima</b> <a class="pull-right"><?= $accept_pengajuan ?></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Pengaturan</h3>
          </div>
          <form action="<?= base_url('profil/updateProfil') ?>" enctype="multipart/form-data" method="POST" id="upload">
            <div class="show_error"></div>
            <div class="box-body">
              <div class="form-group">
                <label>NIB</label>
                <input type="text" name="nib" class="form-control" value="<?= $user['nib'] ?>" required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input name="email" type="text" class="form-control" value="<?= $user['email'] ?>" readonly/>
                <?php
                if($user['verification'] != 'TRUE'){
                  echo "<p class='text-red'>Email Belum Diverifikasi</p>";
                }else {
                  echo "<p class='text-green'>Email Sudah Diverifikasi</p>";
                }
                ?>
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
              </div>
              <div class="form-group">
                <label>Deskription</label>
                <textarea class="form-control" name="desc"><?= $user['desc'] ?></textarea>
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input type="file" class="form-control" id="form-file" placeholder="Masukan File" name="file">
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Ubah Profil</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Ubah Password</h3>
          </div>
          <form action="<?= base_url('profil/updatePassword') ?>" enctype="multipart/form-data" method="POST" id="upload">
            <div class="show_error"></div>
            <div class="box-body">

              <?php 
              if (isset($_GET['password'])) { ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>Berhasil!</h4>
                Password Berhasil diubah !
              </div>
            <?php } ?>
              <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control" required>
              </div>
              <?php 
              if (isset($_GET['new_password'])) { 
                echo "<p class='text-red'>Konfirmasi Passowrd tidak sama</p>";
              } ?>
              <div class="form-group">
                <label>Konfirmasi Password Lama</label>
                <input type="password" name="password_confirmation_last" class="form-control" required>
              </div>
              <?php 
              if (isset($_GET['last_password'])) { 
                echo "<p class='text-red'>Konfirmasi Password lama tidak sesuai </p>";
              } ?>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Ubah Password</button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
    <script type="text/javascript">
      $("#uploads").submit(function(){
        var mydata = new FormData(this);
        var form = $(this);
        $.ajax({
          type: "POST",
          url: form.attr("action"),
          data: mydata,
          cache: false,
          contentType: false,
          processData: false,
          beforeSend : function(){
            $("#send-btns").addClass("disabled").html("<i class='fa fa-spinner fa-spin'></i>  Processing...").attr('disabled',true);
            form.find(".show_error").slideUp().html("");

          },
          success: function(response, textStatus, xhr) {
                // alert(mydata);
                var str = response;
                if (str.indexOf("Success") != -1){
                  form.find(".show_error").hide().html(response).slideDown("fast");
                  $("#send-btns").removeClass("disabled").html('<i class="fa fa-save"></i> Simpan').attr('disabled',false);
                  loaddatas();
                    // document.getElementById('upload').reset();
                    $('#uploads')[0].reset();
                    $("#editsite").modal('hide');
                    
                  }else{
                    form.find(".show_error").hide().html(response).slideDown("fast");
                    $("#send-btns").removeClass("disabled").html('<i class="fa fa-save"></i> Simpan').attr('disabled',false);
                  }
                },
                error: function(xhr, textStatus, errorThrown) {
                  console.log(xhr);
                }
              });
        return false;
      });

    </script>