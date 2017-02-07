<header class="dashboard-header">
    <div class="dash-container">
      <div class="eqho-clear-fix top-menu-bar">
        <div class="dash-eqho-logo">
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
        <div class="dash-main-menu-wrap">
          <div class="dash-main-menu-content">
            <nav role="navigation" aria-label="Primary Menu">
              <ul class="dash-primary-menu">
                <li><a class="welcome" href="#" title="Welcome"><i class="fa fa-user" aria-hidden="true"></i> Welcome steven <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                  <div class="user-option">
                    <ul>
                      <li><a href="#" title="Account">Account</a></li>
                      <li><a href="#" title="Settings">Settings</a></li>
                    </ul>
                  </div>
                </li>
                <li><a class="sign-out" href="{{ url('/auth/logout') }}" title="Sign Out"><i class="fa fa-power-off" aria-hidden="true"></i> Sign Out</a></li>
                <li><div class="dash-menu-toggle-wrap"><i id="menu-toggle" class="fa fa-bars" aria-hidden="true"></i></div></li>
              </ul>            
            </nav>
            
          </div> <!-- main-menu-content -->
        </div> <!-- main-menu-wrap -->
      </div> <!-- top-menu-bar -->
    </div> <!-- eqho-container -->
  </header>