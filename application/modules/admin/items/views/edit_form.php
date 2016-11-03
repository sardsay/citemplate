<?php
$error_form = $this->session->flashdata('error_form');
$error_val = $this->session->flashdata('error_val');
?>
<style>
    .form-control{width: 100%;}
    .wizard-nav {
        cursor: default !important;
        text-align: center;
        margin-bottom: 15px;
    }
    ul#menuLanguage{
            position: absolute;
            margin-left: 50%;
            left: -70px;
    }
    ul#shw_content{list-style-type: none;}
    ul#menuLanguageTemp{
            position: absolute;
            margin-left: 50%;
            left: -70px;
    }
    ul#shw_contentTemp{list-style-type: none;}
</style>
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
        <i class="fa fa-map-marker"></i>แก้ไขข้อมูลสถานที่
        <?php if($itemTempData):?>
        <i class="pull-right">
          <button class="btn btn-lg btn-success" id="btCurrentVersion">ปัจจุบัน</button>
          <button class="btn btn-danger-outline" id="btOldVersion">ข้อมูลสำรอง</button>
        </i>
        <?php endif;?>
      </div>
        
      <hr id="hr0">
        
      <div class="row">
          <div class="col-lg-12" style="padding-left: 10%;"> <span class="glyphicon glyphicon-list"></span> หมวดหมู่ </div>
      </div>
        
      <?php if(count($itemdata)>0){?>
      <div class="widget-content padded" id="current-data">
        <form action="#" class="form-horizontal" name="editform" method="POST" enctype="multipart/form-data">
        <?php 
        $item = array();
        $fields = array('id','parent_id','title','description','address','telephone','website','working_time','lang','latitude','longitude','image_thumb','source_type','status','category_id','subcategory_id','district_id','amphur_id','province_id','create_date','modify_date','user_create','user_modify');
        foreach ($itemdata as $key => $value) { 
          foreach ($fields as $val) {
            $item[$value->lang]->$val = $value->$val;
          }
          
        }
        ?>
        <?php 
        // echo '<pre>';
        // print_r($item);
        // echo '</pre>';
        // exit;
        ?>
          <div class="form-group <?php echo (isset($error_form['ddcategory']))?'has-error':'';?>">
            <label class="control-label col-md-3">หมวดหมู่หลัก:*</label>
            <div class="col-md-6">
            <select class="form-control" name="ddcategory" id="ddcategory">
              <option value="0">กรุณาเลือกหมวดหมู่หลัก</option>
                <?php foreach ($ddcategory as $cvalue):?>
                    <option <?php echo ($cvalue->id==$item['th']->category_id||$cvalue->id==$item['en']->category_id)?'selected':'';?> value="<?php echo $cvalue->id;?>" <?php echo (isset($error_val['val_ddcategory'])&& $error_val['val_ddcategory']==$cvalue->id)?'selected="selected"':'';?>><?php echo $cvalue->name;?></option>
                <?php endforeach;?>
              </select>
              
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['ddcategory']))?'has-error':'';?>">
            <label class="control-label col-md-3">หมวดหมู่ย่อย:</label>
            <div class="col-md-6">
            <select class="form-control" name="ddsubcategory" id="ddsubcategory">
              <option value="0">กรุณาเลือกหมวดหมู่ย่อย</option>
                <?php foreach ($ddsubcategory as $cvalue):?>
                    <option <?php echo ($cvalue->id==$item['th']->subcategory_id||$cvalue->id==$item['en']->subcategory_id)?'selected':'';?>  value="<?php echo $cvalue->id;?>" <?php echo (isset($error_val['val_ddcategory'])&& $error_val['val_ddcategory']==$cvalue->id)?'selected="selected"':'';?>><?php echo $cvalue->name;?></option>
                <?php endforeach;?>
              </select>
              <!-- <input class="form-control" name="ddcategory" id="ddcategory" placeholder="Name" type="text" value="<?php echo (isset($error_val['val_ddcategory']))?$error_val['val_ddcategory']:'';?>"> -->
            </div>
          </div>
          
          <hr id="hr0">
          
          <div class="row">
              <div class="col-lg-12" style="padding-left: 10%;"> <span class="glyphicon glyphicon-globe"></span> ภาษา (เลือกภาษาเพื่อเพิ่มภาษาต่างๆ)</div>
              <div class="col-lg-12" style="height: 50px;">
                        <ul id="menuLanguage" class="nav nav-pills">
                            <li <?php echo ($this->uri->segment(4)==''||$this->uri->segment(4)=='th')?'class="active"':'';?> >
                            <a data-toggle="tab" href="#tab1">TH</a>
                            </li>
                            <li <?php echo ($this->uri->segment(4)=='en')?'class="active"':'';?>>
                            <a data-toggle="tab" href="#tab2">EN</a>
                            </li>
                            <li <?php echo ($this->uri->segment(4)=='cn')?'class="active"':'';?>>
                            <a data-toggle="tab" href="#tab3">CN</a>
                            </li>
                        </ul>
              </div>
          </div>
          <ul id="shw_content">
              <li id="content1" <?php echo ($this->uri->segment(4)!=''&&$this->uri->segment(4)!='th')?'style="display:none;"':'';?>>
                  <div class="form-group <?php echo (isset($error_form['txttitle']))?'has-error':'';?>">
                    <label class="control-label col-md-3">ชื่อสถานที่:*</label>
                    <div class="col-md-6">
                      <input class="form-control" name="txttitle" id="txttitle" placeholder="กรอกชื่อสถานที่" type="text" value="<?php echo (isset($error_val['val_txttitle']))?$error_val['val_txttitle']:$item['th']->title; ?>">
                    </div>
                  </div>
                    <div class="form-group <?php echo (isset($error_form['txtareaaddress']))?'has-error':'';?>">
                    <label class="control-label col-md-3">ที่อยู่:</label>
                    <div class="col-md-6">
                        <textarea class="form-control" rows="3" name="txtareaaddress" placeholder="กรอกที่อยู่" id="txtareaaddress"><?php echo (isset($error_val['val_txtareaaddress']))?$error_val['val_txtareaaddress']:$item['th']->address;?></textarea>

                    </div>
                  </div>

                  <div class="form-group <?php echo (isset($error_form['txtareadescription']))?'has-error':'';?>">
                    <label class="control-label col-md-3">รายละเอียด:</label>
                    <div class="col-md-6">
                        <textarea class="form-control" rows="10"  name="txtareadescription" id="txtareadescription"><?php echo (isset($error_val['val_txtareadescription']))?$error_val['val_txtareadescription']:$item['th']->description;?></textarea>
                    </div>
                  </div>
              </li>
              <li id="content2" <?php echo ($this->uri->segment(4)!='en')?'style="display:none;"':'';?>>
                  <div class="form-group <?php echo (isset($error_form['txttitle']))?'has-error':'';?>">
                    <label class="control-label col-md-3">Place Name :*</label>
                    <div class="col-md-6">
                      <input class="form-control" name="txttitle2" id="txttitle2" placeholder="กรอกชื่อสถานที่ภาษาอังกฤษ" type="text" value="<?php echo (isset($error_val['val_txttitle2']))?$error_val['val_txttitle2']:$item['en']->title;?>">
                    </div>
                  </div>
                    <div class="form-group <?php echo (isset($error_form['txtareaaddress2']))?'has-error':'';?>">
                    <label class="control-label col-md-3">Address :</label>
                    <div class="col-md-6">
                        <textarea class="form-control" rows="3" placeholder="กรอกที่อยู่ภาษาอังกฤษ" name="txtareaaddress2" id="txtareaaddress2"><?php echo (isset($error_val['val_txtareaaddress2']))?$error_val['val_txtareaaddress2']:$item['en']->address;?></textarea>

                    </div>
                  </div>

                  <div class="form-group <?php echo (isset($error_form['txtareadescription2']))?'has-error':'';?>">
                    <label class="control-label col-md-3">Description :</label>
                    <div class="col-md-6">
                        <textarea class="form-control" rows="10"  name="txtareadescription2" id="txtareadescription2"><?php echo (isset($error_val['val_txtareadescription2']))?$error_val['val_txtareadescription2']:$item['en']->description;?></textarea>
                    </div>
                  </div>
              </li>
              <li id="content3" <?php echo ($this->uri->segment(4)!='cn')?'style="display:none;"':'';?>>
                  <div class="form-group <?php echo (isset($error_form['txttitle3']))?'has-error':'';?>">
                    <label class="control-label col-md-3">ชื่อสถานที่ (命名):*</label>
                    <div class="col-md-6">
                      <input class="form-control" name="txttitle3" id="txttitle3" placeholder="กรอกชื่อสถานที่ภาษาจีน" type="text" value="<?php echo (isset($error_val['val_txttitle3']))?$error_val['val_txttitle3']:$item['cn']->title;?>">
                    </div>
                  </div>
                    <div class="form-group <?php echo (isset($error_form['txtareaaddress3']))?'has-error':'';?>">
                    <label class="control-label col-md-3">ที่อยู่ (住址):</label>
                    <div class="col-md-6">
                        <textarea class="form-control" rows="3" name="txtareaaddress3" placeholder="กรอกที่อยุ่ภาษาจีน" id="txtareaaddress3"><?php echo (isset($error_val['val_txtareaaddress3']))?$error_val['val_txtareaaddress3']:$item['cn']->address;?></textarea>

                    </div>
                  </div>

                  <div class="form-group <?php echo (isset($error_form['txtareadescription3']))?'has-error':'';?>">
                    <label class="control-label col-md-3">รายละเอียด (詳情):</label>
                    <div class="col-md-6">
                        <textarea class="form-control" rows="10"  name="txtareadescription3" id="txtareadescription3"><?php echo (isset($error_val['val_txtareadescription3']))?$error_val['val_txtareadescription3']:$item['cn']->description;?></textarea>
                    </div>
                  </div>
              </li>
          </ul>
            
          <hr id="hr0">
            
          <div class="row">
              <div class="col-lg-12" style="padding-left: 10%;"> <span class="glyphicon glyphicon-edit"></span> อื่นๆ </div>
              <br>
          </div>

          <div class="form-group <?php echo (isset($error_form['ddamphur']))?'has-error':'';?>">
            <label class="control-label col-md-3">จังหวัด: </label>
            <div class="col-md-6">
              ชัยภูมิ (Chaiyaphum)
            </div>
          </div>
          
          <div class="form-group <?php echo (isset($error_form['ddamphur']))?'has-error':'';?>">
            <label class="control-label col-md-3">อำเภอ:*</label>
            <div class="col-md-6">
              <select class="form-control" name="ddamphur" id="ddamphur">
                <option value="0">กรุณาเลือกอำเภอ</option>
                <?php foreach ($ddamphur as $avalue):?>
                    <option value="<?php echo $avalue->id;?>" <?php echo ($error_val['val_ddamphur']==$avalue->id||$item['th']->amphur_id==$avalue->id||$item['en']->amphur_id==$avalue->id)?'selected="selected"':'';?>><?php echo $avalue->name;?></option>
                <?php endforeach;?>
              </select>
            
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['dddistrict']))?'has-error':'';?>">
            <label class="control-label col-md-3">ตำบล:*</label>
            <div class="col-md-6">
              <select class="form-control" name="dddistrict" id="dddistrict">
                <option value="0">กรุณาเลือกตำบล</option>  
                <?php foreach ($dddistrict as $dvalue):?>
                    <option value="<?php echo $dvalue->id;?>" <?php echo ($error_val['val_dddistrict']==$dvalue->id||$item['th']->district_id==$dvalue->id||$item['en']->district_id==$dvalue->id)?'selected="selected"':'';?>><?php echo $dvalue->name;?></option>
                <?php endforeach;?>              
              </select>
            </div>
          </div>

          <div class="form-group <?php echo (isset($error_form['txttelephone']))?'has-error':'';?>">
            <label class="control-label col-md-3">เบอร์โทรศัพท์:</label>
            <div class="col-md-6">
              <input class="form-control" name="txttelephone" id="txttelephone" placeholder="กรอกเบอร์โทรศัพท์" type="text" value="<?php echo (isset($error_val['val_txttelephone']))?$error_val['val_txttelephone']:$item['th']->telephone;?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtwebsite']))?'has-error':'';?>">
            <label class="control-label col-md-3">เว็บไซต์:</label>
            <div class="col-md-6">
              <input class="form-control" name="txtwebsite" id="txtwebsite" placeholder="กรอกเว็บไซต์, เฟสบุ๊ค หรืออีเมล์" type="text" value="<?php echo (isset($error_val['val_txtwebsite']))?$error_val['val_txtwebsite']:$item['th']->website;?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtworkingtime']))?'has-error':'';?>">
            <label class="control-label col-md-3">เวลาทำการ:</label>
            <div class="col-md-6">
              <input class="form-control" name="txtworkingtime" id="txtworkingtime" placeholder="กรอกเวลาทำการ" type="text" value="<?php echo (isset($error_val['val_txtworkingtime']))?$error_val['val_txtworkingtime']:$item['th']->working_time;?>">
            </div>
          </div>
          
          <div class="form-group <?php echo (isset($error_form['txtlatitude']))?'has-error':'';?>">
            <label class="control-label col-md-3">ละติจูด:*</label>
            <div class="col-md-6">
              <input class="form-control" name="txtlatitude" id="txtlatitude" placeholder="กรอกละติจูด" type="text" value="<?php echo (isset($error_val['val_txtlatitude']))?$error_val['val_txtlatitude']:$item['th']->latitude;?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtlongitude']))?'has-error':'';?>">
            <label class="control-label col-md-3">ลองจิจูด:*</label>
            <div class="col-md-6">
              <input class="form-control" name="txtlongitude" id="txtlongitude" placeholder="กรอกลองจิจูด" type="text" value="<?php echo (isset($error_val['val_txtlongitude']))?$error_val['val_txtlongitude']:$item['th']->longitude;?>">
            </div>
          </div>
          

          <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
            <label class="control-label col-md-3">Thumb image</label>
            <div class="col-md-4">
            <label> * ขนาดรูปขั้นต่ำ 600 x 400 px</label>
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                  
                  <img src="<?php echo base_url().URLPATH_UPLOAD_ITEMIMAGES.($item['th']->id%10).'/'.$item['th']->id.'/'.$item['th']->image_thumb;?>">
                </div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                <div>
                  <span class="btn btn-default btn-file"><span class="fileupload-new">เลือกรูปภาพ</span><span class="fileupload-exists">เปลี่ยนรูปภาพ</span><input type="file" name="thumb_image" id="thumb_image"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">ลบรูปภาพ</a>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
            <label class="control-label col-md-3"><button class="btn btn-info" id="addImage" type="button"><i class="fa fa-cloud-download"></i>เพิ่มรูปภาพแกลอรี่</button> </label>
            <div class="col-md-7">
              <div class="row" id="addgallery">
                  <?php foreach ($gallery1 as $key => $value):?>
                    <div class="col-md-4" id="gall<?php echo $value->id;?>">
                      
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                          <img src="<?php echo base_url().URLPATH_UPLOAD_ITEMIMAGES.($item['th']->id%10).'/'.$item['th']->id.'/gallerys/'.$value->image_name;?>" width="200" height="150">
                        </div>
                          <!-- <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div> -->
                        <div>
                            <button class="btn btn-danger" type="button" onclick="delGall(<?php echo $value->id;?>,<?php echo $item['th']->id;?>)"><i class="fa fa-trash-o"></i>ลบรูปภาพ</button>
                            <input type="hidden" name="gallery[]" id="gallery" value="">
                          <!-- <span class="btn btn-default btn-file"><span class="fileupload-new">เลือกรูปภาพ</span><span class="fileupload-exists">เปลี่ยนรูปภาพ</span> -->
                          <!-- <input type="file" name="gallery[]" id="gallery1"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">ลบรูปภาพ</a> -->
                        </div>
                      </div>
                    </div>
                  <?php endforeach;?>
            </div>
          </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
            <div id="gallery-wraper2"></div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3">สถานะ</label>
            <div class="col-md-6">
            <?php 
              if (!isset($error_val['val_rdstatus'])) {
                $error_val['val_rdstatus'] =1;  
              }
            ?>
              <label class="radio-inline"><input name="rdstatus" type="radio" value="1" <?php echo ($error_val['val_rdstatus']==1 || $item['th']==1)?'checked="checked"':'';?>><span>ใช้งาน</span></label>
              <label class="radio-inline"><input name="rdstatus" type="radio" value="0" <?php echo ($error_val['val_rdstatus']==0 || $item['th']==0)?'checked="checked"':'';?>><span>ไม่ใช้งาน</span></label>
              
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3"></label>
            <div class="col-md-6">
              <input type="hidden" name="version" value="current" id="version">
              <button class="btn btn-primary" type="submit" name="save" id="save" value="submit">บันทึก</button><button class="btn btn-default-outline" type="submit" name="save" id="cancel" value="cancel">ยกเลิก</button>
              
            </div>
          </div>

        </form>
      </div>
      <?php }else{ echo 'NOT FOUND !'; } ?>
    
