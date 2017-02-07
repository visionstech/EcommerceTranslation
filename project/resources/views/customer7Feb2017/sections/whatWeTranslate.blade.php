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
                @if(count($sections))
                  @foreach($sections as $section)
                    @if($section->section_type=='what-we-translate')
                    <div class="what_we_translate_{{ $i }}" >
                      <?php echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."' title='".$section->image_title."'>"; ?>
                      <a href="#" title="{{ $section->title }}">{{ $section->title }}</a>
                      <div class="cloud-tool-tip">
                        <h4>{{ $section->title }}</h4>
                        {{ $section->description }}
                      </div>
                    </div>
                    <?php $i++; ?>
                    @endif
                  @endforeach
                @endif
            </div>    
          </div> <!-- cloud-wrapper -->
      </div><!--  eqho-container -->
    </section>