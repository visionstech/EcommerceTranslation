<?php if($errors->any()): ?>
    <?php $errors = $errors; ?>
	<div class="front_errors">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		<p><strong>Whoops!</strong> There were some problems with your input.</p>
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
 	<div class="front_success alert alert-success"> 
        <i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo e(Session::get('success')); ?> 
    </div>
<?php endif; ?>
<?php if(Session::has('error')): ?> 
    <div class="alert alert-danger"> 
        <?php echo e(Session::get('error')); ?> 
    </div> 
<?php endif; ?>