<?php 
if($this->session->userdata('session_sop')=="") {
  redirect(base_url().'login/');
}

if($this->session->userdata('role_id') != '17' ) { 
  echo "<script>window.history.back()</script>";
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= TITLE_APPLICATION  ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>fonts/material-icons/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


  <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

  <script src="<?= base_url('assets/') ?>bower_components/jquery/dist/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="<?= base_url('assets/') ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/') ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
  <script type="text/javascript">

    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
      .ui-autocomplete { z-index:2147483647; }
    </style>
  </head>
  <body class="hold-transition <?= SKIN  ?> sidebar-mini fixed" onload="startTime()">
    <div class="wrapper">
      <header class="main-header">
        <a href="<?= base_url() ?>" class="logo">
          <span class="logo-lg"> <img src="<?= LOGO ?>" width="40px" height="40px"> <?= APPLICATION  ?> </span>
        </a>
        <nav class="navbar navbar-static-top">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li>
                <a><i id="date"></i>&nbsp;<i id="clock"></i></a>
              </li>
              <?php
              $notifications = $this->mymodel->selectWithQuery(
                "SELECT * FROM notifications WHERE role_id = ".$this->session->userdata('role_id')." ORDER BY id DESC, read_on ASC LIMIT 5 "
              );

              $notification_row = $this->mymodel->selectWithQuery("SELECT COUNT('id') FROM notifications where role_id = ".$this->session->userdata('role_id')." AND read_on = 'ENABLE' ");

              ?>
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-bell"></i>
                  <span class="label label-warning"><?= $notification_row['0']["COUNT('id')"] ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header"><b><?= $notification_row['0']["COUNT('id')"] ?></b> Pengajuan Perlu Dikonfirmasi</li>
                  <li>
                    <ul class="menu">
                      <?php 

                      foreach($notifications as $notif){ 
                        $user = $this->mymodel->selectDataone('user',array('id'=>$notif['user_id']));
                        $user_image = $this->mymodel->selectDataone('file',array('table'=>'user', 'table_id'=>$notif['user_id']));
                          echo '<li>';
                        if ($notif['read_on'] == 'ENABLE'){
                          echo '<a href="'.base_url('notif/readon/').$notif['id'].'">';
                        } else {
                          echo '<a href="'.base_url('pengajuan/view/').$notif['pengajuan_id'].'">';
                        }
                        ?>  

                        <div class="pull-left">
                          <img src="<?= base_url('webfile/').$user_image['name'] ?>" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          <?php  if ($notif['read_on'] == 'ENABLE') { ?>
                            <b style="color:#393345;"><?= $user['name'] ?></b>
                          <?php } else { 
                            echo $user['name'];
                          } ?>
                          <small><i class="fa fa-clock-o"></i> 
                            <?php
                              if( (date('Y-m-d', strtotime($notif['created_at']))) == (date('Y-m-d')) ){
                                echo date('H:i', strtotime($notif['created_at']));
                              } else {
                                echo date('Y-m-d', strtotime($notif['created_at']));
                              }
                            ?>
                          </small>
                        </h4>
                        <?php  if ($notif['read_on'] == 'ENABLE') { ?>
                          <b style="color:#393345;"><?= $notif['title'] ?></b><br>
                          <b><small style="color:#393345;"><?= $notif['notif_desc']  ?></small></b>
                        <?php } else { ?>
                          <p style="color:#393345;"><?= $notif['title'] ?><br></p>
                          <small style="color:#393345;"><?= $notif['notif_desc']  ?></small>
                        <?php } ?>
                      </a>
                    </li>
                    <?php
                  }
                  ?>
                </ul>
              </li>
            </ul>
          </li> 
          <li class="dropdown user user-menu">
            <?php
            $id = $this->session->userdata('id');
            $file = $this->mymodel->selectDataone('file',array('table'=>'user','table_id'=>$id));
            ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <object data="<?= base_url($file['dir'])?>" type="image/png" class="user-image" alt="User Image">
                <img src="https://www.library.caltech.edu/sites/default/files/styles/headshot/public/default_images/user.png?itok=1HlTtL2d" class="user-image" alt="User Image">
              </object>
              <span class="hidden-xs"><?= $this->session->userdata('name');?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <object data="<?= base_url($file['dir'])?>" type="image/png" style="width: 100px; border-radius: 50%;" >
                  <img src="https://www.library.caltech.edu/sites/default/files/styles/headshot/public/default_images/user.png?itok=1HlTtL2d" alt="example">
                </object>

                <p>
                  <?= $this->session->userdata('name');?> - <?php $role = $this->mymodel->selectWhere('role',array('id'=>$this->session->userdata('role_id'))); echo $role[0]['role']; ?>
                </p>
              </li>
              <li class="user-footer">
                <a href="<?= base_url('profil/')?>" class="btn btn-default btn-flat"><i class="fa fa-user"></i> Profile</a>
                <a href="<?= base_url('login/logout') ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
        <?php 
        $role = $this->mymodel->selectDataone('role',['id'=>$this->session->userdata('role_id')]);
        $jsonmenu = json_decode($role['menu']);
        $this->db->order_by('urutan asc');
        $this->db->where_in('id',$jsonmenu);
        $menu = $this->mymodel->selectWhere('menu_master',['parent'=>0,'status'=>'ENABLE']);
        foreach ($menu as $m) {
          $this->db->where_in('id',$jsonmenu);
          $parent = $this->mymodel->selectWhere('menu_master',['parent'=>$m['id'],'status'=>'ENABLE']);
          if(count($parent)==0){
            ?>
            <li class="<?php if($page_name==$m['name']) echo "active"; ?>">
              <a href="<?= base_url($m['link']) ?>">
                <i class="<?= $m['icon'] ?>"></i> <span><?= $m['name'] ?></span>
                <?php if($m['notif']!=""){ ?>
                  <span class="pull-right-container">
                    <small class="label pull-right label-danger" id="<?= $m['notif'] ?>">0</small>
                  </span>
                <?php } ?>
              </a>
            </li>
          <?php }else{ ?>
           <li class="treeview <?php if($page_name==$m['name']) echo "active"; ?>">
            <a href="#">
              <i class="<?= $m['icon'] ?>"></i> <span><?= $m['name'] ?></span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php foreach ($parent as $p) { ?>
                <li class="<?php if($page_name==$p['name']) echo "active"; ?>">
                  <a href="<?= base_url($p['link']) ?>">

                    <i class="<?= $p['icon'] ?>"></i> <?= $p['name'] ?>
                    <?php if($p['notif']!=""){ ?>
                      <span class="pull-right-container">
                        <small class="label pull-right label-danger" id="<?= $p['notif'] ?>">0</small>
                      </span>
                    <?php } ?>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } 
      } ?>
    </ul>
  </section>
</aside>

<?=$contents?>

<footer class="main-footer">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 my-auto text-center">
        <dl class="text-left small mb-0 w-75 mx-auto">
          <dd><?= ADDRESS ?></dd>
          <dd><b>Telp.</b> : <?= TELP ?></dd>
        </dl>
      </div>
      <div class="col-md-4 my-auto text-center">
        <dl class="text-left small mb-0 w-50 mx-auto">
          <dd><b>Fax</b> : <?= FAX ?></dd>
          <dd><b>Email</b> : <?= EMAIL ?></dd>
          <dd><b>SMS Center</b> : <?= SMS_CENTER ?></dd>
        </dl>
      </div>
      <div class="col-md-4 my-auto">
        <p class="text-center mb-0"><?= COPYRIGHT ?></p>
      </div>
    </div>
  </div>
</footer>
<div class="control-sidebar-bg"></div>
</div>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?= base_url('assets/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/raphael/raphael.min.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/morris.js/morris.min.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script><script src="<?= base_url('assets/') ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url('assets/') ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
<script src="<?= base_url('assets/') ?>dist/js/pages/dashboard.js"></script>
<script src="<?= base_url('assets/') ?>dist/js/demo.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $('#user-data-autocomplete').autocomplete({
      source: "<?php echo site_url('home/get_autocomplete');?>",

      select: function (event, ui) {
        window.location.href = "<?= base_url('master/user/editUser_redirect/') ?>"+ui.item.id;
      }
    });
  });

  var url = window.location;
  $('ul.sidebar-menu a').filter(function() {
    return this.href == url;
  }).parent().siblings().removeClass('active').end().addClass('active');
  $('ul.treeview-menu a').filter(function() {
    return this.href == url;
  }).parentsUntil(".sidebar-menu > .treeview-menu").siblings().removeClass('active menu-open').end().addClass('active menu-open');
</script>

<script type="text/javascript">
 $('.select2').select2();

 $('.tgl').datepicker({
  autoclose: true,
  format:'yyyy-mm-dd'
});

 $(function () {
  $('.datatable').DataTable()
  $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false
  })
});

 function startTime() {
  var today = new Date();
  var hr = today.getHours();
  var min = today.getMinutes();
  var sec = today.getSeconds();
  ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
  hr = (hr == 0) ? 12 : hr;
  hr = (hr > 12) ? hr - 12 : hr;
  hr = checkTime(hr);
  min = checkTime(min);
  sec = checkTime(sec);
  document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;

  var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
  var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
  var curWeekDay = days[today.getDay()];
  var curDay = today.getDate();
  var curMonth = months[today.getMonth()];
  var curYear = today.getFullYear();
  var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear+" /";
  document.getElementById("date").innerHTML = date;

  var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}

</script>
</body>
</html>
