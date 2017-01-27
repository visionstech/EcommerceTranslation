<?php $__env->startSection('title'); ?>
  Translation Order
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="odering-process-1">
      <div class="eqho-container">
        <div class="eqho-clear-fix translator-wrap">
          <div class="like-to-translate">
            <form>
              <div class="select-lang">
                <h2>Select Your Languages</h2>
                <div class="form-group">
                  <label>Translate From</label>
                  <select name="source">
                    <option>-- Select Your File Language --</option>
                    <?php foreach($languages as $language): ?>
                      <option value="<?php echo e($language->id); ?>"><?php echo e($language->name); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Translate To</label>
                
                  <button type="button" id="" class="translate-btn">-- Translate to --</button>
                  
                </div>
                  <div class="lang-popup">
                    <h1>Choose Languages (3) <span><i class="fa fa-times popup-close" aria-hidden="true"></i></span></h1>
                    <div class="translate-from">
                      <h5>Translate From</h5>

                      <div class="language-selected">
                        <p class="select-langs" id="selected_lang" data-id=""><img src="<?php echo e(asset('/customer/img/english-lang.jpg')); ?>" alt="english" title="english">English <span class="list-caret-down"><i class="fa fa-caret-down" aria-hidden="true"></i></span></p>
                        <ul class="show-1">
                          <?php foreach($languages as $language): ?>
                            <li id="<?php echo e($language->id); ?>"><img src="<?php echo e(asset('/customer/img/english-lang.jpg')); ?>" alt="english" title="english"> <?php echo e($language->name); ?> </li>
                          <?php endforeach; ?>       
                          
                        </ul>
                        
                      </div> <!-- language-selected -->

                      <h5>Translate To</h5>

                    </div> <!-- translate-from -->
                    <div class="all-languages">
                      <ul class="eqho-clear-fix">
                       <?php foreach($languages as $language): ?>
                          <li id="<?php echo e('selectedLangs_'.$language->id); ?>"><img src="<?php echo e(asset('/customer/img/english-lang.jpg')); ?>" alt="english" title="english"> <?php echo e($language->name); ?> </li>
                        <?php endforeach; ?>
                      </ul>
                    </div> <!-- all-languages -->
                    <div class="total-lang">
                      <p>Selected Languages: (3)</p>
                    </div>
                    <div class="btn-wrap popup-btn-wrap">
                      <input type="submit" value="Add Language" name="" class="btn_ctrl">
                    </div>
                  </div> <!-- lang-popup -->
                  
              </div> <!-- select-lang -->
              <div class="btn-wrap">
                <a href="<?php echo e(url('/translation-application/step-one')); ?>" class="btn_ctrl back-btn">Back: Upload files</a>
                <input type="submit" value="Next: Choose Purpose" name="" class="btn_ctrl">
              </div>
            </form>
          </div> <!-- like-to-translate -->
        
          <div class="your-order">
            <h2>Your Result</h2>
            <ul>
              <li><p>Total Words</p> <span>0</span></li>
              <li><p>Languages</p> <span>0</span></li>
              <li><p>Purpose</p> <span>none</span></li>
              <li><p>Type</p> <span>none</span></li>
              <li><p>Your Price</p> <span>$0.00</span></li>
            </ul>
          </div>
        </div> <!-- translator-wrap -->
      </div>
    </section>

  
    <section class="contact-sales">
      <div class="eqho-container">
        <h3>Have a <span>Large Project?</span></h3>
        <div class="contact-sales-inner">
          <p>Speak to one of our sales managers</p>
          <a href="#" title="Contact Sales">Contact Sales</a>
        </div>
      </div> <!-- eqho-container -->
    </section> <!-- contact-sales -->
<?php $__env->stopSection(); ?>

  
<?php echo $__env->make('customer.front-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>