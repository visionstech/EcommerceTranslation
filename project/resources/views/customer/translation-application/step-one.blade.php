@extends('customer.front-app')
@section('title')
  Translation Order
@endsection
@section('content')

    <section class="odering-process-1">
      <div class="eqho-container">
        <div class="eqho-clear-fix translator-wrap">
        <form id='myForm' name="frmupload" method="post"  enctype='multipart/form-data'>
           <input type="hidden" name="_token" id='token' value="{{ csrf_token() }}">
          <div class="like-to-translate">
            <div class="translate-inner">
              <h2>What would you like to translate?</h2>
              <p>Clear All Words</p>

              <div class="translate-content">
                <textarea placeholder="Type your text here..." id='content' name='content'></textarea>
                <div class="item-to-translate">
                  <!--<table border="0">
                    <tr>
                      <td class="type"><img src="{{ asset('/customer/img/plain-text.png') }}" title="plain-text" alt="plain-text"></td>
                      <td class="perview">text...</td>
                      <td class="switch"><span class="words">370 words</span><span class="close"><a href="#" title="Edit">Edit</a> <i class="fa fa-times-circle-o" aria-hidden="true"></i></span></td>
                    </tr>
                    <tr>
                      <td class="type"><img src="{{ asset('/customer/img/acrobat.png') }}" title="acrobat" alt="acrobat" /></td>
                      <td class="perview">Acrobat.pdf</td>
                      <td class="switch"><span class="words">370 words</span><span class="close"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span></td>
                    </tr>
                    <tr>
                      <td class="type"><img src="{{ asset('/customer/img/acrobat.png') }}" title="acrobat" alt="acrobat" /></td>
                      <td class="perview">Acrobat.pdf</td>
                      <td class="switch"><span class="words">370 words</span><span class="close"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span></td>
                    </tr>
                    <tr>
                      <td class="type"><img src="{{ asset('/customer/img/multiple-docs.png') }}" title="multiple-docs" alt="multiple-docs" /></td>
                      <td class="perview">3 Items</td>
                      <td class="switch">741 words</td>
                    </tr>
                  </table>-->
                </div>
                <div>Deleted Elements</div>
                <div class="item-to-translate" id="trashedItems">
                </div>
                <div class="upload-files">
                  <span class="lable-text">Click to upload file</span>
                    <div class="upload-files-btn">
                       <span type="button" class="fileinput-button">
                            <span>Upload Files</span>
                            <input name="file[]" class="file" multiple type="file">
 
                              <div class='progress' id="progress_div">
                              <div class='bar' id='bar1'></div>
                              <div class='percent' id='percent1'>0%</div>
                              </div>
         
                        </span>                      
                    </div>
                </div> <!-- upload-files -->
                
              </div> <!-- translate-content -->
         
            </div> <!-- translate-inner -->
            <div class="btn-wrap">
              <input type='submit'  value='Next: Choose Languages' id='testSub' class='btn_ctrl' >
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
              <li><p>Languages</p> <span>0</span></li>
              <li><p>Purpose</p> <span>none</span></li>
              <li><p>Type</p> <span>none</span></li>
              <li><p>Your Price</p> <span>$0.00</span></li>
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

  