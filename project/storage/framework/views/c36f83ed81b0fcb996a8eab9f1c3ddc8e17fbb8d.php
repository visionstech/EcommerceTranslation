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
      <h1>Projects</h1>
      <div class="common-dashtext-wrap ">
        <div class="common-table project-table">
          <table>
            <thead>
              <tr>
                <th>S.No</th>
                <th>Order Number</th>
                <th>Date</th>
                <th>Type</th>
                <th>File Name</th>
                <th>Words</th>
                <th>Translate From</th>
                <th>Translate To</th>
                <th>Status</th>
                <th>Price</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
            <?php $s=1; ?>
            <?php if(count($allProjects)): ?>
            <?php foreach($allProjects as $allProject): ?>
            <?php
            $dateFormat=strtotime($allProject['orderDate']);
            $FormatedDate=date('M d Y',$dateFormat);
            ?>
              <tr>
                <td><?php echo e($s); ?></td>
                <td><?php echo e($allProject['order_id']); ?></td>
                <td><?php echo e($FormatedDate); ?></td>
                <td>
                  <?php if(count($allProject['fileTypes'] )): ?>
                    <?php foreach($allProject['fileTypes'] as $fileType): ?>
                        <img src="<?php echo e($url[0].'/customer/img/'.$fileType); ?>" title="<?php echo e($fileType); ?>" alt="<?php echo e($fileType); ?>" />
                        <br/>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </td>
                <td><?php echo e(($allProject['files'])?$allProject['files']:''); ?></td>
                <td><?php echo e($allProject['totalWords']); ?></td>
                <td><?php echo e((isset($allProject['sourceLang']))?$allProject['sourceLang']:''); ?></td>
                <td><?php echo e((isset($allProject['destinationLanguage'] ))?$allProject['destinationLanguage']:''); ?></td>
                <td>Translating (1/4)</td>
                <td>$<?php echo e((isset($allProject['finalPrice'] ))?$allProject['finalPrice']:''); ?></td>
                <td><a href="<?php echo e(url('customer/view-order/view/'.encrypt($allProject['order_id']))); ?>" title="view"><i class="fa fa-eye" aria-hidden="true"></i> View </a><a href="<?php echo e(url('customer/view-order/review/'.encrypt($allProject['order_id']))); ?>" title="view"><i class="fa fa-eye" aria-hidden="true"></i> Review </a></td>
              </tr>
            <?php $s++; ?>
            <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div> <!-- common-dashtext-wrap -->

    </div> <!-- dashboard-content -->
    </div> <!-- dashboard-content -->


<?php $__env->stopSection(); ?>

  
<?php echo $__env->make('customer.front-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>