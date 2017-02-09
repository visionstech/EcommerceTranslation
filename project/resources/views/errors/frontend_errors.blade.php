@if($errors->any())
    <?php $errors = $errors; ?>
	<div class="front_errors">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		<p><strong>Whoops!</strong> There were some problems with your input.</p>
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
 	<div class="front_success alert alert-success"> 
        <i class="fa fa-check-circle-o" aria-hidden="true"></i> {{Session::get('success')}} 
    </div>
@endif
@if(Session::has('error')) 
    <div class="alert alert-danger"> 
        {{Session::get('error')}} 
    </div> 
@endif