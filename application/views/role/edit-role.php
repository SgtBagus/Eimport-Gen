

  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>
        Role
      </h1>

      <ol class="breadcrumb">

        <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Role</li>

      </ol>

    </section>

    <!-- Main content -->

    <section class="content">

    <form method="POST" action="<?= base_url('role/update') ?>" id="upload-create" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= $role['id'] ?>">





      <div class="row">

        <div class="col-xs-8">

          <div class="box">

            <!-- /.box-header -->

            <div class="box-header">

              <h5 class="box-title">

                  Edit Role

              </h5>

            </div>

            <div class="box-body">

                <div class="show_error"></div>

                <div class="form-group">

                      <label for="form-role">Role</label>

                      <input type="text" class="form-control" id="form-role" placeholder="Masukan Role" name="dt[role]" value="<?= $role['role'] ?>">

                </div>

                <div class="form-group">

                      <label for="form-role">Menu</label>

                      <!-- <input type="text" class="form-control" id="form-role" placeholder="Masukan Role" name="dt[role]" value="<?= $role['role'] ?>"> -->

                      <div style="background: #fbfbfb;padding: 10px;font-size: 16px;">

                        <ul>

                        <?php 

                        $this->db->order_by('urutan asc');

                        $menu = $this->mymodel->selectWhere('menu_master',['parent'=>0,'status'=>'ENABLE']);

                        foreach ($menu as $m) {

                        $parent = $this->mymodel->selectWhere('menu_master',['parent'=>$m['id'],'status'=>'ENABLE']);

                        if(count($parent)==0){

                        ?>

                        <li class="<?php if($page_name==$m['name']) echo "active"; ?>">

                          <a href="javascript::void(0)">

                            <input type="checkbox" name="menu[]" value="<?= $m['id'] ?>" <?= (in_array($m['id'], json_decode($role['menu']))) ? "checked":"" ?>>

                            <i class="<?= $m['icon'] ?>"></i> <span><?= $m['name'] ?></span>

                          </a>

                        </li>

                        <?php }else{ ?>

                        <li>

                          <a href="javascript::void(0)">

                            <input type="checkbox" name="menu[]" value="<?= $m['id'] ?>" <?= (in_array($m['id'], json_decode($role['menu']))) ? "checked":"" ?>>

                            <i class="<?= $m['icon'] ?>"></i> <span><?= $m['name'] ?></span>

                          </a>

                          <ul>

                            <?php foreach ($parent as $p) { ?>

                            <li class="<?php if($page_name==$p['name']) echo "active"; ?>">

                              <a href="javascript::void(0)">

                                <input type="checkbox" name="menu[]" value="<?= $p['id'] ?>" <?= (in_array($p['id'], json_decode($role['menu']))) ? "checked":"" ?>>

                                <i class="<?= $p['icon'] ?>"></i> <?= $p['name'] ?>

                              </a>

                            </li>

                            <?php } ?>

                          </ul>

                        </li>

                        <?php } ?>

                        <?php } ?>

                        </ul>

                      </div>

                </div>

                </div>

            <div class="box-footer">

                <button type="submit" class="btn btn-primary btn-send" ><i class="fa fa-save"></i> Save</button>

                <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Reset</button>

             

            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->



          <!-- /.box -->

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->

      </form>



    </section>

    <!-- /.content -->

  </div>

  <!-- /.content-wrapper -->

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

                           window.location.href = "<?= base_url('role') ?>";

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