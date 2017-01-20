<!DOCTYPE html>
<html lang="en-US">
<head>
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
  <link rel="stylesheet" type="text/css" href="{{ asset('/customer/css/responsive.css') }}">

</head>
<body>
<div class="main-wrapper eqho-clear-fix">
  @include('customer.header')
  

  <div class="site-content-wrap">
    <section class="languages">
      <div class="eqho-container">
        <div class="languages-content">
          <h3>Over 65 Languages <span>One Easy to Use Platform. No Monthly Fees</span></h3>
          <p class="content">EQHO has been delivering fast, accurate translations to global brands for 20 years. We harness the power of our proprietary translation technology, which enables our team of 3,500 linguists to deliver your project quickly and cost effectively.
          </p>
          <div class="system-img-wrap">
          
          </div>
        </div>
      </div>
      <div>
        <h1>What Whould Like to You Translate?</h1>
        <a>Clear all words</a>
        <form action="{{ url('/translation-application/step-one') }}" method="post" class="form-horizontal form-label-left" enctype='multipart/form-data'>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <textarea placeholder="Type Your text here.." name='content' rows='10' cols='50'></textarea>
          Or 
          <input type='file' name='file' />
          <input type="submit"  value="Next:Choose languages" />
        </form>
      </div>

      <div>
        <table border=1>
          <tr><th colspan=2><h1>Your Result</h1></th></tr>
          <tr><td>Total Words:</td><td>0</td></tr>
          <tr><td>Languages:</td><td>0</td></tr>
          <tr><td>Purpose:</td><td>0</td></tr>
          <tr><td>Type:</td><td>0</td></tr>
        </table>
      </div>
    </section>
     

    <section class="contact-sales">

      <div class="eqho-container">
        <h3>Have a <span>Large Project?</span></h3>
        <div class="contact-sales-inner">
          <p>Speak to one of our sales managers</p>
          <a href="#" title="Contact Sales">Contact Sales</a>
        </div>
      </div> <!-- eqho-container -->
    </section> <!-- contact-sales -->

    @include('customer.footer')

  </div><!-- site-content-wrap -->
</div> <!-- main-wrapper -->
@include('customer.homepageJs')
</body>
</html>