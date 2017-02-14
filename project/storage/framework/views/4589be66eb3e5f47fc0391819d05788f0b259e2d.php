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
      <h1>Dashboard</h1>
      <article class="on-demand">
        <h2>On-demand.eqho.com news</h2>
        <h5>Important Notification: Tuesday july 19th, 10:00am-12:00 noon jul 11 2016</h5>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently.</p>
      </article>
      <div class="common-dashtext-wrap pending-wrap">
        <h2>Pending</h2>
        <div class="common-table pending-table">
          <table>
            <thead>
              <tr>
                <th>S.No</th>
                <th>Order Number</th>
                <th>Date</th>
                <th>Purpose</th>
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
            <?php if(count($pendingProjects)): ?>
              <?php foreach($pendingProjects as $pendingProject): ?>
              <?php
              $dateFormat=strtotime($pendingProject['orderDate']);
              $FormatedDate=date('M d Y',$dateFormat);
              ?>
                <tr>
                  <td><?php echo e($s); ?></td>
                  <td><?php echo e($pendingProject['order_id']); ?></td>
                  <td><?php echo e($FormatedDate); ?></td>
                  <td><?php echo e($pendingProject['languagePackage']); ?></td>
                  <td>
                     <?php if(count($pendingProject['fileTypes'] )): ?>
                        <?php foreach($pendingProject['fileTypes'] as $fileType): ?>
                          <img src="<?php echo e($url[0].'/customer/img/'.$fileType); ?>" title="<?php echo e($fileType); ?>" alt="<?php echo e($fileType); ?>" />
                          <br/>
                        <?php endforeach; ?>
                      <?php endif; ?>
                  </td>
                  <td><?php echo e(($pendingProject['files'])?$pendingProject['files']:''); ?></td>
                  <td><?php echo e($pendingProject['totalWords']); ?></td>
                  <td><?php echo e((isset($pendingProject['sourceLang']))?$pendingProject['sourceLang']:''); ?></td>
                  <td><?php echo e((isset($pendingProject['destinationLanguage'] ))?$pendingProject['destinationLanguage']:''); ?></td>
                  <td><img src="<?php echo e(asset('/customer/img/pending-icon.png')); ?>" alt="pending-icon" title="pending-icon"> 
                  <?php echo e($pendingProject['languageStatus']); ?></td>
                  <td>$<?php echo e((isset($allProject['finalPrice'] ))?$allProject['finalPrice']:''); ?></td>
                  <td><a href="<?php echo e(url('customer/view-order/view/'.encrypt($pendingProject['order_id']))); ?>" title="view"><i class="fa fa-eye" aria-hidden="true"></i> View </a><a href="<?php echo e(url('customer/view-order/review/'.encrypt($pendingProject['order_id']))); ?>" title="view"><i class="fa fa-eye" aria-hidden="true"></i> Review </a></td>
                </tr>
                <?php $s++; ?>
              <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div> <!-- common-dashtext-wrap -->

    </div> <!-- dashboard-content -->

<?php $__env->stopSection(); ?>

  
<?php echo $__env->make('customer.front-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>