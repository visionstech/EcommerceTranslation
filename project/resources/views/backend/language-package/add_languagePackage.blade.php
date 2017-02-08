@extends('backend.app')
@section('title')
    {{ ($packageId)?'Edit':'Add'}} Language Package
@endsection
@section('content') 
<section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li><a href="{{ url('/language-management') }}">Manage Language Packages</a></li>
                    <li class="active">{{ ($packageId)?'Edit':'Add'}} Language Package</li>
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
                  <h3 class="box-title">{{ ($packageId)?'Edit':'Add'}} Language Package</h3>
                </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ url('/language-package/add-package') }}" method="post" class="form-horizontal form-label-left">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="packageId" value="{{ $packageId }}">
                <input type="hidden" name="method" value="{{ ($packageId)?'update':'create'}}">
                @include('errors.user_error')
                <div class="box-body">
                  <div class="form-group">
                      <?php $name = (old('name')) ? old('name') : ((!empty($packageDetail)) ? $packageDetail[0]['name'] : '');  
                      ?>
                      <label for="packagename">Package Name<span class="required">*</span></label>
                      <input type="text" placeholder="Package Name" class="form-control" name="name" value="{{ $name }}">
                  </div>
                  <div class="form-group">
                      <?php $price_per_word = (old('price_per_word')) ? old('price_per_word') : ((!empty($packageDetail)) ? $packageDetail[0]['price_per_word'] : '');  
                      ?>
                      <label for="language">Price<span class="required">*</span></label>
                      <input type="text" placeholder="Price Per Word" class="form-control" name="price_per_word" value="{{ $price_per_word }}">
                  </div>
                  <div class="form-group">
                      <?php $description = (old('description')) ? old('description') : ((!empty($packageDetail)) ? $packageDetail[0]['description'] : '');  
                      ?>
                      <label for="language">Description</label>
                      <textarea type="text" placeholder="Description" class="form-control" name="description" id='editor1'>{{ $description }}</textarea>
                  </div>

                    <?php $Status = (old('status')) ? old('status') : ((!empty($packageDetail)) ? $packageDetail[0]['status'] : 'Active');  
                    ?>
                  <div class="form-group">
                     <label>Select</label>
                     <select name="status" class="form-control">
                          <option value="Active" <?php echo ($Status =='Active')? "selected":''; ?> >Active</option>
                          <option value="Deleted" <?php echo ($Status =='Deleted')? "selected":''; ?>>Deleted</option>
                      </select>
                  </div>               
                </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
         </div>
        <!--/.col (left) -->
       </div>
      <!-- /.row -->
    </section>
@endsection
@section('js')
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>
@endsection