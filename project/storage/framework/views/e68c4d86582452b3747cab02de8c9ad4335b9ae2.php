    <h2>General Information</h2>
    <div class="all-form">
    <div class="form-group">
       <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="Status">Publisher Status</label>
       <div class="col-md-6 col-sm-6 col-xs-12">
        <?php $Status = (old('status')) ? old('status') : ((!empty($PublisherData)) ? $PublisherData[0]['status'] : 'Live');  
        ?>
        <div class="select-wrap">
            <select name="status" class="form-control col-md-7 col-xs-12">
                <option value="Live" <?php echo ($Status =='Live')? "selected":''; ?> >Live</option>
                <option value="Suspended" <?php echo ($Status =='Suspended')? "selected":''; ?>>Suspended</option>
                <option value="Paused" <?php echo ($Status =='Paused')? "selected":''; ?>>Paused</option>
            </select>
            <!-- <span class="caret"></span> -->
            <span><i class="fa fa-chevron-down" aria-hidden="true"></i></span>
        </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="website">Domain <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php $website = (old('website')) ? old('website') : ((!empty($PublisherData)) ? $PublisherData[0]['website'] : '');  ?>
            <input type="text" placeholder="Domain" class="form-control col-md-7 col-xs-12" name="website" value="<?php echo e($website); ?>">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="name">Contact Name <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php $name = (old('name')) ? old('name') : ((!empty($PublisherData)) ? $PublisherData[0]['name'] : '');  ?>
            <input type="text" placeholder="Name" class="form-control col-md-7 col-xs-12" name="name" value="<?php echo e($name); ?>">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="email">Contact Email <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php $email = (old('email')) ? old('email') : ((!empty($PublisherData)) ? $PublisherData[0]['email'] : '');  ?>
            <input type="email" placeholder="Email" class="form-control col-md-7 col-xs-12" name="email" value="<?php echo e($email); ?>">
        </div>
        <div class="clearfix"></div>
    </div> 
    
    <br>
    <h2>Standard Products</h2>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 custom-check">
            <?php foreach($products as $key=>$product): ?>
                <?php 
                $productOld=array(old('products.0'),old('products.1'),old('products.2'),old('products.3'));
                $check_product = (((!empty($PublisherData))&& $PublisherData[0][$product['name']] == 1) ? 'checked="checked"' : ((in_array(($key+1), $productOld))? 'checked="checked"':'')); 
                ?>
                <!--<input type="checkbox" <?php echo e($check_product); ?> name="products[]" value="<?php echo e($product['id']); ?>">-->
                 <input type="checkbox" <?php echo e($check_product); ?> name="products[]" value="<?php echo e($product['id']); ?>" id="<?php echo e($key); ?>" />
                <?php 
                $product_name_array = explode('_', $product['name']);
                $product_name_array = array_map(function($word) { return ucfirst($word); }, $product_name_array);
                $product_name = implode(' ', $product_name_array); ?>
                <!--<label><?php echo e($product_name); ?></label>-->
                <label for="<?php echo e($key); ?>"><?php echo e($product_name); ?></label>
                <br>
            <?php endforeach; ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <br>
    <?php if(Auth::user()->role !=2 ){ ?>
    <h2>DFP Setup</h2>
    <input type="hidden" name="targeting_type" value="configuration" />
    <div class="form-group">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="adunit_id">Adunit ID</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php $adunit_id = (old('adunit_id')) ? old('adunit_id') : ((!empty($PublisherData)) ? $PublisherData[0]['adunit_id'] : '');  ?>
            <input type="text" placeholder="Adunit ID" class="form-control col-md-7 col-xs-12" name="adunit_id" value="<?php echo e($adunit_id); ?>">
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="krux_id">Krux ID</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php $krux_id = (old('krux_id')) ? old('krux_id') : ((!empty($PublisherData)) ? $PublisherData[0]['krux_id'] : '');  ?>
            <input type="text" placeholder="Krux ID" class="form-control col-md-7 col-xs-12" name="krux_id" value="<?php echo e($krux_id); ?>" />
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="form-group">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="comscore_id">ComScore ID</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
             <?php $comscore_id = (old('comscore_id')) ? old('comscore_id') : ((!empty($PublisherData)) ? $PublisherData[0]['comscore_id'] : '');  ?>
            <input type="text" placeholder="ComScore ID" class="form-control col-md-7 col-xs-12" name="comscore_id" value="<?php echo e($comscore_id); ?>">
        </div>
        <div class="clearfix"></div>
    </div>
    
    <div class="form-group" id="targeting_main">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="targeting">Targeting</label>

            <?php $tagetkey = (old('targeting_key')) ? old('targeting_key.0') : ((!empty($TargetingData)) ? $TargetingData[0]['key'] : '');  ?>
			<div class="col-md-3 col-sm-3 col-xs-4">
				<input type="text" placeholder="key" class="form-control col-md-7 col-xs-12" name="targeting_key[]" value="<?php echo e($tagetkey); ?>">
			</div>

            <?php $tagetVal = (old('targeting_value')) ? old('targeting_value.0'): ((!empty($TargetingData)) ? $TargetingData[0]['value'] : '');  ?>
			<div class="col-md-3 col-sm-3 col-xs-4">
				<input type="text" placeholder="value" class="form-control col-md-7 col-xs-12" name="targeting_value[]" value="<?php echo e($tagetVal); ?>">
			</div>
			
        <div class="col-md-2 col-sm-2 col-xs-4">
            <span class="btn btn-primary" id="add_targeting"><i class="fa fa-plus"></i></span>
            <span class="btn btn-primary" id="delete_targeting"><i class="fa fa-minus"></i></span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="target_main one">
        <?php if(sizeof($TargetingData)>1){
                $target=0;
                foreach($TargetingData as $Targeting){ 
                    if($target>0){
                        $tagetkey = (old('targeting_key')) ? old('targeting_key.'.$target) : ((!empty($TargetingData)) ? $Targeting['key'] : '');
                        $tagetVal = (old('targeting_value')) ? old('targeting_value.'.$target) : ((!empty($TargetingData)) ? $Targeting['value'] : '');
        ?>
            <div class="target_sub"><div class="form-group"><div class="col-md-6 col-sm-6 col-xs-6"><input type="text" placeholder="key" class="form-control col-md-7 col-xs-12" name="targeting_key[]" value="<?php echo e($tagetkey); ?>"></div><div class="col-md-6 col-sm-6 col-xs-6"><input type="text" placeholder="value" class="form-control col-md-7 col-xs-12" name="targeting_value[]" value="<?php echo e($tagetVal); ?>"></div></div></div>
        <?php   } $target++;} } ?>
    </div>

    
    <div class="form-group" id="pagetype_main">
        <label class="control-label text-left col-md-3 col-sm-3 col-xs-12" for="page_type">Page Types</label>
        <?php $PageTitle = (old('page_type_title')) ? old('page_type_title.0') : ((!empty($PageTypeData)) ? $PageTypeData[0]['title'] : '');  ?>
     	 <div class="col-md-3 col-sm-3 col-xs-4">
            <input type="text" placeholder="Page Title" class="form-control col-md-7 col-xs-12" name="page_type_title[]" value="<?php echo e($PageTitle); ?>">
        </div>
        <?php $PageSelector = (old('page_type_selector')) ? old('page_type_selector.0') : ((!empty($PageTypeData)) ? $PageTypeData[0]['selector'] : '');  ?>
        <div class="col-md-3 col-sm-3 col-xs-4">
            <input type="text" placeholder="Selector" class="form-control col-md-7 col-xs-12" name="page_type_selector[]" value="<?php echo e($PageSelector); ?>">
        </div>
        <div class="col-md-2 col-sm-2 col-xs-4">
            <span class="btn btn-primary" id="add_page_type"><i class="fa fa-plus"></i></span>
            <span class="btn btn-primary" id="delete_page_type"><i class="fa fa-minus"></i></span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="pagetype_main one">
        <?php if(sizeof($PageTypeData)>1){
                $Page=0;
                foreach($PageTypeData as $PageType){ 
                    if($Page>0){
                        $pageTitle = (old('page_type_title')) ? old('page_type_title'.$Page) : ((!empty($PageTypeData)) ? $PageType['title'] : '');
                        $pageSelector = (old('page_type_selector')) ? old('page_type_selector'.$Page) : ((!empty($PageTypeData)) ? $PageType['selector'] : '');
        ?>
            <div class="pagetype_sub"><div class="form-group"><div class="col-md-6 col-sm-6 col-xs-6"><input type="text" placeholder="Page Title" class="form-control col-md-7 col-xs-12" name="page_type_title[]" value="<?php echo e($pageTitle); ?>"></div><div class="col-md-6 col-sm-6 col-xs-6"><input type="text" placeholder="Selector" class="form-control col-md-7 col-xs-12" name="page_type_selector[]" value="<?php echo e($pageSelector); ?>"></div></div></div>
        
        <?php   } $Page++;} } ?>    

    </div>
    <br>
    <h2>Please copy/ paste the VICE Digital Tag into the footer of the platform</h2>
    <div class="form-group">
        <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" placeholder='<script src="xxxx"></script>' class="form-control col-md-7 col-xs-12" name="vice_digital_tag" readonly value='<script src="xxxx"></script>'>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <span class="btn btn-primary btn-ctrl" id="copy_script">COPY</span>
        </div>
        <span class="control-label text-left col-md-12 col-sm-12 col-xs-12">Current state: VICE Digital Tag has been correctly implemented.</span>
        <div class="clearfix"></div>
    </div> 
    <?php } ?>   
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
        <?php if($publisherId !='') { echo '<input type="hidden" name="method" value="Update">'; }else{  echo '<input type="hidden" name="method" value="Insert">'; } ?>
            <button type="submit" class="btn btn-primary btn-ctrl"><?php echo e($submitButtonText); ?></button>
        </div>
        <div class="clearfix"></div>
    </div> 
    </div>