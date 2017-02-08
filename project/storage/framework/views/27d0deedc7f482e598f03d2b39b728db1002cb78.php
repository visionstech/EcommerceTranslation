<?php $__env->startSection('title'); ?>
  Translation Order
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $dataUrl=url('/');
?>
<div class="dashboard-content-wrap">
    <?php echo $__env->make('customer.customerAside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 			<div class="dashboard-content">
			<h1>Translation Reviewable (#<?php echo e(($singleProject)?$singleProject['order_id']:''); ?>)</h1>
			<div class="common-dashtext-wrap">
				<?php if($singleProject): ?>
					<?php $counter=1; ?>
					<?php foreach($singleProject['languages'] as $single): ?>
						<?php if($counter<10){$decimal='0';}else{$decimal='';} ?>
						<div class="translation-review">
							<div class="translated-files">
								<h2><span class="numbering"><?php echo e($decimal.$counter); ?></span> Translation <span class="trans-lang">(<?php echo e($single['destination']); ?>)</span></h2>
								<div class="form-group">
									<label>File Name</label>
									<select class="download_file" name="<?php echo e($single['id']); ?>">
										<option>-- Select your file name --</option>
										<?php if($singleProject['files']): ?>
											<?php foreach($singleProject['files'] as $file): ?>
												<option data-link="<?php echo e($dataUrl.$file['upload_path'].'/'.$file['name']); ?>" value="<?php echo e($file['id']); ?>"><?php echo e($file['name']); ?></option>
											<?php endforeach; ?>
										<?php endif; ?>
									</select>
									<div class="dash-btn-wrap">
										<a href="<?php echo e($dataUrl.$singleProject['files'][0]['upload_path'].'/'.$singleProject['files'][0]['name']); ?>" class="btn-ctrl dload" download class="download_anchor"><i class="fa fa-download" aria-hidden="true"></i> Download Translation</a>
									</div>
								</div>
								<div class="view-rejection-wrap">
									<div class="dash-btn-wrap">
										<a href="<?php echo e(url('/customer/request-changes/'.encrypt($single['id']))); ?>" class="btn-ctrl" title="Request changes">Request changes</a>
										<a href="#" class="btn-ctrl btn-gray" title="Approve translation"><i class="fa fa-trash" aria-hidden="true"></i> Approve translation</a>
									</div>
									<a href="#" class="view-reject" title="View Rejection"><i class="fa fa-eye" aria-hidden="true"></i> View Rejection Form</a>
								</div>
							</div>
							<div class="orignal-files">
								<h2>Original files <span class="trans-lang">(<?php echo e($single['source']); ?>)</span></h2>
								<div class="org-file-info">
									<?php if($singleProject['files']): ?>
										<?php foreach($singleProject['files'] as $file): ?>
											<ul>
												<li><img src="<?php echo e($dataUrl.'/customer/img/'.$file['type']); ?>" alt="<?php echo e($file['title']); ?>" title="<?php echo e($file['title']); ?>" /></li>
												<li><?php echo e($file['name']); ?></li>
												<li>
													<div class="dash-btn-wrap ">
														<a href="<?php echo e($dataUrl.$file['upload_path'].'/'.$file['name']); ?>" class="btn-ctrl dload" download><i class="fa fa-download" aria-hidden="true"></i> Download Original</a>
													</div>
												</li>
											</ul>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
							</div>
						</div> <!-- translation-review -->
						<?php $counter++; ?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div> <!-- common-dashtext-wrap -->
		</div> <!-- dashboard-content -->
	</div><!-- dashboard-content-wrap -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.front-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>