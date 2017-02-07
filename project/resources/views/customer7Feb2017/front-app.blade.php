<!DOCTYPE html>
<html lang="en-US">
<head>
<?php  $current_url = Request::url();
       $homePageUrl=url('/');
?>
  <title>EQHO Translation</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;" http-equiv="X-UA-Compatible" />
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,700" rel="stylesheet"> 
  <link rel="stylesheet" type="text/css" href="{{ asset('/customer/css/slick.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('/customer/css/slick-theme.css') }}"/>
  <link rel="stylesheet" href="{{ asset('/customer/css/jquery-ui.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/customer/css/font-awesome.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/customer/css/style.css') }}">
  @if(strpos($_SERVER['REQUEST_URI'],'customer') != false) 
  <link rel="stylesheet" type="text/css" href="{{ asset('/customer/css/dashboard.css') }}">
  @endif
  <link rel="stylesheet" type="text/css" href="{{ asset('/customer/css/responsive.css') }}">

</head>
<body>

<div class="main-wrapper eqho-clear-fix">
  @if(strpos($_SERVER['REQUEST_URI'],'customer') != false) 
    @include('customer.customerHeader')
  @else
    @include('customer.header')
  @endif

  @if($current_url==$homePageUrl)
    @include('customer.banner')
  @endif
  <div class="site-content-wrap">
    @yield('content')
    @include('customer.footer')
  </div><!-- site-content-wrap -->
</div> <!-- main-wrapper -->

@if($current_url==$homePageUrl)
  @include('customer.homepageJs')
@elseif(strpos($_SERVER['REQUEST_URI'],'customer') != false)
  @include('customer.DashboardJs')
@else
  @include('customer.innerPageJs')
@endif

</body>
</html>