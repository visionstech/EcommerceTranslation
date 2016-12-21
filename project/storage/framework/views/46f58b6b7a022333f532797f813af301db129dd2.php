<?php $__env->startSection('title'); ?>
	Registeration
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="register_wrapper">
            <div id="register" class="form">
                <?php if (Session::has('message')) { $message = Session::get('message'); ?>
                <label class=""> <?php echo $message; ?> </label>
                <?php Session::pull('message', 'User Registered Successfully!'); 
                } ?>
                <section class="login_content">
                    <img src="<?php echo e(asset('/images/VICE_DIGITAL_BLACK-02.png')); ?>" />
                    <form action="<?php echo e(url('/auth/register')); ?>" method="post" class="form-signup">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <h1>Registeration</h1>
                        <?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <div>
                            <label class="register_label text-left col-md-3 col-sm-3 col-xs-12" for="website">Domain <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" placeholder="Domain" class="form-control" name="website" value="<?php echo e(old('website')); ?>" maxlength="32">
                            </div>
                        </div>
                        <div>
                            <label class="register_label text-left col-md-3 col-sm-3 col-xs-12" for="name">Contact Name <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" placeholder="Name" class="form-control" name="name" value="<?php echo e(old('name')); ?>" maxlength="32">
                            </div>
                        </div>
                        <div>
                            <label class="register_label text-left col-md-3 col-sm-3 col-xs-12" for="email">Contact Email <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="email" placeholder="Email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" maxlength="100">
                            </div>
                        </div>
                        <div>
                            <label class="register_label text-left col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" placeholder="Password" class="form-control" name="password" maxlength="30" value="<?php echo e(old('password')); ?>">
                            </div>
                        </div>
                        <div>
                            <label class="register_label text-left col-md-3 col-sm-3 col-xs-12" for="password_confirmation">Repeat Password <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" placeholder="Repeat Password" class="form-control" value="<?php echo e(old('password_confirmation')); ?>" name="password_confirmation" maxlength="30">
                            </div>
                        </div>
                        <div class="text-left col-md-12 col-sm-12 col-xs-12">

                            <label>Which products would you like to subscribe to? <span class="required">*</span></label><br>
                            <?php foreach($products as $key=>$product): ?>

                             <?php 
                                $productOld=array(old('products.0'),old('products.1'),old('products.2'),old('products.3'));
                                $check_product = ((old('products')) ? ((in_array(($key+1), $productOld))? 'checked="checked"':''):''); 
                                
                                ?>
                                <div class="custom-check">
                                    <input type="checkbox" <?php echo e($check_product); ?> name="products[]" value="<?php echo e($product->id); ?>" id="<?php echo e($key); ?>">
                                    <?php 
                                        $product_name_array = explode('_', $product->name);
                                        $product_name_array = array_map(function($word) { return ucfirst($word); }, $product_name_array);
                                        $product_name = implode(' ', $product_name_array); ?>
                                    <label for="<?php echo e($key); ?>"><?php echo e($product_name); ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit" >Submit</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                          <p class="change_link">Already a member ?
                            <a href="<?php echo e(url('/auth/login')); ?>" class="to_register"> Log in </a>
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