@extends('backend.app')
@section('title')
    {{ ($sectionId)?'Edit':'Add'}} Banner Info
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
                    <li><a href="{{ url('/homepage-section/view-sections/banner-info') }}">Manage Banner Info</a></li>
                    <li class="active">{{ ($sectionId)?'Edit':'Add'}} Banner Info</li>
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
                  <h3 class="box-title">{{ ($sectionId)?'Edit':'Add'}} Banner Info</h3>
                </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ url('/homepage-section/add-section/banner-info') }}" method="post" class="form-horizontal form-label-left" enctype='multipart/form-data'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="sectionType" value="banner-info">
                <input type="hidden" name="sectionId" value="{{ $sectionId }}">
                <input type="hidden" name="method" value="{{ ($sectionId)?'update':'create'}}">
                @include('errors.user_error')
                <?php $description = (old('description')) ? old('description') : ((!empty($section)) ? $section->description : '');  
                    ?>
              <div class="box-body">
                <div class="form-group">
                    <label for="image"> Banner Content<span class="required">*</span></label>
                    <textarea name="description" id="editor1" rows="10" cols="80">{{ $description }}</textarea>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{ ($sectionId)?'Update':'Save'}}</button>
                </div>
            </form>
          </div>
         </div>
       </div>
    </section>    
@endsection