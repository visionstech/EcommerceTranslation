<script type="text/javascript" src="{{ asset('/customer/js/jquery-v3.1.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('/customer/js/slick.min.js') }}"></script>
<script src="{{ asset('/customer/js/jquery-ui.js') }}"></script>
 <script type="text/javascript" src="{{ asset('/customer/js/jquery.form.js') }}"></script>
<script>
$(document).ready(function(){
  // ......... Menu Toggle .............
  $("#menu-toggle").click(function(){
      $(".menu-navigation").toggle(400);
    $("#menu-toggle").toggleClass("menu-active");
  });

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

  // ........ stop touch zoom script ............
  document.documentElement.addEventListener('touchstart', function (event) {
    if (event.touches.length > 1) {
      event.preventDefault();
    }
  }, false);
  // ....... END.........
});

  //Step One Save Cart Data

/*function upload_image() 
{*/

 $('.btn_ctrl').click(function () {
  var bar = $('#bar1');
  var percent = $('#percent1');
  var data = new FormData();
  var file = $(".file");
  InvalidFiles=[];
  $.each($(file), function (i, obj) {
      $.each(obj.files, function (j, file) {
        //console.log(file.type);
        //InvalidFiles.push(file.type);
        if(file.type=='application/pdf'){
            data.append("files[" + j + "]", file);
        }else{
          InvalidFiles.push(file.name);
        }
    })
  });

  if(InvalidFiles.length > 0){
      var errorString='Invalid File Formats';
      $.each(InvalidFiles, function( index, value ) {

        errorString +=value;
        errorString +='<br/>';
      });
      alert(errorString);
  }

  $('#myForm').ajaxForm({
    beforeSubmit: function() {
      document.getElementById("progress_div").style.display="block";
      var percentVal = '0%';
      bar.width(percentVal)
      percent.html(percentVal);
    },

    uploadProgress: function(event, position, total, percentComplete) {
      var percentVal = percentComplete + '%';
      bar.width(percentVal)
      percent.html(percentVal);
    },
    
    success: function(res) {
      var percentVal = '100%';
      bar.width(percentVal)
      percent.html(percentVal);

      $('.item-to-translate').html(res);
      var TotalWords= $('.switch_total').html();
      $('.total_words').html(TotalWords);
    },

    complete: function(xhr) {
      if(xhr.responseText)
      {
        document.getElementById("output_image").innerHTML=xhr.responseText;
      }
    }
  }); 
});



</script>