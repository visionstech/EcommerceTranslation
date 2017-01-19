<section class="features">
      <div class="eqho-container">
        <div class="features-content">
          <h3>Features</h3>
          <ul>
               <?php
                  $dataUrl=url('/');                
                  $url=explode('index.php',$dataUrl);
              ?>
                <?php if(count($sections)): ?>
                  <?php foreach($sections as $section): ?>
                    <?php if($section->section_type=='features'): ?>
                    <li>
                      <div class="eqho-number-content">
                      <?php echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."' title='".$section->image_title."'>"; ?>
                        <h2><?php echo e($section->title); ?></h2>
                        <p><?php echo e($section->description); ?></p>
                      </div>
                    </li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
          </ul>
        </div> <!-- features-content -->
      </div>
    </section>