@extends('customer.front-app')
@section('title')
  Translation Order
@endsection
@section('content')
<?php $dataUrl=url('/');                
      $url=explode('index.php',$dataUrl); //echo "<pre>";print_r($translateTo);exit;
?>

    <section class="odering-process-1">
      <div class="eqho-container">
        <div class="eqho-clear-fix translator-wrap">
          <div class="like-to-translate">
            <div class="loading_overlay">           
              <div class="loader_img">
                <img src="{{ asset('/customer/img/loading.gif') }}" alt="system" title="system" />
              </div> 
            </div>      
              <form>
              @include('errors.frontend_errors')
              <div class="purpose">
                <h2>What will you use the translation for?</h2>
                <input type="hidden" name="_token" id='token' value="{{ csrf_token() }}">
                <input type="hidden" id="purpose" name="purpose" vaue=""/>
                <div class="form-group">
                  <label>Your choice will help us price your order correctly</label>
                  <button type="button" id="" class="purpose-btn">-- Select purpose --</button>

                  <ul class="purpose-list">
                  <?php $c=1; ?>
                  @foreach($languagePackages as $languagePackage)
                    <li class="package_li" id="li-{{$c}}">
                      <div class="purpose-list-text">
                        <h6>{{ $languagePackage->name }}</h6>
                          <?php  echo $languagePackage->description; ?>
                      </div>
                    </li>
                  <?php $c++; ?>
                  @endforeach
                  </ul>
                  
                </div>
                <div class="purpose-type">
                  <table class="purpose-type-table">
                    <thead class="custom-radio">
                      <tr>
                        <?php $d=1; ?>
                        @foreach($languagePackages as $languagePackage)
                          <th>
                            <input type="radio" id="sel-radio-{{$d}}" class="radio_package {{ $languagePackage->name }}" name="selector">
                            <label data-id="{{$d}}" class="sel-radio" for="sel-radio-{{$d}}">{{ $languagePackage->name }}</label>
                            <div class="check"></div>
                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                          </th>
                        <?php $d++; ?>
                        @endforeach
                        <th>                         
                          <label data-id="3" class="" for="sel-radio-3">Add-on services</label>
                          <i class="fa fa-question-circle" aria-hidden="true"></i>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php $d=1; ?>
                        @foreach($languagePackages as $languagePackage)
                        <?php //echo strip_tags($languagePackage->description,'<ul><li></li>'); ?>
                          <td>
                            <div class="purpose-list-text">
                              <?php echo $languagePackage->description; ?>
                            </div>
                          </td>
                        <?php $d++; ?>
                        @endforeach
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
                        @foreach($languagePackages as $languagePackage)
                          <td><?php echo 'From $'.$languagePackage->price_per_word.'/word'; ?></td>
                        @endforeach
                        <td><a href="#" title="Contact Sales">Contact Sales</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>  <!-- purpose-type -->
                  
              </div> <!-- purpose -->
              <div class="btn-wrap">
                <a href="{{ url('/translation-application/step-two') }}" class="btn_ctrl back-btn no-margin"> Back to: Choose Languages </a>
              </div>

              <div class="existing-customer">
                <h4>Are you an existing customer?</h4>
                <p class="hide_after_login">If so, you can select:</p>
                 <?php $projectTranslator =  ($projectTranslator!=null)?($projectTranslator->translator_id):'';
                 /*if($projectTranslator){
                    $checked='checked';
                 }else{
                    $checked='';
                 }*/
                 ?>
                @if(!empty($translateTo))
                  @foreach($translateTo as $translateT)
                  <div class="">
                  Translate To: {{ $translateT['destination'] }}
                  <input type="hidden" name="translateto" value="{{ $translateT['id'] }}" />
                    <ul class="existing-option">
                      <li class="hide_after_login">                      
                        <label for="ex-radio-1">A translator you worked with previously</label>
                        <div class="check"></div>
                      </li>
                      <div id='previous_translators'> 
                     
                        <div class="form-group previous_data">
                          <label>Previous Translator</label>
                          <select name="previous_translator[]" data-id="{{ $translateT['id'] }}" class="option-select previous_translator" > 
                            <option value=''>-- Select your Translator --</option>
                            @if(count($previousTranslators))
                              @foreach($previousTranslators as $previousTranslator)
                                <option value='{{ $previousTranslator->translator_id }}' <?php if($translateT['previous_translator']==$previousTranslator->translator_id){echo "selected";} ?>>{{ $previousTranslator->translatorEmail }}</option>
                              @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                      <?php /*$gloosary =  ($projectGloosaries!=null)?($projectGloosaries->file_name):'';
                            $brief =  ($projectBriefs!=null)?($projectBriefs->file_name):'';
                            $style =  ($projectStyles!=null)?($projectStyles->file_name):'';*/
                            /*if($gloosary || $brief || $style){
                              $checkedAsset='checked';
                            }else{
                              $checkedAsset='';
                            }*/
                      ?>
                      <li class="hide_after_login">                      
                        <label for="ex-radio-2">An existing translation asset (e.g. Glossary) stored in your account</label>
                        <div class="check"><div class="inside"></div></div>
                      </li>
                      <div id='assets'>

                        <div class="form-group previous_data">
                          <label>Existing Translation Glossary</label>
                          <select name="previous_gloosary" data-id="{{ $translateT['id'] }}" class="option-select previous_gloosary" > 
                            <option value=''>-- Select your Gloosary --</option>
                            @if(count($previousAssets))
                              @foreach($previousAssets as $previousAsset)
                                @if($previousAsset->asset_type=='glossary')
                                  <option value='{{ $previousAsset->file_name }}' <?php if($translateT['previous_glossary']==$previousAsset->file_name){echo "selected";} ?> >{{ $previousAsset->file_name }}</option>
                                @endif
                              @endforeach
                            @endif
                          </select>
                        </div>
                      </div>
                    </ul>
                  </div>
                  @endforeach
                @endif

                <div class="existing-login">
                @if(!Auth::user())
                  <input type="button" value="Login" name="" class="btn_ctrl login_pop" />
                @else  
                  <input type="button" value="Save" name="" onclick="saveOptionalData('previous');" class="btn_ctrl" />
                   <span class="complete"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Done</span>
                @endif
                </div>
              </div> <!-- existing-customer -->

              <div class="instructions">
                <h4>Instructions for translator  <span>(Optional)</span></h4>
                <div class="form-group">
                <?php $tone =  ($projectInstructions!=null)?($projectInstructions->tone):'';?>
                  <label>What tone you are looking for in your translation?</label>
                  <select name="tone" class="option-select tone" onchange="saveOptionalData('instruction');" >   <option value=''>-- Select your option --</option>
                    <option value='Formal' <?php if($tone=='Formal'){ echo 'selected'; } ?> >Formal</option>
                    <option value='Informal' <?php if($tone=='Informal'){ echo 'selected'; } ?>>Informal</option>
                    <option value='Friendly' <?php if($tone=='Friendly'){ echo 'selected'; } ?>>Friendly</option>
                    <option value='Business' <?php if($tone=='Business'){ echo 'selected'; } ?>>Business</option>
                  </select>
                 </div>
                 <?php $instruction =  ($projectInstructions!=null)?($projectInstructions->instruction):'';?>
                <div class="form-group">
                  <label>Instructions for the translator</label>
                  <textarea onblur="saveOptionalData('instruction');" name="instruction" class="instruction" placeholder="Write your instructions here...">{{$instruction}}</textarea>                  
                </div>
              @if(!empty($translateTo))
                @foreach($translateTo as $translateT)
                   Translate To: {{ $translateT['destination'] }} <hr>
                  <div class="upload-files">
                    <span class="lable-text">Upload your brief</span>
                      <div class="upload-files-btn">                     
                          <span type="button" class="fileinput-button">
                                  <span>Upload Files</span>
                                  <input data-id="{{ $translateT['id'] }}" name="file" multiple="multiple" name="brief" class="brief" onchange="saveOptionalData('brief');" size="1" type="file">
                          </span>
                      </div>
                      <span class="complete"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Done</span>
                      <div class="file-information">
                        <ul>
                          @if(count($allProjectAssets))
                              @foreach($allProjectAssets as $allProjectAsset)
                               <li> {{ $allProjectAsset->file_name }}</li>
                              @endforeach
                          @endif
                        </ul>
                      </div>
                  </div> <!-- upload-files -->
                  <div class="upload-files">
                    <span class="lable-text">Upload a glossary</span>
                      <div class="upload-files-btn">
                          <span type="button" class="fileinput-button">
                            <span>Upload Files</span>
                            <input data-id="{{ $translateT['id'] }}" name="file" multiple="multiple" name="gloosary" class="gloosary" onchange="saveOptionalData('glossary');" size="1" type="file">
                          </span>
                      </div>
                      
                      <span class="complete"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Done</span>
                      <div class="file-information">
                        <ul> @if(count($allProjectAssets))
                                @foreach($allProjectAssets as $allProjectAsset)
                                 <li> {{ $allProjectAsset->file_name }}</li>
                                @endforeach
                              @endif
                          </ul>
                      </div>
                  </div> <!-- upload-files -->
                  <div class="upload-files">
                    <span class="lable-text">Upload brand/ style guide</span>
                      <div class="upload-files-btn">
                          <span type="button" class="fileinput-button">
                                <span>Upload Files</span>
                                <input data-id="{{ $translateT['id'] }}" name="file" multiple="multiple" name="style" class="style" onchange="saveOptionalData('style');" size="1" type="file">
                          </span>
                      </div>

                      <span class="complete"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Done</span>
                      <div class="file-information">
                        <ul>
                          @if(count($allProjectAssets))
                              @foreach($allProjectAssets as $allProjectAsset)
                               <li> {{ $allProjectAsset->file_name }}</li>
                              @endforeach
                          @endif
                         </ul>
                      </div>
                  </div>    <!-- upload-files -->
                @endforeach
              @endif
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
                </div> <!-- custom-radio<script src="https://checkout.stripe.com/checkout.js"></script>

                      <button id="customButton">Purchase</button>-->
                <div class="btn-wrap pay-now">
                  <input value="Pay Now" name="" class="btn_ctrl pay_button" type="button">
                  <form action="{{ url('/translation-application/step-three') }}" class="payment_form" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="final_amount" class="final_amount" value="">
                    <script
                      src="https://checkout.stripe.com/checkout.js" id="stripeForm" class="stripe-button"
                      data-key="pk_test_r4CeAbcQPVt8E2CMepdZOz3l"
                      data-image="<?php echo $url[0]; ?>uploads/header-image_Y1thKMaaDZWL0OUuDlDY.png" data-name="eqho.com"
                      data-description="Payment of translations"
                      >
                     
                    </script>
                  </form>
                </div>
              </div>
            </div><!--  your-result-inner -->
            @if(count($getCartItems))
              <div class="btn-wrap view-full">
                <input value="View Full Quote" name="" class="btn_ctrl" type="button" onclick="getQuote()" />
              </div>
            @endif
          </div> <!-- your-order -->
        </div> <!-- translator-wrap -->
      </div>

      <div class="eqho-container">
        <div class="over-lay login_popup">
          <div class="sign-in-popup">
            <h1>Sign In <span class="close_login"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span></h1>
            <form action="{{ url('/auth/login') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="popup-text">
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
              </div>
              <div class="sign-btn-wrap">
                <input class="btn-ctrl" type="submit" name="" value="Sign In" />
              </div>
              </form>
              <div class="popup-error-msg">
                <p class="error">Error Message</p>
                <p><a href="#">Forgot Password ?</a> <a href="#">Not Yet Registered ?</a></p>
              </div>
            </div>  
          </div> <!-- sign-in-popup -->
        </div>
      </div>
    </section>
    <!-- Error Popup --> 
      <div class="over-lay terms_popup">
          <div class="unsupported-popup">
            <h1>Please Accept terms and conditions first<span class="close-icon popup-close"><i class="fa fa-times popup-close" aria-hidden="true"></i></span></h1>
            <div class="popup-close-btn">
              <input type="submit" name="" value="Close" class="popup-close" />
            </div>
          </div> <!-- unsupported-popup -->
      </div> <!-- over-lay --> 

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
@endsection

  