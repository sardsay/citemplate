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
        <i class="fa fa-bars"></i>เพิ่มเออาร์
      </div>
      <div class="widget-content padded">
        <form action="#" class="form-horizontal" name="editform" method="POST" enctype="multipart/form-data">
          <?php foreach($ardata as $key => $item):?>
          <div class="form-group <?php echo (isset($error_form['txtar_name']))?'has-error':'';?>">
            <label class="control-label col-md-2">ชื่อเออาร์:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txtar_name" id="txtar_name" placeholder="กรอกชื่อเออาร์" type="text" value="<?php echo (isset($error_val['val_txtar_name']))?$error_val['val_txtar_name']:$item->title;?>">
            </div>
          </div>
            
          <div class="form-group <?php echo (isset($error_form['txtyoutube']))?'has-error':'';?>">
            <label class="control-label col-md-2"> youtube link:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txtyoutube" id="txtyoutube" placeholder="กรอก url จาก youtube" type="text" value="<?php echo (isset($error_val['val_txtyoutube']))?$error_val['val_txtyoutube']:$item->link;?>">
            </div>
          </div>
           
          <div class="form-group">
            <label class="control-label col-md-2">สถานะ</label>
            <div class="col-md-7">
            <?php 
              if (isset($error_val['val_rdstatus'])) {
                $error_val['val_rdstatus'] = $error_val['val_rdstatus'];  
              }else{
                  $error_val['val_rdstatus']  = $item->status;
              }
            ?>
              <label class="radio-inline"><input name="rdstatus" type="radio" value="1" <?php echo ($error_val['val_rdstatus']==1)?'checked="checked"':'';?>><span>ใช้งาน</span></label>
              <label class="radio-inline"><input name="rdstatus" type="radio" value="0" <?php echo ($error_val['val_rdstatus']==0)?'checked="checked"':'';?>><span>ไม่ใช้งาน</span></label>
              
            </div>
          </div>
          
          <hr id="hr0">
          <div id="schedule-wrapper"></div>
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit">บันทึก</button><a href="<?php echo base_url().'ars';?>"><button class="btn btn-default-outline" type="button">ยกเลิก</button></a>
            </div>
          </div>
        <?php endforeach;?>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
