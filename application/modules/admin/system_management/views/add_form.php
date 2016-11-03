<?php 
$error_form = $this->session->flashdata('error_form');
$error_val = $this->session->flashdata('error_val');
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $header_title;?><a href="<?php echo base_url();?>complaint_status"><button type="button" class="btn btn-outline btn-danger btn-lg">Cancel</button></a></h1>
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
                            <?php $attributes = array('role' => 'form', 'id' => 'add_complaint_form','name'=>'add_complaint_form'); ?>
                            <?php echo form_open('complaint_status/add',$attributes);?>
                            <div class="row">
                                <div class="col-lg-4">
                                   <div class="text-head"> ชื่อ</div>
                                </div>
                                <div class="col-lg-4">
                                        <div id="form_name" class="form-group <?php echo (isset($error_form['txtname']))?'has-error':'';?>">
                                            <input class="form-control" name="txtname" id="txtname" type="text" value="<?php echo (isset($error_val['val_txtname']))?$error_val['val_txtname']:'';?>">
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
                                   <div class="text-head"> ลำดับ</div>
                                </div>
                                <div class="col-lg-4">
                                    <div id="form_order" class="form-group <?php echo (isset($error_form['txtorder']))?'has-error':'';?>">
                                    <input class="form-control" name="txtorder" id="txtorder" type="text" value="<?php echo (isset($error_val['val_txtorder']))?$error_val['val_txtorder']:'99';?>">
                                    <?php if (isset($error_form['txtorder'])) {?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $error_form['txtorder'];?>
                                            </div>
                                    <?php }?>
                                    <?php if (isset($error_form['txtorder_num'])) {?>
                                            <div class="alert alert-dismissable alert-danger">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                <?php echo $error_form['txtorder_num'];?>
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
                                        <option value="0">ไม่ใช้งาน</option>
                                        <option value="1" selected="selected">ใช้งาน</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="row">
							<div class="col-lg-4">
								
                            </div>
                            <div class="col-lg-4">
                            <button type="submit" class="btn btn-outline btn-success">save</button>
                            <button type="reset" class="btn btn-outline btn-danger">cancel</button>
                            </div>
                            </div>
                            <?php echo form_close();?>
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
