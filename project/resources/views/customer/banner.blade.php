<div class="banner-section">
<?php 
  $dataUrl=url('/');                
  $url=explode('index.php',$dataUrl);
?>  <!-- Banner Image -->
        @if(count($sections))
          @foreach($sections as $section)
            @if($section->section_type=='banner-image')
            <?php  
            echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."'>"; ?>
            @endif
          @endforeach
        @endif
    <!-- Banner Content -->
    <div class="banner-info">
    <?php $c=1; ?>
      @if(count($sections))

        @foreach($sections as $section)
          @if($section->section_type=='banner-info')
            <?php 
            if($c<2){
              echo $section->description;
            }
            $c++; ?>
          @endif
        @endforeach
      @endif
      <div class="slider-link">
        <a href="#" title="Get a quotation">Get a quotation</a>
        <a href="#" title="Contact sales">Contact sales</a>
      </div>
    </div>
    <!-- Banner Bottom Logos -->
    <div class="banner-bottom-logos">
      <div class="eqho-container">
        <div class="header-slider">
          @if(count($sections))
          @foreach($sections as $section)
            @if($section->section_type=='banner-bottom-logos')
              <div> 
                <a href="#">
                  <?php  
                    echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."'>"; 
                  ?>
                </a>
              </div>
            @endif
          @endforeach
        @endif

        @if(count($sections))
          @foreach($sections as $section)
            @if($section->section_type=='banner-bottom-logos')
              <div> 
                <a href="#">
                  <?php  
                    echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."'>"; 
                  ?>
                </a>
              </div>
            @endif
          @endforeach
        @endif
          

        </div>  <!-- header-slider -->      
      </div>
    </div> <!-- banner-bottom-logos -->
  </div> <!-- banner-section -->