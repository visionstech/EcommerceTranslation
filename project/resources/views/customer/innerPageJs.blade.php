<script type="text/javascript" src="{{ asset('/customer/js/jquery-v3.1.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('/customer/js/slick.min.js') }}"></script>
<script src="{{ asset('/customer/js/jquery-ui.js') }}"></script>
 <script type="text/javascript" src="{{ asset('/customer/js/jquery.form.js') }}"></script>
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
  $('#trashedItems').hide();
  $('.del-arrow').hide();
  $('.del-permanent').hide();
  $('#content').show();
  $.ajax({
        
        url: baseUrl+'/translation-application/cart-update',
        type:'get',
        processData: false,
        contentType: false,
        success: function(res) {
          var data = $.parseJSON(res);
          $('.item-to-translate').html(data[1]);
          var TotalWords= $('.switch_total').html();
          //console.log(data);return false;
          $('#content').val(data[0]);
          if(data[0]){
            $('#content').hide();
          }
          if(data[2]){
            $('#trashedItems').html(data[2]);
            $('.deleted_count').html(data[4]);
            
            $('.del-arrow').show();
          }  
         
          $('.total_words').html(TotalWords);
        }
      });
  //End Get Cart Data on Page load

  $('.popup-close').click(function(){
    $('.over-lay').hide();
  });

  

  //$('#content').show();


  $('.del-arrow').click(function(){
    $('#trashedItems').toggle();
    $('.del-arrow').toggleClass('arrow-up');
    $('.del-permanent').toggle();
    
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
             errorString += '<tr><td><img src="{{ asset("/customer/img/multiple-docs.png") }}" title="plain-text" alt="plain-text"></td><td>'+value+'</td></tr>';
          });
          $('#error-tbody').html(errorString);
          $('.over-lay').show();
      }

      $.ajax({
        
        url: baseUrl+'/translation-application/cart-update',
        type:'post',
        data: data,
        processData: false,
        contentType: false,
        beforeSend: function(){
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
          
          if(data[0]){
            $('#content').val(data[0]);
            $('#content').hide();
          }
          if(data[2]){
            $('#trashedItems').html(data[2]);
            $('.deleted_count').html(data[4]);
            $('.del-arrow').show();
            $('.del-permanent').show();
          }  
          $('.total_words').html(TotalWords);
          setTimeout(function(){ $('#progress_div').hide(); }, 900);
          
        }
      });
  });

});

function trashElement(value){
   var baseUrl='<?php echo url('/'); ?>';
    $.ajax({
        
        url: baseUrl+'/translation-application/cart-update/Trashed/'+value,
        type:'get',
        processData: false,
        contentType: false,
        success: function(res) {
          var data = $.parseJSON(res);
          $('.item-to-translate').html(data[1]);
          var TotalWords= $('.switch_total').html();
          
         // $('#content').val(data[0]);
          //$('.del-wrap').show();
          if(data[0]){
            $('#content').val(data[0]);
            $('#content').hide();
          }
          if(data[2]){
            $('#trashedItems').html(data[2]);
            $('.deleted_count').html(data[4]);
            $('.del-arrow').show();
            $('.del-permanent').hide();
          }  
          //$('#trashedItems').html(data[2]);
          $('.total_words').html(TotalWords);
        }
      });

}

function restoreElement(value){
   var baseUrl='<?php echo url('/'); ?>';
    $.ajax({
        
        url: baseUrl+'/translation-application/cart-update/Active/'+value,
        type:'get',
        processData: false,
        contentType: false,
        success: function(res) {
          var data = $.parseJSON(res);
          //console.log(data[2]);return false;
          $('.item-to-translate').html(data[1]);
          var TotalWords= $('.switch_total').html();
          
          //$('#content').val(data[0]);
          //$('#trashedItems').html(data[2]);
          if(data[0]){
            $('#content').val(data[0]);
            $('#content').hide();
          }
          if(data[2]){
            $('#trashedItems').html(data[2]);
            $('.deleted_count').html(data[4]);
            $('.del-arrow').show();
          }
          $('.total_words').html(TotalWords);
        }
      });

}

function clearAllElements(){
   var baseUrl='<?php echo url('/'); ?>';
    $.ajax({
        
        url: baseUrl+'/translation-application/cart-update/clearAll',
        type:'get',
        processData: false,
        contentType: false,
        success: function(res) {
          var data = $.parseJSON(res);
          $('.item-to-translate').html('');
          var TotalWords= $('.switch_total').html();
          $('#content').val('');
          $('#content').show();
          $('.del-arrow').hide();
          $('.del-permanent').hide();
          $('#trashedItems').hide();
          $('#trashedItems').html('');
          $('.deleted_count').html(0);
          $('.total_words').html(0);
        }
      });
}

function delete_permanently(){
   var baseUrl='<?php echo url('/'); ?>';
    $.ajax({
        
        url: baseUrl+'/translation-application/cart-update/delete_permanently',
        type:'get',
        processData: false,
        contentType: false,
        success: function(res) {
          var data = $.parseJSON(res);
          $('.del-arrow').hide();
          $('.del-permanent').hide();
          $('#trashedItems').hide();
          $('#trashedItems').html('');
          $('.deleted_count').html(0);
        }
      });
}

// order process select list
  $(".select-langs").click(function(){
      $(".show-1").toggle();
  });
  $(".select-langs").blur(function(){
      $(".show-1").hide();
  });
  
  $('.all-languages li').click( function() {
    if ($(this).hasClass("active-li")) {
      $(this).removeClass("active-li");
    }
    else{
      $(this).addClass("active-li");
    }
  });

  $(".translate-btn, .popup-close").click(function(){
      $(".lang-popup").toggle();
  });
  
  //........... end .......
  
</script>