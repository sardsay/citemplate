<div class="container-fluid main-content">
        <div class="page-title">
          <h1>
            <?php echo $Header_title;?><a href="<?php echo base_url();?>ars/add"><button class="btn btn-lg btn-info">เพิ่มเออาร์</button></a>
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
        <i class="fa fa-comment"></i>ค้นหารายการ AR
      </div>
      <div class="widget-content padded">
        <form action="<?php echo base_url().'ars';?>" name="mainForm" id="mainForm" method="GET" class="form-horizontal">
          <div class="form-group">
              <div class="row">
                    <div class="control-label col-md-4">ชื่อเอาร์ :</div>
                    <div class="col-md-5">
                      <input autocomplete="off" name="txtsearch" id="txtsearch" class="form-control states typeahead tt-query" dir="auto" placeholder="กรอกชื่อเออาร์" spellcheck="false" type="text" value="<?php echo ($this->input->get('txtsearch'))?$this->input->get('txtsearch'):'';?>">
                    </div>
                    <div class="col-md-3"><button type="submit" class="btn btn-warning">ค้นหา</button></div>
              </div>
          </div>
        </form>
          
      </div>

    </div>
  </div>
</div>
        <div class="row">
          <!-- Striped Table -->
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
              <div class="heading">
                <i class="fa fa-table"></i><?php echo $title;?>
              </div>
              <div class="widget-content padded clearfix">
                <table class="table table-striped">
                  <thead>
                    <th>#</th>
                    <th>ชื่อ เออาร์</th>
                    <th class="hidden-xs">ข้อมูล</th>
                    <th class="hidden-xs">วันที่สร้าง</th>
                    <th class="hidden-xs">วันที่แก้ไขล่าสุด</th>
                    <th class="hidden-xs">สถานะ</th>
                    <th class="hidden-xs">จัดการ</th>
                  </thead>
                  <tbody>
                    <?php foreach($allArs as $key => $item):?>
                    <tr>
                      <td>
                        <?php
                        $page = $this->input->get('page');
                        if ($page=='') {
                          $page = 1;
                        }
                        $idstart =  (($per_page*$page)-$per_page)+1;
                         echo ($key+$idstart);?>
                      </td>
                      <td>
                        <?php echo $item->title;?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $item->image;?>
                      </td>
                      <td class="hidden-xs">
                          <?php echo date('d-m-Y H:i:s',strtotime($item->create_date));?>
                      </td>
                      <td class="hidden-xs">
                          <?php echo ($item->modify_date != '0000-00-00 00:00:00')?date('d-m-Y H:i:s',strtotime($item->modify_date)):'-';?>
                      </td>
                      <td class="hidden-xs">
                          <?php if($item->status==1):?>
                        <span class="label label-success">ใช้งาน</span>
                          <?php else:?>
                          <span class="label label-warning">ไม่ใช้งาน</span>
                          <?php endif;?>
                      </td>
                        <td>
                            
                            <a href="<?php echo base_url().'ars/edit/'.$item->id;?>"> แก้ไข</a>/<a href="#" onclick="del(<?php echo $item->id;?>)">ลบ</a>
                      </td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- end Striped Table --><!-- Condensed Table -->

        </div>
        <div class="row">
            <div class="col-md-8">
              
            </div>
            <div class="col-md-4">
              
              <ul class="pagination" style="">
              <?php echo $pagination;?>
              </ul>
            </div>
          </div>
      </div>
<script type="text/javascript">
function del(ar_id){
    if(confirm('คุณต้องการลบใช่หรือไม่ ?')==true){
            var url = '<?php echo base_url();?>'+'ars/delete';
            $.post(url,{ar_id:ar_id},function(result){
                if (result==1) {
                    alert('ทำการลบข้อมูลเรียบร้อยแล้ว');location.reload();
                }else{
                    alert('กรุณาติดต่อ webmaster');
                }
            });
    }
}
//$(document).ready(function() {
//  $('.datepicker').datepicker();
//    $('#txtsearch').focus();
//    $("#txtsearch").typeahead({
//        remote:{
//          url: '<?php echo base_url();?>events/get_Autocomplete?keyword=%QUERY'
//        }
//        
//      });
//
//    
//
//});
</script>