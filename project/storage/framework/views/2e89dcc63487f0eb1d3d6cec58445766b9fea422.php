<?php $__env->startSection('title'); ?>
	Dashboard
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <!-- top tiles -->
    <div class="content-header ">
        <ol class="breadcrumb">
           <li><i class="fa fa-home"></i> Dashboard</li>
        </ol>
    </div>
    <!-- /top tiles -->

    <div class="row admin-dashboard">
        <h3>Admin Dashboard</h3>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Statistics</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Impressions last 30 days</td>
                                <td>100.000.00</td>
                            </tr>
                            <tr>
                                <td>Impressions last month</td>
                                <td>120.000.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Notices</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>- Overlays are enabled but not generating impressions</td>
                                <td><button type="button" class="btn btn-primary">Report</button></td>
                            </tr>
                            <tr>
                                <td>- Decrease of impressions last 30 days compared to last month</td>
                                <td><button type="button" class="btn btn-primary">Report</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Products</th>
                                <th>Live</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product): ?>
                                <tr>
                                    <td>
                                        <?php 
                                            $product_name_array = explode('_', $product->name);
                                            $product_name_array = array_map(function($word) { return ucfirst($word); }, $product_name_array);
                                            $product_name = implode(' ', $product_name_array); ?>
                                        <?php echo e($product_name); ?>

                                    </td>
                                    <td><?php echo ($product->status == 1) ? 'Yes' : 'No'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
 
    
<?php $__env->stopSection(); ?>


<?php echo $__env->make('app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>