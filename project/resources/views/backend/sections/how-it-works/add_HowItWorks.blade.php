@extends('backend.app')
@section('title')
    {{ ($sectionId)?'Edit':'Add'}} How It Works
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
                    <li class="active">{{ ($sectionId)?'Edit':'Add'}} How It Works</li>
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
                  <h3 class="box-title">{{ ($sectionId)?'Edit':'Add'}} How It Works</h3>
                </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ url('/homepage-section/add-section/how-it-works') }}" method="post" class="form-horizontal form-label-left" enctype='multipart/form-data'>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="sectionType" value="how-it-works">
                <input type="hidden" name="sectionId" value="{{ $sectionId }}">
                <input type="hidden" name="method" value="{{ ($sectionId)?'update':'create'}}">
                @include('errors.user_error')
              <div class="box-body">
               <?php $title = (old('title')) ? old('title') : ((!empty($section)) ? $section->title : '');  
                    ?>
                <div class="form-group">
                    <label for="title">Title<span class="required">*</span></label>
                    <input type="text" placeholder="Title" class="form-control" name="title" value="{{ $title }}">
                </div>
                <?php $image = ((!empty($section)) ? $section->image : ''); 
                    if($image){
                        $dataUrl=url('/');                
                        $url=explode('index.php',$dataUrl);
                        echo "<input type='hidden' name='image' value='".$section->image."'>";
                    } 
                ?>
                <div class="form-group">
                    <label for="image">Image<span class="required">*</span></label>
                    <input type="file" placeholder="image" class="form-control" name="image">
                </div>
                <?php $image = ((!empty($section)) ? $section->image : ''); 
                        if($image){
                            echo "<img src='".$url[0].'/uploads/'.$section->image."' alt='".$section->image_title."'>";
                        } 
                ?>
                
                <?php $description = (old('description')) ? old('description') : ((!empty($section)) ? $section->description : '');  
                    ?>

                <div class="form-group">
                    <label for="title">Description<span class="required">*</span></label>
                    <textarea placeholder="Description" class="form-control" name="description">{{ $description }}</textarea>
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