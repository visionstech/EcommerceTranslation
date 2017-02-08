<!DOCTYPE html>
<html>
<?php   
  $current_url = Request::url(); 
  $login_url = url('/').'/auth/login'; 
  $register_url = url('/').'/auth/register'; 
  $register_url2 = url('/').'/register'; 
  $login_url2 = url('/'); 
  $reset_password_url = url('/').'/auth/reset-password'; 
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Eqho</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo e(asset('/bootstrap/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('/css/AdminLTE.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('/css/backend_custom.css')); ?>">
  <?php if(!($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2 || (strpos($_SERVER['REQUEST_URI'],'reset-password') != false))) {
    $bodyClass='skin-blue sidebar-mini';
   ?>

          <link rel="stylesheet" href="<?php echo e(asset('/css/skins/_all-skins.min.css')); ?>">
          <!-- iCheck -->
          <link rel="stylesheet" href="<?php echo e(asset('/plugins/iCheck/flat/blue.css')); ?>">
          <!-- Morris chart -->
          <link rel="stylesheet" href="<?php echo e(asset('/plugins/morris/morris.css')); ?>">
          <!-- jvectormap -->
          <link rel="stylesheet" href="<?php echo e(asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css')); ?>">
          <!-- Date Picker -->
          <link rel="stylesheet" href="<?php echo e(asset('/plugins/datepicker/datepicker3.css')); ?>">
          <!-- Daterange picker -->
          <link rel="stylesheet" href="<?php echo e(asset('/plugins/daterangepicker/daterangepicker.css')); ?>">
          <!-- bootstrap wysihtml5 - text editor -->
          <link rel="stylesheet" href="<?php echo e(asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')); ?>">
            
  <?php }else{ $bodyClass='login-page';  ?>
          <!-- iCheck -->
          <link rel="stylesheet" href="<?php echo e(asset('/plugins/iCheck/square/blue.css')); ?>" />

  <?php } ?>

  <?php echo $__env->yieldContent('css'); ?>
</head>
<body class="hold-transition <?php echo $bodyClass; ?>">
<div class="wrapper">
    <?php echo $__env->make('backend.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>		
    
    <?php if(!($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2 || (strpos($_SERVER['REQUEST_URI'],'reset-password') != false))) { ?>
	    <?php echo $__env->make('backend.aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <?php if (Session::has('message')) { $message = Session::get('message'); ?>
                <label class=""> <?php echo $message; ?> </label>
            <?php Session::pull('message', 'User Registered Successfully!'); } ?>
        
    <?php } ?>
    <?php echo $__env->yieldContent('content'); ?>
    
    <?php if(!($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2 || (strpos($_SERVER['REQUEST_URI'],'reset-password') != false))) { ?>
        </div>
    <?php } ?>
    
    <?php echo $__env->make('backend.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <!-- Scripts -->
    <!-- Jquery -->

<!-- jQuery 2.2.3 -->
<?php 
if(!($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2 || (strpos($_SERVER['REQUEST_URI'],'reset-password') != false))) { ?>
    <script src="<?php echo e(asset('/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo e(asset('/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo e(asset('/plugins/morris/morris.min.js')); ?>"></script>
    <!-- Sparkline -->
    <script src="<?php echo e(asset('/plugins/sparkline/jquery.sparkline.min.js')); ?>"></script>
    <!-- jvectormap -->
    <script src="<?php echo e(asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo e(asset('/plugins/knob/jquery.knob.js')); ?>"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="<?php echo e(asset('/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
    <!-- datepicker -->
    <script src="<?php echo e(asset('/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo e(asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>    
    <!-- Slimscroll -->
    <script src="<?php echo e(asset('/plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo e(asset('/plugins/fastclick/fastclick.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('/js/app.min.js')); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo e(asset('/js/demo.js')); ?>"></script>
<?php } else { ?>

  <script src="<?php echo e(asset('/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo e(asset('/bootstrap/js/bootstrap.min.js')); ?>"></script>
  <!-- iCheck -->
  <script src="<?php echo e(asset('/plugins/iCheck/icheck.min.js')); ?>"></script>
 
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>

<?php } ?> 
<?php echo $__env->yieldContent('js'); ?>
</body>
</html>