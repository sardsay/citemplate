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
        <i class="fa fa-bars"></i>เพิ่มหมวดหมู่ย่อย
      </div>
      <div class="widget-content padded">
        <form action="#" class="form-horizontal" name="addform" method="POST" enctype="multipart/form-data">
        <div class="form-group <?php echo (isset($error_form['ddmaincategory']))?'has-error':'';?>">
            <label class="control-label col-md-2">หวดหมู่หลัก:</label>
            <div class="col-md-7">
              <select class="form-control" name="ddmaincategory" id="ddmaincategory">
                <option value="0">เลือกหมวดหมู่หลัก</option>
                <?php foreach ($mainCategorys as $key => $mcvalue):?>
                  <option value="<?php echo $mcvalue->id;?>" <?php echo ($error_val['val_ddmaincategory']==$mcvalue->id)?'selected="selected"':'';?>><?php echo $mcvalue->name;?></option>
                <?php endforeach;?>
              </select>
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtname']))?'has-error':'';?>">
            <label class="control-label col-md-2">ชื่อ:</label>
            <div class="col-md-7">
              <input class="form-control" name="txtname" id="txtname" placeholder="ชื่อหมวดหมู่" type="text" value="<?php echo (isset($error_val['val_txtname']))?$error_val['val_txtname']:'';?>">
            </div>
          </div>
            <div class="form-group <?php echo (isset($error_form['txtname_en']))?'has-error':'';?>">
            <label class="control-label col-md-2">ชื่อภาษาอังกฤษ:</label>
            <div class="col-md-7">
              <input class="form-control" name="txtname_en" id="txtname_en" placeholder="ชื่อหมวดหมู่ภาษาอังกฤษ" type="text" value="<?php echo (isset($error_val['val_txtname_en']))?$error_val['val_txtname_en']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtname_cn']))?'has-error':'';?>">
            <label class="control-label col-md-2">ชื่อภาษาจีน:</label>
            <div class="col-md-7">
              <input class="form-control" name="txtname_cn" id="txtname_cn" placeholder="ชื่อหมวดหมู่ภาษาจีน" type="text" value="<?php echo (isset($error_val['val_txtname_cn']))?$error_val['val_txtname_cn']:'';?>">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              

            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
            <label class="control-label col-md-2">Thumb image</label>
            <div class="col-md-4">
            <label> * แนะนำให้อัพโหลดรูปแนวตั้ง ขนาดขั้นตำ่ 300 x 400 px</label>
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                  <img src="<?php echo base_url().URLPATH_ADMIN_IMAGES;?>no-image.png">
                </div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                <div>
                  <span class="btn btn-default btn-file"><span class="fileupload-new">เลือกรูปภาพ</span><span class="fileupload-exists">เปลี่ยนรูปภาพ</span><input type="file" name="thumb_image" id="thumb_image"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">ลบรูปภาพ</a>
                </div>
              </div>
            </div>
            <label class="control-label col-md-1"></label>
            <div class="col-md-4">
            <!-- <label> * ขนาดรูปขั้นต่ำ 150 x 220 px</label>
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                  <img src="<?php echo base_url().URLPATH_ADMIN_IMAGES;?>no-image.png">
                </div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                <div>
                  <span class="btn btn-default btn-file"><span class="fileupload-new">เลือกหมุด</span><span class="fileupload-exists">เปลี่ยนหมุด</span><input type="file" name="pin_map" id="pin_map"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">ลบหมุด</a>
                </div>
              </div> -->
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
                
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">สถานะ</label>
            <div class="col-md-7">
            <?php 
              if (!isset($error_val['val_rdstatus'])) {
                $error_val['val_rdstatus'] =1;  
              }
            ?>
              <label class="radio-inline"><input name="rdStatus" type="radio" value="1" <?php echo ($error_val['val_rdstatus']==1)?'checked="checked"':'';?>><span>ใช้งาน</span></label>
              <label class="radio-inline"><input name="rdStatus" type="radio" value="0" <?php echo ($error_val['val_rdstatus']==0)?'checked="checked"':'';?>><span>ไม่ใช้งาน</span></label>
              
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit">บันทึก</button><a href="<?php echo base_url().'subcategorys';?>"><button class="btn btn-default-outline" type="button">ยกเลิก</button></a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
      </div>