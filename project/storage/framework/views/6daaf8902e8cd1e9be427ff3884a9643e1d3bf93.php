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
  

  $('.popup-close').click(function(){
    $('.over-lay').hide();
  });

  
// Step 1 Cart Functionality of Saving Items

 //Get Cart Data on Page load
  $('#trashedItems').hide();
  $('.del-arrow').hide();
  $('.del-permanent').hide();
  $('#content').show();
  $.ajax({
        
        url: baseUrl+'/translation-application/cart-item',
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


  $('.del-arrow').click(function(){
    $('#trashedItems').toggle();
    $('.del-arrow').toggleClass('arrow-up');
    $('.del-permanent').toggle();
    
  });

  $('#myForm input[class=file]').change(function(){
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
          });
          $('#error-tbody').html(errorString);
          $('.over-lay').show();
      }

      $.ajax({
        
        url: baseUrl+'/translation-application/cart-item',
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
        
        url: baseUrl+'/translation-application/cart-item/Trashed/'+value,
        type:'get',
        processData: false,
        contentType: false,
        success: function(res) {
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
            $('.del-permanent').hide();
          }
          $('.total_words').html(TotalWords);
        }
      });

}

function restoreElement(value){
   var baseUrl='<?php echo url('/'); ?>';
    $.ajax({
        
        url: baseUrl+'/translation-application/cart-item/Active/'+value,
        type:'get',
        processData: false,
        contentType: false,
        success: function(res) {
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
          }else{
            $('#trashedItems').html('');
            $('.deleted_count').html(0);
            $('.del-arrow').hide();
          }
          $('.total_words').html(TotalWords);
        }
      });

}

