<?php $__env->startSection('title'); ?>
	Orders
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style>
    #example1_filter label input.input-sm {
      margin: 0 0 0 5px;
    }
    </style>
    <section class="content-header">
      <h1>
        View Orders
        <small>Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo e(url('/management/all-projects')); ?>">View Orders</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php if(Session::has('success')): ?> 
                    <div class="alert alert-success"> 
                        <?php echo e(Session::get('success')); ?> 
                    </div> 
                <?php endif; ?>
                <?php if(Session::has('error')): ?> 
                    <div class="alert alert-danger"> 
                        <?php echo e(Session::get('error')); ?> 
                    </div> 
                <?php endif; ?>
                <div class="box">
                <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table" id="example1">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Language From</th>
                                    <th>Language To</th>
                                    <th>Customer Email</th>
                                    <th>Total Words</th>
                                    <th>Final Price</th>
                                    <th>Order Date</th>
                                    <th>Translation Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($allProjects as $allProject): ?>
                                    <tr>
                                        <td>#<?php echo e($allProject['order_id']); ?></td>
                                        <td><?php echo e($allProject['sourceLang']); ?></td>
                                        <td><?php echo e($allProject['destinationLanguage']); ?></td>
                                        <td><?php echo e($allProject['useremail']); ?></td>
                                        <td><?php echo e($allProject['totalWords']); ?></td>
                                        <td>$<?php echo e($allProject['finalPrice']); ?></td>
                                        <?php
                                          $dateFormat=strtotime($allProject['orderDate']);
                                          $FormatedDate=date('M d Y',$dateFormat);
                                        ?>
                                        <td><?php echo e($FormatedDate); ?></td>                
                                        <td>
                                            <?php if($allProject['languageStatus']=='Approved'): ?>
                                                <?php $class="success"; ?>
                                            <?php elseif(($allProject['languageStatus']=='Pending') || ($allProject['languageStatus']=='Changes')): ?>
                                                <?php $class="warning"; ?>
                                            <?php elseif($allProject['languageStatus']=='Rejected'): ?>
                                                <?php $class="danger"; ?>
                                            <?php else: ?>
                                                <?php $class="warning"; ?>
                                            <?php endif; ?>
                                            <span class="label label-<?php echo e($class); ?>">
                                                <?php echo e($allProject['languageStatus']); ?>

                                            </span>
                                        </td>

                                        <td><a href="<?php echo e(url('management/view-order/view/'.encrypt($allProject['order_id']))); ?>" title="view"><i class="fa fa-eye" aria-hidden="true"></i> View </a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                    
            </div>
        </div>
    </section>
    <!-- Popup Model For Delete action -->
<!-- End Popup Model -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
       $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        var baseUrl='<?php echo URL::to('/'); ?>';
        $('.actionAnchor').click(function(){
            var UserId=$(this).attr('data-did');
            var status=$(this).attr('data-status');
            var statusDiv=$(this).attr('data-statusDiv');
            $('.status').val(status);
            $('.statusDiv').html(statusDiv);
            $('.UserId').val(UserId);
        });
        
        $('.delete_confirm').click(function(){
            var UserId=$('.UserId').val();
            var Status=$('.status').val();
            window.location.href=baseUrl+'/user/delete-user/'+UserId+'/'+Status;
        });        
    });

    $(document).ready(function(){
        $("#example1").dataTable();
        var baseUrl='<?php echo URL::to('/'); ?>';
        $('.actionAnchor').click(function(){
            var LanguageId=$(this).attr('data-did');
            var status=$(this).attr('data-status');
            var statusDiv=$(this).attr('data-statusDiv');
            $('.status').val(status);
            $('.statusDiv').html(statusDiv);
            $('.UserId').val(LanguageId);
        });
        
        $('.delete_confirm').click(function(){

            var UserId= $(this).prev().prev().prev().val();
            var Status= $(this).prev().prev().val();
            window.location.href=baseUrl+'/user/delete-user/'+UserId+'/'+Status;
        });        
    });
</script>
<?php $__env->stopSection(); ?>
 


<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>