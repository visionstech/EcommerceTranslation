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
      <h1>Projects</h1>
      <div class="common-dashtext-wrap ">
        <div class="common-table project-table">
          <table>
            <thead>
              <tr>
                <th>S.No</th>
                <th>Order Number</th>
                <th>Date</th>
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
            @if(count($allProjects))
            @foreach($allProjects as $allProject)
            <?php
            $dateFormat=strtotime($allProject['orderDate']);
            $FormatedDate=date('M d Y',$dateFormat);
            ?>
              <tr>
                <td>{{ $s }}</td>
                <td>{{ $allProject['order_id'] }}</td>
                <td>{{ $FormatedDate }}</td>
                <td>
                  @if(count($allProject['fileTypes'] ))
                    @foreach($allProject['fileTypes'] as $fileType)
                        <img src="{{ $url[0].'/customer/img/'.$fileType }}" title="{{ $fileType }}" alt="{{ $fileType }}" />
                        <br/>
                    @endforeach
                  @endif
                </td>
                <td>{{ ($allProject['files'])?$allProject['files']:''  }}</td>
                <td>{{ $allProject['totalWords'] }}</td>
                <td>{{ (isset($allProject['sourceLang']))?$allProject['sourceLang']:''  }}</td>
                <td>{{ (isset($allProject['destinationLanguage'] ))?$allProject['destinationLanguage']:''}}</td>
                <td>Translating (1/4)</td>
                <td>${{ (isset($allProject['finalPrice'] ))?$allProject['finalPrice']:'' }}</td>
                <td><a href="{{ url('customer/view-order/view/'.encrypt($allProject['order_id'])) }}" title="view"><i class="fa fa-eye" aria-hidden="true"></i> View </a><a href="{{ url('customer/view-order/review/'.encrypt($allProject['order_id'])) }}" title="view"><i class="fa fa-eye" aria-hidden="true"></i> Review </a></td>
              </tr>
            <?php $s++; ?>
            @endforeach
            @endif
            </tbody>
          </table>
        </div>
      </div> <!-- common-dashtext-wrap -->

    </div> <!-- dashboard-content -->
    </div> <!-- dashboard-content -->


@endsection

  