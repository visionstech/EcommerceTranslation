<header class="main-header">
    <div class="eqho-container ">
      <div class="eqho-clear-fix top-menu-bar">
        <div class="eqho-logo">
          <a href="#" rel="home" title="EQHO">
            <?php 
            $dataUrl=url('/');                
            $url=explode('index.php',$dataUrl);
          ?>  <!-- Header Image -->
          @if(count($sections))
            @foreach($sections as $section)
              @if($section->section_type=='header-image')
                <?php  echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."' width='220' height='62'>"; ?>
              @endif
            @endforeach
          @endif
          </a>
        </div><!-- eqho-logo -->
        <div class="main-menu-wrap">
          <div class="main-menu-content">
            <nav class="menu-navigation" role="navigation" aria-label="Primary Menu">
              <ul class="primary-menu">
                <?php  $current_url = Request::url();
                       $homePageUrl=url('/');
                ?>
                @if($current_url==$homePageUrl)
                  @if(count($sections))
                    @foreach($sections as $section)
                      @if($section->section_type=='header-menus')
                        <li><a href="#" title="{{ $section->title }}">{{ $section->title }}</a></li>
                      @endif
                    @endforeach
                  @endif
                @else
                  <li><a href="#" title="Order Translation">Order Translation</a></li>
                  <li><a href="#" title="HOME">Contact Sales</a></li>
                @endif
                @if(Auth::user())
               <li><a href="{{ url('/auth/logout') }}" title="SIGN OUT">SIGN OUT</a></li>  
                @else
                 <li><a href="{{ url('/auth/login') }}" title="SIGN IN">SIGN IN</a></li>
                              
                @endif
              </ul>
            </nav>
            <div class="menu-toggle-wrap"><i id="menu-toggle" class="fa fa-bars" aria-hidden="true"></i></div>
          </div> <!-- main-menu-content -->
        </div> <!-- main-menu-wrap -->
      </div> <!-- top-menu-bar -->
    </div> <!-- eqho-container -->
  </header>