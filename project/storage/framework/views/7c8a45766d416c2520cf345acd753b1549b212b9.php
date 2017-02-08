<?php $__env->startSection('title'); ?>
	Error
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    
    <!-- top tiles -->
    <div class="content-header">
        <ol class="breadcrumb">
           <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
        </ol>
    </div>
    <!-- /top tiles -->

    <div class="row">
        <h3>Error</h3>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_content"><br />
                <h4><b><span style="color:red">ERROR:</span> <?php echo e($exception_message); ?></b></h4>
            </div>
        </div>
      </div>
    </div>

    
<?php $__env->stopSection(); ?>  


<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>