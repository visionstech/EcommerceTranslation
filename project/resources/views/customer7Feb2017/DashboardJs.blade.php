<script type="text/javascript" src="{{ asset('/customer/js/jquery-v3.1.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('/customer/js/slick.min.js') }}"></script>
<script src="{{ asset('/customer/js/jquery-ui.js') }}"></script>
<script>
$(document).ready(function(){
  // ......... Menu Toggle .............
  
  //..................Menu Toggle END..................
  

  $("#menu-toggle").click(function(){
    $("aside.dashboard-menu").toggleClass("aside-active");
    });
  // ......... Welcome Menu Toggle .............
  $(".welcome").click(function(){
      $(".user-option").toggle("slide", { direction: "up" }, 500);
  });
  //.................. END..................
  // ......... dashboard submenu toggle .............
  $(".has-child").click(function(){
      $(".sub-child").toggle("slide", { direction: "up" }, 500);
  });
  //.................. END..................
    
  // ........ stop touch zoom script ............
  document.documentElement.addEventListener('touchstart', function (event) {
    if (event.touches.length > 1) {
      event.preventDefault();
    }
  }, false);
  // ....... END.........
  function setHeight() {
      windowHeight = $('.dashboard-content').innerHeight();
      $('.dashboard-menu').css('min-height', windowHeight);
    };
    setHeight();
    
    $('.dashboard-content').resize(function() {
      setHeight();
    });
  
});

</script>
