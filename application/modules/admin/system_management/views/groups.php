<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo $header_title;?><!-- <a href="<?php echo base_url();?>system_management/addgroup_form"><button type="button" class="btn btn-outline btn-primary btn-lg">New</button></a> --></h1>
    </div>
</div>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <?php $attributes = array('role' => 'form', 'id' => 'system_management','name'=>'system_management'); ?>
                        <?php echo form_open('groups_management',$attributes);?>
                        <div class="row">
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
                                <div class="col-lg-3"></div>
                                <div class="col-lg-3">
                                	<div class="text-head"><label>คำค้นหา</label></div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <input class="form-control" name="txtsearch" id="txtsearch" type="text" value="<?php echo ($this->input->post('txtsearch')==0 && $this->input->post('txtsearch')!='')?$this->input->post('txtsearch'):'';?>">
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <button type="submit" name="btnsearch" class="btn btn-warning">ค้นหา</button>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <a href="<?php echo base_url();?>groups_management">
                                        <input type="button" name="btncancel" class="btn btn-danger" value="ยกเลิก">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-3"></div>
                            </div>
                        <?php echo form_close();?>
                        <div class="panel-body">
                        <?php if (!empty($allgroups)) {?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ชื่อกลุ่ม</th>
                                            <th>การจัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($allgroups as $key => $item) { ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo ($key+1);?></td>
                                            <td class="center"><a href="<?php echo base_url();?>system_management/editgroup_form/<?php echo $item->id;?>"><?php echo $item->name;?></a></td>
                                            
                                            <td><a href="<?php echo base_url();?>system_management/editgroup_form/<?php echo $item->id;?>">แก้ไข</a> / <a href="#" onclick="checkDel(<?php echo $item->id;?>)">ลบ</a></td>
                                        </tr>
                                        <?php }?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <?php }else{ echo 'No List.';}?>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
<script type="text/javascript">
function checkDel(did){
    if(confirm('คุณต้องการลบใช่หรือไม่ ?')==true)
        {
            var url = '<?php echo base_url();?>'+'system_management/delGroup';
            $.post(url,{did:did},function(result){
                if (result==1) {
                    alert('ทำการลบข้อมูลเรียบร้อยแล้ว');location.reload();
                }else{
                    alert('กรุณาติดต่อ webmaster');
                }
            });
        }
}
$(document).ready(function() {
    $('#dataTables-example').dataTable({
        "dom": '<"top">rt<"bottom"pi><"clear">'
    });
});
</script>