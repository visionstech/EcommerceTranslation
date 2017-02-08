<?php $__env->startSection('title'); ?>
	Users
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
#example1_filter label input.input-sm {
  margin: 0 0 0 5px;
}</style>
    <section class="content-header">
      <h1>
        Manage Users
        <small>Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo e(url('/user')); ?>">Manage users</a></li>
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
            <div class="box-header">
              <h3 class="box-title"><a href="<?php echo e(url('/user/add-user')); ?>">Add User</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
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
                                    if($user->role_id==1){
                                        $role='Superadmin';
                                    }else if($user->role_id==2){
                                        $role='Management';
                                    }else if($user->role_id==3){
                                        $role='Customer';
                                    }else{
                                        $role='Translator';
                                    }
                            ?>
                                <tr>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php echo e($role); ?></td>
                                    <td><?php echo e($user->created_at); ?></td>
                                    <td><?php echo e($user->status); ?></td>
                                   <td>
                                    <?php if($user->status != 'Deleted'){ ?>
                                            <a class="btn btn-primary actionAnchor" data-target=".bs-example-modal-dm" data-toggle="modal" href="javascript:void(0);" data-did="<?php echo e(encrypt($user->id)); ?>" data-status="Deleted" data-statusDiv="Delete">Delete</a>
                                    <?php }else{ ?>
                                            <a class="btn btn-primary actionAnchor" data-target=".bs-example-modal-dm" data-toggle="modal" href="javascript:void(0);" data-did="<?php echo e(encrypt($user->id)); ?>" data-status="Active" data-statusDiv="Active">Active</a>
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
    </section>
<!-- Popup Model For Delete action -->

<div class="modal fade bs-example-modal-dm" aria-hidden="true" role="dialog" tabindex="-1" style="display: none;">   <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"><span class="statusDiv"></span> User</h4>
            </div>
            <div class="modal-body">
                <h4></h4>
                <p>Are you sure you want to <span class="statusDiv"></span> this user ? </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="UserId" class="UserId" />
                <input type="hidden" name="status" class="status" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary delete_confirm"><span class="statusDiv"></span></button>
            </div>
        </div>
    </div>
</div>
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
</script>
<?php $__env->stopSection(); ?>
 


<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>