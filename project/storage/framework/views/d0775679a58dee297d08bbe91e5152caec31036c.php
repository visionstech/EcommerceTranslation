<section class="how-it-work-wrap">
      <div class="eqho-container">
        <h3>How it <span> Works</span></h3>
        <div class="how-it-work-container">
                  <?php $i=1; ?>
                  <?php if(count($sections)): ?>
                    <?php foreach($sections as $section): ?>
                      <?php if($section->section_type=='how-it-works'): ?>
                        <div class="how-it-work">
                          <div class="circlebox">
                            <div class="circleboximg">
                              <?php if($i==1): ?>
                              <img src="<?php echo e(asset('/customer/img/estimate.png')); ?>" alt="estimate" title="Estimate" />
                              <?php elseif($i==2): ?>
                              <img src="<?php echo e(asset('/customer/img/uplode.png')); ?>" alt="uplode" title="Upload" />
                              <?php else: ?>
                              <img src="<?php echo e(asset('/customer/img/approved.png')); ?>" alt="approved" title="Approved" />
                              <?php endif; ?>
                            </div>
                          </div>
                          <a href="#" title="Sign Up">
                            <div class="boxcontent">
                              <div class="stepbox">0<?php echo e($i); ?><span>STEP</span></div>
                          <h3><?php echo e($section->title); ?></h3>
                          <div class="content">
                            <p align="center"><?php echo e($section->description); ?></p>
                          </div>
                        </div>
                        </a>
                      </div> <!-- how-it-work -->
                          <?php $i++; ?>
                        <?php endif; ?>

                    <?php endforeach; ?>
                  <?php endif; ?>
        </div> <!-- how-it-work-container -->
      </div> <!--  eqho-container -->
    </section>