<?php $__env->startSection('title'); ?>
    <?php echo e(($ourPromisesId)?'Edit':'Add'); ?> Our Promise
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>    
    <!-- top tiles -->
<section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li><a href="<?php echo e(url('/homepage-section/our-promises')); ?>">Manage Our Promises</a></li>
                    <li class="active"><?php echo e(($ourPromisesId)?'Edit':'Add'); ?> Our Promise</li>
                </ol>
            </section>
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo e(($ourPromisesId)?'Edit':'Add'); ?> Our Promise</h3>
                </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?php echo e(url('/homepage-section/add-our-promise')); ?>" method="post" class="form-horizontal form-label-left">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="ourPromisesId" value="<?php echo e($ourPromisesId); ?>">
                <input type="hidden" name="method" value="<?php echo e(($ourPromisesId)?'update':'create'); ?>">
                <?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <div class="box-body">
               <?php $title = (old('title')) ? old('title') : ((!empty($ourPromises)) ? $ourPromises->title : '');  
                    ?>
                <div class="form-group">
                    <label for="title">Title<span class="required">*</span></label>
                    <input type="text" placeholder="Title" class="form-control" name="title" value="<?php echo e($title); ?>">
                </div>
                <?php $description = (old('description')) ? old('description') : ((!empty($ourPromises)) ? $ourPromises->description : '');  
                    ?>
                <div class="form-group">
                    <label for="title">Description<span class="required">*</span></label>
                    <textarea placeholder="Description" class="form-control" name="description"><?php echo e($description); ?></textarea>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><?php echo e(($ourPromisesId)?'Update':'Save'); ?></button>
                </div>
            </form>
          </div>
         </div>
       </div>
    </section>    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>