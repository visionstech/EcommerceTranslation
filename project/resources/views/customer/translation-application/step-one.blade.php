@extends('customer.front-app')
@section('title')
  Translation Order
@endsection
@section('content')

    <section class="odering-process-1" id="Step-one">
      <div class="eqho-container">
        <div class="eqho-clear-fix translator-wrap">
        <form id='myForm' name="frmupload" method="post"  enctype='multipart/form-data'>
           <input type="hidden" name="_token" id='token' value="{{ csrf_token() }}">
          <div class="like-to-translate">
          <div class="loading_overlay">           
            <div class="loader_img">
                <img src="{{ asset('/customer/img/loading.gif') }}" alt="system" title="system" />
              </div> 
            </div> 
            <div class="translate-inner">
              <h2>What would you like to translate?</h2>
              <p><a onclick="clearAllElements();" href="javascript:void(0)">Clear All Words</a></p>

              <div class="translate-content">
                <textarea placeholder="Type your text here..." id='content' name='content'></textarea>
                <div class="item-to-translate">
                </div>
                <div class='progress' id="progress_div">
                  <div class='bar' id='bar1'></div>
                  <div class='percent' id='percent1'>0%</div>
                </div>
                <div class="upload-files">
                  <span class="lable-text">Or Click to upload file</span>
                    <div class="upload-files-btn">
                       <span type="button" class="fileinput-button">
                            <span>Upload Files</span>
                            <input name="file[]" class="file" multiple type="file">       
                        </span>                      
                    </div>
                </div> <!-- upload-files -->
                <div class="del-wrap">
                    <h4><span class="del-arrow"><i class="fa fa-trash-o" aria-hidden="true"></i> <span class='deleted_count'> 0 </span>Deleted Elements</span> <span class="del-permanent"><a onclick="delete_permanently();">Delete permanently</a></span></h4>
                    <div class="item-to-translate" id="trashedItems">
                    </div>
                </div>
              </div> <!-- translate-content -->
         
            </div> <!-- translate-inner -->
            <div class="btn-wrap">
             <!-- <input type='submit'  value='Next: Choose Languages' id='testSub' class='btn_ctrl' >-->
              <a href="{{ url('/translation-application/step-two') }}" class="btn_ctrl">Next: Choose Languages</a>
            </div>
            <div class="guidelines">
              <h4>GUIDELINES</h4>
              <ul>
                <li>
                  <p><i class="fa fa-question-circle" aria-hidden="true"></i> Files that we accept</p>
                  <div class="guide-tool-tip">
                    <h5>We accept the following files:</h5>
                    <div class="guide-file-type">
                      <p><img src="{{ asset('/customer/img/acrobat.png') }}" title="acrobat" /> <span class="file-name">Acrobat</span> <span class="extension">.pdf</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/excel.png') }}" title="excel" /> <span class="file-name">Excel</span> <span class="extension">.xls, .xlsx, .xlsm</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/open-office.png') }}" title="open-office" /> <span class="file-name">Open Office</span> <span class="extension">.odt</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/power-point.png') }}" title="power-point" /> <span class="file-name">PowerPoint</span> <span class="extension">.ppt, .pptx</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/plain-text.png') }}" title="plain-text" /> <span class="file-name">Plain Text</span> <span class="extension">.txt</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/word.png') }}" title="word" /> <span class="file-name">.doc, .docx</span> <span class="extension">.pdf</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/rich-text-format.png') }}" title="rich-text-format" /> <span class="file-name">Rich Text Format</span> <span class="extension">.rtf</span> </p>
                    </div>
                    <div class="guide-file-text">
                      <p>We only accept files that have extractable text. Please note that we cannot accept images or documents where text is contained in an image. For more info, visit our <a href="#" title="FAQ">FAQ</a>.</p>
                    </div>
                  </div>
                </li>
                <li>
                  <p><i class="fa fa-question-circle" aria-hidden="true"></i> Exclude code and mark-up from your word count</p>
                  <div class="guide-tool-tip">
                    <h5>We accept the following files:</h5>
                    <div class="guide-file-type">
                      <p><img src="{{ asset('/customer/img/acrobat.png') }}" alt='acrobat' title="acrobat" /> <span class="file-name">Acrobat</span> <span class="extension">.pdf</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/excel.png') }}" title="excel" /> <span class="file-name">Excel</span> <span class="extension">.xls, .xlsx, .xlsm</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/open-office.png') }}" title="open-office" /> <span class="file-name">Open Office</span> <span class="extension">.odt</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/power-point.png') }}" title="power-point" /> <span class="file-name">PowerPoint</span> <span class="extension">.ppt, .pptx</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/plain-text.png') }}" title="plain-text" /> <span class="file-name">Plain Text</span> <span class="extension">.txt</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/word.png') }}" title="word" /> <span class="file-name">.doc, .docx</span> <span class="extension">.pdf</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/rich-text-format.png') }}" title="rich-text-format" /> <span class="file-name">Rich Text Format</span> <span class="extension">.rtf</span> </p>
                    </div>
                    <div class="guide-file-text">
                      <p>We only accept files that have extractable text. Please note that we cannot accept images or documents where text is contained in an image. For more info, visit our <a href="#" title="FAQ">FAQ</a>.</p>
                    </div>
                  </div>
                </li>
                <li>
                  <p><i class="fa fa-question-circle" aria-hidden="true"></i> Layout and other services</p>
                  <div class="guide-tool-tip">
                    <h5>We accept the following files:</h5>
                    <div class="guide-file-type">
                      <p><img src="{{ asset('/customer/img/acrobat.png') }}" title="acrobat" /> <span class="file-name">Acrobat</span> <span class="extension">.pdf</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/excel.png') }}" title="excel" /> <span class="file-name">Excel</span> <span class="extension">.xls, .xlsx, .xlsm</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/open-office.png') }}" title="open-office" /> <span class="file-name">Open Office</span> <span class="extension">.odt</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/power-point.png') }}" title="power-point" /> <span class="file-name">PowerPoint</span> <span class="extension">.ppt, .pptx</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/plain-text.png') }}" title="plain-text" /> <span class="file-name">Plain Text</span> <span class="extension">.txt</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/word.png') }}" title="word" /> <span class="file-name">.doc, .docx</span> <span class="extension">.pdf</span> </p>
                      
                      <p><img src="{{ asset('/customer/img/rich-text-format.png') }}" title="rich-text-format" /> <span class="file-name">Rich Text Format</span> <span class="extension">.rtf</span> </p>
                    </div>
                    <div class="guide-file-text">
                      <p>We only accept files that have extractable text. Please note that we cannot accept images or documents where text is contained in an image. For more info, visit our <a href="#" title="FAQ">FAQ</a>.</p>
                    </div>
                  </div>
                </li>
              </ul>
              
            </div>
          </div> <!-- like-to-translate -->
         </form>
         
          <div class="your-order">
            <h2>Your Order</h2>
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
   <!-- Error Popup --> 
      <div class="over-lay">
              <div class="unsupported-popup">
                <h1>Unsupported file format <span class="close-icon"><i class="fa fa-times popup-close" aria-hidden="true"></i></span></h1>
                <table class="error-table">
                  <tbody id='error-tbody'>
                    <tr>
                      <td><img src="{{ asset('/customer/img/multiple-docs.png') }}" title="plain-text" alt="plain-text"></td>
                      <td>File-type.png</td>
                    </tr>
                    <tr>
                      <td><img src="{{ asset('/customer/img/multiple-docs.png') }}" title="acrobat" alt="acrobat"></td>
                      <td>File-type.png</td>
                    </tr>
                  </tbody>
                </table>
                <p>Files listed above have not been uploaded, because they are in a format that we do not support.</p>
                <div class="popup-close-btn">
                  <input type="submit" name="" value="Close" class="popup-close" />
                </div>
              </div> <!-- unsupported-popup -->
            </div> <!-- over-lay --> 

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

  