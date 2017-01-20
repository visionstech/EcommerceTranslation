<section class="our-client">
      <div class="eqho-container">
        <h3>Our <span>Clients</span></h3>
        <div class="client-inner">
          <ul>
            <?php
                $dataUrl=url('/');                
                $url=explode('index.php',$dataUrl);
            ?>
            <?php if(count($sections)): ?>
                  <?php foreach($sections as $section): ?>
                    <?php if($section->section_type=='clients'): ?>

                    <li>
                      <div class="clients-images">
                        <?php
                          echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."' title='".$section->image_title."'>"; 
                        ?>
                      </div>
                    </li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
          </ul>
        </div> <!-- client-inner -->
      </div>
    </section>  <!-- our-client -->