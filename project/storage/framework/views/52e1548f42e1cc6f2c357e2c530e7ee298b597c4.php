<script type="text/javascript" src="<?php echo e(asset('/customer/js/jquery-v3.1.1.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/customer/js/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset('/customer/js/jquery-ui.js')); ?>"></script>
<script>
$(document).ready(function(){
  // ......... Menu Toggle .............
  $("#menu-toggle").click(function(){
      $(".menu-navigation").toggle(400);
    $("#menu-toggle").toggleClass("menu-active");
  });
  //..................Menu Toggle END..................
  $(" a").click(function (e) {
     e.preventDefault();
      $temphref = $(this).attr("href");
      $('html, body').animate({
          scrollTop: $($temphref).offset().top - 50  }, 2000);
  });
  // ......... Banner Slider .............
  $('.header-slider').slick({
    dots: false,
    infinite: true,
    arrows: false,
      autoplaySpeed: 2000,
    slidesToShow: 6,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1170,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          infinite: true,
          dots: false
        }
      },
      {
        breakpoint: 980,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 650,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 390,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
  // ......... Banner Slider-End .............

  // ....... Client Slider-function .........
   $('.slider-for').slick({ 
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
  });
  $('.slider-nav').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    arrows: false,
    dots: false,
    focusOnSelect: true,
    responsive: [
      {
        breakpoint: 1280,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 1,
          infinite: true,
          dots: false
        }
      },
      {
        breakpoint: 1170,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
          infinite: true,
          dots: false
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          dots: false
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });
  // ....... Slider-function End.........
  
  // ....... Accordian-function .........
  $( function(){
      $( "#faq-accordion" ).accordion();
    });
  // ....... Accordian-function End .........

  // ....... Add class-function to header.........
      var url      = window.location.href; 
      var Homepage='<?php echo url('/');?>';
      if((url==Homepage)){
        $(window).scroll(function() {   
         
            var scroll = $(window).scrollTop();
            if (scroll >= 100) {
                $(".main-header").addClass("fix-header");
            }
            else{
              $(".main-header").removeClass("fix-header");
            }
        });
      }else{
          $(".main-header").addClass("fix-header");
      }
  // ....... END.........

  // ........ stop touch zoom script ............
  document.documentElement.addEventListener('touchstart', function (event) {
    if (event.touches.length > 1) {
      event.preventDefault();
    }
  }, false);
  // ....... END.........
});

</script>