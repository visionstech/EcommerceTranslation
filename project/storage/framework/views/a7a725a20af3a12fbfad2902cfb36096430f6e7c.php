<?php $__env->startSection('title'); ?>
  Translation Order
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $dataUrl=url('/');                
      $url=explode('index.php',$dataUrl); 
?>
    <section class="odering-process-1">
      <div class="eqho-container">
        <div class="quote-wrap">
          <div class="form-filds">
          <form>
          <input type="hidden" name="_token"  id="token" value="<?php echo e(csrf_token()); ?>">
            <div class="form-group">
              <label>Company Name</label>
              <input class="form-ctrl company" onblur="saveUserCompany(this);" value="<?php echo e(($checkCompany!=null)?$checkCompany->company:''); ?>" type="text" name="company" placeholder="Enter Your Company Name" />
              <span class="complete"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Done</span>
            </div>
            <div class="form-group">
              <label>Company Address</label>
              <textarea class="form-ctrl address" onblur="saveUserCompany(this);" name="address" placeholder="Type your address here..."><?php echo e(($checkCompany!=null)?$checkCompany->address:''); ?></textarea>
              <span class="complete"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Done</span>
            </div>
            </form>
          </div> <!-- quote-form-filds -->
          
          <div class="quote-content">
            <h1>QUOTE</h1>
            <div class="quote-tables-erap">
              <table class="trashed">
                <thead>
                  <tr>
                    <th>Type</th>
                    <th>Content to be translated</th>
                    <th>Words</th>
                  </tr>
                </thead>
                <tbody>
                <?php $totalWords=0;?>
                <?php if(count($getCartItems)): ?>
                  <?php foreach($getCartItems as $getCartItem): ?> 
                  
                    <tr>
                    <?php if($getCartItem->file==null): ?>
                     <?php echo '<td class="type"><img src="'.$url[0].'/customer/img/plain-text.png" title="text" alt="text" /></td>';

                     $length=strlen($getCartItem->content);
                     $dots=($length>100)?'...':'';
                    ?>
                     <td><?php echo e($small = substr($getCartItem->content, 0, 100).$dots); ?></td>
                    <?php else: ?>
                    <?php
                    $filename='/var/www/html/eqho/'.$getCartItem->file_path.'/'.$getCartItem->file;
                    $contents = File::get($filename);
                    $res = preg_replace("/[^a-zA-Z0-9 ]/", "", $contents);

                      $filetype=explode('.', $getCartItem->file);
                      $getExtensionGet=$filetype[sizeof($filetype)-1];
                      switch($getExtensionGet){
                          case 'ppt':
                          $imageLogo='power-point.png';
                          break;
                          case 'pptx':
                          $imageLogo='power-point.png';
                          break;
                          case 'doc':
                          $imageLogo='word.png';
                          break;
                          case 'docx':
                          $imageLogo='word.png';
                          break;
                          case 'xls':
                          $imageLogo='excel.png';
                          break;
                          case 'xlsm':
                          $imageLogo='excel.png';
                          break;
                          case 'xlsx':
                          $imageLogo='excel.png';
                          break;
                          case 'rtf':
                          $imageLogo='rich-text-format.png';
                          break;
                          case 'odt':
                          $imageLogo='open-office.png';
                          break;
                          case 'txt':
                          $imageLogo='plain-text.png';
                          break;
                          case 'pdf':
                          $imageLogo='acrobat.png';
                          break;
                          default:
                          $imageLogo='acrobat.png';
                          break;
                      }
                      echo '<td class="type"><img src="'.$url[0].'/customer/img/'.$imageLogo.'" title="'.$getExtensionGet.'" alt="'.$getExtensionGet.'" /></td>';
                      $totalWords=$totalWords+$getCartItem->content_words;
                      $length=strlen($res);
                      $dots=($length>100)?'...':'';
                      ?>
                      <td><?php echo e(substr($res, 0, 100).$dots); ?></td>
                     
                    <?php endif; ?>
                      
                      <td><?php echo e($getCartItem->content_words); ?></td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
                  <tr>
                    <td colspan="2">Total: <?php echo e(count($getCartItems)); ?> file</td>
                    <td><?php echo e($totalWords); ?></td>
                  </tr>
                </tbody>
              </table>

              <table class="language">
                <thead>
                  <tr>
                    <th>Original Language</th>
                    <th>Language</th>
                    <th>Word Price</th>
                    <th>Words</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                <?php  $totalPrice=0; $counter=1;?>
                <?php if(count($languagesData)): ?>
                  <?php foreach($languagesData as $languagesDat): ?> 
                  <tr>
                    <?php if($counter==1): ?>
                      <td rowspan="<?php echo e(count($languagesData)); ?>"><?php echo e($languagesDat['fromLanguage']); ?></td>
                    <?php endif; ?>
                    <td>
                    <img src="<?php echo e($url[0]); ?>customer/img/chines-flag.png" title="<?php echo e($languagesDat['destinationLanguage']); ?>" alt="<?php echo e($languagesDat['destinationLanguage']); ?>" /> <?php echo e($languagesDat['destinationLanguage']); ?></td>
                    <td>$<?php echo e($languagesDat['perWordLanguagePrice']); ?> / word</td>
                    <?php if($counter==1): ?>
                      <td rowspan="<?php echo e(count($languagesData)); ?>"><?php echo e($totalWords); ?> Word</td>
                    <?php endif; ?>
                    <?php $totalPrice=$totalPrice+$languagesDat['LanguagePrice']; ?>
                    <td>$<?php echo e($languagesDat['LanguagePrice']); ?></td>
                  </tr>
                  <?php $counter++; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
                  <tr>
                    <td colspan="3"></td>
                    <td>Total</td>
                    <td>$<?php echo e($totalPrice); ?></td>
                  </tr>
                    
                </tbody>
              </table>
            </div> <!-- quote-tables-erap -->
            <div class="btn-wrap download">
              <a href="" class="btn_ctrl" download>Download</a>
            </div>
          </div><!-- quote-content -->
        
        </div> <!-- translator-wrap -->
      </div>
    </section>


<?php $__env->stopSection(); ?>

  
<?php echo $__env->make('customer.front-app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>