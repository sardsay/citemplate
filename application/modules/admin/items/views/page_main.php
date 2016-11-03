<div class="container-fluid main-content">
        <div class="page-title">
          <h1>
            <?php echo $Header_title;?><a href="<?php echo base_url();?>items/add"><button class="btn btn-lg btn-info">เพิ่มสถานที่</button></a>
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
        <i class="fa fa-comment"></i>ค้นหาสถานที่
      </div>
      <div class="widget-content padded">
        <form action="<?php echo base_url().'items';?>" name="mainForm" id="mainForm" method="GET" class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-4">ชื่อสถานที่ :</label>
            <div class="col-md-5">
              <input autocomplete="off" name="txtsearch" id="txtsearch" class="form-control states typeahead tt-query" dir="auto" placeholder="กรอกชื่อสถานที่ " spellcheck="false" type="text" value="<?php echo ($this->input->get('txtsearch'))?$this->input->get('txtsearch'):'';?>">
            </div>
            <div class="col-md-3"></div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4">หมวดหมู่สถานที่</label>
            <div class="col-md-5">
              <select class="form-control" name="ddcategory" id="ddcategory">
              <option value="0">ทั้งหมด</option>
                <?php foreach ($ddcategory as $cvalue):?>
                    <option value="<?php echo $cvalue->id;?>" <?php echo ($this->input->get('ddcategory')==$cvalue->id)?'selected="selected"':'';?>><?php echo $cvalue->name;?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="col-md-3"></div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4">หมวดหมู่ย่อย</label>
            <div class="col-md-5">
              <select class="form-control" name="ddsubcategory" id="ddsubcategory">
              <option value="0">ทั้งหมด</option>
              <?php foreach ($ddsubcategory as $key => $value):?>
                <option value="<?php echo $value->id;?>" <?php echo ($value->id==$this->input->get('ddsubcategory'))?'selected="selected"':'';?>><?php echo $value->name;?></option>
              <?php endforeach;?>
              </select>
            </div>
            <div class="col-md-3"></div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4">แหล่งข้อมูล</label>
            <div class="col-md-5">
              <select class="form-control" name="ddsource" id="ddsource">
                <option value="0">กรุณาเลือก</option>
                <option value="1" <?php echo ($this->input->get('ddsource')==1)?'selected="selected"':'';?>>หลังบ้าน</option>
                <option value="2" <?php echo ($this->input->get('ddsource')==2)?'selected="selected"':'';?>>แอพลิเคชั่น</option>
                <!--<option value="3" <?php echo ($this->input->get('ddsource')==3)?'selected="selected"':'';?>>member</option>-->
              </select>
            </div>
            <div class="col-md-3"></div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-4">ภาษา</label>
            <div class="col-md-5">
              <select class="form-control" name="ddlang" id="ddlang">
                <option value="th" <?php echo ($this->input->get('ddlang')==''||$this->input->get('ddlang')=='th')?'selected="selected"':'';?>>ภาษาไทย</option>
                <option value="en" <?php echo ($this->input->get('ddlang')=='en')?'selected="selected"':'';?>>ภาษาอังกฤษ</option>
                <option value="cn" <?php echo ($this->input->get('ddlang')=='cn')?'selected="selected"':'';?>>ภาษาจีน</option>
              </select>
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
                    <th>ชื่อสถานที่</th>
                    <th>หมวดหมู่</th>
                    <!-- <th class="hidden-xs">ภาษา</th> -->
                    <th class="hidden-xs">วันที่สร้าง</th>
                    <th class="hidden-xs">วันที่แก้ไขล่าสุด</th>
                    <th class="hidden-xs">สถานะ</th>
                    <th class="hidden-xs">จัดการ</th>
                  </thead>
                  <tbody>
                    <?php foreach($allItems as $key => $item):?>
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
                      <td>
                        <?php echo $item->category_name;?>
                      </td>
                      <!-- <td class="hidden-xs">
                        <?php echo $item->lang;?>
                      </td> -->
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
                            
                            <a href="<?php echo base_url().'items/edit/'.(($item->parent_id==0)?$item->id:$item->parent_id).'/'.$item->lang;?>"> แก้ไข</a> / <a href="#" onclick="del(<?php echo ($item->parent_id==0)?$item->id:$item->parent_id;?>)">ลบ</a>
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
function del(item_id){
    if(confirm('คุณต้องการลบใช่หรือไม่ ?')==true){
            var url = '<?php echo base_url();?>'+'items/delete';
            $.post(url,{item_id:item_id},function(result){
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
          url: '<?php echo base_url();?>items/get_Autocomplete?keyword=%QUERY'
        }
        
      });

    $('#ddcategory').on('change',function(){
      var url = '<?php echo base_url();?>'+'items/get_subcaterys';
      $.post(url,{cateID:$(this).val()},function(result){
        $('#ddsubcategory').html(result);
      });
    });
    

});
</script>