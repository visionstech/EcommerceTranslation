<section class="our-promise" id="our-promise">
  <div class="eqho-container">
    <div class="promise-content">
      <h3>Our <span>Promise</span></h3>
      <?php if(count($sections)): ?>
        <?php foreach($sections as $section): ?>
          <?php if($section->section_type=='our-promises'): ?>
            <h4><?php echo e($section->title); ?></h4>
            <p class="border-after"><?php echo e($section->description); ?></p>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </div><!-- promise-content -->
  </div>
</section>