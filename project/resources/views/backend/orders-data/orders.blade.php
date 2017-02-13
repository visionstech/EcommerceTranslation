@extends('backend.app')
@section('title')
	Orders
@endsection
@section('content')
    <style>
    #example1_filter label input.input-sm {
      margin: 0 0 0 5px;
    }
    </style>
    <section class="content-header">
      <h1>
        View Orders
        <small>Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active"><a href="{{ url('/management/all-projects') }}">View Orders</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @if(Session::has('success')) 
                    <div class="alert alert-success"> 
                        {{Session::get('success')}} 
                    </div> 
                @endif
                @if(Session::has('error')) 
                    <div class="alert alert-danger"> 
                        {{Session::get('error')}} 
                    </div> 
                @endif
                <div class="box">
                <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table" id="example1">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Language From</th>
                                    <th>Language To</th>
                                    <th>Customer Email</th>
                                    <th>Total Words</th>
                                    <th>Final Price</th>
                                    <th>Order Date</th>
                                    <th>Translation Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allProjects as $allProject)
                                    <tr>
                                        <td>#{{ $allProject['order_id'] }}</td>
                                        <td>{{ $allProject['sourceLang'] }}</td>
                                        <td>{{ $allProject['destinationLanguage'] }}</td>
                                        <td>{{ $allProject['useremail'] }}</td>
                                        <td>{{ $allProject['totalWords'] }}</td>
                                        <td>${{ $allProject['finalPrice'] }}</td>
                                        <?php
                                          $dateFormat=strtotime($allProject['orderDate']);
                                          $FormatedDate=date('M d Y',$dateFormat);
                                        ?>
                                        <td>{{ $FormatedDate }}</td>                
                                        <td>
                                            @if($allProject['languageStatus']=='Approved')
                                                <?php $class="success"; ?>
                                            @elseif(($allProject['languageStatus']=='Pending') || ($allProject['languageStatus']=='Changes'))
                                                <?php $class="warning"; ?>
                                            @elseif($allProject['languageStatus']=='Rejected')
                                                <?php $class="danger"; ?>
                                            @else
                                                <?php $class="warning"; ?>
                                            @endif
                                            <span class="label label-{{ $class }}">
                                                {{ $allProject['languageStatus'] }}
                                            </span>
                                        </td>

                                        <td><a href="{{ url('management/view-order/view/'.encrypt($allProject['order_id'])) }}" title="view"><i class="fa fa-eye" aria-hidden="true"></i> View </a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                    
            </div>
        </div>
    </section>
    <!-- Popup Model For Delete action -->
<!-- End Popup Model -->
@endsection
@section('js')
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function(){
       $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
        var baseUrl='<?php echo URL::to('/'); ?>';
        $('.actionAnchor').click(function(){
            var UserId=$(this).attr('data-did');
            var status=$(this).attr('data-status');
            var statusDiv=$(this).attr('data-statusDiv');
            $('.status').val(status);
            $('.statusDiv').html(statusDiv);
            $('.UserId').val(UserId);
        });
        
        $('.delete_confirm').click(function(){
            var UserId=$('.UserId').val();
            var Status=$('.status').val();
            window.location.href=baseUrl+'/user/delete-user/'+UserId+'/'+Status;
        });        
    });

    $(document).ready(function(){
        $("#example1").dataTable();
        var baseUrl='<?php echo URL::to('/'); ?>';
        $('.actionAnchor').click(function(){
            var LanguageId=$(this).attr('data-did');
            var status=$(this).attr('data-status');
            var statusDiv=$(this).attr('data-statusDiv');
            $('.status').val(status);
            $('.statusDiv').html(statusDiv);
            $('.UserId').val(LanguageId);
        });
        
        $('.delete_confirm').click(function(){

            var UserId= $(this).prev().prev().prev().val();
            var Status= $(this).prev().prev().val();
            window.location.href=baseUrl+'/user/delete-user/'+UserId+'/'+Status;
        });        
    });
</script>
@endsection
 

