<?php $__env->startSection('title'); ?>
  Sign in / Sign up
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $dataUrl=url('/');                
      $url=explode('index.php',$dataUrl); 
?>
<div class="site-content-wrap">
        <div class="signin-header">
    <div class="eqho-container">
      <h1>Sign in / Register</h1>
    </div>

  </div> <!-- signin-header -->
  <div class="signin-register-wrap">
    <div class="eqho-container">
      
 <?php echo $__env->make('errors.frontend_errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="signin-wrap">
        <h2>Sign in</h2>
       
        <p>Already have an account</p>
        <form action="<?php echo e(url('/auth/login')); ?>" method="post">
        
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="" placeholder="Enter your email">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="" placeholder="Enter your password">
          </div>
          <div class="sign-btn-wrap eqho-clear-fix forgot-pwd">
            <input class="btn-ctrl" name="" value="SIGN IN" type="submit">
            <a href="<?php echo e(url('/auth/reset-password')); ?>" title="Forgot your password">Forgot your <span>Password?</span></a>
          </div>
          <p>Or Sign in using social network</p>
          <div class="social-icon">
            <a href="<?php echo e(url('/dashboard/social-redirect')); ?>" class="fb" title="Sign in with facebook"><i class="fa fa-facebook" aria-hidden="true"></i> <span>Sign in with facebook</span></a>
            <a href="#" class="gplus" title="Sign in with Google"><i class="fa fa-google-plus" aria-hidden="true"></i> <span>Sign in with Google</span></a>
          </div>
        </form>
    </div><!-- signin-wrap -->



      <div class="register-wrap">
        <h2>Register</h2>
        <p>Create an account as</p>
         
        <form action="<?php echo e(url('/auth/register')); ?>" method="post">
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
          <div class="name-info">
            <div class="form-group">
              <label>First Name</label>
              <input type="text" name="first_name" placeholder="First name">
            </div>
            <div class="form-group">
              <label>Last Name</label>
              <input type="text" name="last_name" placeholder="Last name">
            </div>
          </div> <!-- name-info -->
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="" placeholder="Enter your email address" />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="" placeholder="Enter your password" />
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="" placeholder="Retype your password" />
          </div>          
          <div class="form-group">
            <label>Account as</label>
              <select name="usertype" class="">
                <option value="3">Customer</option>
                <option value="4">Translator</option>
              </select>
          </div>
          <div class="custom-checkbox term-condition">
             <input type="checkbox" name="terms" id="checkbox-1"/>
                  <label for="checkbox-1" class="checkbox-custom-label">I agree to Eqho's <span>Terms & Conditions</span> and <span>Privacy Policy</span></label>    
          </div>
          <div class="sign-btn-wrap register-btn">
            <input class="btn-ctrl" name="" value="REGISTER" type="submit">
          </div>
        </form>
        <span class="devider">or</span>
      </div><!-- register-wrap -->
    </div>
  </div> <!-- signin-register-wrap -->
    
<?php $__env->stopSection(); ?>  

<?php echo $__env->make('customer.front-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>