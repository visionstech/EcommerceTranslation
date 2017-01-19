<section class="our-promise">
  <div class="eqho-container">
    <div class="promise-content">
      <h3>Our <span>Promise</span></h3>
      @if(count($sections))
        @foreach($sections as $section)
          @if($section->section_type=='our-promises')
            <h4>{{ $section->title }}</h4>
            <p class="border-after">{{ $section->description }}</p>
          @endif
        @endforeach
      @endif
    </div><!-- promise-content -->
  </div>
</section>