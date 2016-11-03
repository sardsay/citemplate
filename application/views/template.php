<?php if ($login):?>
  <?php echo $login;?>
<?php else:?>
<!DOCTYPE html>
<html>
  <head>
    <title>
    <?php echo $logo;?>
      <?php echo $website_name;?>
    </title>
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>google.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>font-awesome.min.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>se7en-font.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>isotope.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>jquery.fancybox.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>fullcalendar.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>wizard.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>select2.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>morris.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>datatables.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>datepicker.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>timepicker.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>colorpicker.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>bootstrap-switch.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>bootstrap-editable.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>daterange-picker.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>typeahead.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>summernote.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>ladda-themeless.min.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>social-buttons.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>pygments.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>style.css" media="all" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>color/green.css" media="all" rel="alternate stylesheet" title="green-theme" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>color/orange.css" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>color/magenta.css" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>color/gray.css" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>jquery.fileupload-ui.css" media="screen" rel="stylesheet" type="text/css" /><link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>dropzone.css" media="screen" rel="stylesheet" type="text/css" />
      <link href="<?php echo base_url().URLPATH_ADMIN_CSS;?>font.css" media="all" rel="stylesheet" type="text/css" />
      <?php echo $_styles; ?>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery-1.10.2.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery-ui1.10.3.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>bootstrap.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>raphael.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>selectivizr-min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery.mousewheel.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery.vmap.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery.vmap.sampledata.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery.vmap.world.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery.bootstrap.wizard.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>fullcalendar.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>gcal.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery.dataTables.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>datatable-editable.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery.easy-pie-chart.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>excanvas.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery.isotope.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>isotope_extras.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>modernizr.custom.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery.fancybox.pack.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>select2.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>styleswitcher.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>wysiwyg.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>typeahead.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>summernote.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery.inputmask.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery.validate.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>bootstrap-fileupload.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>bootstrap-datepicker.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>bootstrap-timepicker.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>bootstrap-colorpicker.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>bootstrap-switch.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>spin.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>ladda.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>moment.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>mockjax.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>bootstrap-editable.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>xeditable-demo-mock.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>xeditable-demo.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>address.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>daterange-picker.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>date.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>morris.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>skycons.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>fitvids.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>jquery.sparkline.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url().URLPATH_ADMIN_JS;?>dropzone.js" type="text/javascript"></script>
      <?php echo $_scripts; ?>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <script type="text/javascript">
  chooseStyle('orange-theme', 30);
</script>

    
  </head>
  
  <body class="page-header-fixed bg-1">
    <div class="modal-shiftfix">
      <!-- Navigation -->
      
        <?php echo $menu_top;?>
      <!-- End Navigation -->
        <?php echo $fullpage;?>
      
    </div>

      
  </body>

</html>
<?php endif;?>