<?php $__env->startSection('title'); ?>
    <?php echo e(($roleId)?'Edit':'Add'); ?> Role
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?> 
<section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li><a href="<?php echo e(url('/role')); ?>">Manage User Roles</a></li>
                    <li class="active"><?php echo e(($roleId)?'Edit':'Add'); ?> Role</li>
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
                  <h3 class="box-title"><?php echo e(($roleId)?'Edit':'Add'); ?> Role</h3>
                </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?php echo e(url('/role/add-role')); ?>" method="post" class="form-horizontal form-label-left">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="roleId" value="<?php echo e($roleId); ?>">
                <input type="hidden" name="method" value="<?php echo e(($roleId)?'update':'create'); ?>">
                <?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
              <div class="box-body">
                <div class="form-group">
                    <?php $role = (old('role')) ? old('role') : ((!empty($roleDetail)) ? $roleDetail[0]['role'] : '');  
                    ?>
                    <label for="role">Role<span class="required">*</span></label>
                    <input type="text" placeholder="Role" class="form-control" name="role" value="<?php echo e($role); ?>">
                </div>
                <?php $Status = (old('status')) ? old('status') : ((!empty($roleDetail)) ? $roleDetail[0]['status'] : 'Active');  
                        ?>
                <div class="form-group">
                  <label>Select Status</label>
                   <select name="status" class="form-control">
                        <option value="Active" <?php echo ($Status =='Active')? "selected":''; ?> >Active</option>
                        <option value="Deleted" <?php echo ($Status =='Deleted')? "selected":''; ?>>Deleted</option>
                    </select>
                </div>
                
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
         </div>
        <!--/.col (left) -->
       </div>
      <!-- /.row -->
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>