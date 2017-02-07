<?php $__env->startSection('title'); ?>
    <?php echo e(($languageId)?'Edit':'Add'); ?> Language
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?> 
<section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li><a href="<?php echo e(url('/language-management')); ?>">Manage Languages</a></li>
                    <li class="active"><?php echo e(($languageId)?'Edit':'Add'); ?> Language</li>
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
                  <h3 class="box-title"><?php echo e(($languageId)?'Edit':'Add'); ?> Language</h3>
                </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?php echo e(url('/language-management/add-language')); ?>" method="post" class="form-horizontal form-label-left" enctype='multipart/form-data'>
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="languageId" value="<?php echo e($languageId); ?>">
                <input type="hidden" name="method" value="<?php echo e(($languageId)?'update':'create'); ?>">
                <?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="box-body">
                  <div class="form-group">
                      <?php $name = (old('name')) ? old('name') : ((!empty($languageDetail)) ? $languageDetail[0]['name'] : '');  
                      ?>
                      <label for="language">Name<span class="required">*</span></label>
                      <input type="text" placeholder="Language" class="form-control" name="name" value="<?php echo e($name); ?>">
                  </div>
                  <div class="form-group">
                      <?php $short = (old('short')) ? old('short') : ((!empty($languageDetail)) ? $languageDetail[0]['short'] : '');  
                      ?>
                      <label for="language">Short Name</label>
                      <input type="text" placeholder="Language" class="form-control" name="short" value="<?php echo e($short); ?>">
                  </div>
                  <?php $image = ((!empty($languageDetail)) ? $languageDetail[0]['image'] : ''); 
                    if($image){
                        $dataUrl=url('/');                
                        $url=explode('index.php',$dataUrl);
                        echo "<input type='hidden' name='image' value='".$languageDetail[0]['image']."'>";
                    } 
                ?>
                <div class="form-group">
                   <label for="image">Flag Image<span class="required">*</span></label>
                    <input type="file" placeholder="image" class="form-control" name="image">
                </div>
                <?php $image = ((!empty($languageDetail)) ? $languageDetail[0]['image'] : ''); 
                        if($image){
                            echo "<div class='form-group'><img src='".$dataUrl.'/uploads/'.$languageDetail[0]['image']."' alt='".$languageDetail[0]['image']."' width='30'></div>";
                        } 
                ?>
                    <?php $Status = (old('status')) ? old('status') : ((!empty($languageDetail)) ? $languageDetail[0]['status'] : 'Active');  
                    ?>
                  <div class="form-group">
                     <label>Select</label>
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