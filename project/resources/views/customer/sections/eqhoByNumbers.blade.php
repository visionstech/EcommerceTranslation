<section class="eqho-by-number">
      <div class="eqho-container">
        <div class="number-wrapper">
          <h3>EQHO <span>by Numbers</span></h3>
          <ul>
          <?php
              $dataUrl=url('/');                
              $url=explode('index.php',$dataUrl);
          ?>
                @if(count($sections))
                  @foreach($sections as $section)
                    @if($section->section_type=='eqho-by-numbers')
                    <li>
                      <div class="eqho-number-content">
                      <?php echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."'>"; ?>
                        <h4 class="border-after">{{ $section->title }}</h4>
                        <p>{{ $section->description }}</p>
                      </div>
                    </li>
                    @endif
                  @endforeach
                @endif
          </ul>
        </div>
      </div><!--  eqho-container -->
    </section>