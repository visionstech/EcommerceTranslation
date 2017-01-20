<div class="banner-section">
<?php 
  $dataUrl=url('/');                
  $url=explode('index.php',$dataUrl);
?>  <!-- Banner Image -->
        <?php if(count($sections)): ?>
          <?php foreach($sections as $section): ?>
            <?php if($section->section_type=='banner-image'): ?>
            <?php  
            echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."'>"; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endif; ?>
    <!-- Banner Content -->
    <div class="banner-info">
      <?php if(count($sections)): ?>
        <?php foreach($sections as $section): ?>
          <?php if($section->section_type=='banner-info'): ?>
            <?php echo $section->description; ?>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
      <div class="slider-link">
        <a href="#" title="Get a quotation">Get a quotation</a>
        <a href="#" title="Contact sales">Contact sales</a>
      </div>
    </div>
    <!-- Banner Bottom Logos -->
    <div class="banner-bottom-logos">
      <div class="eqho-container">
        <div class="header-slider">
          <?php if(count($sections)): ?>
          <?php foreach($sections as $section): ?>
            <?php if($section->section_type=='banner-bottom-logos'): ?>
              <div> 
                <a href="#">
                  <?php  
                    echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."'>"; 
                  ?>
                </a>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endif; ?>

        <?php if(count($sections)): ?>
          <?php foreach($sections as $section): ?>
            <?php if($section->section_type=='banner-bottom-logos'): ?>
              <div> 
                <a href="#">
                  <?php  
                    echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."'>"; 
                  ?>
                </a>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endif; ?>
          

        </div>  <!-- header-slider -->      
      </div>
    </div> <!-- banner-bottom-logos -->
  </div> <!-- banner-section -->