<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">


    <title>VICE Digital | <?php echo $__env->yieldContent('title'); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('/images/fav_icon.ico')); ?>"/>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('/images/fav_icon.ico')); ?>"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo e(asset('/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('/css/font-awesome.min.css')); ?>">
    <!-- NProgress -->
    <link rel="stylesheet" href="<?php echo e(asset('/css/nprogress.css')); ?>">
    <!-- bootstrap-progressbar -->
    <link rel="stylesheet" href="<?php echo e(asset('/css/bootstrap-progressbar-3.3.4.min.css')); ?>">
    
    <!-- Custom Theme Style -->
    <link rel="stylesheet" href="<?php echo e(asset('/css/custom.min.css')); ?>">
    <!-- Developer Style -->
    <link rel="stylesheet" href="<?php echo e(asset('/css/developer.css')); ?>">
    <!-- Custom Responsive Css Style 9 Dec 2016-->
    <link rel="stylesheet" href="<?php echo e(asset('/css/custom_responsive.css')); ?>">
    
    <?php echo $__env->yieldContent('css'); ?>
</head>
<?php   $current_url = Request::url(); 
        $login_url = url('/').'/auth/login'; 
        $register_url = url('/').'/auth/register'; 
        $register_url2 = url('/').'/register'; 
        $login_url2 = url('/'); 
?>
<body <?php if($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2) { ?> class="login" <?php } else { ?> class="nav-md" <?php } ?>>
    <?php echo $__env->make('header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>		
    
    <?php if(!($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2)) { ?>
	    <?php echo $__env->make('aside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
            <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo e(asset('/images/user.png')); ?>" alt=""><?php echo e(Auth::user()->name); ?>

                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo e(url('/auth/logout')); ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->        
        <!-- page content -->
        <div class="right_col" role="main">
            <?php if (Session::has('message')) { $message = Session::get('message'); ?>
                <label class=""> <?php echo $message; ?> </label>
            <?php Session::pull('message', 'User Registered Successfully!'); } ?>
        
    <?php } ?>
    <?php echo $__env->yieldContent('content'); ?>
    
    <?php if(!($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2)) { ?>
        </div>
    <?php } ?>
    
    <?php echo $__env->make('footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <!-- Scripts -->
    <!-- Jquery -->
    <script src="<?php echo e(asset('/js/jquery-1.11.2.min.js')); ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo e(asset('/js/bootstrap.min.js')); ?>"></script>
    <!-- Path JS -->
    <script src="<?php echo e(asset('/js/path.js')); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo e(asset('/js/fastclick.js')); ?>"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?php echo e(asset('/js/custom.min.js')); ?>"></script>
        <?php echo $__env->yieldContent('js'); ?>
</body>
</html>