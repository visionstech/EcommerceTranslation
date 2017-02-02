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
                <input type="hidden" name="_token" id='token' value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" id="purpose" name="purpose" vaue=""/>
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
                            <input type="radio" id="sel-radio-<?php echo e($d); ?>" class="radio_package <?php echo e($languagePackage->name); ?>" name="selector">
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
                        <?php foreach($languagePackages as $languagePackage): ?>
                          <td><?php echo 'From $'.$languagePackage->price_per_word.'/word'; ?></td>
                        <?php endforeach; ?>
                        <td><a href="#" title="Contact Sales">Contact Sales</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>  <!-- purpose-type -->
                  
              </div> <!-- purpose -->
              <div class="btn-wrap">
                <a href="<?php echo e(url('/translation-application/step-two')); ?>" class="btn_ctrl back-btn no-margin"> Back to: Choose Languages </a>
              </div>
              <?php if($latestOrderId != 0): ?>
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
                    <div id='previous_translators'>
                      <div class="form-group">
                        <label>Translators</label>
                        <select name="previous_translator" class="option-select previous_translator" > 
                          <option value=''>-- Select your Translator --</option>
                          <?php if(count($previousTranslators)): ?>
                            <?php foreach($previousTranslators as $previousTranslator): ?>
                              <option value='<?php echo e($previousTranslator->translator_id); ?>'><?php echo e($previousTranslator->translatorEmail); ?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                    </div>
                    <li>
                      <input type="radio" id="ex-radio-2" name="existing-assets">
                      <label for="ex-radio-2">An existing translation asset (e.g. Glossary) stored in your account</label>
                      <div class="check"><div class="inside"></div></div>
                    </li>
                    <div id='assets'>
                      <div class="form-group">
                        <label>Gloosaries</label>
                        <select name="previous_gloosary" class="option-select previous_gloosary" > 
                          <option value=''>-- Select your Gloosary --</option>
                          <?php if(count($previousGloosaries)): ?>
                            <?php foreach($previousGloosaries as $previousGloosary): ?>
                              <option value='<?php echo e($previousGloosary->file_name); ?>'><?php echo e($previousGloosary->file_name); ?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Briefs</label>
                        <select name="previous_brief" class="option-select previous_brief" >  
                          <option value=''>-- Select your Brief --</option>
                           <?php if(count($previousBriefs)): ?>
                            <?php foreach($previousBriefs as $previousBrief): ?>
                              <option value='<?php echo e($previousBrief->file_name); ?>'><?php echo e($previousBrief->file_name); ?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Styles</label>
                        <select name="previous_style" class="option-select previous_style">  
                          <option value=''>-- Select your style --</option>
                           <?php if(count($previousStyles)): ?>
                            <?php foreach($previousStyles as $previousStyle): ?>
                              <option value='<?php echo e($previousStyle->file_name); ?>'><?php echo e($previousStyle->file_name); ?></option>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                    </div>
                  </ul>
                </div>
                <div class="existing-login">
                <?php if(!Auth::user()): ?>
                  <input type="button" value="Login" name="" class="btn_ctrl" />
                <?php else: ?>  
                  <input type="button" value="Save" name="" onclick="saveOptionalData('previous');" class="btn_ctrl" />
                <?php endif; ?>
                </div>
              </div> <!-- existing-customer -->
              <?php endif; ?>
              <div class="instructions">
                <h4>Instructions for translator  <span>(Optional)</span></h4>
                <div class="form-group">
                  <label>What tone you are looking for in your translation?</label>
                  <select name="tone" class="option-select" onchange="saveOptionalData('instruction');" >                    
                    <option value=''>-- Select your option --</option>
                    <option>Formal</option>
                    <option>Informal</option>
                    <option>Friendly</option>
                    <option>Business</option>
                  </select>
                 </div>
                <div class="form-group">
                  <label>Instructions for the translator</label>
                  <textarea onblur="saveOptionalData('instruction');" name="instruction" class="instruction" placeholder="Write your instructions here..."></textarea>                  
                </div>
                <div class="upload-files">
                  <span class="lable-text">Upload your brief</span>
                    <div class="upload-files-btn">                     
                        <span type="button" class="fileinput-button">
                                <span>Upload Files</span>
                                <input name="file" multiple="multiple" name="brief" class="brief" onchange="saveOptionalData('brief');" size="1" type="file">
                        </span>
                    </div>
                    <span class="complete"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Done</span>
                </div> <!-- upload-files -->
                <div class="upload-files">
                  <span class="lable-text">Upload a glossary</span>
                    <div class="upload-files-btn">
                        <span type="button" class="fileinput-button">
                          <span>Upload Files</span>
                          <input name="file" multiple="multiple" name="gloosary" class="gloosary" onchange="saveOptionalData('gloosary');" size="1" type="file">
                        </span>
                    </div>
                    <span class="complete"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Done</span>
                </div> <!-- upload-files -->
                <div class="upload-files">
                  <span class="lable-text">Upload brand/ style guide</span>
                    <div class="upload-files-btn">
                        <span type="button" class="fileinput-button">
                              <span>Upload Files</span>
                              <input name="file" multiple="multiple" name="style" class="style" onchange="saveOptionalData('style');" size="1" type="file">
                        </span>
                    </div>
                    <span class="complete"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Done</span>
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
                <li><p>Purpose</p> <span class='package_purpose'>none</span></li>
                <li><p>Type</p> <span class='package_name'>none</span></li>
                <li><p>Your Price</p> <span class='final_price'>$0.00</span></li>
              </ul>
              <div class="pay-method">
                <p>Estimated delivery <span>5 days</span></p>
                <div class="custom-checkbox">
                  <input id="checkbox-1" name="terms_condition" type="checkbox" value='1'>
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
                      <input type="radio" id="pay-2" name="pay" checked>
                      <label for="pay-2">Credit card</label>
                      <div class="check"><div class="inside"></div></div>
                    </li>
                  </ul>
                </div> <!-- custom-radio -->
                <div class="btn-wrap pay-now">
                  <input value="Pay Now" name="" class="btn_ctrl pay_button" type="button">
                  <form action="<?php echo e(url('/translation-application/step-three')); ?>" class="payment_form" method="POST">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" name="final_amount" class="final_amount" value="">
                    <script
                      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                      data-key="pk_test_r4CeAbcQPVt8E2CMepdZOz3l"
                      data-image="http://localhost/eqho/uploads/header-image_Y1thKMaaDZWL0OUuDlDY.png" data-name="eqho.com"
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