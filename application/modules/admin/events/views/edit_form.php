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
        <i class="fa fa-bars"></i>แก้ไขกิจกรรม
      </div>
      <div class="widget-content padded">
        <form action="#" class="form-horizontal" name="editform" method="POST" enctype="multipart/form-data">
        <?php foreach ($eventdata as $key => $item):?>
          <div class="form-group <?php echo (isset($error_form['txtevent_name']))?'has-error':'';?>">
            <label class="control-label col-md-2">ชื่อกิจกรรม:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txtevent_name" id="txtevent_name" placeholder="กรอกชื่อกิจกรรม" type="text" value="<?php echo (isset($error_val['val_txtevent_name']))?$error_val['val_txtevent_name']:$item->event_name;?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtstartdate'])|| isset($error_form['txtenddate']))?'has-error':'';?>">
          <label class="control-label col-md-2">เริ่มวันที่:*</label>
              <div class="col-sm-3">
              <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                <input class="form-control" name="txtstartdate" id="txtstartdate" type="text" placeholder="เลือกวันเริ่มต้น" value="<?php echo (isset($error_val['val_txtstartdate']))?$error_val['val_txtstartdate']:date('d-m-Y',strtotime($item->starttime));?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
              </div>
                  <!-- <input class="form-control" name="txtstartdate" id="txtstartdate" data-date-autoclose="true" data-date-format="dd-mm-yyyy" id="dpd1" placeholder="Start date" type="text"> -->
                </div>
                <label class="control-label col-md-1">สิ้นสุดวันที่:*</label>
                <div class="col-sm-3">
                    <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                    <input class="form-control"  name="txtenddate" id="txtenddate" type="text" placeholder="เลือกวันสิ้นสุด" value="<?php echo (isset($error_val['val_txtenddate']))?$error_val['val_txtenddate']:date('d-m-Y',strtotime($item->endtime));?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
                  </div>
                  <!-- <input class="form-control" name="txtenddate" id="txtenddate" data-date-autoclose="true" data-date-format="dd-mm-yyyy" id="dpd2" placeholder="End date" type="text"> -->
                </div>
          </div>
            <div class="form-group <?php echo (isset($error_form['txtareaaddress']))?'has-error':'';?>">
            <label class="control-label col-md-2">สถานที่จัดกิจกรรม:</label>
            <div class="col-md-7">
                <textarea class="form-control" rows="3" name="txtareaaddress" id="txtareaaddress"><?php echo (isset($error_val['val_txtareaaddress']))?$error_val['val_txtareaaddress']:$item->address;?></textarea>
              
            </div>
          </div>

          <div class="form-group <?php echo (isset($error_form['txtareadescription']))?'has-error':'';?>">
            <label class="control-label col-md-2">รายละเอียดกิจกรรม:</label>
            <div class="col-md-7">
                <textarea class="form-control" rows="3"  name="txtareadescription" id="txtareadescription"><?php echo (isset($error_val['val_txtareadescription']))?$error_val['val_txtareadescription']:$item->event_detail;?></textarea>
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txttelephone']))?'has-error':'';?>">
            <label class="control-label col-md-2">ติดต่อสอบถาม:</label>
            <div class="col-md-7">
              <input class="form-control" name="txttelephone" id="txttelephone" placeholder="กรอกเบอร์โทรศัพท์" type="text" value="<?php echo (isset($error_val['val_txttelephone']))?$error_val['val_txttelephone']:$item->telephone;?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtlatitude']))?'has-error':'';?>">
            <label class="control-label col-md-2">ละติจูด:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txtlatitude" id="txtlatitude" placeholder="กรอกละติจูด" type="text" value="<?php echo (isset($error_val['val_txtlatitude']))?$error_val['val_txtlatitude']:$item->latitude;?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtlongitude']))?'has-error':'';?>">
            <label class="control-label col-md-2">ลองจิจูด:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txtlongitude" id="txtlongitude" placeholder="กรอกลองจิจูด" type="text" value="<?php echo (isset($error_val['val_txtlongitude']))?$error_val['val_txtlongitude']:$item->longitude;?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['ddlang']))?'has-error':'';?>">
            <label class="control-label col-md-2">ภาษา:*</label>
            <div class="col-md-7">
              <select class="form-control" name="ddlang" id="ddlang">
                <option value="0">กรุณาเลือกภาษา *</option>
                <option value="th" <?php echo ((isset($error_val['val_ddlang'])&& $error_val['val_ddlang']=='th') || $item->lang == 'th')?'selected="selected"':'';?>>ภาษาไทย</option>
                <option value="en" <?php echo ((isset($error_val['val_ddlang'])&& $error_val['val_ddlang']=='en') || $item->lang == 'en')?'selected="selected"':'';?>>ภาษาอังกฤษ</option>
                <option value="cn" <?php echo ((isset($error_val['val_ddlang'])&& $error_val['val_ddlang']=='cn') || $item->lang == 'cn')?'selected="selected"':'';?>>ภาษาจีน</option>
              </select>
              
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
            <label class="control-label col-md-2">รูปภาพ</label>
            <div class="col-md-4">
            <label> * ขนาดรูปขั้นต่ำ 600 x 400 px</label>
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                  <img src="<?php echo base_url().URLPATH_UPLOAD_EVENTIMAGES.($item->id%10).'/'.$item->id.'/'.$item->image_thumb;?>">
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
            <?php foreach ($gallery1 as $key => $value):?>
              <div class="col-md-2" id="gall<?php echo $value->id;?>">
                <img src="<?php echo base_url().URLPATH_UPLOAD_EVENTIMAGES.($item->id%10).'/'.$item->id.'/gallerys/'.$value->image_name;?>" width="200" height="150">
                <button class="btn btn-danger" type="button" onclick="delGall(<?php echo $value->id;?>,<?php echo $item->id;?>)"><i class="fa fa-trash-o"></i>ลบรูปภาพ</button>
                <input type="hidden" name="gallery[]" id="gallery" value="">
              </div>  
            <?php endforeach;?>
            
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
            
            <label class="control-label col-md-2"></label>
            <?php foreach ($gallery2 as $key => $value):?>
              <div class="col-md-2" id="gall<?php echo $value->id;?>">
                <img src="<?php echo base_url().URLPATH_UPLOAD_EVENTIMAGES.($item->id%10).'/'.$item->id.'/gallers/'.$value->image_name;?>" width="200" height="150">
                <button class="btn btn-danger" type="button" onclick="delGall(<?php echo $value->id;?>,<?php echo $item->id;?>)"><i class="fa fa-trash-o"></i>ลบรูปภาพ</button>
                <input type="hidden" name="gallery[]" id="gallery" value="">
              </div>  
            <?php endforeach;?>
            <div id="gallery-wraper2"></div>
          </div>
          <hr>
          
          <div class="form-group">
            <label class="control-label col-md-2"><button class="btn btn-success" id="addschedule" type="button"><i class="fa fa-plus"></i>เพิ่มตารางกิจกรรม</button> </label>
            <div class="col-md-7"></div>
          </div>          
          <?php foreach ($scheduleData as $skey => $sitem):?>
          <div id="schedule_date<?php echo $skey?>" class="form-group <?php echo (isset($error_form['txtschestartdate'])|| isset($error_form['txtenddate']))?'has-error':'';?>">
          <label class="control-label col-md-2">วันที่:</label>
              <div class="col-sm-3">
                <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                  <input class="form-control" name="txtschedule_startdate[]" id="txtschedule_startdate" type="text" placeholder="เลือกวันที่เริ่มต้น" value="<?php echo date('d-m-Y',strtotime($sitem->start_date));?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
                </div>                  
              </div>
                <label class="control-label col-md-1">วันที่:</label>
                <div class="col-sm-3">
                    <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                    <input class="form-control"  name="txtschedule_enddate[]" id="txtschedule_enddate" type="text" placeholder="เลือกวันที่สิ้นสุด" value="<?php echo date('d-m-Y',strtotime($sitem->end_date));?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
                  </div>
                  
              </div>
              <label class="control-label col-md-1"><button class="btn btn-danger" type="button" id="remove1" onclick="delSchedule(<?php echo $skey?>)"><i class="fa fa-trash-o"></i>Delete</button></label>
          </div>
          <div id="schedule_time<?php echo $skey?>" class="form-group">
            <label class="control-label col-md-2">เวลาเริ่มต้น</label>
            <div class="col-md-3">
              <div class="input-group bootstrap-timepicker">
                <input class="form-control timepicker-default" id="txtschedule_starttime" type="text" name="txtschedule_starttime[]" value="<?php echo $sitem->start_time;?>"><span class="input-group-addon"><i class="fa fa-clock-o"></i></span></input>
              </div>
            </div>
            <label class="control-label col-md-1">เวลาสิ้นสุด</label>
            <div class="col-md-3">
              <div class="input-group bootstrap-timepicker">
                <input class="form-control timepicker-default" id="txtschedule_endtime" type="text" name="txtschedule_endtime[]" value="<?php echo $sitem->end_time;?>"><span class="input-group-addon"><i class="fa fa-clock-o"></i></span></input>
              </div>
            </div>
          </div>
          <div  id="schedule_detail<?php echo $skey?>" class="form-group">
            <label class="control-label col-md-2">รายละเอียด ตารางกิจกรรม</label>
            <div class="col-md-7">
                <textarea class="form-control" rows="3"  name="areaschedule[]" id="areaschedule" ><?php echo $sitem->schedule_detail;?></textarea>
            </div>
          </div>
          <hr id="hr<?php echo $skey?>">
          <?php endforeach;?>
          <div id="schedule-wrapper"></div>
          <div class="form-group">
            <label class="control-label col-md-2">สถานะ</label>
            <div class="col-md-7">
              <label class="radio-inline"><input name="rdstatus" type="radio" value="1" <?php echo ((isset($error_val['val_rdstatus'])&&$error_val['val_rdstatus']==1) || $item->status == 1)?'checked="checked"':'';?>><span>ใช้งาน</span></label>
              <label class="radio-inline"><input name="rdstatus" type="radio" value="0" <?php echo ((isset($error_val['val_rdstatus'])&&$error_val['val_rdstatus']==0)|| $item->status == 0)?'checked="checked"':'';?>><span>ไม่ใช้งาน</span></label>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit">บันทึก</button><a href="<?php echo base_url().'events';?>"><button class="btn btn-default-outline" type="button">ยกเลิก</button></a>
            </div>
          </div>
        <?php endforeach;?>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
function delGall(id,eid){
    if (confirm('คุณต้องการลบไฟล์นี้ใช่หรือไม่')==true) {

        $.post( "<?php echo base_url();?>events/get_delfile",{fid:id,eid:eid}, function( data ) {
          console.log(data);
            if (data) {
                alert('ลบไฟล์สำร็จแล้ว');
                $('#gall'+id).remove();
                return false;
            }else{
                alert('ไม่สามารถลบไฟล์ได้');
                return false;
            }
            
        });
        
    }else{
        return false;
    }
}
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
          // if (gallery_length == 5) {
          //   $('#gallery-wraper2').append(new_rows);  
          // };
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