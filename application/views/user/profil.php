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
      <div class="col-md-3">

        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="<?= base_url()?>assets/dist/img/user4-128x128.jpg" alt="User profile picture">

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
      <div class="col-md-9">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Settings</h3>
          </div>
          <form action="<?= base_url('user/updateUser') ?>" enctype="multipart/form-data" method="POST" id="upload">
            <div class="box-body">
              <div class="form-group">
                <label>NIB</label>
                <input type="text" name="nib" class="form-control" value="<?= $user['nib'] ?>">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input name="dt[email]" type="text" class="form-control" value="<?= $user['email'] ?>"/>
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
                <label>Password</label>
                <input type="password" name="email" class="form-control">
              </div>
              <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="email" class="form-control">
              </div>
              <div class="form-group">
                <label>Deskription</label>
                <textarea class="form-control" name="desc"><?= $user['desc'] ?></textarea>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Ubah Profil</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>