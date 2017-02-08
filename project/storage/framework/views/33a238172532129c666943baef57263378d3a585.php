<section class="eqho-by-number">
      <div class="eqho-container">
        <div class="number-wrapper">
          <h3>EQHO <span>by Numbers</span></h3>
          <ul>
          <?php
              $dataUrl=url('/');                
              $url=explode('index.php',$dataUrl);
          ?>
                <?php if(count($sections)): ?>
                  <?php foreach($sections as $section): ?>
                    <?php if($section->section_type=='eqho-by-numbers'): ?>
                    <li>
                      <div class="eqho-number-content">
                      <?php echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."'>"; ?>
                        <h4 class="border-after"><?php echo e($section->title); ?></h4>
                        <p><?php echo e($section->description); ?></p>
                      </div>
                    </li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
          </ul>
        </div>
      </div><!--  eqho-container -->
    </section>