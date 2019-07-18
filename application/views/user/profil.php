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
          <form action="<?= base_url('profil/updateprofil') ?>" enctype="multipart/form-data" method="POST" id="upload_profil">
            <div class="box-body">
              <div id="show_error_profil"></div>
              <div class="form-group">
                <label>NIB</label>
                <input type="text" name="nib" class="form-control" value="<?= $user['nib'] ?>">
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
                <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>">
              </div>
              <div class="form-group">
                <label>Deskription</label>
                <textarea class="form-control" name="desc"><?= $user['desc'] ?></textarea>
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input type="file" class="form-control" id="form-file" placeholder="Masukan File" name="file" accept="image/x-png,image/jpeg">
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right" id="btn-profil"><i class="fa fa-edit"></i> Ubah Profil</button>
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
          <form action="<?= base_url('profil/updatepassword') ?>" enctype="multipart/form-data" method="POST" id="upload_password">
            <div class="box-body">
              <div id="show_error_password"></div>
              <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password" class="form-control">
              </div>
              <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control">
              </div>
              <div class="form-group">
                <label>Konfirmasi Password Lama</label>
                <input type="password" name="password_confirmation_last" class="form-control">
              </div>
              <div class="box-footer">
                <button type="submit" id="#btn-password" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Ubah Password</button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
    
<script type="text/javascript">

  $("#upload_profil").submit(function(){
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
        $("#btn-profil").addClass("disabled").html("<i class='la la-spinner la-spin'></i>  Prosess...").attr('disabled',true);
        form.find("#show_error_profil").slideUp().html("");
      },

      success: function(response, textStatus, xhr) {
        var str = response;
        console.log(str);
        if (str.indexOf("success") != -1){
          form.find("#show_error_profil").html(response).slideDown("fast");
          setTimeout(function(){ 
           window.location.href = "<?= base_url('profil') ?>";
         }, 1000);
          $("#btn-profil").removeClass("disabled").html('<i class="fa fa-edit"></i> Ubah Password').attr('disabled',false);
        }else{
          form.find("#show_error_profil").hide().html(response).slideDown("fast");
          $("#btn-profil").removeClass("disabled").html('<i class="fa fa-edit"></i> Ubah Password').attr('disabled',false);
        }
      },
      error: function(xhr, textStatus, errorThrown) {
        console.log(xhr);
        $("$btn-profil").removeClass("disabled").html('<i class="fa fa-edit"></i> Ubah Password').attr('disabled',false);
        form.find("#show_error_profil").hide().html(xhr).slideDown("fast");
      }
    });
    return false;
  });

  
  $("#upload_password").submit(function(){
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
        $("#btn-password").addClass("disabled").html("<i class='la la-spinner la-spin'></i>  Prosess...").attr('disabled',true);
        form.find("#show_error_password").slideUp().html("");
      },

      success: function(response, textStatus, xhr) {
        var str = response;
        console.log(str);
        if (str.indexOf("success") != -1){
          form.find("#show_error_password").html(response).slideDown("fast");
          setTimeout(function(){ 
           window.location.href = "<?= base_url('profil') ?>";
         }, 1000);
          $("#btn-password").removeClass("disabled").html('<i class="fa fa-edit"></i> Ubah Profil').attr('disabled',false);
        }else{
          form.find("#show_error_password").hide().html(response).slideDown("fast");
          $("#btn-password").removeClass("disabled").html('<i class="fa fa-edit"></i> Ubah Profil').attr('disabled',false);
        }
      },
      error: function(xhr, textStatus, errorThrown) {
        console.log(xhr);
        $("$btn-password").removeClass("disabled").html('<i class="fa fa-edit"></i> Ubah Profil').attr('disabled',false);
        form.find("#show_error_password").hide().html(xhr).slideDown("fast");
      }
    });
    return false;
  });

</script>