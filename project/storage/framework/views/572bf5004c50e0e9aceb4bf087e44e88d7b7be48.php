<?php $__env->startSection('title'); ?>
	Login
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
           
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>EQHO</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h2 class="text-center">Login</h2>
    <?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <form action="<?php echo e(url('/auth/login')); ?>" method="post">
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="<?php echo e(url('/dashboard/redirect')); ?>" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->

    <!--<a href="#">I forgot my password</a><br>-->
    <a href="<?php echo e(url('/auth/register')); ?>" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
    
<?php $__env->stopSection(); ?>  

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>