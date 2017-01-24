<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>EQHO Translation</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;" http-equiv="X-UA-Compatible" />
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,700" rel="stylesheet"> 
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/customer/css/slick.css')); ?>"/>
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/customer/css/slick-theme.css')); ?>"/>
  <link rel="stylesheet" href="<?php echo e(asset('/customer/css/jquery-ui.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/customer/css/font-awesome.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/customer/css/style.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/customer/css/responsive.css')); ?>">

</head>
<body>
<?php  $current_url = Request::url();
       $homePageUrl=url('/');
?>
<div class="main-wrapper eqho-clear-fix">
  <?php echo $__env->make('customer.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php if($current_url==$homePageUrl): ?>
    <?php echo $__env->make('customer.banner', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php endif; ?>
  <div class="site-content-wrap">
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('customer.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div><!-- site-content-wrap -->
</div> <!-- main-wrapper -->

<?php if($current_url==$homePageUrl): ?>
  <?php echo $__env->make('customer.homepageJs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?>
  <?php echo $__env->make('customer.innerPageJs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

</body>
</html>