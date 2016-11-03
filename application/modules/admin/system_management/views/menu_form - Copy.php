<?php 
$error_form = $this->session->flashdata('error_form');
$error_val = $this->session->flashdata('error_val');
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $header_title;?></h1>
        <!-- Display Message System -->
                            <?php $msg = $this->session->flashdata('msg');?>
                            <?php if (isset($msg['error_msg'])) {?>
                                  <div class="alert alert-dismissable alert-danger">
                                  <button type="button" class="close" data-dismiss="alert">×</button>
                                  <strong><?php echo $msg['error_msg'];?></strong>
                                  </div>
                            <?php }?>
                            <?php if (isset($msg['success_msg'])) {?>
                                <div class="alert alert-success alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <?php echo $msg['success_msg'];?>
                                </div>
                            <?php }?>
                            <!-- End Display Message System -->
    </div>
</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo $title;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        
                            <?php $attributes = array('role' => 'form', 'id' => 'edit_complaint_form','name'=>'edit_complaint_form'); ?>
                            <?php echo form_open('system_management/create_menu',$attributes);?>
                            <div class="row">
                                <div class="col-lg-12">
                                <input type="hidden" name="id" value="<?php echo $this->uri->segment(3);?>">
                                <button type="submit" class="btn btn-outline btn-success">save</button>
                                <a href="<?php echo base_url();?>system_management/groups"><button type="button" class="btn btn-outline btn-danger">cancel</button></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>menu</th>
                                        <?php foreach ($role_data as $key => $role) {?>
                                        <?php $menu = $role->menu_id;$all_id[$key] = $role->id;?>
                                            <th><?php echo $role->name;?></th>
                                        <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($menu_list as $key => $ml) {?>
                                        <tr>
                                            
                                            <td><?php echo $ml->menu;?></td>
                                            <td><input type="checkbox" name="admin[]" value="<?php echo $ml->mid;?>"></td>
                                            <td><input type="checkbox" name="staff[]" value="<?php echo $ml->mid;?>"></td>
                                            <td><input type="checkbox" name="protect[]" value="<?php echo $ml->mid;?>"></td>
                                            <td><input type="checkbox" name="rapid[]" value="<?php echo $ml->mid;?>"></td>
                                            <td><input type="checkbox" name="manager[]" value="<?php echo $ml->mid;?>"></td>
                                            
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                                    
                                    <input type="hidden" name="admin_id" value="<?php echo $all_id[0];?>">
                                    <input type="hidden" name="staff_id" value="<?php echo $all_id[1];?>">
                                    <input type="hidden" name="admin_id" value="<?php echo $all_id[2];?>">
                                    <input type="hidden" name="admin_id" value="<?php echo $all_id[3];?>">
                                    <input type="hidden" name="admin_id" value="<?php echo $all_id[4];?>">
                                    
                                </div>
                            </div>
                            <?php echo form_close();?>
                            
                        </div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
<script type="text/javascript">

$(document).ready(function() {
    
});
</script>
