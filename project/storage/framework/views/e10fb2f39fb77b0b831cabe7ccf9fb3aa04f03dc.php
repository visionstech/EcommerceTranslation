    <h2>Custom Scripting</h2>
    <input type="hidden" name="publisher_id" value="<?php (isset($publisher)) ? $publisher->id : ''; ?>">
	
	<div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
      		<textarea rows="6" cols="50" name="custom_scripting2"></textarea>
            <div id="editor"><?php echo e($customScripting[0]['custom_scripting']); ?></div>
		</div>
        <div class="clearfix"></div>
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <button type="submit" class="btn btn-success"><?php echo e($submitButtonText); ?></button>
        </div>
        <div class="clearfix"></div>
    </div>
 