<?php 

      foreach ($itemTempData as $key => $value) { 
          foreach ($fields as $val) {
            $itemTemp[$value->lang]->$val = $value->$val;
          }
          
      }unset($value);?>


    <div id="temp-data" style="display:none;">
        <div class="widget-content padded">
          <form action="#" class="form-horizontal" name="editform" method="POST" enctype="multipart/form-data">
          
            <div class="form-group <?php echo (isset($error_form['ddcategory']))?'has-error':'';?>">
            <label class="control-label col-md-3">หมวดหมู่หลัก:*</label>
            <div class="col-md-6">
            <select class="form-control" name="ddcategory" id="ddcategory" disabled="disabled">
              <option value="0">กรุณาเลือกหมวดหมู่หลัก</option>
                <?php foreach ($ddcategory as $cvalue):?>
                    <option <?php echo ($cvalue->id==$item['th']->category_id||$cvalue->id==$itemTemp['en']->category_id)?'selected':'';?> value="<?php echo $cvalue->id;?>" <?php echo (isset($error_val['val_ddcategory'])&& $error_val['val_ddcategory']==$cvalue->id)?'selected="selected"':'';?>><?php echo $cvalue->name;?></option>
                <?php endforeach;?>
              </select>
              
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['ddcategory']))?'has-error':'';?>">
            <label class="control-label col-md-3">หมวดหมู่ย่อย:</label>
            <div class="col-md-6">
            <select class="form-control" name="ddsubcategory" id="ddsubcategory" disabled="disabled">
              <option value="0">กรุณาเลือกหมวดหมู่ย่อย</option>
                <?php foreach ($ddsubcategory as $cvalue):?>
                    <option <?php echo ($cvalue->id==$itemTemp['th']->subcategory_id||$cvalue->id==$itemTemp['en']->subcategory_id)?'selected':'';?>  value="<?php echo $cvalue->id;?>" <?php echo (isset($error_val['val_ddcategory'])&& $error_val['val_ddcategory']==$cvalue->id)?'selected="selected"':'';?>><?php echo $cvalue->name;?></option>
                <?php endforeach;?>
              </select>
              
            </div>
          </div>
          
          <hr id="hr0">
            <div class="row">
              <div class="col-lg-12" style="padding-left: 10%;"> <span class="glyphicon glyphicon-globe"></span> ภาษา (เลือกภาษาเพื่อเพิ่มภาษาต่างๆ)</div>
              <div class="col-lg-12" style="height: 50px;">
                        <ul id="menuLanguageTemp" class="nav nav-pills">
                            <li <?php echo ($this->uri->segment(4)==''||$this->uri->segment(4)=='th')?'class="active"':'';?> >
                            <a data-toggle="tab" href="#tab1">TH</a>
                            </li>
                            <li <?php echo ($this->uri->segment(4)=='en')?'class="active"':'';?>>
                            <a data-toggle="tab" href="#tab2">EN</a>
                            </li>
                            <li <?php echo ($this->uri->segment(4)=='cn')?'class="active"':'';?>>
                            <a data-toggle="tab" href="#tab3">CN</a>
                            </li>
                        </ul>
              </div>
          </div>
          <ul id="shw_contentTemp">
              <li id="contentTemp1" <?php echo ($this->uri->segment(4)!=''&&$this->uri->segment(4)!='th')?'style="display:none;"':'';?>>
                  <div class="form-group <?php echo (isset($error_form['txttitle']))?'has-error':'';?>">
                    <label class="control-label col-md-3">ชื่อสถานที่:*</label>
                    <div class="col-md-6">
                      <input class="form-control" disabled="disabled" name="txttitle" id="txttitle" placeholder="กรอกชื่อสถานที่" type="text" value="<?php echo (isset($error_val['val_txttitle']))?$error_val['val_txttitle']:$itemTemp['th']->title; ?>">
                    </div>
                  </div>
                    <div class="form-group <?php echo (isset($error_form['txtareaaddress']))?'has-error':'';?>">
                    <label class="control-label col-md-3">ที่อยู่:</label>
                    <div class="col-md-6">
                        <textarea class="form-control" disabled="disabled" rows="3" name="txtareaaddress" placeholder="กรอกที่อยู่" id="txtareaaddress"><?php echo (isset($error_val['val_txtareaaddress']))?$error_val['val_txtareaaddress']:$itemTemp['th']->address;?></textarea>

                    </div>
                  </div>

                  <div class="form-group <?php echo (isset($error_form['txtareadescription']))?'has-error':'';?>">
                    <label class="control-label col-md-3">รายละเอียด:</label>
                    <div class="col-md-6">
                        <textarea class="form-control" disabled="disabled" rows="10"  name="txtareadescription" id="txtareadescription"><?php echo (isset($error_val['val_txtareadescription']))?$error_val['val_txtareadescription']:$itemTemp['th']->description;?></textarea>
                    </div>
                  </div>
              </li>
              <li id="contentTemp2" <?php echo ($this->uri->segment(4)!='en')?'style="display:none;"':'';?>>
                  <div class="form-group <?php echo (isset($error_form['txttitle']))?'has-error':'';?>">
                    <label class="control-label col-md-3">Place Name :*</label>
                    <div class="col-md-6">
                      <input class="form-control" disabled="disabled" name="txttitle2" id="txttitle2" placeholder="กรอกชื่อสถานที่ภาษาอังกฤษ" type="text" value="<?php echo (isset($error_val['val_txttitle2']))?$error_val['val_txttitle2']:$itemTemp['en']->title;?>">
                    </div>
                  </div>
                    <div class="form-group <?php echo (isset($error_form['txtareaaddress2']))?'has-error':'';?>">
                    <label class="control-label col-md-3">Address :</label>
                    <div class="col-md-6">
                        <textarea class="form-control" disabled="disabled" rows="3" placeholder="กรอกที่อยู่ภาษาอังกฤษ" name="txtareaaddress2" id="txtareaaddress2"><?php echo (isset($error_val['val_txtareaaddress2']))?$error_val['val_txtareaaddress2']:$itemTemp['en']->address;?></textarea>

                    </div>
                  </div>

                  <div class="form-group <?php echo (isset($error_form['txtareadescription2']))?'has-error':'';?>">
                    <label class="control-label col-md-3">Description :</label>
                    <div class="col-md-6">
                        <textarea class="form-control" disabled="disabled" rows="10"  name="txtareadescription2" id="txtareadescription2"><?php echo (isset($error_val['val_txtareadescription2']))?$error_val['val_txtareadescription2']:$itemTemp['en']->description;?></textarea>
                    </div>
                  </div>
              </li>
              <li id="contentTemp3" <?php echo ($this->uri->segment(4)!='cn')?'style="display:none;"':'';?>>
                  <div class="form-group <?php echo (isset($error_form['txttitle3']))?'has-error':'';?>">
                    <label class="control-label col-md-3">ชื่อสถานที่ (命名):*</label>
                    <div class="col-md-6">
                      <input class="form-control" disabled="disabled" name="txttitle3" id="txttitle3" placeholder="กรอกชื่อสถานที่ภาษาจีน" type="text" value="<?php echo (isset($error_val['val_txttitle3']))?$error_val['val_txttitle3']:$itemTemp['cn']->title;?>">
                    </div>
                  </div>
                    <div class="form-group <?php echo (isset($error_form['txtareaaddress3']))?'has-error':'';?>">
                    <label class="control-label col-md-3">ที่อยู่ (住址):</label>
                    <div class="col-md-6">
                        <textarea class="form-control" disabled="disabled" rows="3" name="txtareaaddress3" placeholder="กรอกที่อยุ่ภาษาจีน" id="txtareaaddress3"><?php echo (isset($error_val['val_txtareaaddress3']))?$error_val['val_txtareaaddress3']:$itemTemp['cn']->address;?></textarea>

                    </div>
                  </div>

                  <div class="form-group <?php echo (isset($error_form['txtareadescription3']))?'has-error':'';?>">
                    <label class="control-label col-md-3">รายละเอียด (詳情):</label>
                    <div class="col-md-6">
                        <textarea class="form-control" disabled="disabled" rows="10"  name="txtareadescription3" id="txtareadescription3"><?php echo (isset($error_val['val_txtareadescription3']))?$error_val['val_txtareadescription3']:$itemTemp['cn']->description;?></textarea>
                    </div>
                  </div>
              </li>
          </ul>
            
          <hr id="hr0">
            <div class="row">
              <div class="col-lg-12" style="padding-left: 10%;"> <span class="glyphicon glyphicon-edit"></span> อื่นๆ </div>
              <br>
          </div>

          <div class="form-group <?php echo (isset($error_form['ddamphur']))?'has-error':'';?>">
            <label class="control-label col-md-3">จังหวัด: </label>
            <div class="col-md-6">
              ชัยภูมิ (Chaiyaphum)
            </div>
          </div>
          
          <div class="form-group <?php echo (isset($error_form['ddamphur']))?'has-error':'';?>">
            <label class="control-label col-md-3">อำเภอ:*</label>
            <div class="col-md-6">
              <select class="form-control" name="ddamphur" id="ddamphur" disabled="disabled">
                <option value="0">กรุณาเลือกอำเภอ</option>
                <?php foreach ($ddamphur as $avalue):?>
                    <option value="<?php echo $avalue->id;?>" <?php echo ($error_val['val_ddamphur']==$avalue->id||$itemTemp['th']->amphur_id==$avalue->id||$itemTemp['en']->amphur_id==$avalue->id)?'selected="selected"':'';?>><?php echo $avalue->name;?></option>
                <?php endforeach;?>
              </select>
            
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['dddistrict']))?'has-error':'';?>">
            <label class="control-label col-md-3">ตำบล:*</label>
            <div class="col-md-6">
              <select class="form-control" name="dddistrict" id="dddistrict" disabled="disabled">
                <option value="0">กรุณาเลือกตำบล</option>  
                <?php foreach ($dddistrict as $dvalue):?>
                    <option value="<?php echo $dvalue->id;?>" <?php echo ($error_val['val_dddistrict']==$dvalue->id||$itemTemp['th']->district_id==$dvalue->id||$itemTemp['en']->district_id==$dvalue->id)?'selected="selected"':'';?>><?php echo $dvalue->name;?></option>
                <?php endforeach;?>              
              </select>
            </div>
          </div>

          <div class="form-group <?php echo (isset($error_form['txttelephone']))?'has-error':'';?>">
            <label class="control-label col-md-3">เบอร์โทรศัพท์:</label>
            <div class="col-md-6">
              <input class="form-control" name="txttelephone" disabled="disabled" id="txttelephone" placeholder="กรอกเบอร์โทรศัพท์" type="text" value="<?php echo (isset($error_val['val_txttelephone']))?$error_val['val_txttelephone']:$itemTemp['th']->telephone;?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtwebsite']))?'has-error':'';?>">
            <label class="control-label col-md-3">เว็บไซต์:</label>
            <div class="col-md-6">
              <input class="form-control" name="txtwebsite" disabled="disabled" id="txtwebsite" placeholder="กรอกเว็บไซต์, เฟสบุ๊ค หรืออีเมล์" type="text" value="<?php echo (isset($error_val['val_txtwebsite']))?$error_val['val_txtwebsite']:$itemTemp['th']->website;?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtworkingtime']))?'has-error':'';?>">
            <label class="control-label col-md-3">เวลาทำการ:</label>
            <div class="col-md-6">
              <input class="form-control" name="txtworkingtime" disabled="disabled" id="txtworkingtime" placeholder="กรอกเวลาทำการ" type="text" value="<?php echo (isset($error_val['val_txtworkingtime']))?$error_val['val_txtworkingtime']:$itemTemp['th']->working_time;?>">
            </div>
          </div>
          
          <div class="form-group <?php echo (isset($error_form['txtlatitude']))?'has-error':'';?>">
            <label class="control-label col-md-3">ละติจูด:*</label>
            <div class="col-md-6">
              <input class="form-control" name="txtlatitude" disabled="disabled" id="txtlatitude" placeholder="กรอกละติจูด" type="text" value="<?php echo (isset($error_val['val_txtlatitude']))?$error_val['val_txtlatitude']:$itemTemp['th']->latitude;?>">
            </div>
          </div>
          <div class="form-group <?php echo (isset($error_form['txtlongitude']))?'has-error':'';?>">
            <label class="control-label col-md-3">ลองจิจูด:*</label>
            <div class="col-md-6">
              <input class="form-control" name="txtlongitude" disabled="disabled" id="txtlongitude" placeholder="กรอกลองจิจูด" type="text" value="<?php echo (isset($error_val['val_txtlongitude']))?$error_val['val_txtlongitude']:$itemTemp['th']->longitude;?>">
            </div>
          </div>
          

          <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
            <label class="control-label col-md-3">Thumb image</label>
            <div class="col-md-4">
            <label> * ขนาดรูปขั้นต่ำ 600 x 400 px</label>
              <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                  <img src="<?php echo base_url().URLPATH_UPLOAD_ITEMIMAGES.($item['th']->id%10).'/'.$item['th']->id.'/'.$item['th']->image_thumb;?>">
                </div>
                <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                <div>
                  <!-- <span class="btn btn-default btn-file"><span class="fileupload-new">เลือกรูปภาพ</span><span class="fileupload-exists">เปลี่ยนรูปภาพ</span><input type="file" name="thumb_image" id="thumb_image"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">ลบรูปภาพ</a> -->
                </div>
              </div>
              
            </div>
          </div>

          <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
            <label class="control-label col-md-3"> </label>
            <div class="col-md-7">
              <div class="row" id="addgallery">
                  <?php foreach ($galleryTemp1 as $key => $value):?>
                    <div class="col-md-4">
                      <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                          <img src="<?php echo base_url().URLPATH_UPLOAD_ITEMIMAGES.($item['th']->id%10).'/'.$item['th']->id.'/gallerys/'.$value->image_name;?>" width="200" height="150">
                        </div>
                        <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div>
                        <div>
                        <!-- <button class="btn btn-danger" type="button" onclick="delGall(<?php echo $value->id;?>,<?php echo $item['th']->id;?>)"><i class="fa fa-trash-o"></i>ลบรูปภาพ</button> -->
                          <!-- <input type="file" name="gallery[]" id="gallery1"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">ลบรูปภาพ</a> -->
                        </div>
                      </div>
                    </div>
                  <?php endforeach;?>
            </div>
          </div>

          <div class="form-group <?php echo (isset($error_form['image_thumb']))?'has-error':'';?>">
            <div id="gallery-wraper2"></div>
          </div>

          <!-- <div class="form-group">
            <label class="control-label col-md-3">สถานะ</label>
            <div class="col-md-6">
            <?php 
              // if (!isset($error_val['val_rdstatus'])) {
              //   $error_val['val_rdstatus'] =1;  
              // }
            ?>
              <label class="radio-inline"><input name="rdstatus" disabled="disabled" type="radio" value="1" <?php //echo ($error_val['val_rdstatus']==1 || $itemTemp['th']==1)?'checked="checked"':'';?>><span>ใช้งาน</span></label>
              <label class="radio-inline"><input name="rdstatus" disabled="disabled" type="radio" value="0" <?php //echo ($error_val['val_rdstatus']==0 || $itemTemp['th']==0)?'checked="checked"':'';?>><span>ไม่ใช้งาน</span></label>
              
            </div>
          </div> -->

          <div class="form-group">
            <label class="control-label col-md-3"></label>
            <div class="col-md-6">
              <input type="hidden" name="version" value="old" id="version">
              <button class="btn btn-primary" type="submit" name="save" id="save" value="submit">ย้อนกลับ</button>
              
              
            </div>
          </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
