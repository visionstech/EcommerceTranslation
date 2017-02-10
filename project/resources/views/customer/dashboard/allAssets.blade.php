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
      <h1>{{ ucfirst($type) }} </h1>
      <div class="upload-asset">
        <a href="#" class="btn-ctrl"><i class="fa fa-upload" aria-hidden="true"></i> Upload Upload a Translation Asset</a>
      </div>
      @include('errors.frontend_errors')
      <div class="common-dashtext-wrap">
        <div class="common-table glossaries-table">
          <table>
            <thead>
              <tr>
                <th>S.No</th>
                <th>Upload Date</th>
                <th>Modified Date</th>
                <th>File Name</th>
                <th>Project History</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @if(!empty($assets))
              <?php $s=1; ?>
              @foreach($assets as $asset)
               <?php
                  $createdDate=strtotime($asset['created_at']);
                  $createdDate=date('M d Y',$createdDate);
                  $updatedDate=strtotime($asset['updated_at']);
                  $updatedDate=date('M d Y',$updatedDate);
               ?>
                <tr>
                  <td>{{ $s }}</td>
                  <td>{{ $createdDate }}</td>
                  <td>{{ $updatedDate }} </td>
                  <td>{{$asset['file_name']}}</td>
                  <td>#{{ $asset['order_id'] }} / files used on</td>
                  <td>
                    <a href="{{ url('/customer/single-asset/'.$type.'/'.encrypt($asset['id'])) }}" title="view"><i class="fa fa-eye" aria-hidden="true"></i> View </a>
                    <a href="javascript::void(0)" class="delete_asset" data-url="{{ url('/customer/delete-single-asset/'.$type.'/'.encrypt($asset['id'])) }}" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i> Delete </a>
                  </td>
                </tr>
                <?php $s++; ?>
              @endforeach
            @endif
            </tbody>
          </table>
        </div>
      </div> <!-- common-dashtext-wrap -->
      @if(!empty($assets))
        {{ $assets->links() }}
      @endif
    </div> <!-- dashboard-content -->


  </div><!-- dashboard-content-wrap -->
    </div> <!-- dashboard-content -->

<!-- Error Popup --> 
      <div class="over-lay asset_popup invalidFiles">
          <div class="unsupported-popup">
            <h1>Are you sure to delete this asset?<span class="close-icon"><i class="fa fa-times popup-close" aria-hidden="true"></i></span></h1>
            <div class="popup-close-btn">
              <input type="hidden" name="data_link" class="data_link">
              <input type="submit" name="" value="Cancel" class="popup-close" />
              <input type="submit" name="" value="Yes" class="popup-close delete_asset_confirm" />
            </div>
          </div> <!-- unsupported-popup -->
      </div> <!-- over-lay --> 
@endsection

  