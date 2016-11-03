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
        <i class="fa fa-bars"></i>เพิ่มกิจกรรม
      </div>
      <div class="widget-content padded">
        <form action="#" class="form-horizontal" name="addform" method="POST" enctype="multipart/form-data">
          
          <div class="form-group <?php echo (isset($error_form['txtevent_name']))?'has-error':'';?>">
            <label class="control-label col-md-2">ชื่อกิจกรรม:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txtevent_name" id="txtevent_name" placeholder="กรอกชื่อกิจกรรม" type="text" value="<?php echo (isset($error_val['val_txtevent_name']))?$error_val['val_txtevent_name']:'';?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtstartdate'])|| isset($error_form['txtenddate']))?'has-error':'';?>">
          <label class="control-label col-md-2">เริ่มวันที่:*</label>
              <div class="col-sm-3">
              <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                <input class="form-control" name="txtstartdate" id="txtstartdate" type="text" placeholder="เลือกวันที่เริ่ม" value="<?php echo (isset($error_val['val_txtstartdate']))?$error_val['val_txtstartdate']:'';?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
              </div>
                  
                </div>
                <label class="control-label col-md-1">สิ้นสุดวันที่:*</label>
                <div class="col-sm-3">
                    <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                    <input class="form-control"  name="txtenddate" id="txtenddate" type="text" placeholder="เลือกวันสิ้นสุด" value="<?php echo (isset($error_val['val_txtenddate']))?$error_val['val_txtenddate']:'';?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
                  </div>
                  
                </div>
          </div>
            <div class="form-group <?php echo (isset($error_form['txtareaaddress']))?'has-error':'';?>">
            <label class="control-label col-md-2">สถานที่จัดกิจกรรม:</label>
            <div class="col-md-7">
                <textarea class="form-control" rows="3" name="txtareaaddress" id="txtareaaddress"><?php echo (isset($error_val['val_txtareaaddress']))?$error_val['val_txtareaaddress']:'';?></textarea>
              
            </div>
          </div>

          <div class="form-group <?php echo (isset($error_form['txtareadescription']))?'has-error':'';?>">
            <label class="control-label col-md-2">รายละเอียดกิจกรรม:</label>
            <div class="col-md-7">
                <textarea class="form-control" rows="3"  name="txtareadescription" id="txtareadescription"><?php echo (isset($error_val['val_txtareadescription']))?$error_val['val_txtareadescription']:'';?></textarea>
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txttelephone']))?'has-error':'';?>">
            <label class="control-label col-md-2">ติดต่อสอบถาม:</label>
            <div class="col-md-7">
              <input class="form-control" name="txttelephone" id="txttelephone" placeholder="กรอกเบอร์โทรศัพท์" type="text" value="<?php echo (isset($error_val['val_txttelephone']))?$error_val['val_txttelephone']:'';?>">
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
            <label class="control-label col-md-2">รูปภาพ</label>
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
            <label class="control-label col-md-2"><button class="btn btn-info" id="addImage" type="button"><i class="fa fa-plus"></i>เพิ่มรูปภาพแกลอรี่</button> </label>
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
          <hr>
          <div class="form-group">
            <label class="control-label col-md-2"><button class="btn btn-success" id="addschedule" type="button"><i class="fa fa-plus"></i>เพิ่มตารางกิจกรรม</button> </label>
            <div class="col-md-7"></div>
          </div>          
          <div id="schedule_date0" class="form-group <?php echo (isset($error_form['txtschestartdate'])|| isset($error_form['txtenddate']))?'has-error':'';?>">
          <label class="control-label col-md-2">วันที่:</label>
              <div class="col-sm-3">
                <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                  <input class="form-control" name="txtschedule_startdate[]" id="txtschedule_startdate" type="text" placeholder="Start date" value="<?php echo (isset($error_val['val_txtschestartdate']))?$error_val['val_txtschestartdate']:'';?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
                </div>                  
              </div>
                <label class="control-label col-md-1">วันที่:</label>
                <div class="col-sm-3">
                    <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                    <input class="form-control"  name="txtschedule_enddate[]" id="txtschedule_enddate" type="text" placeholder="End date" value="<?php echo (isset($error_val['val_txtschenddate']))?$error_val['val_txtschenddate']:'';?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
                  </div>
                  
              </div>
          </div>
          <div id="schedule_time0" class="form-group">
            <label class="control-label col-md-2">เวลาเริ่มต้น</label>
            <div class="col-md-3">
              <div class="input-group bootstrap-timepicker">
                <input class="form-control timepicker-default" id="txtschedule_starttime" type="text" name="txtschedule_starttime[]"><span class="input-group-addon"><i class="fa fa-clock-o"></i></span></input>
              </div>
            </div>
            <label class="control-label col-md-1">เวลาสิ้นสุด</label>
            <div class="col-md-3">
              <div class="input-group bootstrap-timepicker">
                <input class="form-control timepicker-default" id="txtschedule_endtime" type="text" name="txtschedule_endtime[]"><span class="input-group-addon"><i class="fa fa-clock-o"></i></span></input>
              </div>
            </div>
          </div>
          <div  id="schedule_detail0" class="form-group">
            <label class="control-label col-md-2">รายละเอียด ตารางกิจกรรม</label>
            <div class="col-md-7">
                <textarea class="form-control" rows="3"  name="areaschedule[]" id="areaschedule" ><?php echo (isset($error_val['val_txtareadescription']))?$error_val['val_txtareadescription']:'';?></textarea>
            </div>
          </div>
          <hr id="hr0">
          <div id="schedule-wrapper"></div>
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit">บันทึก</button><a href="<?php echo base_url().'events';?>"><button class="btn btn-default-outline" type="button">ยกเลิก</button></a>
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
var schedule_length = 1;

