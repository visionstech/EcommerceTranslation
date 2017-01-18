@extends('app')
@section('title')
	Login
@endsection
@section('content')
           
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>EQHO</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h2 class="text-center">Reset Password</h2>
    @include('errors.user_error')
    <form action="{{ url('/auth/reset-password') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="reset_token" value="{{ $resetToken }}">
        <?php if($resetToken){ ?>
                <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-keys form-control-feedback"></span>
                <span class="glyphicons glyphicons-keys"></span>
                </div>
                <div class="form-group has-feedback">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                <span class="glyphicon glyphicon-keys form-control-feedback"></span>
                </div>
        <?php }else{ ?>
                <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
         <?php } ?>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary">Reset Password</button>
          </div>
          <!-- /.col -->
        </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->    
@endsection