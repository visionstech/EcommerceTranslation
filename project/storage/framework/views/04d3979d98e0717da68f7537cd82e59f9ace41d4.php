<?php $__env->startSection('title'); ?>
	Request Changes
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php //echo "<pre>";print_r($feedbackData);exit; ?>
    <style>
    #example1_filter label input.input-sm {
      margin: 0 0 0 5px;
    }
    </style>
    <section class="content-header">
      <h1>
        View Request Changes
        <small>Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo e(url('/management/all-projects')); ?>">View Request Changes</a></li>
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
                                    <th>File Name</th>
                                    <th>Correction Types</th>
                                    <th>Comment</th>
                                    <th>Requested Date</th>
                                    <th>File Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php foreach($feedbackData as $feedback): ?>
                                    <tr>
                                        <td>#<?php echo e($feedback['order_id']); ?></td>                          
                                        <td><?php echo e($feedback['sourceLang']); ?></td>    
                                        <td><?php echo e($feedback['destinationLang']); ?></td>  
                                        <td><a download href="<?php echo e(url('/').$feedback['FilePath'].'/'.$feedback['FileName']); ?>"><?php echo e($feedback['FileName']); ?></a></td>     
                                        <td><?php echo e($feedback['corrections']); ?></td>      
                                        <td><?php echo e($feedback['comment']); ?></td>      
                                        <td>
                                            <?php
                                              $dateFormat=strtotime($feedback['feedbackDate']);
                                              $FormatedDate=date('M d Y',$dateFormat);
                                            ?>
                                            <?php echo e($FormatedDate); ?>

                                        </td>                  
                                        <td>
                                            <?php if($feedback['FileStatus']=='Approved'): ?>
                                                <?php $class="success"; ?>
                                            <?php elseif(($feedback['FileStatus']=='Pending') || ($feedback['FileStatus']=='Changes')): ?>
                                                <?php $class="warning"; ?>
                                            <?php elseif($feedback['FileStatus']=='Rejected'): ?>
                                                <?php $class="danger"; ?>
                                            <?php else: ?>
                                                <?php $class="warning"; ?>
                                            <?php endif; ?>
                                            <span class="label label-<?php echo e($class); ?>">
                                                <?php echo e($feedback['FileStatus']); ?>

                                            </span>
                                        </td>
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