<?php $__env->startSection('title'); ?>
  Translation Order
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $dataUrl=url('/');                
      $url=explode('index.php',$dataUrl); 
?>
<div class="dashboard-content-wrap">
    <?php echo $__env->make('customer.customerAside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="dashboard-content">
      <h1><?php echo e(ucfirst($type)); ?> </h1>
      <div class="upload-asset">
        <a href="#" class="btn-ctrl"><i class="fa fa-upload" aria-hidden="true"></i> Upload Upload a Translation Asset</a>
      </div>
      <div class="common-dashtext-wrap">
        <div class="common-table glossaries-table">
          <table>
            <thead>
              <tr>
                <th>S.No</th>
                <th>Upload Date</th>
                <th>Modified Date</th>
                <th>File Name</th>
                <th>Project History</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            <?php if(!empty($assets)): ?>
              <?php $s=1; ?>
              <?php foreach($assets as $asset): ?>
               <?php
                  $createdDate=strtotime($asset['created_at']);
                  $createdDate=date('M d Y',$createdDate);
                  $updatedDate=strtotime($asset['updated_at']);
                  $updatedDate=date('M d Y',$updatedDate);
               ?>
                <tr>
                  <td><?php echo e($s); ?></td>
                  <td><?php echo e($createdDate); ?></td>
                  <td><?php echo e($updatedDate); ?> </td>
                  <td><?php echo e($asset['file_name']); ?></td>
                  <td>#<?php echo e($asset['order_id']); ?> / files used on</td>
                  <td>
                    <a href="<?php echo e(url('/customer/single-asset/'.$type.'/'.encrypt($asset['id']))); ?>" title="view"><i class="fa fa-eye" aria-hidden="true"></i> View </a>
                    <a href="#" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i> Delete </a>
                  </td>
                </tr>
                <?php $s++; ?>
              <?php endforeach; ?>

            <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div> <!-- common-dashtext-wrap -->
      <?php if(!empty($assets)): ?>
        <?php echo e($assets->links()); ?>

      <?php endif; ?>
    </div> <!-- dashboard-content -->


  </div><!-- dashboard-content-wrap -->
    </div> <!-- dashboard-content -->


<?php $__env->stopSection(); ?>

  
<?php echo $__env->make('customer.front-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>