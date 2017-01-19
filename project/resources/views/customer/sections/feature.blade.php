<section class="features">
      <div class="eqho-container">
        <div class="features-content">
          <h3>Features</h3>
          <ul>
               <?php
                  $dataUrl=url('/');                
                  $url=explode('index.php',$dataUrl);
              ?>
                @if(count($sections))
                  @foreach($sections as $section)
                    @if($section->section_type=='features')
                    <li>
                      <div class="eqho-number-content">
                      <?php echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."' title='".$section->image_title."'>"; ?>
                        <h2>{{ $section->title }}</h2>
                        <p>{{ $section->description }}</p>
                      </div>
                    </li>
                    @endif
                  @endforeach
                @endif
          </ul>
        </div> <!-- features-content -->
      </div>
    </section>