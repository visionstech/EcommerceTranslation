<?php $__env->startSection('title'); ?>
	Languages
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="content-header">
      <h1>
        Manage Languages
        <small>Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo e(url('/language-management')); ?>">Languages Overview</a></li>
      </ol>
    </section>
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
                  <h3 class="box-title"><a href="<?php echo e(url('/language-management/add-language')); ?>">Add Language</a></h3>
                </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th>Language Name</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($languages as $language): ?>
                                <tr>
                                    <td><?php echo e($language->name); ?></td>
                                    <td><?php echo e($language->created_at); ?></td>
                                    <td><?php echo e($language->status); ?></td>
                                   <td>
                                    <?php if($language->status != 'Deactive'){ ?>
                                            <a class="btn btn-primary" data-target="<?php echo e('.bs-example-modal-dm_'.$language->id); ?>" data-toggle="modal" href="javascript:void(0);" data-did="<?php echo e(encrypt($language->id)); ?>" data-status="Deactive" data-statusDiv="Deactive">Deactive</a>
                                    <?php }else{ ?>
                                            <a class="btn btn-primary" data-target="<?php echo e('.bs-example-modal-dm_'.$language->id); ?>" data-toggle="modal" href="javascript:void(0);" data-did="<?php echo e(encrypt($language->id)); ?>" data-status="Active" data-statusDiv="Active">Active</a>
                                    <?php } ?>
                                    <a class="btn btn-primary actionedit" href="<?php echo e(url('/language-management/add-language/'.encrypt($language->id))); ?>">Edit</a>
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
    <?php foreach($languages as $language): ?>
        <?php if($language->status != 'Deactive'): ?>
            <?php $status='Deactive';
                  $dataStatus="Deactive";
            ?>
        <?php else: ?>
            <?php $status='Active';
                  $dataStatus="Active";
            ?>
        <?php endif; ?>
      <div class="modal fade <?php echo e('bs-example-modal-dm_'.$language->id); ?>" aria-hidden="true" role="dialog" tabindex="-1" style="display: none;">   <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"><?php echo e($status); ?> Language</h4>
            </div>
            <div class="modal-body">
                <h4></h4>
                <p>Are you sure you want to <?php echo e($status); ?> this language ? </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="LanguageId" value="<?php echo e(encrypt($language->id)); ?>"  class="LanguageId" />
                <input type="hidden" name="status" value="<?php echo e($dataStatus); ?>" class="status" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary delete_confirm"><?php echo e($status); ?></button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<!-- Popup Model For Delete action -->


<!-- End Popup Model -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $("#example1").dataTable();
        var baseUrl='<?php echo URL::to('/'); ?>';
        $('.actionAnchor').click(function(){
            var LanguageId=$(this).attr('data-did');
            var status=$(this).attr('data-status');
            var statusDiv=$(this).attr('data-statusDiv');
            $('.status').val(status);
            $('.statusDiv').html(statusDiv);
            $('.LanguageId').val(LanguageId);
        });
        
        $('.delete_confirm').click(function(){

            var LanguageId= $(this).prev().prev().prev().val();
            var Status= $(this).prev().prev().val();
            window.location.href=baseUrl+'/language-management/delete-language/'+LanguageId+'/'+Status;
        });        
    });
</script>
<?php $__env->stopSection(); ?>
 


<?php echo $__env->make('backend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>