<?php $__env->startSection('title'); ?>
	Login
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
           
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="form login_form">
                    <?php if (Session::has('message')) { $message = Session::get('message'); ?>
                    <label class=""> <?php echo $message; ?> </label>
                    <?php Session::pull('message', 'User Registered Successfully!'); 
                    } ?>
                    <section class="login_content">
                        <img src="<?php echo e(asset('/images/VICE_DIGITAL_BLACK-02.png')); ?>" />
                        <form action="<?php echo e(url('/auth/login')); ?>" method="post" class="form-signup">
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <h1>Login Form</h1>
                            <?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <div>
                                <input type="email" placeholder="Email" class="form-control" id="login_email" name="email" required>
                            </div>
                            <div>
                                <input type="password" placeholder="Password" class="form-control" id="login_password" name="password" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-default submit" >Log in</button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">
                                <p class="change_link">New to site?
                                    <a href="<?php echo e(url('/auth/register')); ?>" class="to_register" id="register_form"> Create Account </a>
                                </p>
                                <div class="clearfix"></div> <br />
                            </div>
                        </form>
                    </section>
                </div>

            </div>
        </div>
    
<?php $__env->stopSection(); ?>  

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>