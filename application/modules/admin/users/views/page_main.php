<div class="container-fluid main-content">
        <div class="page-title">
          <h1>
            <?php echo $Header_title;?><a href="<?php echo base_url();?>users/add"><button class="btn btn-lg btn-info">เพิ่มผู้ใช้งาน</button></a>
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
        <i class="fa fa-comment"></i>ค้นหาผู้ใช้งาน
      </div>
      <div class="widget-content padded">
        <form action="<?php echo base_url().'users';?>" name="mainForm" id="mainForm" method="POST" class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-4">ชื่อ :</label>
            <div class="col-md-5">
              <input autocomplete="off" name="txtsearch" id="txtsearch" class="form-control states typeahead tt-query" dir="auto" placeholder="ค้นหาชื่อผู้ใช้" spellcheck="false" type="text" value="<?php echo ($this->input->post('txtsearch'))?$this->input->post('txtsearch'):'';?>">
            </div>
            <div class="col-md-3"></div>
          </div>
          
         
          <div class="form-group">
            <label class="control-label col-md-4"></label>
            <div class="col-md-5">
              <button type="submit" class="btn btn-warning">ค้นหา</button>
            </div>
            <div class="col-md-3"></div>
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
                    <th>ชื่อ</th>
                    <th>username</th>
                    <th>กลุ่ม</th>
                    <th>วันที่สร้าง</th>
                    <th>วันที่แก้ไขล่าสุด</th>
                    <th class="hidden-xs">สถานะ</th>
                    <th class="hidden-xs">จัดการ</th>
                  </thead>
                  <tbody>
                    <?php foreach($allUsers as $key => $item):?>
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
                        <?php echo $item->name;?>
                      </td>
                      <td>
                        <?php echo $item->username;?>
                      </td>
                      <td>
                        <?php echo $item->group_name;?>
                      </td>
                      <td class="hidden-xs">
                          <?php echo $item->create_date;?>
                      </td>
                      <td class="hidden-xs">
                          <?php echo $item->modify_date;?>
                      </td>
                      <td class="hidden-xs">
                          <?php if($item->status==1):?>
                        <span class="label label-success">ใช้งาน</span>
                          <?php else:?>
                          <span class="label label-warning">ไม่ใช้งาน</span>
                          <?php endif;?>
                      </td>
                        <td>
                            
                            <a href="<?php echo base_url().'users/edit/'.$item->id;?>"> แก้ไข</a>/<a href="#" onclick="del(<?php echo $item->id;?>)">ลบ</a>
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
function del(id){
    if(confirm('คุณต้องการลบใช่หรือไม่ ?')==true){
            var url = '<?php echo base_url();?>'+'users/delete';
            $.post(url,{id:id},function(result){
                if (result==1) {
                    alert('ทำการลบข้อมูลเรียบร้อยแล้ว');location.reload();
                }else{
                    alert('กรุณาติดต่อ webmaster');
                }
            });
    }
}
$(document).ready(function() {
    $('#txtsearch').focus();
    $("#txtsearch").typeahead({
        remote:{
          url: '<?php echo base_url();?>users/get_Autocomplete?keyword=%QUERY'
        }
        
      });

    

});
</script>