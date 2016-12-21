<?php $__env->startSection('title'); ?>
	Registeration
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

  <div class="register-box">
  <div class="register-logo">
    <a href=""><b>EQHO</b></a>
  </div>

  <div class="register-box-body">
    <h2 class="text-center">Register</h2>
    <?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <form action="<?php echo e(url('/auth/register')); ?>" method="post">
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email" />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" />
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" />
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <h4 class="text-center">Create an account as</h4>
      <div class="form-group has-feedback">
        <select name="usertype" class="form-control">
            <option value="3">Customer</option>
            <option value="4">Translator</option>
        </select>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="terms" /> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign up</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>

    <a href="<?php echo e(url('/auth/login')); ?>" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
<?php $__env->stopSection(); ?>  


<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>