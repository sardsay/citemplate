<div class="container-fluid main-content">
        <!-- Statistics -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container stats-container">
              <div class="col-md-3">
                <div class="number">
                  <div class="fa fa-fw fa-bullhorn"></div>
                  
                  <!-- 86<small>%</small> -->
                </div>
                <div class="text">
                จัดการข่าว
                  <!-- Overall  -->
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="icon globe"></div>
                  <?php echo (isset($newsAll) && $newsAll !='')?$newsAll:'0';?>
                </div>
                <div class="text">
                  จำนวนข่าวทั้งหมด
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="fa fa-check"></div>
                  <?php echo (isset($newsYes) && $newsYes !='')?$newsYes:'0';?>
                </div>
                <div class="text">
                  จำนวนข่าวที่ใช้งานอยู่
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="fa fa-power-off"></div>
                  <?php echo (isset($newsNo) && $newsNo !='')?$newsNo:'0';?>
                </div>
                <div class="text">
                  จำนวนที่ไม่ได้ใช้งาน
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Statistics -->
        <!-- Statistics -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container stats-container">
              <div class="col-md-3">
                <div class="number">
                  <div class="fa fa-fw fa-sitemap"></div>
                  
                  <!-- 86<small>%</small> -->
                </div>
                <div class="text">
                จัดการหมวดหมู่
                  <!-- Overall  -->
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="icon globe"></div>
                  <?php echo (isset($cateAll) && $cateAll !='')?$cateAll:'0';?>
                </div>
                <div class="text">
                  จำนวนหมวดหมู่ทั้งหมด
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="fa fa-check"></div>
                  <?php echo (isset($cateYes) && $cateYes !='')?$cateYes:'0';?>
                </div>
                <div class="text">
                  จำนวนหมวดหมู่ที่ใช้งานอยู่
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="fa fa-power-off"></div>
                  <?php echo (isset($cateNo) && $cateNo !='')?$cateNo:'0';?>
                </div>
                <div class="text">
                  จำนวนที่ไม่ได้ใช้งาน
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Statistics -->
        <!-- Statistics -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container stats-container">
              <div class="col-md-3">
                <div class="number">
                  <div class="fa fa-fw fa-building-o"></div>
                  <!-- 86<small>%</small> -->
                </div>
                <div class="text">
                  จัดการสถานที่
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="icon globe"></div>
                  <?php echo (isset($itemAll) && $itemAll !='')?$itemAll:'0';?>
                </div>
                <div class="text">
                  จำนวนสถานที่ทั้งหมด
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="fa fa-check"></div>
                  <?php echo (isset($itemYes) && $itemYes !='')?$itemYes:'0';?>
                </div>
                <div class="text">
                  จำนวนสถานที่ที่ใช้งานอยู่
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="fa fa-power-off"></div>
                  <?php echo (isset($itemNo) && $itemNo !='')?$itemNo:'0';?>
                </div>
                <div class="text">
                  จำนวนที่ไม่ได้ใช้งาน
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Statistics -->
        <!-- Statistics -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container stats-container">
              <div class="col-md-3">
                <div class="number">
                  <div class="fa fa-fw fa-calendar"></div>
                  <!-- 86<small>%</small> -->
                </div>
                <div class="text">
                  จัดการกิจกรรม
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="icon globe"></div>
                  <?php echo (isset($eventAll) && $eventAll !='')?$eventAll:'0';?>
                </div>
                <div class="text">
                  จำนวนกิจกรรมทั้งหมด
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="fa fa-check"></div>
                  <?php echo (isset($eventYes) && $eventYes !='')?$eventYes:'0';?>
                </div>
                <div class="text">
                  จำนวนกิจกรรมที่ใช้งานอยู่
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="fa fa-power-off"></div>
                  <?php echo (isset($eventNo) && $eventNo !='')?$eventNo:'0';?>
                </div>
                <div class="text">
                  จำนวนที่ไม่ได้ใช้งาน
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Statistics -->
      </div>