function clearAllElements(){
   var baseUrl='<?php echo url('/'); ?>';
    $.ajax({
        
        url: baseUrl+'/translation-application/cart-item/clearAll',
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
        
        url: baseUrl+'/translation-application/cart-item/delete_permanently',
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
function editContent(){
  $('#content').show();
}
// Ending of Step 1 Cart Functionality of Saving Items


// order process select list

  
  //........... end .......
  
  // Start jQuery Of Step 2 Cart 
  

$(document).ready(function(){
  var baseUrl='<?php echo url('/'); ?>';

  $(".select-langs").click(function(){
      $(".show-1").toggle();
  });
  $(".select-langs").blur(function(){
      $(".show-1").hide();
  });

  $(document).on('click','.all-languages li',function() {
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
  $(document).on('click','.add-more',function() {
    $(".lang-popup").toggle();
  });
 $(".translate_to_summary").hide();
  $.ajax({        
        url: baseUrl+'/translation-application/cart-language',
        type:'get',
        processData: false,
        contentType: false,
        beforeSend: function(){
          $('.final_price').html('Calculating...');
          $('.language_count').html('Counting...');
        },
        success: function(res) {
          var data = $.parseJSON(res);
          $('#added_langs').html(data[0]);
          if(data[0]){
             $(".translate_to_popup").hide();
             $(".translate_to_summary").show();
          }
          $('.total_words').html(data[1]);
          $('.language_count').html(data[2]);
          $('.final_price').html(data[3]);
          
        }
  });
  $('.all-languages').html('');
  $(".source").change(function(){
      var Html ="<img src='<?php echo e(asset('/customer/img/english-lang.jpg')); ?>' alt='english' title='english'>";
      Html += $('.source option:selected').text();
      $("#selected_lang").html(Html);
      var fromLang=$('.source').val();
      $.ajax({        
          url: baseUrl+'/translation-application/valid-translations/'+fromLang,
          type:'get',
          success: function(res) {
            var data = $.parseJSON(res);
            $('.all-languages').html(data[0]);
          }
      });

      clearAllLanguages();

  });

  $(".from_lang_li").click(function(){
    $(".source").val($(this).attr('id'));
    $("#selected_lang").html($(this).html());
    $("#selected_lang").attr('data-id',$(this).attr('id'));
    var fromLang=$('.source').val();
      $.ajax({        
          url: baseUrl+'/translation-application/valid-translations/'+fromLang,
          type:'get',
          success: function(res) {
            var data = $.parseJSON(res);
            $('.all-languages').html(data[0]);
          }
      }); 
  });
  
  var ToLangs=[];
  $(document).on('click','.eqho-clear-fix > li',function() {  
    if($(this).hasClass('active-li')){
        ToLangs.push($(this).attr('data-id'));
    }else{
        var i = ToLangs.indexOf($(this).attr('data-id'));
        if(i != -1) {
          ToLangs.splice(i, 1);
        }
    }
    var languageSelected=ToLangs.length;
    $('.total-lang').find('p').html('Selected Languages: ('+languageSelected+')');
    $('.choose_langs').html('Choose Languages ('+languageSelected+')');
    
  });

  $("form#step2").submit(function(event) {
        
        event.preventDefault();
        var data = new FormData();
        var fromLang=$('#selected_lang').attr('data-id');
        data.append('_token',$('#token').val());
        data.append('from_language_id',fromLang);
        $.each($(ToLangs), function (i, obj) {
          data.append("to_language_id[" + i + "]", obj);
        });
        $('.final_price').html('Calculating...');
        $('.language_count').html('Counting...');
        $.ajax({        
          url: baseUrl+'/translation-application/cart-language',
          type:'post',
          data: data,
          processData: false,
          contentType: false,
          
          success: function(res) {
            var data = $.parseJSON(res);
            $('.lang-popup').hide();
            $('#added_langs').html(data[0]);
            if(data[0]){
               $(".translate_to_popup").hide();
               $(".translate_to_summary").show();
            }
            $('.total_words').html(data[1]);
            $('.language_count').html(data[2]);
            $('.final_price').html(data[3]);
          }
        }); 
    });
});

function clearAllLanguages(){
   var baseUrl='<?php echo url('/'); ?>';
    $('.final_price').html('Calculating...');
    $('.language_count').html('Counting...');
    $.ajax({
        
        url: baseUrl+'/translation-application/cart-language/Deleted',
        type:'get',
        processData: false,
        contentType: false,
        success: function(res) {
          var data = $.parseJSON(res);
          $(".translate_to_summary").hide();          
          $('#added_langs').html('');
          $(".translate_to_popup").show();
          $('.total_words').html(data[1]);
          $('.language_count').html(data[2]);

          
        }
      });
}
function trashTranslation(value){
   var baseUrl='<?php echo url('/'); ?>';
    $('.final_price').html('Calculating...');
    $('.language_count').html('Counting...');
    $.ajax({
        
        url: baseUrl+'/translation-application/cart-language/Trashed/'+value,
        type:'get',
        processData: false,
        contentType: false,
        success: function(res) {
          var data = $.parseJSON(res);
          $('.lang-popup').hide();
          $('#added_langs').html(data[0]);
          if(data[0]){
            $(".translate_to_popup").hide();
            $(".translate_to_summary").show();
          }
          $('.total_words').html(data[1]);
          $('.language_count').html(data[2]);
          $('.final_price').html(data[3]);
        }
      });

}

function restoreTranslation(value){
   var baseUrl='<?php echo url('/'); ?>';
    $('.final_price').html('Calculating...');
    $('.language_count').html('Counting...');
    $.ajax({
        
        url: baseUrl+'/translation-application/cart-language/Active/'+value,
        type:'get',
        processData: false,
        contentType: false,
        success: function(res) {
          var data = $.parseJSON(res);
          $('.lang-popup').hide();
          $('#added_langs').html(data[0]);
          if(data[0]){
            $(".translate_to_popup").hide();
            $(".translate_to_summary").show();
          }
          $('.total_words').html(data[1]);
          $('.language_count').html(data[2]);
          $('.final_price').html(data[3]);
          
        }
      });

}
// End jQuery Of Step 2 Cart 
</script>