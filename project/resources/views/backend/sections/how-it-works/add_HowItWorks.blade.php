@extends('backend.app')
@section('title')
    {{ ($howItWorksId)?'Edit':'Add'}} How It Works
@endsection
@section('content')    
    <!-- top tiles -->
<section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li><a href="{{ url('/homepage-section/our-promises') }}">Manage How It Works</a></li>
                    <li class="active">{{ ($howItWorksId)?'Edit':'Add'}} How It Works</li>
                </ol>
            </section>
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
          <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ ($howItWorksId)?'Edit':'Add'}} How It Works</h3>
                </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ url('/homepage-section/add-how-it-works') }}" method="post" class="form-horizontal form-label-left">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="howItWorksId" value="{{ $howItWorksId }}">
                <input type="hidden" name="method" value="{{ ($howItWorksId)?'update':'create'}}">
                @include('errors.user_error')
              <div class="box-body">
               <?php $title = (old('title')) ? old('title') : ((!empty($howItWorks)) ? $howItWorks->title : '');  
                    ?>
                <div class="form-group">
                    <label for="title">Title<span class="required">*</span></label>
                    <input type="text" placeholder="Title" class="form-control" name="title" value="{{ $title }}">
                </div>
                <?php $description = (old('description')) ? old('description') : ((!empty($howItWorks)) ? $howItWorks->description : '');  
                    ?>
                <div class="form-group">
                    <label for="title">Description<span class="required">*</span></label>
                    <textarea placeholder="Description" class="form-control" name="description">{{ $description }}</textarea>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{ ($howItWorksId)?'Update':'Save'}}</button>
                </div>
            </form>
          </div>
         </div>
       </div>
    </section>    
@endsection