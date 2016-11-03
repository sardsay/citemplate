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
        <i class="fa fa-bars"></i>เพิ่มข้อมูลสถานที่</div>
      <div class="widget-content padded">
        <form action="#" class="form-horizontal" name="addform" method="POST" enctype="multipart/form-data">
          <div class="form-group <?php echo (isset($error_form['ddcategory']))?'has-error':'';?>">
            <label class="control-label col-md-2">หมวดหมู่หลัก:*</label>
            <div class="col-md-7">
            <select class="form-control" name="ddcategory" id="ddcategory">
              <option value="0">กรุณาเลือกหมวดหมู่หลัก</option>
                <?php foreach ($ddcategory as $cvalue):?>
                    <option value="<?php echo $cvalue->id;?>" <?php echo (isset($error_val['val_ddcategory'])&& $error_val['val_ddcategory']==$cvalue->id)?'selected="selected"':'';?>><?php echo $cvalue->name;?></option>
                <?php endforeach;?>
              </select>
              <!-- <input class="form-control" name="ddcategory" id="ddcategory" placeholder="Name" type="text" value="<?php echo (isset($error_val['val_ddcategory']))?$error_val['val_ddcategory']:'';?>"> -->
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['ddcategory']))?'has-error':'';?>">
            <label class="control-label col-md-2">หมวดหมู่ย่อย:</label>
            <div class="col-md-7">
            <select class="form-control" name="ddsubcategory" id="ddsubcategory">
              <option value="0">กรุณาเลือกหมวดหมู่ย่อย</option>
                <?php foreach ($ddsubcategory as $cvalue):?>
                    <option value="<?php echo $cvalue->id;?>" <?php echo (isset($error_val['val_ddcategory'])&& $error_val['val_ddcategory']==$cvalue->id)?'selected="selected"':'';?>><?php echo $cvalue->name;?></option>
                <?php endforeach;?>
              </select>
              
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txttitle']))?'has-error':'';?>">
            <label class="control-label col-md-2">ชื่อสถานที่:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txttitle" id="txttitle" placeholder="กรอกชื่อสถานที่" type="text" value="<?php echo (isset($error_val['val_txttitle']))?$error_val['val_txttitle']:'';?>">
            </div>
          </div>
            <div class="form-group <?php echo (isset($error_form['txtareaaddress']))?'has-error':'';?>">
            <label class="control-label col-md-2">ที่อยู่:</label>
            <div class="col-md-7">
                <textarea class="form-control" rows="3" name="txtareaaddress" id="txtareaaddress"><?php echo (isset($error_val['val_txtareaaddress']))?$error_val['val_txtareaaddress']:'';?></textarea>
              
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txttelephone']))?'has-error':'';?>">
            <label class="control-label col-md-2">เบอร์โทรศัพท์:</label>
            <div class="col-md-7">
              <input class="form-control" name="txttelephone" id="txttelephone" placeholder="กรอกเบอร์โทรศัพท์" type="text" value="<?php echo (isset($error_val['val_txttelephone']))?$error_val['val_txttelephone']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtwebsite']))?'has-error':'';?>">
            <label class="control-label col-md-2">เว็บไซต์:</label>
            <div class="col-md-7">
              <input class="form-control" name="txtwebsite" id="txtwebsite" placeholder="กรอกเว็บไซต์, เฟสบุ๊ค หรืออีเมล์" type="text" value="<?php echo (isset($error_val['val_txtwebsite']))?$error_val['val_txtwebsite']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtworkingtime']))?'has-error':'';?>">
            <label class="control-label col-md-2">เวลาทำการ:</label>
            <div class="col-md-7">
              <input class="form-control" name="txtworkingtime" id="txtworkingtime" placeholder="กรอกเวลาทำการ" type="text" value="<?php echo (isset($error_val['val_txtworkingtime']))?$error_val['val_txtworkingtime']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtareadescription']))?'has-error':'';?>">
            <label class="control-label col-md-2">รายละเอียด:</label>
            <div class="col-md-7">
                <textarea class="form-control" rows="10"  name="txtareadescription" id="txtareadescription"><?php echo (isset($error_val['val_txtareadescription']))?$error_val['val_txtareadescription']:'';?></textarea>
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtlatitude']))?'has-error':'';?>">
            <label class="control-label col-md-2">ละติจูด:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txtlatitude" id="txtlatitude" placeholder="กรอกละติจูด" type="text" value="<?php echo (isset($error_val['val_txtlatitude']))?$error_val['val_txtlatitude']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtlongitude']))?'has-error':'';?>">
            <label class="control-label col-md-2">ลองจิจูด:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txtlongitude" id="txtlongitude" placeholder="กรอกลองจิจูด" type="text" value="<?php echo (isset($error_val['val_txtlongitude']))?$error_val['val_txtlongitude']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['ddamphur']))?'has-error':'';?>">
            <label class="control-label col-md-2">อำเภอ:*</label>
            <div class="col-md-7">
              <select class="form-control" name="ddamphur" id="ddamphur">
                <option value="0">กรุณาเลือกอำเภอ</option>
                <?php foreach ($ddamphur as $avalue):?>
                    <option value="<?php echo $avalue->id;?>" <?php echo ($error_val['val_ddamphur']==$avalue->id)?'selected="selected"':'';?>><?php echo $avalue->name;?></option>
                <?php endforeach;?>
              </select>
            
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['dddistrict']))?'has-error':'';?>">
            <label class="control-label col-md-2">ตำบล:*</label>
            <div class="col-md-7">
              <select class="form-control" name="dddistrict" id="dddistrict">
                <option value="0">กรุณาเลือกตำบล</option>  
                <?php foreach ($dddistrict as $dvalue):?>
                    <option value="<?php echo $dvalue->id;?>" <?php echo ($error_val['val_dddistrict']==$dvalue->id)?'selected="selected"':'';?>><?php echo $dvalue->name;?></option>
                <?php endforeach;?>              
              </select>
            </div>
          </div>
          
          <div class="form-group <?php echo (isset($error_form['ddlang']))?'has-error':'';?>">
            <label class="control-label col-md-2">ภาษา:*</label>
            <div class="col-md-7">
              <select class="form-control" name="ddlang" id="ddlang">
                <option value="0">กรุณาเลือกภาษา</option>
                <option value="th" <?php echo (isset($error_val['val_ddlang'])&& $error_val['val_ddlang']=='th')?'selected="selected"':'';?>>ภาษาไทย</option>
                <option value="en" <?php echo (isset($error_val['val_ddlang'])&& $error_val['val_ddlang']=='en')?'selected="selected"':'';?>>ภาษาอังกฤษ</option>
                <option value="cn" <?php echo (isset($error_val['val_ddlang'])&& $error_val['val_ddlang']=='cn')?'selected="selected"':'';?>>ภาษาจีน</option>
              </select>
            
            </div>
          </div>
  
          <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
            <label class="control-label col-md-2">Thumb image</label>
            <div class="col-md-4">
            <label> * ขนาดรูปขั้นต่ำ 600 x 400 px</label>
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
          </div>
          <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
            <label class="control-label col-md-2"><button class="btn btn-info" id="addImage" type="button"><i class="fa fa-cloud-download"></i>เพิ่มรูปภาพแกลอรี่</button> </label>
            <div class="col-md-2">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                  <img src="<?php echo base_url().URLPATH_ADMIN_IMAGES;?>no-image.png">
                </div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                <div>
                  <span class="btn btn-default btn-file"><span class="fileupload-new">เลือกรูปภาพ</span><span class="fileupload-exists">เปลี่ยนรูปภาพ</span>
                  <input type="file" name="gallery[]" id="gallery1"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">ลบรูปภาพ</a>
                </div>
              </div>
            </div>
            <div id="gallery-wraper"></div>
            
          </div>
          <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
            <div id="gallery-wraper2"></div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">สถานะ</label>
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
              <button class="btn btn-primary" type="submit">บันทึก</button><a href="<?php echo base_url().'items';?>"><button class="btn btn-default-outline" type="button">ยกเลิก</button></a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  var gallery_length;
    
  $('#addImage').on('click',function(){
    gallery_length = $('input[name="gallery[]"]').length;
    console.log(gallery_length);
    var new_rows = '<label class="control-label col-md-2"></label>';
    var gallery_text = '<div class="col-md-2"><div class="fileupload fileupload-new" data-provides="fileupload"><div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo base_url().URLPATH_ADMIN_IMAGES;?>no-image.png"></div>';
    gallery_text += '<div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div><div>';
    gallery_text += '<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>';
    gallery_text += '<input type="file" name="gallery[]" id="gallery1"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>';
    gallery_text += '</div></div></div>';
    if (gallery_length <=9) {
        if (gallery_length >4) {
          if (gallery_length == 5) {
            $('#gallery-wraper2').append(new_rows);  
          };
          $('#gallery-wraper2').append(gallery_text);
        }else{
          $('#gallery-wraper').append(gallery_text);  
        }
      }else{
        alert('เพิ่มรู้ได้สูงสุด 10 รูป');
      }
    
    
  });
    $('#ddcategory').on('change',function(){
      var url = '<?php echo base_url();?>'+'items/get_subcaterys';
      $.post(url,{cateID:$(this).val()},function(result){
        $('#ddsubcategory').html(result);
      });
    });
    $('#ddamphur').on('change',function(){
      var url = '<?php echo base_url();?>'+'items/get_amphurs';
      $.post(url,{amphurID:$(this).val()},function(result){
        $('#dddistrict').html(result);
      });
    });
});
</script>