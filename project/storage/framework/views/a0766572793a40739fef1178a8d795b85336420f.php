<?php $__env->startSection('title'); ?>
    <?php echo e(($userId)?'Edit':'Add'); ?> User
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>    
    <!-- top tiles -->
    <div class="content-header data-pub">
        <ol class="breadcrumb">
           <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
           <li><a href="<?php echo e(url('/user')); ?>">User Overview</a></li>
           <li class="active"><?php echo e(($userId)?'Edit':'Add'); ?> User</li>
        </ol>
    </div>
    <!-- /top tiles -->

    <div class="row publisher">
        <h3><?php echo e(($userId)?'Edit':'Add'); ?> User</h3>
        <div class="col-md-12 col-sm-12 col-xs-12 all-form publisher-padding">
            <div class="x_panel">
            <div class="x_content"><br />

            <form action="<?php echo e(url('/user/add-user')); ?>" method="post" class="form-horizontal form-label-left">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="userId" value="<?php echo e($userId); ?>">
                <input type="hidden" name="method" value="<?php echo e(($userId)?'update':'create'); ?>">
                <?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Domain<span class="required">*</span></label>

                    <?php $website = (old('website')) ? old('website') : ((!empty($publisherDetail)) ? $publisherDetail[0]['website'] : '');  ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" placeholder="Domain" class="form-control col-md-7 col-xs-12" name="website" value="<?php echo e($website); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Contact Name <span class="required">*</span></label>
                    <?php $name = (old('name')) ? old('name') : ((!empty($userDetail)) ? $userDetail[0]['name'] : '');  
                    ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" placeholder="Name" class="form-control col-md-7 col-xs-12" name="name" value="<?php echo e($name); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Contact Email<span class="required">*</span></label>
                    <?php $email = (old('email')) ? old('email') : ((!empty($userDetail)) ? $userDetail[0]['email'] : '');  
                    ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" placeholder="Email" class="form-control col-md-7 col-xs-12" name="email" value="<?php echo e($email); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="role" class="control-label col-md-3 col-sm-3 col-xs-12">User Role<span class="required">*</span></label>
                    <?php
                    $Role=((old('role')))?old('role'):((!empty($userDetail))?$userDetail[0]['role']:'');
                    ?>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="select-wrap">
                            <select name="role" class="form-control">
                                <option value="">Select role</option>
                                <?php foreach($roles as $role): ?>
                                    <option value="<?php echo e($role->id); ?>" <?php echo ($Role == ($role->id))? "selected":''; ?> > <?php echo e($role->role); ?> </option>
                                <?php endforeach; ?>
                                
                            </select>
                        <span><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="role" class="control-label col-md-3 col-sm-3 col-xs-12">Which products would you like to subscribe to? <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12 custom-check">
            
                        <?php foreach($products as $key=>$product): ?>
                        <?php
                            $productOld=array(old('products.0'),old('products.1'),old('products.2'),old('products.3'));
                            $check_product = (((!empty($publisherDetail))&& $publisherDetail[0][$product['name']] == 1) ? 'checked="checked"' : ((in_array(($key+1), $productOld))? 'checked="checked"':'')); 
                        ?>
                            <input type="checkbox" id="<?php echo e($key); ?>" <?php echo e($check_product); ?> name="products[]"  value="<?php echo e($product->id); ?>">
                            <?php 
                                $product_name_array = explode('_', $product->name);
                                $product_name_array = array_map(function($word) { return ucfirst($word); }, $product_name_array);
                                $product_name = implode(' ', $product_name_array); ?>
                            <label for="<?php echo e($key); ?>"><?php echo e($product_name); ?></label><br>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Status">User Status</label>
                   <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php $Status = (old('status')) ? old('status') : ((!empty($userDetail)) ? $userDetail[0]['status'] : 'Live');  
                        ?>
                        <div class="select-wrap">
                            <select name="status" class="form-control col-md-7 col-xs-12">
                                <option value="" >Select status</option>
                                <option value="Live" <?php echo ($Status =='Live')? "selected":''; ?> >Live</option>
                                <option value="Suspended" <?php echo ($Status =='Suspended')? "selected":''; ?>>Suspended</option>
                                <option value="Paused" <?php echo ($Status =='Paused')? "selected":''; ?>>Paused</option>
                            </select>
                        <span><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>