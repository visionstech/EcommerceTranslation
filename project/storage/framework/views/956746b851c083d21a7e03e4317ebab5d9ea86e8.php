<?php $__env->startSection('title'); ?>
	Configuration
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    
    <!-- top tiles -->
    <div class="content-header">
        <ol class="breadcrumb">
           <li><a href="<?php echo e(url('/publisher/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
           <li class="active">Configuration</li>
        </ol>
    </div>
    <!-- /top tiles -->

    <div class="row">
        <h3>Configuration</h3>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_content"><br />
            <form action="<?php echo e(url('/publisher/configuration')); ?>" method="post" class="form-horizontal form-label-left">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Contact Name <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" placeholder="Name" class="form-control col-md-7 col-xs-12" name="name" value="<?php echo e(Auth::user()->name); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Contact Email</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <span class="form-control col-md-7 col-xs-12" readonly><?php echo e(Auth::user()->email); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" placeholder="Password" class="form-control col-md-7 col-xs-12" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="password" placeholder="Repeat Password" class="form-control col-md-7 col-xs-12" name="password_confirmation">
                    </div>
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