<script type="text/javascript" src="{{ asset('/customer/js/jquery-v3.1.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('/customer/js/slick.min.js') }}"></script>
<script src="{{ asset('/customer/js/jquery-ui.js') }}"></script>
<script>
$(document).ready(function(){
  // ......... Menu Toggle .............
  
  //..................Menu Toggle END..................
  var baseUrl='<?php echo url('/'); ?>';

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

    //Custom Js of cstomer dashboard pages.

    $('.popup-close').click(function() {
      $('.invalidFiles').hide();
    });

    var validFiles=['ppt','pptx','doc','docx','xls','xlsm','xlsx','rtf','odt','txt','pdf'];  
    $('input[class=file]').change(function(){
      var bar = $('#bar1');
      var percent = $('#percent1');
      var data = new FormData();
      var file = $(".file");
      InvalidFiles=[];
      var nameFile=file[0].files[0].name;
      var fileExtension = nameFile.substr( (nameFile.lastIndexOf('.') +1) );
      if($.inArray(fileExtension, validFiles) !== -1){
        data.append("file", file[0].files[0]);
      }else{
        InvalidFiles.push(nameFile);
      }
      data.append('_token',$('#token').val());
      data.append('asset_type',$('#asset_type').val());
      data.append('asset_id',$('#asset_id').val());     
            
      if(InvalidFiles.length > 0){
          var errorString='';
          $.each(InvalidFiles, function( index, value ) {
             errorString += '<tr><td><img src="{{ asset("/customer/img/multiple-docs.png") }}" title="plain-text" alt="plain-text"></td><td>'+value+'</td></tr>';
          });
          $('#error-tbody').html(errorString);
          $('.invalidFiles').show();
          return false;
      }
      //console.log(data);return false;
      $.ajax({        
        url: baseUrl+'/customer/update-asset',
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
          $('.doc-text').html(data['fileName']);
          $('.imageLogo').attr('src',data['imageLogo']);
          $('.fileNames').html('<span>File names:</span> '+data['fileName']);               
          setTimeout(function(){ $('#progress_div').hide(); }, 900);          
        }
      });
  });
  
});

</script>
