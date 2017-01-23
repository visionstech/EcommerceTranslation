@extends('customer.front-app')
@section('title')
  Users
@endsection
@section('content')

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
@endsection