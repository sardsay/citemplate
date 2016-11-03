<div class="container-fluid main-content">
        <div class="page-title">
          <h1>
            <?php echo $Header_title;?><a href="<?php echo base_url();?>subcategorys/add"><button class="btn btn-lg btn-info">เพิ่มหมวดหมู่</button></a>
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
        <i class="fa fa-comment"></i>ค้นหาหมวดหมู่ย่อย
      </div>
      <div class="widget-content padded">
        <form action="<?php echo base_url().'subcategorys';?>" name="mainForm" id="mainForm" method="POST" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-md-4">หมวดหมู่หลัก</label>
            <div class="col-md-5">
              <select class="form-control" name="ddmaincategory" id="ddmaincategory">
                <option value="0">เลือกหมวดหมู่หลัก</option>
                <?php foreach ($mainCategorys as $key => $mcvalue):?>
                  <option value="<?php echo $mcvalue->id;?>" <?php echo ($error_val['val_ddmaincategory']==$mcvalue->id)?'selected="selected"':'';?>><?php echo $mcvalue->name;?></option>
                <?php endforeach;?>
              </select>
              
            </div>
            <div class="col-md-3">
              
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4">ชื่อหมวดหมู่ย่อย</label>
            <div class="col-md-5">
              <input autocomplete="off" name="txtsearchCate" id="txtsearchCate" class="form-control states typeahead tt-query" dir="auto" placeholder="กรอกชื่อหมวดหมู่ย่อย"spellcheck="false" type="text" value="<?php echo ($this->input->post('txtsearchCate'))?$this->input->post('txtsearchCate'):'';?>">
              
            </div>
            <div class="col-md-3">
              <button type="submit" class="btn btn-warning">ค้นหา</button>
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
                    <th class="hidden-xs">หมวดหมู่หลัก</th>
                    <th>ชื่อหมวดหมู่ย่อย(ไทย)</th>
                    <th>ชื่อหมวดหมู่ย่อย(อังกฤษ)</th>
                    <th>ชื่อหมวดหมู่ย่อย(จีน)</th>
                    <th class="hidden-xs">สถานะ</th>
                    <th class="hidden-xs">จัดการ</th>
                  </thead>
                  <tbody>
                    <?php foreach($allCategorys as $key => $item):?>
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
                      <td><?php echo $item->maincate;?></td>
                      <td>
                        <?php echo $item->name;?>
                      </td>
                      <td>
                        <?php echo $item->name_en;?>
                      </td>
                      <td class="hidden-xs" style="padding-left:40px;">
                        <?php echo $item->name_cn;?>
                      </td>
                      <td class="hidden-xs">
                          <?php if($item->status==1):?><span class="label label-success">ใช้งาน</span><?php else:?>
                          <span class="label label-warning">ไม่ใช้งาน</span>
                          <?php endif;?>
                      </td>
                        <td>
                            
                            <a href="<?php echo base_url().'subcategorys/edit/'.$item->id;?>"> แก้ไข</a>/<a href="#" onclick="delCate(<?php echo $item->id;?>)">ลบ</a>
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
function delCate(cate_id){
    if(confirm('คุณต้องการลบใช่หรือไม่ ?')==true){
            var url = '<?php echo base_url();?>'+'subcategorys/delete';
            $.post(url,{cate_id:cate_id},function(result){
                if (result==1) {
                    alert('ทำการลบข้อมูลเรียบร้อยแล้ว');
                    location.reload();
                }else{
                    alert('กรุณาติดต่อ webmaster');
                }
            });
    }
}
$(document).ready(function() {
    $('#txtsearchCate').focus();
    $("#txtsearchCate").typeahead({
        remote:{
          url: '<?php echo base_url();?>subcategorys/get_AutocompleteCate?keyword=%QUERY'
        }
        
      });

    

});
</script>