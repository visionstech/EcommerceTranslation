<?php if($errors->any()): ?>
    <?php $errors = $errors; ?>
	<div class="alert alert-danger errorAlertMsgMain text-left">
		<!--a class="close"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a-->
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		<strong>Whoops!</strong> There were some problems with your input.
		<ul class="errorAlertMsg">
			<?php foreach($errors->all() as $error): ?>
			<li><?php echo e($error); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php else: ?> 
    <?php $errors = []; ?>
<?php endif; ?>
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