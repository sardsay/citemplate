<?php 
$error_form = $this->session->flashdata('error_form');
$error_val = $this->session->flashdata('error_val');
// echo '<pre>';
// print_r($user_data);
// echo '</pre>';
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $header_title;?></h1>
    </div>
</div>
<div class="row">
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
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo $title;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php foreach ($user_data as $key => $value) {?>
                            <?php $attributes = array('role' => 'form', 'id' => 'edit_complaint_form','name'=>'edit_complaint_form'); ?>
                            <?php echo form_open('system_management/edituser',$attributes);?>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> ชื่อ</div>
                                </div>
                                <div class="col-lg-4">
                                        <div id="form_name" class="form-group <?php echo (isset($error_form['txtname']))?'has-error':'';?>">
                                            <input class="form-control" name="txtname" id="txtname" type="text" value="<?php echo (isset($error_val['val_txtname'])&& $error_val['val_txtname']=='')?'':$value->name;?>">
                                            <?php if (isset($error_form['txtname'])) {?>
                                                <div class="alert alert-dismissable alert-danger">
                                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                  <?php echo $error_form['txtname'];?>
                                                </div>
                                            <?php }?>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> นามสกุล</div>
                                </div>
                                <div class="col-lg-4">
                                        <div id="form_name" class="form-group <?php echo (isset($error_form['txtlastname']))?'has-error':'';?>">
                                            <input class="form-control" name="txtlastname" id="txtlastname" type="text" value="<?php echo (isset($error_val['val_txtlastname'])&& $error_val['val_txtlastname']=='')?'':$value->lastname;?>">
                                            <?php if (isset($error_form['txtlastname'])) {?>
                                                <div class="alert alert-dismissable alert-danger">
                                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                  <?php echo $error_form['txtlastname'];?>
                                                </div>
                                            <?php }?>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> ตำแหน่งผู้ใช้งาน</div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="form_order" class="form-group <?php echo (isset($error_form['txtposition']))?'has-error':'';?>">
                                    <input class="form-control" name="txtposition" id="txtposition" type="text" value="<?php echo (isset($error_val['val_txtposition'])&& $error_val['val_txtposition']=='')?'99':$value->position;?>">
                                    <?php if (isset($error_form['txtposition'])) {?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $error_form['txtposition'];?>
                                            </div>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> ตำบล</div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="form_order" class="form-group <?php echo (isset($error_form['txtsubdistrict']))?'has-error':'';?>">
                                    <input class="form-control" name="txtsubdistrict" id="txtsubdistrict" type="text" value="<?php echo (isset($error_val['val_txtsubdistrict'])&& $error_val['val_txtsubdistrict']=='')?'99':$value->subdistrict;?>">
                                    <?php if (isset($error_form['txtsubdistrict'])) {?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $error_form['txtsubdistrict'];?>
                                            </div>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> อำเภอ</div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="form_order" class="form-group <?php echo (isset($error_form['txtdistrict']))?'has-error':'';?>">
                                    <input class="form-control" name="txtdistrict" id="txtdistrict" type="text" value="<?php echo (isset($error_val['val_txtdistrict'])&& $error_val['val_txtdistrict']=='')?'99':$value->district;?>">
                                    <?php if (isset($error_form['txtdistrict'])) {?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $error_form['txtdistrict'];?>
                                            </div>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> จังหวัด</div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="form_order" class="form-group <?php echo (isset($error_form['txtprovince']))?'has-error':'';?>">
                                    <input class="form-control" name="txtprovince" id="txtprovince" type="text" value="<?php echo (isset($error_val['val_txtprovince'])&& $error_val['val_txtprovince']=='')?'99':$value->province;?>">
                                    <?php if (isset($error_form['txtprovince'])) {?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $error_form['txtprovince'];?>
                                            </div>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> รหัสไปรษณีย์</div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="form_order" class="form-group <?php echo (isset($error_form['txtpostcode']))?'has-error':'';?>">
                                    <input class="form-control" name="txtpostcode" maxlength="5"  id="txtpostcode" type="text" value="<?php echo (isset($error_val['val_txtpostcode'])&& $error_val['val_txtpostcode']=='')?'99':$value->postcode;?>">
                                    <?php if (isset($error_form['txtpostcode'])) {?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $error_form['txtpostcode'];?>
                                            </div>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> โทรศัพท์</div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="form_order" class="form-group <?php echo (isset($error_form['txttelephone']))?'has-error':'';?>">
                                    <input class="form-control" name="txttelephone" id="txttelephone" type="text" value="<?php echo (isset($error_val['val_txttelephone'])&& $error_val['val_txttelephone']=='')?'99':$value->telephone;?>">
                                    <?php if (isset($error_form['txttelephone'])) {?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $error_form['txttelephone'];?>
                                            </div>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> โทรสาร</div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="form_order" class="form-group <?php echo (isset($error_form['txtfax']))?'has-error':'';?>">
                                    <input class="form-control" name="txtfax" id="txtfax" type="text" value="<?php echo (isset($error_val['val_txtfax'])&& $error_val['val_txtfax']=='')?'99':$value->fax;?>">
                                    <?php if (isset($error_form['txtfax'])) {?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $error_form['txtfax'];?>
                                            </div>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> อีเมล์</div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="form_order" class="form-group <?php echo (isset($error_form['txtemail']))?'has-error':'';?>">
                                    <input class="form-control" name="txtemail" id="txtemail" type="text" value="<?php echo (isset($error_val['val_txtemail'])&& $error_val['val_txtemail']=='')?'99':$value->email;?>">
                                    <?php if (isset($error_form['txtemail'])) {?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $error_form['txtemail'];?>
                                            </div>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> username *</div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="form_order" class="form-group <?php echo (isset($error_form['txtusername']))?'has-error':'';?>">
                                    <input class="form-control" name="txtusername" id="txtusername" type="text" value="<?php echo (isset($error_val['val_txtusername'])&& $error_val['val_txtusername']=='')?'99':$value->username;?>">
                                    <?php if (isset($error_form['txtusername'])) {?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $error_form['txtusername'];?>
                                            </div>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> password *</div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="form_order" class="form-group <?php echo (isset($error_form['txtpassword']))?'has-error':'';?>">
                                    <input class="form-control" name="txtpassword" id="txtpassword" type="password" value="">
                                    <?php if (isset($error_form['txtpassword'])) {?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $error_form['txtpassword'];?>
                                            </div>
                                    <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> กลุ่ม *</div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="form_status" class="form-group">
                                    <select class="form-control" name="ddgroup" id="ddgroup">
                                        <option value="">เลือก</option>
                                        <?php foreach ($groupdatas as $key => $group) {?>
                                            <option value="<?php echo $group->id;?>" <?php echo ($value->group_id==$group->id)?'selected="selected"':'';?>><?php echo $group->name;?></option>
                                        <?php }?>
                                    </select>
                                    <?php if (isset($error_form['ddgroup'])) {?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $error_form['ddgroup'];?>
                                            </div>
                                    <?php }?>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> สถานะ</div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="form_status" class="form-group">
                                    <select class="form-control" name="ddstatus" id="ddstatus">
                                        <option value="1" <?php echo ($value->status==1)?'selected="selected"':'';?>>ใช้งาน</option>
                                        <option value="0" <?php echo ($value->status==0)?'selected="selected"':'';?>>ไม่ใช้งาน</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="row">
							<div class="col-lg-4">
								
                            </div>
                            <div class="col-lg-4">
                            <input type="hidden" name="id" value="<?php echo $this->uri->segment(3);?>">
                            <button type="submit" name="submit" class="btn btn-outline btn-success">save</button>
                            <a href="<?php echo base_url();?>system_management"><button type="button" class="btn btn-outline btn-danger">cancel</button></a>
                            </div>
                            </div>
                            <?php echo form_close();?>
                            <?php } // end foreach ?>
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
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
<script type="text/javascript">

$(document).ready(function() {
    
});
</script>
