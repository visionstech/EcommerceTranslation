<?php $__env->startSection('title'); ?>
  Orders
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Order
        <small>#<?php echo e($singleProject['order_id']); ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Order Detail.
            <?php
              $dateFormat=strtotime($singleProject['orderDate']);
              $FormatedDate=date('M d Y',$dateFormat);
            ?>
            <small class="pull-right"><?php echo e($FormatedDate); ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Payment From
          <address>
            <strong><?php echo e($singleProject['useremail']); ?></strong>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Payment To
          <address>
            <strong><?php echo e(Auth::user()->email); ?></strong>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Order ID #<?php echo e($singleProject['order_id']); ?> </b>
          <br>
          <b>Transaction Id: </b><?php echo e($singleProject['transaction_id']); ?><br>
          <b>Payment Status:</b> <?php echo e($singleProject['paymentStatus']); ?><br>
          <b>Total Payment:</b> $<?php echo e($singleProject['finalPrice']); ?>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Project</th>
              <th>Language From</th>
              <th>Language To</th>
              <th>Price</th>
            </tr>
            </thead>
            <tbody>
            <?php $c=1; ?>
            <?php if($singleProject['languages']): ?> 
              <?php foreach($singleProject['languages'] as $languages): ?>
                <tr>
                  <td><?php echo e($c); ?></td>
                  <td><?php echo e($languages['source']); ?></td>
                  <td><?php echo e($languages['destination']); ?></td>
                  <td>$<?php echo e($languages['singlelangprice']); ?></td>
                  <td>
                    <?php if($languages['status']=='Approved'): ?>
                      <?php $class="success"; ?>
                    <?php elseif(($languages['status']=='Pending') || ($languages['status']=='Changes')): ?>
                      <?php $class="warning"; ?>
                    <?php elseif($languages['status']=='Rejected'): ?>
                        <?php $class="danger"; ?>
                    <?php else: ?>
                      <?php $class="warning"; ?>
                    <?php endif; ?>
                    <span class="label label-<?php echo e($class); ?>">
                      <?php echo e($languages['status']); ?>

                    </span>
                  </td>
                </tr>
                <?php $c++; ?>
              <?php endforeach; ?>
            <?php endif; ?>
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-5">
          <p class="lead">Payment Methods:</p>
          <img src="<?php echo e(asset('/img/credit/visa.png')); ?>" alt="Visa">
          <img src="<?php echo e(asset('/img/credit/mastercard.png')); ?>" alt="Mastercard">
          <img src="<?php echo e(asset('/img/credit/american-express.png')); ?>" alt="American Express">
          <img src="<?php echo e(asset('/img/credit/mestro.png')); ?>" alt="Mestro">

        </div>
        <!-- /.col -->
        <div class="col-xs-7">
          <p class="lead">Files Uploaded</p>

          <div class="table-responsive">
            <table class="table">
            <?php if($singleProject['files']): ?> 
              <?php foreach($singleProject['files'] as $file): ?>
                <tr>
                  <th style="width:50%"><img src="<?php echo e(url('/').'/customer/img/'.$file['type']); ?>" name="" title="" /></th>
                  <td><?php echo e($file['name']); ?></td>
                  <td><a href="<?php echo e(url('/').$file['upload_path'].'/'.$file['name']); ?>" download class="btn btn-default"><i class="fa fa-print"></i> Download</a></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  <!-- /.content -->
<div class="clearfix"></div>

<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>