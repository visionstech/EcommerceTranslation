@extends('customer.front-app')
@section('title')
  Translation Order
@endsection
@section('content')
<?php 
  $dataUrl=url('/');                
  $url=explode('index.php',$dataUrl);
?>
    <section class="odering-process-1">
      <div class="eqho-container">
        <div class="eqho-clear-fix translator-wrap">
          <div class="like-to-translate">
            <form action="" id="step2" name="step2" method="post">
               <input type="hidden" name="_token" id='token' value="{{ csrf_token() }}">
              <div class="select-lang">
                <h2>Select Your Languages</h2>
                <div class="form-group">
                  <label>Translate From</label>
                  <select name="source" class="source">
                    <option>-- Select Your File Language --</option>
                    @foreach($languages as $language)
                      <option value="{{ $language->id }}">{{ $language->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="translate_to_summary">
                  <div class="form-group">
                    <label class="clear-label">Translate To <span onclick="clearAllLanguages();" >Clear all languages</span></label>
                  </div>
                  <div class="translate-table-wrap">
                    <table>
                      <thead>
                        <tr>
                          <th>Language</th>
                          <th>Word Price</th>
                          <th>Words</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody id="added_langs">
                      </tbody>
                    </table>
                  </div> <!-- translate-table-wrap -->
                </div>
                <div class="form-group translate_to_popup">
                  <label>Translate To</label>
                
                  <button type="button" id="" class="translate-btn">-- Translate to --</button>
                  
                </div>
                  <div class="lang-popup">
                    <h1><span class="choose_langs">Choose Languages (0) </span><span class="close_choose"><i class="fa fa-times popup-close" aria-hidden="true"></i></span></h1>
                    <div class="translate-from">
                      <h5>Translate From</h5>

                      <div class="language-selected">
                        <p class="select-langs"  data-id=""><span id="selected_lang" data-id="{{ $languages[0]->id }}"><img src="{{ asset('/customer/img/english-lang.jpg') }}" alt="english" title="english">{{ $languages[0]->name }}</span><span class="list-caret-down"><i class="fa fa-caret-down" aria-hidden="true"></i></span></p>
                        <ul class="show-1">
                          @foreach($languages as $language)
                            <li id="{{ $language->id }}" class="from_lang_li">
                            <?php   
                              $image = ((!empty($language)) ? $language->image : ''); 
                              if($image){
                                  echo "<img src='".$url[0].'uploads/'.$language->image."' alt='".$language->image."'>";
                              }else{
                            ?><img src="{{ asset('/customer/img/english-lang.jpg') }}" alt="{{ $language->name }} " title="{{ $language->name }} ">

                           <?php  } ?>
                            {{ $language->name }} 
                            </li>
                          @endforeach       
                          
                        </ul>
                        
                      </div> <!-- language-selected -->

                      <h5>Translate To</h5>

                    </div> <!-- translate-from -->
                    <div class="all-languages">
                      <ul class="eqho-clear-fix">
                       @foreach($languages as $language)
                          <li id="{{ 'selectedLangs_'.$language->id }}" data-id="{{ $language->id }}">
                          <?php   
                              $image = ((!empty($language)) ? $language->image : ''); 
                              if($image){
                                //echo "sdfsdfsf";exit;
                                  echo "<img src='".$url[0].'uploads/'.$language->image."' alt='".$language->name."'>";
                              }else{
                          ?>
                                  <img src="{{ asset('/customer/img/english-lang.jpg') }}" alt="{{ $language->name }} " title="{{ $language->name }} ">

                      <?php  } ?> 
                          {{ $language->name }} 
                          </li>
                        @endforeach
                      </ul>
                    </div> <!-- all-languages -->
                    <div class="total-lang">
                      <p>Selected Languages: (0)</p>
                    </div>
                    <div class="btn-wrap popup-btn-wrap">
                     
                      <input type="submit" name="submit" class="btn_ctrl step2_save" value="Add Language" />
                    </div>
                  </div> <!-- lang-popup -->
                  
              </div> <!-- select-lang -->
              <div class="btn-wrap">
                <a href="{{ url('/translation-application/step-one') }}" class="btn_ctrl back-btn">Back: Upload files</a>
                <a href="{{ url('/translation-application/step-three') }}" class="btn_ctrl">Next: Choose Purpose</a>
              </div>
            </form>
          </div> <!-- like-to-translate -->
        
          <div class="your-order">
            <h2>Your Result</h2>
            <ul>
              <li><p>Total Words</p> <span class='total_words'>0</span></li>
                <li><p>Languages</p> <span class='language_count'>0</span></li>
                <li><p>Purpose</p> <span class='package_purpose'>none</span></li>
                <li><p>Type</p> <span class='package_name'>none</span></li>
                <li><p>Your Price</p> <span class='final_price'>$0.00</span></li>
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
@endsection

  