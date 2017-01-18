 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo e(asset('/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
       
        <li class="<?php echo e((strpos($_SERVER['REQUEST_URI'],'dashboard') != false)?'active':''); ?>">
          <a href="<?php echo e(url('/dashboard')); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php if(Auth::user()->role_id==1){ ?>
                <li class="<?php echo e((strpos($_SERVER['REQUEST_URI'],'user') != false)?'active':''); ?>">
                  <a href="<?php echo e(url('/user')); ?>">
                    <i class="fa fa-users"></i> <span>Manage Users</span>
                  </a>
                </li>
                <li class="<?php echo e((strpos($_SERVER['REQUEST_URI'],'role') != false)?'active':''); ?>">
                  <a href="<?php echo e(url('/role')); ?>">
                    <i class="fa fa-user"></i> <span>Manage User Roles</span>
                  </a>
                </li>
                <li class="<?php echo e((strpos($_SERVER['REQUEST_URI'],'homepage-section') != false)?'active':''); ?> treeview">
                  <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Homepage Sections</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo e(url('/homepage-section/our-promises')); ?>"><i class="fa fa-circle-o"></i> Manage Our Promises</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Manage Features</a></li>
                  </ul>
                </li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>