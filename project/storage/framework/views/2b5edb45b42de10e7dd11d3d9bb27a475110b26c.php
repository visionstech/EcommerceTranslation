<?php $__env->startSection('title'); ?>
	Publishers
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css" media="screen">
    #editor { 
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>
    <!-- top tiles -->
    <div class="content-header data-pub">
        <ol class="breadcrumb">
           <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i> Dashboard</a></li>
           <li><a href="<?php echo e(url('/publisher/publishers')); ?>">Publisher Overview</a></li>
           <li class="active">Edit Publisher</li>
        </ol>
    </div>
    <!-- /top tiles -->
    <div class="row publisher">
        <h3>Add Publisher</h3>

        <div class="col-md-12 col-sm-12 col-xs-12 publisher-padding">
            <div class="x_panel">
				<div class="x_title tab_on">
					 <a class="btn btn-default btn-ctrl" href="<?php echo e(url('/publisher/add-configuration/'.$publisherId)); ?>">Configuration</a>
                    <a class="btn btn-default btn-ctrl"  href="<?php echo e(url('/publisher/positions/'.$publisherId)); ?>">Ad Positions</a>
					<a class="btn btn-default btn-ctrl btn-active" href="javascript:void(0);">Custom</a>
				</div>
            <div class="x_content"><br />
                <?php echo $__env->make('errors.user_error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <form action="<?php echo e(url('/publisher/add-custom')); ?>" method="post" class="form-label-left">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" name="custom_scripting" id="custom_scripting">
                    <input type="hidden" name="publisherId" value="<?php echo e($publisherId); ?>">               
                    <?php echo $__env->make('publisher.custom_form',['submitButtonText' => 'Submit'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </form>
            
            </div>
        </div>
      </div>
    </div>
    
<?php $__env->stopSection(); ?>  
<?php $__env->startSection('js'); ?>
 <script src="<?php echo e(asset('/js/ace.js')); ?>"></script>
 <script>
    var editor = ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.getSession().setMode("ace/mode/javascript");
    
    function getCustomScript(){

        var Str='';
        $.each($('.ace_line'), function(index, value) {
                Str += $(this).html();
                Str += '\n';
        });
        $("#custom_scripting").val(Str);
    }

    setTimeout(getCustomScript, 1000);

    $("#editor").on('keyup',function(){        
        var Str='';
        $.each($('.ace_line'), function(index, value) {
            Str += $(this).html();
            Str += '\n';
        });
        $("#custom_scripting").val(Str);
    });

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>