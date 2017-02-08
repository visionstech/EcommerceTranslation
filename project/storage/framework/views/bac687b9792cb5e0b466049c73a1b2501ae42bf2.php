<?php $__env->startSection('title'); ?>
	Menus
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <section class="content-header">
      <h1>
        Manage Menus
        <small>Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo e(url('/homepage-section/view-sections/header-menus')); ?>">Manage Menus</a></li>
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
              <h3 class="box-title"><a href="<?php echo e(url('/homepage-section/add-section/header-menus')); ?>">Add Menus</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th>Menu Title</th>
                                <th>Menu Link</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($sections as $section): ?>
                                <tr>
                                    <td><?php echo e($section->title); ?></td>
                                    <td><?php echo e($section->description); ?></td>
                                    <td><?php echo e($section->created_at); ?></td>
                                   <td>
                                    <?php if($section->status != 'Deleted'){ ?>
                                            <a class="btn btn-primary actionAnchor" data-target=".bs-example-modal-dm" data-toggle="modal" href="javascript:void(0);" data-did="<?php echo e(encrypt($section->id)); ?>" data-status="Deleted" data-statusDiv="Delete">Delete</a>
                                    <?php }else{ ?>
                                            <a class="btn btn-primary actionAnchor" data-target=".bs-example-modal-dm" data-toggle="modal" href="javascript:void(0);" data-did="<?php echo e(encrypt($section->id)); ?>" data-status="Active" data-statusDiv="Active">Active</a>
                                    <?php } ?>
                                    <a class="btn btn-primary actionedit" href="<?php echo e(url('/homepage-section/add-section/header-menus/'.encrypt($section->id))); ?>">Edit</a>
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
                <p>Are you sure you want to <span class="statusDiv"></span> this section ? </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="Id" class="Id" />
                <input type="hidden" name="status" class="status" />
                <input type="hidden" name="type" class="type" value='header-menus'/>
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
            var Id=$(this).attr('data-did');
            var status=$(this).attr('data-status');
            var statusDiv=$(this).attr('data-statusDiv');
            $('.status').val(status);
            $('.statusDiv').html(statusDiv);
            $('.Id').val(Id);
        });
        
        $('.delete_confirm').click(function(){
            var Id=$('.Id').val();
            var Status=$('.status').val();
            var Type=$('.type').val();
            window.location.href=baseUrl+'/homepage-section/delete-section/'+Id+'/'+Status+'/'+Type;
        });        
    });
</script>
<?php $__env->stopSection(); ?>
 


<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>