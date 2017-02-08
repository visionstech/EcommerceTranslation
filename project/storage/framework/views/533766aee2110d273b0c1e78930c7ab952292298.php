<?php $__env->startSection('title'); ?>
  Translation Order
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $dataUrl=url('/');                
      $url=explode('index.php',$dataUrl); 
?>
<div class="dashboard-content-wrap">
    <?php echo $__env->make('customer.customerAside', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="dashboard-content">
			<h1>Order: <span>#<?php echo e(($singleProject)?$singleProject['order_id']:''); ?></span></h1>

			<div class="common-dashtext-wrap">
				<?php $fileType=array();$fileNames=array();  $c=1;?>
				<?php foreach($singleProject['files'] as $file): ?>
					<?php 
					if(!in_array($file['title'],$fileType)){
						$fileType[] = $file['title'];
					}
					$fileNames[]=$file['name']
					?>
					<div class="doc-info">
						<div class="doc-img">
							<img src="<?php echo e($url[0].'/customer/img/'.$file['type']); ?>" alt="<?php echo e($file['title']); ?>" title="<?php echo e($file['title']); ?>" />
						</div>
						<div class="doc-text">
							<p><?php echo e($file['name']); ?></p>
							<h6><?php echo e($file['words']); ?> word count</h6>
						</div>
						<?php if(sizeof($singleProject['files'])==$c): ?>
							<div class="doc-price">
								<h5>Price: $<?php echo e($singleProject['finalPrice']); ?></h5>
							</div>
						<?php endif; ?>
					</div>
					<?php  $c++; ?>
				<?php endforeach; ?>

				<div class="project-details">
					<h2>Project Details</h2>
					<p><span>Purpose:</span> <?php echo e(($singleProject)?$singleProject['languagePurpose']:''); ?></p>
					<p><span>Delivery date:</span> N/A</p>
					<p><span>File type:</span> <?php echo e(implode(',',$fileType)); ?></p>
					<p><span>File names:</span> <span class="files_content"><?php echo implode(','."<br/>",$fileNames); ?></span></p>
				</div>
				<div class="common-table project-details">
					<table>
						<thead>
							<tr>
								<th>Translate From</th>
								<th>Translate To</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($singleProject['languages'] as $language): ?>
								<tr>
									<td><?php echo e($language['source']); ?></td>
									<td><?php echo e($language['destination']); ?></td>
									<td>
										<?php if($language['status']=='pending'): ?>
											<img src="<?php echo e(asset('/customer/img/pending-icon.png')); ?>" alt="pending-icon" title="pending-icon">
											<?php echo e(ucfirst($language['status'])); ?> <span>( The order is received but the translation is not yet placed with a translator.)</span>
										<?php elseif($language['status']=='translated'): ?>
											<span class="translated"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo e(ucfirst($language['status'])); ?></span>
										<?php else: ?>
											<span class="translating"><i class="fa fa-spinner" aria-hidden="true"></i> <?php echo e(ucfirst($language['status'])); ?></span>
										<?php endif; ?>
									 </td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div> <!-- common-dashtext-wrap -->
		</div> <!-- dashboard-content -->
	</div><!-- dashboard-content-wrap -->
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('customer.front-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>