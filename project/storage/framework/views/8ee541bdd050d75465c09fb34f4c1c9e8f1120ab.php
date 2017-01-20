<section class="we-translate">
      <div class="eqho-container">
        <div class="cloud-wrapper">
          <h3>What We <span>Translate</span></h3>
          <div class="cloud-inner">
            <?php
              $dataUrl=url('/');                
              $url=explode('index.php',$dataUrl);
              $i=1;
            ?>
                <?php if(count($sections)): ?>
                  <?php foreach($sections as $section): ?>
                    <?php if($section->section_type=='what-we-translate'): ?>
                    <div class="what_we_translate_<?php echo e($i); ?>" >
                      <?php echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."' title='".$section->image_title."'>"; ?>
                      <a href="#" title="<?php echo e($section->title); ?>"><?php echo e($section->title); ?></a>
                      <div class="cloud-tool-tip">
                        <h4><?php echo e($section->title); ?></h4>
                        <?php echo e($section->description); ?>

                      </div>
                    </div>
                    <?php $i++; ?>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
            </div>    
          </div> <!-- cloud-wrapper -->
      </div><!--  eqho-container -->
    </section>