</div>
<script type="text/javascript">
function delGall(id,eid){
    if (confirm('คุณต้องการลบไฟล์นี้ใช่หรือไม่')==true) {

        $.post( "<?php echo base_url();?>items/get_delfile",{fid:id,eid:eid}, function( data ) {
          console.log(data);
            if (data) {
                alert('ลบไฟล์สำร็จแล้ว');
                $('#gall'+id).remove();
                return false;
            }else{
                alert('ไม่สามารถลบไฟล์ได้');
                return false;
            }
            
        });
        
    }else{
        return false;
    }
}
$(document).ready(function() {
  var gallery_length;

  $('#menuLanguage li').on('click',function(){
      console.log($(this).index("#menuLanguage li"));
      var index = $(this).index("#menuLanguage li");
      $('#shw_content li').css('display','none');
      $('#shw_content #content'+(index+1)).css('display','block');
  });
  $('#menuLanguageTemp li').on('click',function(){
      console.log($(this).index("#menuLanguageTemp li"));
      var index = $(this).index("#menuLanguageTemp li");
      $('#shw_contentTemp li').css('display','none');
      $('#shw_contentTemp #contentTemp'+(index+1)).css('display','block');
  });
  var count_g = <?php echo count(gallery1);?>;
  $('#addImage').on('click',function(){
    count_g++;
    gallery_length = $('input[name="gallery[]"]').length;
    // console.log(gallery_length);
    var gallery_text = '<div class="col-md-4"><div class="fileupload fileupload-new" data-provides="fileupload"><div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo base_url().URLPATH_ADMIN_IMAGES;?>no-image.png"></div>';
    gallery_text += '<div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div><div>';
    gallery_text += '<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>';
    gallery_text += '<input type="file" name="gallery[]" id="gallery'+count_g+'"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>';
    gallery_text += '</div></div></div>';
    if (gallery_length <=9) {
      $('#addgallery').append(gallery_text);
      }else{
        alert('เพิ่มรู้ได้สูงสุด 10 รูป');
      }
    
    
  });
$('#ddcategory').on('change',function(){
  var url = '<?php echo base_url();?>'+'items/get_subcaterys';
  $.post(url,{cateID:$(this).val()},function(result){
    $('#ddsubcategory').html(result);
  });
});
$('#ddamphur').on('change',function(){
  var url = '<?php echo base_url();?>'+'items/get_amphurs';
  $.post(url,{amphurID:$(this).val()},function(result){
    $('#dddistrict').html(result);
  });
});

$('#btCurrentVersion').on('click',function(){
  $('#btCurrentVersion').removeClass('btn-danger-outline').addClass('btn-lg btn-success');
  $('#btOldVersion').addClass('btn-danger-outline').removeClass('btn-lg btn-success');
  $('#current-data').show();
  $('#temp-data').hide();
});
$('#btOldVersion').on('click',function(){
  $('#btOldVersion').removeClass('btn-danger-outline').addClass('btn-lg btn-success');
  $('#btCurrentVersion').addClass('btn-danger-outline').removeClass('btn-lg btn-success');
  $('#current-data').hide();
  $('#temp-data').show();
});

});


</script>