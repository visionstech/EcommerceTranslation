@extends('backend.app')
@section('title')
    {{ ($priceId)?'Edit':'Add'}} Language
@endsection
@section('content') 
<section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li><a href="{{ url('/language-price') }}">Manage Language Price</a></li>
                    <li class="active">{{ ($priceId)?'Edit':'Add'}} Language Price</li>
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
                  <h3 class="box-title">{{ ($priceId)?'Edit':'Add'}} Language Price</h3>
                </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ url('/language-price/add-language-price') }}" method="post" class="form-horizontal form-label-left">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="priceId" value="{{ $priceId }}">
                <input type="hidden" name="method" value="{{ ($priceId)?'update':'create'}}">
                @include('errors.user_error')
                <div class="box-body">

                  <?php $source = (old('source')) ? old('source') : ((!empty($priceDetail)) ? $priceDetail[0]['source'] : '');  
                  ?>
                  <div class="form-group">
                     <label>Language From<span class="required">*</span></label>
                      <select name="source" class="form-control">
                          <option value=''>Select Language From</option>
                          @foreach($languages as $language)
                            <option value='{{ $language->id }}' <?php echo ($source ==$language->id)? "selected":''; ?>>{{ $language->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <?php $destination = (old('destination')) ? old('destination') : ((!empty($priceDetail)) ? $priceDetail[0]['destination'] : '');  
                  ?>
                  
                  <div class="form-group">
                     <label>Language To<span class="required">*</span></label>
                     <select name="destination" class="form-control">
                          <option value=''>Select Language To</option>
                          @foreach($languages as $language)
                            <option value='{{ $language->id }}' <?php echo ($destination ==$language->id)? "selected":''; ?>>{{ $language->name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                      <?php $price_per_word = (old('price_per_word')) ? old('price_per_word') : ((!empty($priceDetail)) ? $priceDetail[0]['price_per_word'] : '');  
                      ?>
                      <label for="language">Price Per Word<span class="required">*</span></label>
                      <input type="text" placeholder="Language" class="form-control" name="price_per_word" value="{{ $price_per_word }}">
                  </div>
                  <div class="form-group">
                      <?php $Status = (old('status')) ? old('status') : ((!empty($priceDetail)) ? $priceDetail[0]['status'] : '');  
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