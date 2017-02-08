<section class="how-it-work-wrap" id="how-it-works">
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
                                <?php $default='estimate.png'; $alt='estimate';?>                              
                              <?php elseif($i==2): ?>
                                <?php $default='uplode.png'; $alt='uplode';?>  
                              <?php else: ?>
                                <?php $default='approved.png'; $alt='approved';?>
                              <?php endif; ?>
                              <?php if($section->image): ?>
                                  <img src="<?php echo e(asset('/uploads/'.$section->image)); ?>" alt="<?php echo e($alt); ?>" title="Estimate" />
                              <?php else: ?>
                                  <img src="<?php echo e(asset('/customer/img/'.$default)); ?>" alt="<?php echo e($alt); ?>" title="Estimate" />
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