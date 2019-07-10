<div class="show_error"></div>
<input type="hidden" name="ids" value="<?= $user['id'] ?>">
<input type="hidden" name="nib" value="<?= $user['nib'] ?>">
<input type="hidden" name="email" value="<?= $user['email'] ?>">


<small>NIB</small>
<input name="dt[nib]" type="text" class="form-control" value="<?= $user['nib'] ?>" disabled />
<small>Email</small>
<input name="dt[email]" type="text" class="form-control" value="<?= $user['email'] ?>" disabled />

<?php
  if($user['verification'] != 'TRUE'){
    echo "<p class='text-red'>Email Belum Diverifikasi</p>";
  }else {
    echo "<p class='text-green'>Email Sudah Diverifikasi</p>";
  }
?>
<small>Name</small>
<input name="dt[name]" type="text" class="form-control" value="<?= $user['name'] ?>" disabled />
<small>Role</small>
<select class="form-control" name="dt[role_id]">
	<?php 
	$res =  $this->mymodel->selectData('role');
	foreach ($res as $role) {
	 ?>
	<option value="<?= $role['id'] ?>" <?php if($user['role_id']==$role['id']){ echo "selected"; } ?>><?= $role['role'] ?></option>
	<?php } ?>
</select>	
<small>Description</small>
<textarea class="form-control" name="dt[desc]"><?= $user['desc'] ?></textarea>
    <!-- <br>

 <?php
  if($file['dir']!=""){
  $types = explode("/", $file['mime']);
  if($types[0]=="image"){
  ?>
    <img src="<?= base_url($file['dir']) ?>" style="width: 200px" class="img img-thumbnail">
    <br>
  <?php }else{ ?>
    
    <i class="fa fa-file fa-5x text-danger"></i>
    <br>
    <a href="<?= base_url($file['dir']) ?>" target="_blank"><i class="fa fa-download"></i> <?= $file['name'] ?></a>
    <br>
  <br>
<?php } ?>
<?php } ?>
 <label for="form-file">File</label>
<input type="file" class="form-control" id="form-file" placeholder="Masukan File" name="file"> -->
