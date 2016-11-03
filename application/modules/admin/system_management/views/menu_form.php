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
                            <?php echo form_open('system_management/menu_setting',$attributes);?>
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
                                        <?php
                                            if (!empty($role->menu_id)) {
                                                $menu_value[$role->id] = json_decode($role->menu_id);     
                                            }else{
                                                $menu_value[$role->id] = array();
                                            } 
                                            
                                            $all_id[$key] = $role->id;
                                        ?>
                                            <th><?php echo $role->name;?></th>
                                        <?php }unset($key,$role);?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php //echo '<pre>';print_r($menu_value);echo '</pre>';?>
                                        <?php foreach ($menu_list as $key => $ml) {?>
                                        
                                        
                                            <?php if (isset($ml['main'])) {?>
                                            <tr>
                                                <td>+ <?php echo $ml['main']['menu'];?></td>  
                                                <?php //foreach ($role_data as $key => $role) {?>
                                                    <!-- <td><input type="checkbox" name="role<?php echo $role->id;?>[]" value="<?php echo $ml['main']['id'];?>" <?php echo (in_array($ml['main']['id'], $menu_value[$role->id]))?'checked="checked"':'';?>></td> -->
                                                <?php //}unset($key,$role);?>
                                                <td><input type="checkbox" name="admin[]" value="<?php echo $ml['main']['id'];?>" <?php echo (in_array($ml['main']['id'], $menu_value[1]))?'checked="checked"':'';?>></td>
                                                <td><input type="checkbox" name="staff[]" value="<?php echo $ml['main']['id'];?>" <?php echo (in_array($ml['main']['id'], $menu_value[2]))?'checked="checked"':'';?>></td>
                                                <td><input type="checkbox" name="protect[]" value="<?php echo $ml['main']['id'];?>" <?php echo (in_array($ml['main']['id'], $menu_value[3]))?'checked="checked"':'';?>></td>
                                                <td><input type="checkbox" name="guest[]" value="<?php echo $ml['main']['id'];?>" <?php echo (in_array($ml['main']['id'], $menu_value[4]))?'checked="checked"':'';?>></td>
                                                <!-- <td><input type="checkbox" name="manager[]" value="<?php //echo $ml['main']['id'];?>" <?php echo (in_array($ml['main']['id'], $menu_value[5]))?'checked="checked"':'';?>></td>  -->
                                            </tr>
                                            <?php } ?>
                                            <?php if (isset($ml['sub'])) {?>
                                            <tr>
                                                <?php foreach ($ml['sub'] as $svalue) {?>
                                                <!-- <td style="padding-left:30px"> -<?php echo $svalue['menu'];?></td> -->
                                                <!-- <td><input type="checkbox" name="admin[]" value="<?php echo $svalue['id'];?>" <?php echo (in_array($svalue['id'], $menu_value[1]))?'checked="checked"':'';?>></td> -->
                                                <!-- <td><input type="checkbox" name="staff[]" value="<?php echo $svalue['id'];?>" <?php echo (in_array($svalue['id'], $menu_value[2]))?'checked="checked"':'';?>></td> -->
                                                <!-- <td><input type="checkbox" name="protect[]" value="<?php echo $svalue['id'];?>" <?php echo (in_array($svalue['id'], $menu_value[3]))?'checked="checked"':'';?>></td> -->
                                                <!-- <td><input type="checkbox" name="rapid[]" value="<?php //echo $svalue['id'];?>" <?php echo (in_array($svalue['id'], $menu_value[4]))?'checked="checked"':'';?>></td> -->
                                                <!-- <td><input type="checkbox" name="manager[]" value="<?php //echo $svalue['id'];?>" <?php echo (in_array($svalue['id'], $menu_value[5]))?'checked="checked"':'';?>></td>  -->
                                            </tr>
                                                <?php if (isset($svalue['insub'])) {?>
                                                    <?php foreach ($svalue['insub'] as $ivalue) {?>
                                                    <tr>
                                                    <!-- <td style="padding-left:60px"> --<?php echo $ivalue['menu'];?></td> -->
                                                    <!-- <td><input type="checkbox" name="admin[]" value="<?php echo $ivalue['id'];?>" <?php echo (in_array($ivalue['id'], $menu_value[1]))?'checked="checked"':'';?>></td> -->
                                                    <!-- <td><input type="checkbox" name="staff[]" value="<?php echo $ivalue['id'];?>" <?php echo (in_array($ivalue['id'], $menu_value[2]))?'checked="checked"':'';?>></td> -->
                                                    <!-- <td><input type="checkbox" name="protect[]" value="<?php echo $ivalue['id'];?>" <?php echo (in_array($ivalue['id'], $menu_value[3]))?'checked="checked"':'';?>></td> -->
                                                    <!-- <td><input type="checkbox" name="rapid[]" value="<?php //echo $ivalue['id'];?>" <?php echo (in_array($ivalue['id'], $menu_value[4]))?'checked="checked"':'';?>></td> -->
                                                    <!-- <td><input type="checkbox" name="manager[]" value="<?php //echo $ivalue['id'];?>" <?php echo (in_array($ivalue['id'], $menu_value[5]))?'checked="checked"':'';?>></td>  -->
                                                    </tr>
                                                    <?php }?>
                                                <?php }?>

                                                <?php } ?>
                                            <?php } ?>
                                            
                                        
                                        <?php }?>
                                    </tbody>
                                </table>
                                    
                                    <input type="hidden" name="admin_id" value="<?php echo $all_id[0];?>">
                                    <input type="hidden" name="staff_id" value="<?php echo $all_id[1];?>">
                                    <input type="hidden" name="protect_id" value="<?php echo $all_id[2];?>">
                                    <input type="hidden" name="guest_id" value="<?php echo $all_id[3];?>">
                                    <!-- <input type="hidden" name="manager_id" value="<?php echo $all_id[4];?>"> -->
                                    
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
