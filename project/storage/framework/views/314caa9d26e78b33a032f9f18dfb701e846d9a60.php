<?php $__env->startSection('title'); ?>
  Translation Order
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $dataUrl=url('/'); ?>
<div class="dashboard-content-wrap">
    <?php echo $__env->make('customer.customerAside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="dashboard-content">
		<h1>Translation Reviewable (#<?php echo e(($singleProject)?$singleProject['order_id']:''); ?>)</h1>
			<div class="common-dashtext-wrap ">
				<div class="translation-review request-changes-wrap">
					<div class="translated-files">
						<h2>Translation <span class="trans-lang">(<?php echo e($singleProject['language']['destination']); ?>)</span></h2>
						<?php echo $__env->make('errors.frontend_errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						<form  action="<?php echo e(url('/customer/customer-feedback')); ?>" method="post" enctype="multipart/form-data">
							<input type="hidden" name="_token" id='token' value="<?php echo e(csrf_token()); ?>" />
							<input type="hidden" name="project_id" value="<?php echo e($singleProject['project_id']); ?>" />
							<input type="hidden" name="order_id"  value="<?php echo e($singleProject['order_id']); ?>" />
							<div class="form-group">
								<label>File Name</label>
								<select class="download_file" name="translated_file">
									<option value="">-- Select your file name --</option>
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
							<div class="request-changes">
								<h2>What would you like to change?</h2>
								<?php if(count($translationCorrection)): ?>
									<?php foreach($translationCorrection as $correction): ?>
										<div class="custom-checkbox">
											<input id="change-<?php echo e($correction->id); ?>" name="corrections[]" type="checkbox" value="<?php echo e($correction->id); ?>">
									        <label for="change-<?php echo e($correction->id); ?>" class="checkbox-custom-label"><?php echo e(ucfirst($correction->name)); ?></label>    
									    </div>
								    <?php endforeach; ?>
							    <?php endif; ?>
							    <div class="new-file-up upload-files">
							    	<h2>File Upload <i class="fa fa-question-circle" aria-hidden="true"></i></h2>
									<div class="upload-files-btn">
										<span type="button" class="fileinput-button">
											<span>Upload File</span>
										    <input name="requested_file" size="1" type="file">
										</span>
									</div>
									<span class="lable-text"></span>
								</div>

								<div class="comment">
									<h2>Comment</h2>
									<textarea name="comment" placeholder="Your comments..."></textarea>
								</div>

								<div class="dash-btn-wrap">
									<input type="submit" name="submit" value="Request changes" class="btn-ctrl"/>
									<input type="submit" name="submit" value="Approve translation" class="btn-ctrl btn-gray"/>
									<a href="#" class="btn-ctrl btn-gray" title="Approve translation">Approve translation</a>
								</div>
							</div>
						</div>
					</form>
					<div class="orignal-files">
						<h2>Original files <span class="trans-lang">(<?php echo e($singleProject['language']['source']); ?>)</span></h2>
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
			</div> <!-- common-dashtext-wrap -->
		</div> <!-- dashboard-content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.front-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>