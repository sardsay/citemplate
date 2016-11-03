<div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <!--<img width="34" height="34" src="<?php echo base_url().URLPATH_ADMIN_IMAGES;?>chaiyaphum.png" />--><?php echo ($this->session->userdata('user_id')!='')?$this->session->userdata('username'):'';?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <!-- <li><a href="#">
                    <i class="fa fa-user"></i>My Account</a>
                  </li> -->
                  <!-- <li><a href="#">
                    <i class="fa fa-gear"></i>การตั้งค่า</a>
                  </li> -->
                  <li><a href="<?php echo base_url().'home/logout';?>">
                    <i class="fa fa-sign-out"></i>ออกจากระบบ</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="logos" href="index.html">Template Logo</a>
          <!-- <form class="navbar-form form-inline col-lg-2 hidden-xs">
            <input class="form-control" placeholder="Search" type="text">
          </form> -->
        </div>
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
              <li>
                <a <?php echo (isset($main_active)&&$main_active=='dashboard')?'class="current"':'';?> href="<?php echo base_url().'dashboard';?>"><span aria-hidden="true" class="se7en-home"></span>Dashboard</a>
              </li>
              <li class="dropdown">
              <a data-toggle="dropdown" <?php echo ($main_active=='categorys' || $main_active=='subcategorys')?'class="current"':'';?> href="#">
                <span aria-hidden="true" class="fa fa-fw fa-sitemap"></span>จัดการหมวดหมู่<b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="<?php echo base_url().'categorys'?>">หมวดหมู่หลัก</a>
                  </li>
                  <li>
                    <a href="<?php echo base_url().'subcategorys'?>">หมวดหมู่ย่อย</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown" >
			  <a data-toggle="dropdown" <?php echo (isset($main_active)&&$main_active=='items')?'class="current"':'';?>>
                <span aria-hidden="true" class="fa fa-fw fa-building-o"></span>จัดการสถานที่<b class="caret"></b></a>
                 <ul class="dropdown-menu">
                  <li>
                    <a href="<?php echo base_url().'items'?>">จัดการสถานที่</a>
                  </li>
                  <li>
                    <a href="<?php echo base_url().'items_mobile'?>">จัดการสถานทที่จากแอพพลิเคชั่น</a>
                  </li>
                </ul>
              </li>
              <li><a <?php echo (isset($main_active)&&$main_active=='events')?'class="current"':'';?> href="<?php echo base_url().'events';?>">
                <span aria-hidden="true" class="fa fa-fw fa-calendar"></span>จัดการกิจกรรม</a>
              </li>
              <li><a <?php echo (isset($main_active)&&$main_active=='news')?'class="current"':'';?> href="<?php echo base_url().'news';?>">
                <span aria-hidden="true" class="fa fa-fw fa-bullhorn"></span>จัดการข่าว</a>
              </li>
              <li><a <?php echo (isset($main_active)&&$main_active=='ars')?'class="current"':'';?> href="<?php echo base_url().'ars';?>">
                <span aria-hidden="true" class="fa fa-fw fa-barcode"></span>AR</a>
              </li>

              <li><a  data-toggle="dropdown" <?php echo (isset($main_active)&&$main_active=='users')?'class="current"':'';?> href="#">
                <span aria-hidden="true" class="fa fa-fw fa-users"></span>จัดการผู้ใช้<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <a href="<?php echo base_url().'users';?>">จัดการผู้ใช้</a>
                  </li>
                  <!--<li>
                    <a href="<?php echo base_url().'menu'?>">จัดการเมนู</a>
                  </li>-->
                </ul>
              </li>
              
            </ul>
          </div>
        </div>
      </div>