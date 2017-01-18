<section class="how-it-work-wrap">
      <div class="eqho-container">
        <h3>How it <span> Works</span></h3>
        <div class="how-it-work-container">
                  <?php $i=1; ?>
                  @if(count($sections))
                    @foreach($sections as $section)
                      @if($section->section_type=='how-it-works')
                        <div class="how-it-work">
                          <div class="circlebox">
                            <div class="circleboximg">
                              @if($i==1)
                              <img src="{{ asset('/customer/img/estimate.png') }}" alt="estimate" title="Estimate" />
                              @elseif($i==2)
                              <img src="{{ asset('/customer/img/uplode.png') }}" alt="uplode" title="Upload" />
                              @else
                              <img src="{{ asset('/customer/img/approved.png') }}" alt="approved" title="Approved" />
                              @endif
                            </div>
                          </div>
                          <a href="#" title="Sign Up">
                            <div class="boxcontent">
                              <div class="stepbox">0{{ $i }}<span>STEP</span></div>
                          <h3>{{ $section->title }}</h3>
                          <div class="content">
                            <p align="center">{{ $section->description }}</p>
                          </div>
                        </div>
                        </a>
                      </div> <!-- how-it-work -->
                          <?php $i++; ?>
                        @endif

                    @endforeach
                  @endif
        </div> <!-- how-it-work-container -->
      </div> <!--  eqho-container -->
    </section>