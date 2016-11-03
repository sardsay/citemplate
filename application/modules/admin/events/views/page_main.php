<div class="container-fluid main-content">
        <div class="page-title">
          <h1>
            <?php echo $Header_title;?><a href="<?php echo base_url();?>events/add"><button class="btn btn-lg btn-info">เพิ่มกิจกรรม</button></a>
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
        <i class="fa fa-comment"></i>ค้นหากิจกรรม
      </div>
      <div class="widget-content padded">
        <form action="<?php echo base_url().'events';?>" name="mainForm" id="mainForm" method="GET" class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-md-3">ชื่อกิจกรรม :</label>
            <div class="col-md-5">
              <input autocomplete="off" name="txtsearch" id="txtsearch" class="form-control states typeahead tt-query" dir="auto" placeholder="กรอกชื่อกิจกรรม" spellcheck="false" type="text" value="<?php echo ($this->input->get('txtsearch'))?$this->input->get('txtsearch'):'';?>">
            </div>
            <div class="col-md-3"></div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3">ภาษา</label>
            <div class="col-md-5">
              <select class="form-control" name="ddlang" id="ddlang">
                <option value="0">กรุณาเลือกภาษา</option>
                <option value="th" <?php echo ($this->input->get('ddlang')=='th')?'selected="selected"':'';?>>ภาษาไทย</option>
                <option value="en" <?php echo ($this->input->get('ddlang')=='en')?'selected="selected"':'';?>>ภาษาอังกฤษ</option>
                <option value="cn" <?php echo ($this->input->get('ddlang')=='cn')?'selected="selected"':'';?>>ภาษาจีน</option>
              </select>
            </div>
            <div class="col-md-3"></div>
          </div>
          <div class="form-group">
              <label class="control-label col-md-3">เริ่มวันที่:</label>
              <div class="col-sm-3">
                  <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                  <input class="form-control" name="txtstartdate" id="txtstartdate" type="text" placeholder="เลือกวันที่เริ่ม" value="<?php echo ($this->input->get('txtstartdate'))?$this->input->get('txtstartdate'):'';?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
                </div>
                  
              </div>
                <label class="control-label col-md-1">สิ้นสุดวันที่:</label>
                <div class="col-sm-3">
                    <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd-mm-yyyy">
                      <input class="form-control"  name="txtenddate" id="txtenddate" type="text" placeholder="เลือกวันสิ้นสุด" value="<?php echo ($this->input->get('txtenddate'))?$this->input->get('txtenddate'):'';?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span></input>
                    </div>
                  
                </div>
            
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
                    <th>ชื่อกิจกรรม</th>
                    <th>ช่วงเวลา</th>
                    <th class="hidden-xs">ภาษา</th>
                    <th class="hidden-xs">วันที่สร้าง</th>
                    <th class="hidden-xs">วันที่แก้ไขล่าสุด</th>
                    <th class="hidden-xs">สถานะ</th>
                    <th class="hidden-xs">จัดการ</th>
                  </thead>
                  <tbody>
                    <?php foreach($allEvents as $key => $item):?>
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
                        <?php echo $item->event_name;?>
                      </td>
                      <td>
                        <?php echo date('d-m-Y',strtotime($item->starttime)).' ถึง '.date('d-m-Y',strtotime($item->endtime));?>
                      </td>
                      <td class="hidden-xs">
                        <?php echo $item->lang;?>
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
                            
                            <a href="<?php echo base_url().'events/edit/'.$item->id;?>"> แก้ไข</a>/<a href="#" onclick="del(<?php echo $item->id;?>)">ลบ</a>
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
function del(event_id){
    if(confirm('คุณต้องการลบใช่หรือไม่ ?')==true){
            var url = '<?php echo base_url();?>'+'events/delete';
            $.post(url,{event_id:event_id},function(result){
                if (result==1) {
                    alert('ทำการลบข้อมูลเรียบร้อยแล้ว');location.reload();
                }else{
                    alert('กรุณาติดต่อ webmaster');
                }
            });
    }
}
$(document).ready(function() {
  $('.datepicker').datepicker();
    $('#txtsearch').focus();
    $("#txtsearch").typeahead({
        remote:{
          url: '<?php echo base_url();?>events/get_Autocomplete?keyword=%QUERY'
        }
        
      });

    

});
</script>