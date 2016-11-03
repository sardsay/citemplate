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
        <i class="fa fa-bars"></i>Edit Items
      </div>
      <div class="widget-content padded">
        <form action="#" class="form-horizontal" name="editform" method="POST" enctype="multipart/form-data">
        <?php foreach ($itemdata as $key => $item):?>
          <div class="form-group <?php echo (isset($error_form['txtname']))?'has-error':'';?>">
            <label class="control-label col-md-2">ชื่อกลุ่ม:*</label>
            <div class="col-md-7">
              <input class="form-control" name="txtname" id="txtname" placeholder="Name" type="text" value="<?php echo (isset($error_val['val_txtname']))?$error_val['val_txtname']:$item->name;?>">
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-2">Status</label>
            <div class="col-md-7">
            <?php 
              if (!isset($error_val['val_rdstatus'])) {
                $error_val['val_rdstatus'] =1;  
              }
            ?>
              <label class="radio-inline"><input name="rdstatus" type="radio" value="1" <?php echo ($error_val['val_rdstatus']==1 || $item->status == 1)?'checked="checked"':'';?>><span>show</span></label>
              <label class="radio-inline"><input name="rdstatus" type="radio" value="0" <?php echo ($error_val['val_rdstatus']==0 | $item->status == 0)?'checked="checked"':'';?>><span>hide</span></label>
              
            </div>
          </div>
          
          
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-7">
              <button class="btn btn-primary" type="submit">Submit</button><a href="<?php echo base_url().'groups';?>"><button class="btn btn-default-outline" type="button">Cancel</button></a>
            </div>
          </div>
        <?php endforeach;?>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- <div class="row">
  <div class="col-md-12">
    <div class="widget-container">
      <div class="heading">
        <i class="fa fa-cloud-upload"></i>File Upload
      </div>
      <div class="widget-content padded">
        <form action="#" class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-2">Custom File Upload</label>
            <div class="col-md-4">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="input-group">
                  <div class="form-control">
                    <i class="fa fa-file fileupload-exists"></i><span class="fileupload-preview"></span>
                  </div>
                  <div class="input-group-btn">
                    <a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a><span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Without Input</label>
            <div class="col-md-4">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file"></span><span class="fileupload-preview"></span><button class="close fileupload-exists" data-dismiss="fileupload" style="float:none" type="button">×</button>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">With Preview</label>
            <div class="col-md-4">
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                  <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
                </div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                <div>
                  <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> -->

      </div>