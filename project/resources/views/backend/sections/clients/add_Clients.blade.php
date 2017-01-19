@extends('backend.app')
@section('title')
    {{ ($sectionId)?'Edit':'Add'}} Clients
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
                    <li><a href="{{ url('/homepage-section/view-sections/clients') }}">Manage Clients</a></li>
                    <li class="active">{{ ($sectionId)?'Edit':'Add'}} Clients</li>
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
                  <h3 class="box-title">{{ ($sectionId)?'Edit':'Add'}} Clients</h3>
                </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ url('/homepage-section/add-section/clients') }}" method="post" class="form-horizontal form-label-left" enctype='multipart/form-data'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="sectionType" value="clients">
                <input type="hidden" name="sectionId" value="{{ $sectionId }}">
                <input type="hidden" name="method" value="{{ ($sectionId)?'update':'create'}}">
                @include('errors.user_error')
              <div class="box-body">
                <?php $image = ((!empty($section)) ? $section->image : ''); 
                    if($image){
                        $dataUrl=url('/');                
                        $url=explode('index.php',$dataUrl);
                        echo "<input type='hidden' name='image' value='".$section->image."'>";
                    } 
                ?>
                <div class="form-group">
                   <label for="image">Client Image<span class="required">*</span></label>
                    <input type="file" placeholder="image" class="form-control" name="image">
                </div>
                <?php $image = ((!empty($section)) ? $section->image : ''); 
                        if($image){
                            echo "<img src='".$url[0].'uploads/'.$section->image."' alt='".$section->image_title."'>";
                        } 
                ?>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">{{ ($sectionId)?'Update':'Save'}}</button>
                </div>
            </form>
          </div>
         </div>
       </div>
    </section>    
@endsection