<!DOCTYPE html>
<html>
<?php   
  $current_url = Request::url(); 
  $login_url = url('/').'/auth/login'; 
  $register_url = url('/').'/auth/register'; 
  $register_url2 = url('/').'/register'; 
  $login_url2 = url('/'); 
  $reset_password_url = url('/').'/auth/reset-password'; 
?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Eqho</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/backend_custom.css') }}">
  <?php if(!($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2 || (strpos($_SERVER['REQUEST_URI'],'reset-password') != false))) {
    $bodyClass='skin-blue sidebar-mini';
   ?>

          <link rel="stylesheet" href="{{ asset('/css/skins/_all-skins.min.css') }}">
          <!-- iCheck -->
          <link rel="stylesheet" href="{{ asset('/plugins/iCheck/flat/blue.css') }}">
          <!-- Morris chart -->
          <link rel="stylesheet" href="{{ asset('/plugins/morris/morris.css') }}">
          <!-- jvectormap -->
          <link rel="stylesheet" href="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
          <!-- Date Picker -->
          <link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
          <!-- Daterange picker -->
          <link rel="stylesheet" href="{{ asset('/plugins/daterangepicker/daterangepicker.css') }}">
          <!-- bootstrap wysihtml5 - text editor -->
          <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
            
  <?php }else{ $bodyClass='login-page';  ?>
          <!-- iCheck -->
          <link rel="stylesheet" href="{{ asset('/plugins/iCheck/square/blue.css') }}" />

  <?php } ?>

  @yield('css')
</head>
<body class="hold-transition <?php echo $bodyClass; ?>">
<div class="wrapper">
    @include('backend.header')		
    
    <?php if(!($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2 || (strpos($_SERVER['REQUEST_URI'],'reset-password') != false))) { ?>
	    @include('backend.aside')
            
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <?php if (Session::has('message')) { $message = Session::get('message'); ?>
                <label class=""> <?php echo $message; ?> </label>
            <?php Session::pull('message', 'User Registered Successfully!'); } ?>
        
    <?php } ?>
    @yield('content')
    
    <?php if(!($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2 || (strpos($_SERVER['REQUEST_URI'],'reset-password') != false))) { ?>
        </div>
    <?php } ?>
    
    @include('backend.footer')
    
    <!-- Scripts -->
    <!-- Jquery -->

<!-- jQuery 2.2.3 -->
<?php 
if(!($current_url == $login_url || $current_url == $login_url2 || $current_url == $register_url || $current_url == $register_url2 || (strpos($_SERVER['REQUEST_URI'],'reset-password') != false))) { ?>
    <script src="{{ asset('/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('/plugins/morris/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('/plugins/knob/jquery.knob.js') }}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{ asset('/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>    
    <!-- Slimscroll -->
    <script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('/plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/js/app.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <?php if($current_url==url('/dashboard')){ ?>
      <script src="{{ asset('/js/pages/dashboard.js') }}"></script>
      <script>
        $(function () {
          var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
              {y: '2016', users: <?php echo $userGraphCount[0]; ?>},             
              {y: '2017', users: <?php echo $userGraphCount[1]; ?>},             
              {y: '2018', users: <?php echo $userGraphCount[2]; ?>},
              {y: '2019', users: <?php echo $userGraphCount[3]; ?>},
              {y: '2020', users: <?php echo $userGraphCount[4]; ?>}
            ],
            xkey: 'y',
            ykeys: ['users'],
            labels: ['users'],
            lineColors: ['#efefef'],
            lineWidth: 2,
            hideHover: 'auto',
            gridTextColor: "#fff",
            gridStrokeWidth: 0.4,
            pointSize: 4,
            pointStrokeColors: ["#efefef"],
            gridLineColor: "#efefef",
            gridTextFamily: "Open Sans",
            gridTextSize: 10
          });

          var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            data: [
              {y: '2016', orders: <?php echo $orderGraphCount[0]; ?>},
              {y: '2017', orders: <?php echo $orderGraphCount[1]; ?>},
              {y: '2018', orders: <?php echo $orderGraphCount[2]; ?>},
              {y: '2019', orders: <?php echo $orderGraphCount[3]; ?>},
              {y: '2020', orders: <?php echo $orderGraphCount[4]; ?>},
            ],
            xkey: 'y',
            ykeys: ['orders'],
            labels: ['orders'],
            lineColors: ['#a0d0e0', '#3c8dbc'],
            hideHover: 'auto'
          });
        });
      </script>
    <?php } ?>
    <script src="{{ asset('/js/demo.js') }}"></script>
<?php } else { ?>

  <script src="{{ asset('/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
  <!-- iCheck -->
  <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}"></script>
 
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>

<?php } ?> 
@yield('js')
</body>
</html>