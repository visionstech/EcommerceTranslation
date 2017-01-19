<section class="faq-wrap">
      <div class="eqho-container">
        <h3>Frequently Asked <span>Questions</span></h3>
        <div class="faq-inner">
          <div id="faq-accordion">
            <?php if(count($sections)): ?>
                <?php $i=1;?>
                <?php foreach($sections as $section): ?>
                  <?php if($section->section_type=='faqs'): ?>
                    <?php if($i<10){$dec='0';}else{$dec='';}?>
                    <h3><span class="order-list"><?php echo e($dec.$i); ?></span><span class="question"><?php echo e($section->title); ?>?</span></h3>
                    <div class="faq-accordion-text">
                        <p><?php echo e($section->description); ?></p>
                    </div>
                <?php $i++;?>
                  <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
          </div> <!-- faq-accordion -->
        </div> <!-- faq-inner -->
      </div>
    </section> <!-- faq-wrap -->