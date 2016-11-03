<div class="container-fluid main-content">
        <div class="page-title">
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
        <!-- <i class="fa fa-comment"></i>ค้นหาสถานที่ -->
      </div>
      <div class="row">
          <div class="col-lg-12">
            <div class="widget-container stats-container">
              <div class="col-md-6">
                <a href="<?php echo base_url().'items_mobile/new_index';?>">
                <div class="number">
                  <div class="fa fa-fw fa-bell-o"></div>
                  <?php echo (isset($allNew) && $allNew !='')?$allNew:'0';?>
                  <!-- 86<small>%</small> -->
                </div>
                <div class="text">
                แจ้งสถานที่ใหม่
                  <!-- Overall  -->
                </div>
                </a>
              </div>
              <div class="col-md-6">
                <a href="<?php echo base_url().'items_mobile/update_index';?>">
                <div class="number">
                  <div class="fa fa-fw fa-refresh"></div>

                  <?php echo (isset($allUpdate) && $allUpdate !='')?$allUpdate:'0';?>
                </div>
                <div class="text">
                  แจ้งอัพเดทข้อมูลสถานที่
                </div>
                </a>
              </div>
              
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
        
      </div>
<script type="text/javascript">

</script>