
<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo e(url('/dashboard/dashboard')); ?>" class="site_title"></i> 
              <!--<span>VICE Digital LLC</span>-->
                  <img src="<?php echo e(asset('/images/VICE_DIGITAL_WHITE-02-(1).png')); ?>" />
              </a>
            </div>
            <div class="clearfix"></div> <br />
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="<?php echo e(url('/dashboard')); ?>"><i class="fa fa-home"></i>Dashboard</a></li>
                  <li><a href="<?php echo e(url('/dashboard/configuration')); ?>"><i class="fa fa-cog"></i> Configuration</a></li>
                 <li class="<?php echo e((strpos($_SERVER['REQUEST_URI'],'publisher') != false)?'current-page':''); ?>"><a href="<?php echo e(url('/publisher')); ?>"><i class="fa fa-newspaper-o"></i> Publishers</a></li>
                 <?php if(Auth::user()->role==1) { ?>
                    <li class="<?php echo e((strpos($_SERVER['REQUEST_URI'],'user') != false)?'current-page':''); ?>" ><a href="<?php echo e(url('/user')); ?>"><i class="fa fa-users"></i> User Management System</a></li>
                 <?php } ?>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>
