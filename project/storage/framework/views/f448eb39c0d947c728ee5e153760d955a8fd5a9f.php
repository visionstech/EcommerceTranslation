<header class="main-header">
    <div class="eqho-container">
      <div class="eqho-clear-fix top-menu-bar">
        <div class="eqho-logo">
          <a href="<?php echo e(url('/')); ?>" rel="home" title="EQHO">
          <?php 
            $dataUrl=url('/');                
            $url=explode('index.php',$dataUrl);
          ?>  <!-- Header Image -->
          <?php if(count($sections)): ?>
            <?php foreach($sections as $section): ?>
              <?php if($section->section_type=='header-image'): ?>
                <?php  echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."' width='220' height='62'>"; ?>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php endif; ?>
          </a>
        </div><!-- eqho-logo -->
        <div class="main-menu-wrap">
          <div class="main-menu-content">
            <nav class="menu-navigation" role="navigation" aria-label="Primary Menu">
              <ul class="primary-menu">
                <?php  $current_url = Request::url();
                       $homePageUrl=url('/');
                ?>
                <?php if($current_url==$homePageUrl): ?>
                  <?php if(count($sections)): ?>
                    <?php foreach($sections as $section): ?>
                      <?php if($section->section_type=='header-menus'): ?>
                        <?php if($section->description=='#home'): ?>
                          <li><a class="menusClick" href="<?php echo e(url('/')); ?>" title="<?php echo e($section->title); ?>"><?php echo e($section->title); ?></a></li>
                        <?php else: ?>
                        <li><a class="menusClick" href="<?php echo e($section->description); ?>" title="<?php echo e($section->title); ?>"><?php echo e($section->title); ?></a></li>
                        <?php endif; ?>                        
                      <?php endif; ?>
                    <?php endforeach; ?>
                  <?php endif; ?>
                <?php else: ?>
                  <li><a href="<?php echo e(url('/')); ?>" title="Order Translation">Order Translation</a></li>
                  <li><a href="#" title="HOME">Contact Sales</a></li>
                <?php endif; ?>
                <?php if(Auth::user()): ?>
               <li><a href="<?php echo e(url('/auth/logout')); ?>" title="SIGN OUT">SIGN OUT</a></li>  
                <?php else: ?>
                 <li><a href="<?php echo e(url('/auth/login')); ?>" title="SIGN IN">SIGN IN</a></li>
                              
                <?php endif; ?>
              </ul>
            </nav>
            <div class="menu-toggle-wrap"><i id="menu-toggle" class="fa fa-bars" aria-hidden="true"></i></div>
          </div> <!-- main-menu-content -->
        </div> <!-- main-menu-wrap -->
      </div> <!-- top-menu-bar -->
    </div> <!-- eqho-container -->
  </header>