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
  
  @include('customer.banner')
  <div class="site-content-wrap">
    <section class="languages">
      <div class="eqho-container">
        <div class="languages-content">
          <h3>Over 65 Languages <span>One Easy to Use Platform. No Monthly Fees</span></h3>
          <p class="content">EQHO has been delivering fast, accurate translations to global brands for 20 years. We harness the power of our proprietary translation technology, which enables our team of 3,500 linguists to deliver your project quickly and cost effectively.
          </p>
          <div class="system-img-wrap">
            <img src="{{ asset('/customer/img/system.png') }}" alt="system" title="system" />
          </div>
        </div>
      </div>
    </section>

    @include('customer.sections.feature')

    @include('customer.sections.ourPromise')

    @include('customer.sections.whatWeTranslate')
    
    @include('customer.sections.eqhoByNumbers')

    @include('customer.sections.howItWorks')
    
    <section class="need-consultant-wrap">
      <div class="eqho-container">
        <h3>Need to Speak <span>to a Consultant?</span></h3>
        <div class="need-consultant">
          <a href="#" title="Contact Sales">Contact Sales</a>
        </div> <!-- need-consultant -->
      </div>
    </section> <!-- need-consultant-wrap -->


    @include('customer.sections.clientsSay')

    @include('customer.sections.faq')

    @include('customer.sections.clients')

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