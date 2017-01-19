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
                                <?php $default='estimate.png'; $alt='estimate';?>                              
                              @elseif($i==2)
                                <?php $default='uplode.png'; $alt='uplode';?>  
                              @else
                                <?php $default='approved.png'; $alt='approved';?>
                              @endif
                              @if($section->image)
                                  <img src="{{ asset('/uploads/'.$section->image) }}" alt="{{ $alt }}" title="Estimate" />
                              @else
                                  <img src="{{ asset('/customer/img/'.$default) }}" alt="{{ $alt }}" title="Estimate" />
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