@extends('backend.app')
@section('title')
  Orders
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Order
        <small>#{{ $singleProject['order_id'] }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Invoice</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Order Detail.
            <?php
              $dateFormat=strtotime($singleProject['orderDate']);
              $FormatedDate=date('M d Y',$dateFormat);
            ?>
            <small class="pull-right">{{ $FormatedDate }}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Payment From
          <address>
            <strong>{{ $singleProject['useremail'] }}</strong>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Payment To
          <address>
            <strong>{{ Auth::user()->email }}</strong>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Order ID #{{ $singleProject['order_id'] }} </b>
          <br>
          <b>Transaction Id: </b>{{ $singleProject['transaction_id'] }}<br>
          <b>Payment Status:</b> {{ $singleProject['paymentStatus'] }}<br>
          <b>Total Payment:</b> ${{ $singleProject['finalPrice'] }}
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Project</th>
              <th>Language From</th>
              <th>Language To</th>
              <th>Price</th>
            </tr>
            </thead>
            <tbody>
            <?php $c=1; ?>
            @if($singleProject['languages']) 
              @foreach($singleProject['languages'] as $languages)
                <tr>
                  <td>{{$c}}</td>
                  <td>{{ $languages['source'] }}</td>
                  <td>{{ $languages['destination'] }}</td>
                  <td>${{ $languages['singlelangprice'] }}</td>
                  <td>
                    @if($languages['status']=='Approved')
                      <?php $class="success"; ?>
                    @elseif(($languages['status']=='Pending') || ($languages['status']=='Changes'))
                      <?php $class="warning"; ?>
                    @elseif($languages['status']=='Rejected')
                        <?php $class="danger"; ?>
                    @else
                      <?php $class="warning"; ?>
                    @endif
                    <span class="label label-{{ $class }}">
                      {{ $languages['status'] }}
                    </span>
                  </td>
                </tr>
                <?php $c++; ?>
              @endforeach
            @endif
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-5">
          <p class="lead">Payment Methods:</p>
          <img src="{{ asset('/img/credit/visa.png') }}" alt="Visa">
          <img src="{{ asset('/img/credit/mastercard.png') }}" alt="Mastercard">
          <img src="{{ asset('/img/credit/american-express.png') }}" alt="American Express">
          <img src="{{ asset('/img/credit/mestro.png') }}" alt="Mestro">

        </div>
        <!-- /.col -->
        <div class="col-xs-7">
          <p class="lead">Files Uploaded</p>

          <div class="table-responsive">
            <table class="table">
            @if($singleProject['files']) 
              @foreach($singleProject['files'] as $file)
                <tr>
                  <th style="width:50%"><img src="{{ url('/').'/customer/img/'.$file['type'] }}" name="" title="" /></th>
                  <td>{{ $file['name'] }}</td>
                  <td><a href="{{ url('/').$file['upload_path'].'/'.$file['name'] }}" download class="btn btn-default"><i class="fa fa-print"></i> Download</a></td>
                </tr>
              @endforeach
            @endif
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  <!-- /.content -->
<div class="clearfix"></div>

<!-- /.content-wrapper -->
@endsection