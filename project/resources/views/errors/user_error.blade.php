@if($errors->any())
    <?php $errors = $errors; ?>
	<div class="alert alert-danger errorAlertMsgMain text-left">
		<!--a class="close"><span aria-hidden="true" class="glyphicon glyphicon-remove"></span></a-->
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		<strong>Whoops!</strong> There were some problems with your input.
		<ul class="errorAlertMsg">
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@else 
    <?php $errors = []; ?>
@endif
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