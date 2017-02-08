@extends('customer.front-app')
@section('title')
  Translation Order
@endsection
@section('content')
<?php $dataUrl=url('/');
?>
<div class="dashboard-content-wrap">
    @include('customer.customerAside')
 			<div class="dashboard-content">
			<h1>Translation Reviewable (#{{ ($singleProject)?$singleProject['order_id']:'' }})</h1>
			<div class="common-dashtext-wrap">
				@if($singleProject)
					<?php $counter=1; ?>
					@foreach($singleProject['languages'] as $single)
						<?php if($counter<10){$decimal='0';}else{$decimal='';} ?>
						<div class="translation-review">
							<div class="translated-files">
								<h2><span class="numbering">{{ $decimal.$counter }}</span> Translation <span class="trans-lang">({{ $single['destination'] }})</span></h2>
								<div class="form-group">
									<label>File Name</label>
									<select class="download_file" name="{{ $single['id'] }}">
										<option>-- Select your file name --</option>
										@if($singleProject['files'])
											@foreach($singleProject['files'] as $file)
												<option data-link="{{ $dataUrl.$file['upload_path'].'/'.$file['name'] }}" value="{{ $file['id'] }}">{{ $file['name'] }}</option>
											@endforeach
										@endif
									</select>
									<div class="dash-btn-wrap">
										<a href="{{ $dataUrl.$singleProject['files'][0]['upload_path'].'/'.$singleProject['files'][0]['name'] }}" class="btn-ctrl dload" download class="download_anchor"><i class="fa fa-download" aria-hidden="true"></i> Download Translation</a>
									</div>
								</div>
								<div class="view-rejection-wrap">
									<div class="dash-btn-wrap">
										<a href="{{ url('/customer/request-changes/'.encrypt($single['id'])) }}" class="btn-ctrl" title="Request changes">Request changes</a>
										<a href="#" class="btn-ctrl btn-gray" title="Approve translation"><i class="fa fa-trash" aria-hidden="true"></i> Approve translation</a>
									</div>
									<a href="#" class="view-reject" title="View Rejection"><i class="fa fa-eye" aria-hidden="true"></i> View Rejection Form</a>
								</div>
							</div>
							<div class="orignal-files">
								<h2>Original files <span class="trans-lang">({{ $single['source'] }})</span></h2>
								<div class="org-file-info">
									@if($singleProject['files'])
										@foreach($singleProject['files'] as $file)
											<ul>
												<li><img src="{{ $dataUrl.'/customer/img/'.$file['type'] }}" alt="{{ $file['title'] }}" title="{{ $file['title'] }}" /></li>
												<li>{{ $file['name'] }}</li>
												<li>
													<div class="dash-btn-wrap ">
														<a href="{{ $dataUrl.$file['upload_path'].'/'.$file['name'] }}" class="btn-ctrl dload" download><i class="fa fa-download" aria-hidden="true"></i> Download Original</a>
													</div>
												</li>
											</ul>
										@endforeach
									@endif
								</div>
							</div>
						</div> <!-- translation-review -->
						<?php $counter++; ?>
					@endforeach
				@endif
			</div> <!-- common-dashtext-wrap -->
		</div> <!-- dashboard-content -->
	</div><!-- dashboard-content-wrap -->
@endsection