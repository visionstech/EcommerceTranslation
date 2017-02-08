@extends('customer.front-app')
@section('title')
  Translation Order
@endsection
@section('content')
<?php $dataUrl=url('/'); ?>
<div class="dashboard-content-wrap">
    @include('customer.customerAside')
	<div class="dashboard-content">
		<h1>Translation Reviewable (#{{ ($singleProject)?$singleProject['order_id']:'' }})</h1>
			<div class="common-dashtext-wrap ">
				<div class="translation-review request-changes-wrap">
					<div class="translated-files">
						<h2>Translation <span class="trans-lang">({{ $singleProject['language']['destination'] }})</span></h2>
						<form  action="{{ url('/customer/customer-feedback') }}" method="post" enctype="multipart/form-data">
							<input type="hidden" name="_token" id='token' value="{{ csrf_token() }}" />
							<input type="hidden" name="project_id" value="{{ $singleProject['project_id'] }}" />
							<input type="hidden" name="order_id"  value="{{ $singleProject['order_id'] }}" />
							<div class="form-group">
								<label>File Name</label>
								<select class="download_file" name="translated_file">
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
							<div class="request-changes">
								<h2>What would you like to change?</h2>
								@if(count($translationCorrection))
									@foreach($translationCorrection as $correction)
										<div class="custom-checkbox">
											<input id="change-{{ $correction->id }}" name="corrections[]" type="checkbox" value="{{ $correction->id }}">
									        <label for="change-{{ $correction->id }}" class="checkbox-custom-label">{{ ucfirst($correction->name) }}</label>    
									    </div>
								    @endforeach
							    @endif
							    <div class="new-file-up upload-files">
							    	<h2>File Upload <i class="fa fa-question-circle" aria-hidden="true"></i></h2>
									<div class="upload-files-btn">
										<span type="button" class="fileinput-button">
											<span>Upload File</span>
										    <input name="requested_file" size="1" type="file">
										</span>
									</div>
									<span class="lable-text"></span>
								</div>

								<div class="comment">
									<h2>Comment</h2>
									<textarea name="comment" placeholder="Your comments..."></textarea>
								</div>

								<div class="dash-btn-wrap">
									<input type="submit" name="submit" value="Request changes" class="btn-ctrl"/>
									<a href="#" class="btn-ctrl btn-gray" title="Approve translation">Approve translation</a>
								</div>
							</div>
						</div>
					</form>
					<div class="orignal-files">
						<h2>Original files <span class="trans-lang">({{ $singleProject['language']['source'] }})</span></h2>
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
			</div> <!-- common-dashtext-wrap -->
		</div> <!-- dashboard-content -->
@endsection