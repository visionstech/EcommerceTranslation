@extends('backend.app')
@section('title')
    {{ ($userId)?'Edit':'Add'}} User
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
                    <li><a href="{{ url('/role') }}">Manage Users</a></li>
                    <li class="active">{{ ($userId)?'Edit':'Add'}} User</li>
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
                  <h3 class="box-title">{{ ($userId)?'Edit':'Add'}} User</h3>
                </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ url('/user/add-user') }}" method="post" class="form-horizontal form-label-left">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="userId" value="{{ $userId }}">
                <input type="hidden" name="method" value="{{ ($userId)?'update':'create'}}">
                @include('errors.user_error')
              <div class="box-body">
               <?php $email = (old('email')) ? old('email') : ((!empty($userDetail)) ? $userDetail[0]['email'] : '');  
                    ?>
                <div class="form-group">
                    <label for="email">Contact Email<span class="required">*</span></label>
                    <input type="text" placeholder="Email" class="form-control" name="email" value="{{ $email }}">
                </div>
                <?php
                    $Role=((old('role')))?old('role'):((!empty($userDetail))?$userDetail[0]['role_id']:'');
                ?>        
                <div class="form-group">
                   <label for="role">User Role<span class="required">*</span></label>
                   <select name="role" class="form-control">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" <?php echo ($Role == ($role->id))? "selected":''; ?> > {{ $role->role }} </option>
                        @endforeach
                    </select>
                </div>
                <?php $Status = (old('status')) ? old('status') : ((!empty($userDetail)) ? $userDetail[0]['status'] : 'Live');  
                        ?>
                <div class="form-group">
                   <label for="role">User Role<span class="required">*</span></label>
                   <select name="role" class="form-control">
                        <option value="Active" <?php echo ($Status =='Active')? "selected":''; ?> >Active</option>
                        <option value="Deleted" <?php echo ($Status =='Deleted')? "selected":''; ?>>Deleted</option>
                        <option value="Paused" <?php echo ($Status =='Paused')? "selected":''; ?>>Paused</option>
                    </select>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
         </div>
       </div>
    </section>    
@endsection