$('#addschedule').on('click',function(){
  // schedule_length = $('input[name="txtschedule_startdate[]"]').length;
  console.log(schedule_length);
  var schedule_text = '<div class="form-group" id="schedule_date'+schedule_length+'"><label class="control-label col-md-2">วันที่:</label><div class="col-sm-3"><div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">';
    schedule_text+= '<input class="form-control" name="txtschedule_startdate[]" id="txtschedule_startdate" type="text" placeholder="Start date" value=""><span class="input-group-addon"><i class="fa fa-calendar"></i></span></input></div></div>';
    schedule_text+= '<label class="control-label col-md-1">วันที่:</label><div class="col-sm-3"><div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">';
    schedule_text+= '<input class="form-control"  name="txtschedule_enddate[]" id="txtschedule_enddate" type="text" placeholder="End date" value=""><span class="input-group-addon"><i class="fa fa-calendar"></i></span></input></div></div><label class="control-label col-md-1"><button class="btn btn-danger" type="button" id="remove'+schedule_length+'" onclick="delSchedule('+schedule_length+')"><i class="fa fa-trash-o"></i>Delete</button></label></div>';
    schedule_text+= '<div  id="schedule_time'+schedule_length+'" class="form-group"><label class="control-label col-md-2">เวลาเริ่มต้น</label><div class="col-md-3"><div class="input-group bootstrap-timepicker">';
    schedule_text+= '<input class="form-control timepicker-default" id="txtschedule_starttime" type="text" name="txtschedule_starttime[]"><span class="input-group-addon"><i class="fa fa-clock-o"></i></span></input></div></div>';
    schedule_text+= '<label class="control-label col-md-1">เวลาสิ้นสุด</label>';
    schedule_text+= '<div class="col-md-3"><div class="input-group bootstrap-timepicker"><input class="form-control timepicker-default" id="txtschedule_endtime" type="text" name="txtschedule_endtime[]" ><span class="input-group-addon"><i class="fa fa-clock-o"></i></span></input>';
    schedule_text+= '</div></div></div><div  id="schedule_detail'+schedule_length+'" class="form-group"><label class="control-label col-md-2">รายละเอียด ตารางกิจกรรม</label><div class="col-md-7">';
    schedule_text+= '<textarea class="form-control" rows="3"  name="areaschedule[]" id="areaschedule"></textarea></div></div><hr id="hr'+schedule_length+'">';
  
  $('#schedule-wrapper').append(schedule_text);
  dateTimePicker();
    ++schedule_length;
  });

                
  
  });

</script>