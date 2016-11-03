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
        <i class="fa fa-bars"></i>เพิ่มข่าว
      </div>
      <div class="widget-content padded">
        <form action="#" class="form-horizontal" name="addform" method="POST" enctype="multipart/form-data">
          
          <div class="form-group <?php echo (isset($error_form['txttitle']))?'has-error':'';?>">
            <label class="control-label col-md-2">หัวข้อข่าว:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txttitle" id="txttitle" placeholder="หัวข้อข่าว" type="text" value="<?php echo (isset($error_val['val_txttitle']))?$error_val['val_txttitle']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtdatadate'])|| isset($error_form['txtenddate']))?'has-error':'';?>">
            <label class="control-label col-md-2">วันที่:*</label>
              <div class="col-md-5">
                <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                  <input class="form-control" name="txtdatadate" id="txtdatadate" type="text" placeholder="เลือกวันที่" value="<?php echo (isset($error_val['val_txtdatadate']))?$error_val['val_txtdatadate']:'';?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
                </div>
                  
              </div>
              
          </div>
          <div class="form-group <?php echo (isset($error_form['txtareadescription']))?'has-error':'';?>">
            <label class="control-label col-md-2">รายละเอียดข่าว:*</label>
            <div class="col-md-7">
                <textarea class="form-control" rows="3"  name="txtareadescription" id="txtareadescription"><?php echo (isset($error_val['val_txtareadescription']))?$error_val['val_txtareadescription']:'';?></textarea>
            </div>
          </div>
          
          <div class="form-group <?php echo (isset($error_form['ddlang']))?'has-error':'';?>">
            <label class="control-label col-md-2">ภาษา:*</label>
            <div class="col-md-7">
              <select class="form-control" name="ddlang" id="ddlang">
                <option value="0">กรุณาเลือกภาษา *</option>
                <option value="th" <?php echo (isset($error_val['val_ddlang'])&& $error_val['val_ddlang']=='th')?'selected="selected"':'';?>>ภาษาไทย</option>
                <option value="en" <?php echo (isset($error_val['val_ddlang'])&& $error_val['val_ddlang']=='en')?'selected="selected"':'';?>>ภาษาอังกฤษ</option>
                <option value="cn" <?php echo (isset($error_val['val_ddlang'])&& $error_val['val_ddlang']=='cn')?'selected="selected"':'';?>>ภาษาจีน</option>
              </select>
            
            </div>
          </div>

          <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
            <label class="control-label col-md-2">
            <?php if(isset($error_form['gallery'])):?>
              <button class="btn btn-danger" id="addImage" type="button"><i class="fa fa-plus"></i>เพิ่มรูปภาพแกลอรี่</button> 
            <?php else:?>
                <button class="btn btn-info" id="addImage" type="button"><i class="fa fa-plus"></i>เพิ่มรูปภาพแกลอรี่</button> 
            <?php endif;?>
            </label>
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
          <!-- <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
            <div id="gallery-wraper2"></div>
          </div> -->
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
              <button class="btn btn-primary" type="submit">บันทึก</button><a href="<?php echo base_url().'news';?>"><button class="btn btn-default-outline" type="button">ยกเลิก</button></a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
function delSchedule(rid){
  $('#hr'+rid).remove();
  $('#schedule_date'+rid).remove();
  $('#schedule_time'+rid).remove();
  $('#schedule_detail'+rid).remove();
}
function dateTimePicker(){
  $(".timepicker-default").timepicker();

  $('.datepicker').datepicker();
    nowTemp = new Date();
    now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    checkin = $("#dpd1").datepicker({
      onRender: function(date) {
        if (date.valueOf() < now.valueOf()) {
          return "disabled";
        } else {
          return "";
        }
      }
    }).on("changeDate", function(ev) {
      var newDate;
      if (ev.date.valueOf() > checkout.date.valueOf()) {
        newDate = new Date(ev.date);
        newDate.setDate(newDate.getDate() + 1);
        checkout.setValue(newDate);
      }
      checkin.hide();
      return $("#dpd2")[0].focus();
    }).data("datepicker");
    checkout = $("#dpd2").datepicker({
      onRender: function(date) {
        if (date.valueOf() <= checkin.date.valueOf()) {
          return "disabled";
        } else {
          return "";
        }
      }
    }).on("changeDate", function(ev) {
      return checkout.hide();
    }).data("datepicker");
}
$(document).ready(function() {
  dateTimePicker();
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
    if (gallery_length <=4) {
        
      $('#gallery-wraper').append(gallery_text);  
        
    }else{
      alert('เพิ่มรู้ได้สูงสุด 5 รูป');
    }
    
    
  });

});

</script>