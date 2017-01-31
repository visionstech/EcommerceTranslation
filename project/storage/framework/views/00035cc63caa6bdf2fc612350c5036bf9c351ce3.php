<?php $__env->startSection('title'); ?>
  Translation Order
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="odering-process-1">
      <div class="eqho-container">
        <div class="eqho-clear-fix translator-wrap">
          <div class="like-to-translate">
              <form>
              <div class="purpose">
                <h2>What will you use the translation for?</h2>
                
                <div class="form-group">
                  <label>Your choice will help us price your order correctly</label>
                  <button type="button" id="" class="purpose-btn">-- Select purpose --</button>

                  <ul class="purpose-list">
                  <?php $c=1; ?>
                  <?php foreach($languagePackages as $languagePackage): ?>
                    <li class="package_li" id="li-<?php echo e($c); ?>">
                      <div class="purpose-list-text">
                        <h6><?php echo e($languagePackage->name); ?></h6>
                          <?php  echo $languagePackage->description; ?>
                      </div>
                    </li>
                  <?php $c++; ?>
                  <?php endforeach; ?>
                  </ul>
                  
                </div>
                <div class="purpose-type">
                  <table class="purpose-type-table">
                    <thead class="custom-radio">
                      <tr>
                        <?php $d=1; ?>
                        <?php foreach($languagePackages as $languagePackage): ?>
                          <th>
                            <input type="radio" id="sel-radio-<?php echo e($d); ?>" class="radio_package" name="selector">
                            <label data-id="<?php echo e($d); ?>" class="sel-radio" for="sel-radio-<?php echo e($d); ?>"><?php echo e($languagePackage->name); ?></label>
                            <div class="check"></div>
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                          </th>
                        <?php $d++; ?>
                        <?php endforeach; ?>
                        <th>                         
                          <label data-id="3" class="" for="sel-radio-3">Add-on services</label>
                          <i class="fa fa-question-circle" aria-hidden="true"></i>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php $d=1; ?>
                        <?php foreach($languagePackages as $languagePackage): ?>
                        <?php //echo strip_tags($languagePackage->description,'<ul><li></li>'); ?>
                          <td>
                            <div class="purpose-list-text">
                              <?php echo $languagePackage->description; ?>
                            </div>
                          </td>
                        <?php $d++; ?>
                        <?php endforeach; ?>
                        <td>
                          <div class="purpose-table-list ">
                            <ul>
                              <li>Everyday use</li>
                              <li>Personal translations </li>
                              <li>General online</li>
                              <li>User generated content </li>
                            </ul>
                          </div>
                        </td>
                      </tr>
                      <tr class="words-price">
                        <td>From $0.12/ word</td>
                        <td>From $0.18/ word</td>
                        <td><a href="#" title="Contact Sales">Contact Sales</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>  <!-- purpose-type -->
                  
              </div> <!-- purpose -->
              <div class="btn-wrap">
                <input type="submit" value="Back to: Choose Languages" name="" class="btn_ctrl back-btn no-margin" />
              </div>
              <div class="existing-customer">
                <h4>Are you an existing customer?</h4>
                <p>If so, you can select:</p>
                <div class="custom-radio">
                  <ul class="existing-option">
                    <li>
                      <input type="radio" id="ex-radio-1" name="existing-customer">
                      <label for="ex-radio-1">A translator you worked with previously</label>
                      <div class="check"></div>
                    </li>
                    <li>
                      <input type="radio" id="ex-radio-2" name="existing-customer">
                      <label for="ex-radio-2">An existing translation asset (e.g. Glossary) stored in your account</label>
                      <div class="check"><div class="inside"></div></div>
                    </li>
                  </ul>
                </div>
                <div class="existing-login">
                  <input type="submit" value="Login" name="" class="btn_ctrl" />
                </div>
              </div> <!-- existing-customer -->

              <div class="instructions">
                <h4>Instructions for translator  <span>(Optional)</span></h4>
                <div class="form-group">
                  <label>What tone you are looking for in your translation?</label>
                  <button type="button" id="" class="option-btn">-- Select your option --</button>
                  
                </div>
                <div class="form-group">
                  <label>Instructions for the translator</label>
                  <textarea placeholder="Write your instructions here..."></textarea>
                  
                </div>
                <div class="upload-files">
                  <span class="lable-text">Upload your brief</span>
                    <div class="upload-files-btn">
                      <form method="POST" >
                        <span type="button" class="fileinput-button">
                                <span>Upload Files</span>
                                <input name="file" multiple="multiple" size="1" type="file">
                        </span>
                      </form>
                    </div>
                </div> <!-- upload-files -->
                <div class="upload-files">
                  <span class="lable-text">Upload a glossary</span>
                    <div class="upload-files-btn">
                      <form method="POST" >
                        <span type="button" class="fileinput-button">
                                <span>Upload Files</span>
                                <input name="file" multiple="multiple" size="1" type="file">
                        </span>
                      </form>
                    </div>
                </div> <!-- upload-files -->
                <div class="upload-files">
                  <span class="lable-text">Upload brand/ style guide</span>
                    <div class="upload-files-btn">
                      <form method="POST" >
                        <span type="button" class="fileinput-button">
                                <span>Upload Files</span>
                                <input name="file" multiple="multiple" size="1" type="file">
                        </span>
                      </form>
                    </div>
                </div> <!-- upload-files -->
              </div><!-- instructions -->
            </form>
      
          </div> <!-- like-to-translate -->
        
          <div class="your-order your-result">
            <div class="your-result-inner">
              <h2>Your Result</h2>
              <ul>
                <li><p>Total Words</p> <span class='total_words'>0</span></li>
                <li><p>Languages</p> <span class='language_count'>0</span></li>
                <li><p>Purpose</p> <span>none</span></li>
                <li><p>Type</p> <span>none</span></li>
                <li><p>Your Price</p> <span class='final_price'>$0.00</span></li>
              </ul>
              <div class="pay-method">
                <p>Estimated delivery <span>5 days</span></p>
                <div class="custom-checkbox">
                  <input id="checkbox-1" name="checkbox-3" type="checkbox">
                        <label for="checkbox-1" class="checkbox-custom-label">I agree to the Terms & Conditions and Quality Policy</label>    
                        
                </div>
                <h2>Payment method:</h2>
                <div class="custom-radio">
                  <ul class="pay-option">
                    <li>
                      <input type="radio" id="pay-1" name="pay">
                      <label for="pay-1">PayPal</label>
                      <div class="check"></div>
                    </li>
                    <li>
                      <input type="radio" id="pay-2" name="pay">
                      <label for="pay-2">Credit card</label>
                      <div class="check"><div class="inside"></div></div>
                    </li>
                  </ul>
                </div> <!-- custom-radio -->
                <div class="btn-wrap pay-now">
                  <form action="<?php echo e(url('/translation-application/step-three')); ?>" class="" method="POST">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" name="final_amount" class="final_amount" value="">
                    <script
                      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                      data-key="pk_test_r4CeAbcQPVt8E2CMepdZOz3l"
                      data-image="http://localhost/eqho/uploads/header-image_Y1thKMaaDZWL0OUuDlDY.png"                      data-name="eqho.com"
                      data-description="Payment of translations"
                      data-amount="34343">
                    </script>

                  </form>
                </div>
              </div>
            </div><!--  your-result-inner -->
            <div class="btn-wrap view-full">
              <input value="View Full Quote" name="" class="btn_ctrl" type="button" onclick="myFunction()" />
            </div>
          </div> <!-- your-order -->
        </div> <!-- translator-wrap -->
      </div>
    </section>

 <section class="odering-process-1">
      <div class="eqho-container">
        <div class="eqho-clear-fix translator-wrap">
          <div class="like-to-translate">
  </div></div></div></section>
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