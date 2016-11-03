<?php
$error_form = $this->session->flashdata('error_form');
$error_val = $this->session->flashdata('error_val');
?>
<div class="container-fluid main-content"><div class="page-title">
  <h1>
    <?php echo $Header_title;?>
  </h1>
</div>
<!-- Display Message System -->
<?php $msg = $this->session->flashdata('msg');?>
<?php if (isset($msg['error_msg'])) {?>
<div class="alert alert-danger">
<button class="close" data-dismiss="alert" type="button">&times;</button><?php echo $msg['error_msg'];?>
</div>
<?php }?>
<?php if (isset($msg['success_msg'])) {?>                                
<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button">&times;</button><?php echo $msg['success_msg'];?>
</div>
<?php }?>
<!-- End Display Message System -->
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="fa fa-bars"></i>เพิ่มผู้ใช้งาน
      </div>
      <div class="widget-content padded">
        <form action="#" class="form-horizontal" name="addform" method="POST" enctype="multipart/form-data">
          <div class="form-group <?php echo (isset($error_form['txtname']))?'has-error':'';?>">
            <label class="control-label col-md-2">ชื่อผู้ใช้งาน:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txtname" id="txtname" placeholder="ชื่อ" type="text" value="<?php echo (isset($error_val['val_txtname']))?$error_val['val_txtname']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtrealname']))?'has-error':'';?>">
            <label class="control-label col-md-2">ชื่อจริง:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txtrealname" id="txtrealname" placeholder="ชื่อจริง" type="text" value="<?php echo (isset($error_val['val_txtrealname']))?$error_val['val_txtrealname']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtusername']))?'has-error':'';?>">
            <label class="control-label col-md-2">Username:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txtusername" id="txtusername" placeholder="Username" type="text" value="<?php echo (isset($error_val['val_txtusername']))?$error_val['val_txtusername']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtpassword']))?'has-error':'';?>">
            <label class="control-label col-md-2">Password:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txtpassword" id="txtpassword" placeholder="Password" type="password" value="<?php echo (isset($error_val['val_txtpassword']))?$error_val['val_txtpassword']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtareaaddress']))?'has-error':'';?>">
            <label class="control-label col-md-2">ที่อยู่:</label>
            <div class="col-md-7">
              <textarea class="form-control"name="txtareaaddress" id="txtareaaddress" rows="3"><?php echo (isset($error_val['val_txtareaaddress']))?$error_val['val_txtareaaddress']:'';?></textarea>
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtphone']))?'has-error':'';?>">
            <label class="control-label col-md-2">เบอร์โทรศัพท์:</label>
            <div class="col-md-7">
              <input class="form-control" name="txtphone" id="txtphone" placeholder="เบอร์โทรศัพท์" type="phone" value="<?php echo (isset($error_val['val_txtphone']))?$error_val['val_txtphone']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtemail']))?'has-error':'';?>">
            <label class="control-label col-md-2">อีเมล์:</label>
            <div class="col-md-7">
              <input class="form-control" name="txtemail" id="txtemail" placeholder="อีเมล์" type="email" value="<?php echo (isset($error_val['val_txtemail']))?$error_val['val_txtemail']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['ddgroups']))?'has-error':'';?>">
            <label class="control-label col-md-2">กลุ่ม:*</label>
            <div class="col-md-7">
            <select class="form-control" name="ddgroups" id="ddgroups">
              <option value="0">กรุณาเลือกกลุ่ม</option>
                <?php foreach ($ddgroups as $cvalue):?>
                    <option value="<?php echo $cvalue->id;?>" <?php echo (isset($error_val['val_ddcategory'])&& $error_val['val_ddcategory']==$cvalue->id)?'selected="selected"':'';?>><?php echo $cvalue->name;?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">สถานะ:</label>
            <div class="col-md-7">
            <?php 
              if (!isset($error_val['val_rdstatus'])) {
                $error_val['val_rdstatus'] =1;  
              }
            ?>
              <label class="radio-inline"><input name="rdstatus" type="radio" value="1" <?php echo ($error_val['val_rdstatus']==1)?'checked="checked"':'';?>><span>ใช้งาน</span></label>
              <label class="radio-inline"><input name="rdstatus" type="radio" value="0" <?php echo ($error_val['val_rdstatus']==0)?'checked="checked"':'';?>><span>ไม่ใช้งาน</span></label>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit">ยืนยัน</button><a href="<?php echo base_url().'users';?>"><button class="btn btn-default-outline" type="button">ยกเลิก</button></a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>