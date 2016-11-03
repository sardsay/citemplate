<?php
$error_form = $this->session->flashdata('error_form');
$error_val = $this->session->flashdata('error_val');
?>
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
          <!-- Conversation -->
          <div class="col-lg-12">
            <div class="widget-container scrollable chat chat-page">
              <div class="contact-list">
                <div class="heading">
                  ประวัติ<i class="fa fa-plus pull-right"></i>
                </div>
                <ul>
                  <li>
                    <a href="#"><i class = "fa fa-calendar pull-left"></i>Walter White<i class="fa fa-circle text-danger"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class = "fa fa-calendar pull-left"></i>Jessie Pinkman<i class="fa fa-circle text-success"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class = "fa fa-calendar pull-left"></i>Skyler White<i class="fa fa-circle text-warning"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class = "fa fa-calendar pull-left"></i>Flynn White<i class="fa fa-circle text-danger"></i></a>
                  </li>
                  
                </ul>
              </div>
              <div class="heading">
                <i class="fa fa-comments"></i>Chat with <a href="#">John Smith</a><i class="fa fa-cog pull-right"></i><i class="fa fa-smile-o pull-right"></i>
              </div>
              <div class="widget-content padded">
                <ul>
                  <li>
                    <img width="30" height="30" src="images/avatar-male.jpg" />
                    <div class="bubble">
                      <a class="user-name" href="">John Smith</a>
                      <p class="message">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
                      </p>
                      <p class="time">
                        <strong>Today </strong>3:53 pm
                      </p>
                    </div>
                  </li>
                  <li class="current-user">
                    <img width="30" height="30" src="images/avatar-female.jpg" />
                    <div class="bubble">
                      <a class="user-name" href="">Jane Smith</a>
                      <p class="message">
                        Donec odio. Quisque volutpat mattis eros.
                      </p>
                      <p class="time">
                        <strong>Today </strong>3:53 pm
                      </p>
                    </div>
                  </li>
                  <li>
                    <img width="30" height="30" src="images/avatar-male.jpg" />
                    <div class="bubble">
                      <a class="user-name" href="">John Smith</a>
                      <p class="message">
                        Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl.
                      </p>
                      <p class="time">
                        <strong>Today </strong>3:53 pm
                      </p>
                    </div>
                  </li>
                  <li>
                    <img width="30" height="30" src="images/avatar-male.jpg" />
                    <div class="bubble">
                      <a class="user-name" href="">John Smith</a>
                      <p class="message">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.
                      </p>
                      <p class="time">
                        <strong>Today </strong>3:53 pm
                      </p>
                    </div>
                  </li>
                  <li class="current-user">
                    <img width="30" height="30" src="images/avatar-female.jpg" />
                    <div class="bubble">
                      <a class="user-name" href="">Jane Smith</a>
                      <p class="message">
                        Morbi interdum mollis sapien. Sed ac risus. Phasellus lacinia, magna a ullamcorper laoreet, lectus arcu pulvinar risus, vitae facilisis libero dolor a purus. Sed vel lacus. Mauris nibh felis, adipiscing varius, adipiscing in, lacinia vel, tellus. Suspendisse ac urna. Etiam pellentesque mauris ut lectus. Nunc tellus ante, mattis eget, gravida vitae, ultricies ac, leo.
                      </p>
                      <p class="time">
                        <strong>Today </strong>3:53 pm
                      </p>
                    </div>
                  </li>
                  <li>
                    <img width="30" height="30" src="images/avatar-male.jpg" />
                    <div class="bubble">
                      <a class="user-name" href="">John Smith</a>
                      <p class="message">
                        Donec odio. Quisque volutpat mattis eros.
                      </p>
                      <p class="time">
                        <strong>Today </strong>3:53 pm
                      </p>
                    </div>
                  </li>
                  <li class="current-user">
                    <img width="30" height="30" src="images/avatar-female.jpg" />
                    <div class="bubble">
                      <a class="user-name" href="">Jane Smith</a>
                      <p class="message">
                        Suspendisse mauris. Fusce accumsan mollis eros. Pellentesque a diam sit amet mi ullamcorper vehicula. Integer adipiscing risus a sem. Nullam quis massa sit amet nibh viverra malesuada.
                      </p>
                      <p class="time">
                        <strong>Today </strong>3:53 pm
                      </p>
                    </div>
                  </li>
                  <li class="current-user">
                    <img width="30" height="30" src="images/avatar-female.jpg" />
                    <div class="bubble">
                      <a class="user-name" href="">Jane Smith</a>
                      <p class="message">
                        Ut convallis, sem sit amet interdum consectetuer, odio augue aliquam leo, nec dapibus tortor nibh sed augue. Integer eu magna sit amet metus fermentum posuere. Morbi sit amet nulla sed dolor elementum imperdiet. Quisque fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque adipiscing eros ut libero. Ut condimentum mi vel tellus. Suspendisse laoreet. 
                      </p>
                      <p class="time">
                        <strong>Today </strong>3:53 pm
                      </p>
                    </div>
                  </li>
                  <li>
                    <img width="30" height="30" src="images/avatar-male.jpg" />
                    <div class="bubble">
                      <a class="user-name" href="">John Smith</a>
                      <p class="message">
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.
                      </p>
                      <p class="time">
                        <strong>Today </strong>3:53 pm
                      </p>
                    </div>
                  </li>
                  <li class="current-user">
                    <img width="30" height="30" src="images/avatar-female.jpg" />
                    <div class="bubble">
                      <a class="user-name" href="">Jane Smith</a>
                      <p class="message">
                        Sem sit amet interdum consectetuer, odio augue aliquam leo, nec dapibus tortor nibh sed augue. Integer eu magna sit amet metus fermentum posuere. Morbi sit amet nulla sed dolor elementum imperdiet. Quisque fermentum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
                      </p>
                      <p class="time">
                        <strong>Today </strong>3:53 pm
                      </p>
                    </div>
                  </li>
                  <li>
                    <img width="30" height="30" src="images/avatar-male.jpg" />
                    <div class="bubble">
                      <a class="user-name" href="">John Smith</a>
                      <p class="message">
                        Consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.
                      </p>
                      <p class="time">
                        <strong>Today </strong>3:53 pm
                      </p>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="post-message">
                <input class="form-control" placeholder="Write your message here…" type="text"><input type="submit" value="Send">
              </div>
            </div>
          </div>
        </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  var gallery_length;
    
  $('#addImage').on('click',function(){
    gallery_length = $('input[name="gallery[]"]').length;
    console.log(gallery_length);
    var new_rows = '<label class="control-label col-md-2"></label>';
    var gallery_text = '<div class="col-md-2"><div class="fileupload fileupload-new" data-provides="fileupload"><div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;"><img src="<?php echo base_url().URLPATH_ADMIN_IMAGES;?>no-image.png"></div>';
    gallery_text += '<div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 200px; max-height: 150px"></div><div>';
    gallery_text += '<span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>';
    gallery_text += '<input type="file" name="gallery[]" id="gallery1"></span><a class="btn btn-default fileupload-exists" data-dismiss="fileupload" href="#">Remove</a>';
    gallery_text += '</div></div></div>';
    if (gallery_length <=9) {
        if (gallery_length >4) {
          if (gallery_length == 5) {
            $('#gallery-wraper2').append(new_rows);  
          };
          $('#gallery-wraper2').append(gallery_text);
        }else{
          $('#gallery-wraper').append(gallery_text);  
        }
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
});
</script>