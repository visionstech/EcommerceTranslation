<?php $__env->startSection('title'); ?>
	Publishers
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- top tiles -->
    <div class="content-header data-pub">
        <ol class="breadcrumb">
           <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
           <li><a href="<?php echo e(url('/publisher/publishers')); ?>">Publisher Overview</a></li>
           <li class="active">Edit Publisher</li>
        </ol>
    </div>
    <!-- /top tiles -->
    <div class="row publisher ">
        <h3>Ad Positions</h3>
        <div class="col-md-12 col-sm-12 col-xs-12 publisher-padding">
            <div class="x_panel">
                <div class="x_title tab_on">
                   
                    <?php if($publisherId !=''){ ?>
                        <a class="btn btn-default btn-ctrl" href="<?php echo e(url('/publisher/add-configuration/'.$publisherId)); ?>">Configuration</a>
                        <a  class="btn btn-default btn-ctrl btn-active" href="<?php echo e(url('/publisher/positions/'.$publisherId)); ?>">Ad Positions</a>
                    <?php if(Auth::user()->role !=2 ){ ?>
                        <a class="btn btn-default btn-ctrl" href="<?php echo e(url('/publisher/add-custom/'.$publisherId)); ?>">Custom</a>
                    <?php } 
                    } ?>
                    
                </div>
            
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
                    <table class="table" id="example">
                        <thead>
                            <tr>
                                <th>Slotname</th>
                                <th>Notices</th>
                                <th>Status</th>
                                <?php if(Auth::user()->role !=2 ){ ?>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($positions as $position): ?>
                            <?php $adsId=encrypt($position->id); ?>
                                <tr>
                                    <td><?php echo e($position->slotname); ?></td>
                                    <td>6</td>
                                    <td><?php echo e($position->status); ?></td>
                                    <?php if(Auth::user()->role !=2 ){ ?>
                                    <td>
                                    <?php if($position->status != 'Suspended'){ ?>
                                    <a class="btn btn-primary actionAnchor" data-target=".bs-example-modal-sm" data-toggle="modal" href="javascript:void(0);" data-adId="<?php echo e($adsId); ?>" data-status="Suspended" >Suspend</a>
                                    <?php } 
                                         if($position->status != 'Deleted'){ 
                                    ?>
                                    <a class="btn btn-primary actionAnchor" data-target=".bs-example-modal-dm" data-toggle="modal" href="javascript:void(0);" data-adId="<?php echo e($adsId); ?>" data-status="Deleted" >Delete</a>
                                    <?php }  ?>
                                    <a class="btn btn-primary" href="<?php echo e(url('/publisher/add-positions/'.$publisherId.'/'.encrypt($position->id))); ?>">Edit</a></td>
                                    <?php } ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php if(Auth::user()->role !=2 ){ ?>
                        <a class="btn btn-primary" style="float:left;" href="<?php echo e(url('/publisher/add-positions/'.$publisherId)); ?>">NEW ADSLOT</a>
                <?php }?>
            </div>
        </div>
    </div>
    <input type="hidden" name="AdId" class="AdId" value="">
    <div class="modal fade bs-example-modal-sm" aria-hidden="true" role="dialog" tabindex="-1" style="display: none;">   
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel2">Modal title</h4>
                </div>
                <div class="modal-body">
                    <h4>Suspend Ads position</h4>
                    <p>Are you sure you want to suspend this Ad position ? </p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="publisherId" class="publisherId" value="<?php echo e($publisherId); ?>">
                    <input type="hidden" name="status" class="suspend" value="Suspended">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary suspend_confirm">Suspend</button>
                </div>

        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-dm" aria-hidden="true" role="dialog" tabindex="-1" style="display: none;">   <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Delete Ads position</h4>
            </div>
            <div class="modal-body">
                <h4></h4>
                <p>Are you sure you want to delete this Ad position ? </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="publisherId" class="publisherId" value="<?php echo e($publisherId); ?>">
                <input type="hidden" name="status" class="delete" value="Deleted">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary delete_confirm">Delete</button>
            </div>
        </div>
    </div>
</div>
    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('/js/datatables/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<script>
    $(document).ready(function(){
        $("#example").dataTable();
        var publisher=$('.publisherId').val();
        var baseUrl='<?php echo URL::to('/'); ?>';
        $('.actionAnchor').click(function(){
            var Ads=$(this).attr('data-adId');
            $('.AdId').val(Ads);
        });
        $('.suspend_confirm').click(function(){
            var Status='Suspended';
            var Ads=$('.AdId').val();
            window.location.href=baseUrl+'/publisher/delete-positions/'+publisher+'/'+Ads+'/'+Status;
        });
        $('.delete_confirm').click(function(){
            var Status='Deleted';
            var Ads=$('.AdId').val();
            window.location.href=baseUrl+'/publisher/delete-positions/'+publisher+'/'+Ads+'/'+Status;
        });
    });
</script>
<?php $__env->stopSection(); ?>
 


<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>