<script type="text/javascript" src="<?php echo e(asset('/customer/js/jquery-v3.1.1.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/customer/js/slick.min.js')); ?>"></script>
<script src="<?php echo e(asset('/customer/js/jquery-ui.js')); ?>"></script>
 <script type="text/javascript" src="<?php echo e(asset('/customer/js/jquery.form.js')); ?>"></script>
<script>


$(document).ready(function(){
  //$('.over-lay').show();
  var baseUrl='<?php echo url('/'); ?>';
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
  //Get Cart Data on Page load

  $.ajax({
        
        url: baseUrl+'/translation-application/cart-update',
        type:'get',
        processData: false,
        contentType: false,
        success: function(res) {
          var data = $.parseJSON(res);
          //console.log(data[0]);return false;
          $('.item-to-translate').html(data[1]);
          var TotalWords= $('.switch_total').html();
          
          $('#content').val(data[0]);
          $('#trashedItems').html(data[2]);
          $('.total_words').html(TotalWords);
        }
      });
  //End Get Cart Data on Page load

  $('.popup-close').click(function(){
    $('.over-lay').hide();
  });

  

  $('#myForm input[class=file]').change(function(){
      //$("#testSub").click();
      var bar = $('#bar1');
      var percent = $('#percent1');
      var data = new FormData();
      var file = $(".file");
      InvalidFiles=[];
      $.each($(file), function (i, obj) {
          $.each(obj.files, function (j, file) {
            if(file.type=='application/pdf'){
                data.append("files[" + j + "]", file);
            }else{
              InvalidFiles.push(file.name);
            }
        })
      });
      data.append('_token',$('#token').val());
      data.append('content',$('#content').val());
      
      if(InvalidFiles.length > 0){
          var errorString='';
          $.each(InvalidFiles, function( index, value ) {
             errorString += '<tr><td><img src="<?php echo e(asset("/customer/img/multiple-docs.png")); ?>" title="plain-text" alt="plain-text"></td><td>'+value+'</td></tr>';
            //errorString +=value;
            //errorString +='<br/>';
          });
         // alert(errorString);
          $('#error-tbody').html(errorString);
          $('.over-lay').show();
      }

      $.ajax({
        
        url: baseUrl+'/translation-application/cart-update',
        type:'post',
       // data: {'_token':$('#token').val()},
        data: data,
        processData: false,
        contentType: false,
        beforeSend: function(){
           //alert('dfsdfsdfsdfsdfsdfsdf');return false;
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

          var data = $.parseJSON(res);
          $('.item-to-translate').html(data[1]);
          var TotalWords= $('.switch_total').html();
          
          $('#content').val(data[0]);
          $('.total_words').html(TotalWords);
        },
        complete: function(xhr) {
          if(xhr.responseText)
          {
            document.getElementById("output_image").innerHTML=xhr.responseText;
          }
        }
      }); 
      //$("#testSub").click();

      //alert('sfsdfsd');
  });

});

  //Step One Save Cart Data

/*function upload_image() 
{*/



 /*$('.file').change(function () {
  
  var bar = $('#bar1');
  var percent = $('#percent1');
  var data = new FormData();
  var file = $(".file");
  InvalidFiles=[];
  $.each($(file), function (i, obj) {
      $.each(obj.files, function (j, file) {
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
});*/

function trashElement(value){
   var baseUrl='<?php echo url('/'); ?>';
    $.ajax({
        
        url: baseUrl+'/translation-application/cart-update/'+value,
        type:'get',
        processData: false,
        contentType: false,
        success: function(res) {
          var data = $.parseJSON(res);
          //console.log(data[2]);return false;
          $('.item-to-translate').html(data[1]);
          var TotalWords= $('.switch_total').html();
          
          $('#content').val(data[0]);
          $('#trashedItems').html(data[2]);
          $('.total_words').html(TotalWords);
        }
      });

}

function restoreElement(value){
   var baseUrl='<?php echo url('/'); ?>';
    $.ajax({
        
        url: baseUrl+'/translation-application/cart-update/'+value+'/restore',
        type:'get',
        processData: false,
        contentType: false,
        success: function(res) {
          var data = $.parseJSON(res);
          //console.log(data[2]);return false;
          $('.item-to-translate').html(data[1]);
          var TotalWords= $('.switch_total').html();
          
          $('#content').val(data[0]);
          $('#trashedItems').html(data[2]);
          $('.total_words').html(TotalWords);
        }
      });

}

</script>