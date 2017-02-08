<section class="faq-wrap">
      <div class="eqho-container">
        <h3>Frequently Asked <span>Questions</span></h3>
        <div class="faq-inner">
          <div id="faq-accordion">
            @if(count($sections))
                <?php $i=1;?>
                @foreach($sections as $section)
                  @if($section->section_type=='faqs')
                    <?php if($i<10){$dec='0';}else{$dec='';}?>
                    <h3><span class="order-list">{{ $dec.$i }}</span><span class="question">{{ $section->title }}?</span></h3>
                    <div class="faq-accordion-text">
                        <p>{{ $section->description }}</p>
                    </div>
                <?php $i++;?>
                  @endif
                @endforeach
            @endif
          </div> <!-- faq-accordion -->
        </div> <!-- faq-inner -->
      </div>
    </section> <!-- faq-wrap -->