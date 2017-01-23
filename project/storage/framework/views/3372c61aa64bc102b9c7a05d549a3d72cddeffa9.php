<?php $__env->startSection('title'); ?>
    <?php echo e(($priceId)?'Edit':'Add'); ?> Language
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?> 
<section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li><a href="<?php echo e(url('/language-price')); ?>">Manage Language Price</a></li>
                    <li class="active"><?php echo e(($priceId)?'Edit':'Add'); ?> Language Price</li>
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
                  <h3 class="box-title"><?php echo e(($priceId)?'Edit':'Add'); ?> Language Price</h3>
                </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="<?php echo e(url('/language-price/add-language-price')); ?>" method="post" class="form-horizontal form-label-left">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="priceId" value="<?php echo e($priceId); ?>">
                <input type="hidden" name="method" value="<?php echo e(($priceId)?'update':'create'); ?>">
                <?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="box-body">

                  <?php $source = (old('source')) ? old('source') : ((!empty($priceDetail)) ? $priceDetail[0]['source'] : '');  
                  ?>
                  <div class="form-group">
                     <label>Language From</label>
                      <select name="source" class="form-control">
                          <option value=''>Select Language From</option>
                          <?php foreach($languages as $language): ?>
                            <option value='<?php echo e($language->id); ?>' <?php echo ($source ==$language->id)? "selected":''; ?>><?php echo e($language->name); ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>
                  <?php $destination = (old('destination')) ? old('destination') : ((!empty($priceDetail)) ? $priceDetail[0]['destination'] : '');  
                  ?>
                  
                  <div class="form-group">
                     <label>Language To</label>
                     <select name="destination" class="form-control">
                          <option value=''>Select Language To</option>
                          <?php foreach($languages as $language): ?>
                            <option value='<?php echo e($language->id); ?>' <?php echo ($destination ==$language->id)? "selected":''; ?>><?php echo e($language->name); ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>

                  <div class="form-group">
                      <?php $price_per_word = (old('price_per_word')) ? old('price_per_word') : ((!empty($priceDetail)) ? $priceDetail[0]['price_per_word'] : '');  
                      ?>
                      <label for="language">Price Per Word<span class="required">*</span></label>
                      <input type="text" placeholder="Language" class="form-control" name="price_per_word" value="<?php echo e($price_per_word); ?>">
                  </div>
                  <div class="form-group">
                      <?php $Status = (old('status')) ? old('status') : ((!empty($priceDetail)) ? $priceDetail[0]['status'] : '');  
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