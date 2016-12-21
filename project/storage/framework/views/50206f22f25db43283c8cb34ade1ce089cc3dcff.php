<?php $__env->startSection('title'); ?>
	Users
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- top tiles -->
    <div class="content-header">
        <ol class="breadcrumb">
           <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
           <li class="active"><a href="<?php echo e(url('/user')); ?>">Users Overview</a></li>
        </ol>
    </div>
    <!-- /top tiles -->
    <div class="row publisher">
        <h3>Manage Users</h3>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <a class="btn btn-primary" style="float:right;" href="<?php echo e(url('/user/add-user')); ?>">Add User</a>
                <div class="x_content">
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
                    <div class="pub-table">
                    <table class="table" id="example">
                        <thead>
                            <tr>
                                <th>User name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $user): ?>
                            <?php //$adsId=encrypt($position->id); 
                                    if($user->role==1){
                                        $role='Admin';
                                    }else if($user->role==2){
                                        $role='User';
                                    }else{
                                        $role='Manager';
                                    }
                            ?>
                                <tr>
                                    <td><?php echo e($user->name); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php echo e($role); ?></td>
                                    <td><?php echo e($user->created_at); ?></td>
                                    <td><?php echo e($user->status); ?></td>
                                   <td>
                                    <?php if($user->status != 'Deleted'){ ?>
                                          <a class="btn btn-primary actionAnchor" data-target=".bs-example-modal-dm" data-toggle="modal" href="javascript:void(0);" data-did="<?php echo e(encrypt($user->id)); ?>" data-status="Deleted">Delete</a>
                                    <?php } ?>
                                    <a class="btn btn-primary actionedit" href="<?php echo e(url('/user/add-user/'.encrypt($user->id))); ?>">Edit</a>
                                   </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
<!-- Popup Model For Delete action -->

<div class="modal fade bs-example-modal-dm" aria-hidden="true" role="dialog" tabindex="-1" style="display: none;">   <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Delete User</h4>
            </div>
            <div class="modal-body">
                <h4></h4>
                <p>Are you sure you want to delete this user ? </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="UserId" class="UserId" />
                <input type="hidden" name="status" class="status" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary delete_confirm">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- End Popup Model -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('/js/datatables/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $("#example").dataTable();
        var baseUrl='<?php echo URL::to('/'); ?>';
        $('.actionAnchor').click(function(){
            var UserId=$(this).attr('data-did');
            var status=$(this).attr('data-status');
            $('.status').val(status);
            $('.UserId').val(UserId);
        });
        
        $('.delete_confirm').click(function(){
            var UserId=$('.UserId').val();
            var Status=$('.status').val();
            window.location.href=baseUrl+'/user/delete-user/'+UserId+'/'+Status;
        });        
    });
</script>
<?php $__env->stopSection(); ?>
 


<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>