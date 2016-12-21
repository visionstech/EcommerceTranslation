@extends('app')
@section('title')
	Error
@endsection
@section('content')

    
    <!-- top tiles -->
    <div class="content-header">
        <ol class="breadcrumb">
           <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        </ol>
    </div>
    <!-- /top tiles -->

    <div class="row">
        <h3>Error</h3>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_content"><br />
                <h4><b><span style="color:red">ERROR:</span> {{ $exception_message }}</b></h4>
            </div>
        </div>
      </div>
    </div>

    
@endsection  

