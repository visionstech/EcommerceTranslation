@extends('customer.front-app')
@section('title')
  Translation Order
@endsection
@section('content')
<?php $dataUrl=url('/');                
      $url=explode('index.php',$dataUrl); 
?>
<div class="dashboard-content-wrap">
    @include('customer.customerAside')
    <div class="dashboard-content">
      <h1>Dashboard</h1>
      <article class="on-demand">
        <h2>On-demand.eqho.com news</h2>
        <h5>Important Notification: Tuesday july 19th, 10:00am-12:00 noon jul 11 2016</h5>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently.</p>
      </article>
      <div class="common-dashtext-wrap pending-wrap">
        <h2>Pending</h2>
        <div class="common-table pending-table">
          <table>
            <thead>
              <tr>
                <th>S.No</th>
                <th>Order Number</th>
                <th>Date</th>
                <th>Purpose</th>
                <th>Type</th>
                <th>File Name</th>
                <th>Words</th>
                <th>Translate From</th>
                <th>Translate To</th>
                <th>Status</th>
                <th>Price</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
            <?php $s=1; ?>
            @foreach($pendingProjects as $pendingProject)
            <?php
            $dateFormat=strtotime($pendingProject['orderDate']);
            $FormatedDate=date('M d Y',$dateFormat);
            ?>
              <tr>
                <td>{{ $s }}</td>
                <td>{{ $pendingProject['order_id'] }}</td>
                <td>{{ $FormatedDate }}</td>
                <td>{{ $pendingProject['languagePackage'] }}</td>
                <td>
                    @foreach($pendingProject['fileTypes'] as $fileType)
                      <img src="{{ $url[0].'/customer/img/'.$fileType }}" title="{{ $fileType }}" alt="{{ $fileType }}" />
                      <br/>
                    @endforeach
                </td>
                <td>{{ $pendingProject['files'] }}</td>
                <td>{{ $pendingProject['totalWords'] }}</td>
                <td>{{ $pendingProject['sourceLang'] }}</td>
                <td>{{ $pendingProject['destinationLanguage'] }}</td>
                <td><img src="{{ asset('/customer/img/pending-icon.png') }}" alt="pending-icon" title="pending-icon"> 
                {{ $pendingProject['languageStatus'] }}</td>
                <td>${{ $pendingProject['finalPrice'] }}</td>
                <td><a href="{{ url('customer/view-order/'.encrypt($pendingProject['order_id'])) }}" title="view"><i class="fa fa-eye" aria-hidden="true"></i> View </a></td>
              </tr>
              <?php $s++; ?>
            @endforeach
            </tbody>
          </table>
        </div>
      </div> <!-- common-dashtext-wrap -->

    </div> <!-- dashboard-content -->

@endsection

  