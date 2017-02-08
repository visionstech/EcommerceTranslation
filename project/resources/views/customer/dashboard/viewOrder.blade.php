@extends('customer.front-app')
@section('title')
  Translation Order
@endsection
@section('content')
<?php $dataUrl=url('/');                
      $url=explode('index.php',$dataUrl); 
?>
<div class="dashboard-content-wrap">
    @include('customer.customerAside')
    <div class="dashboard-content">
			<h1>Order: <span>#{{ ($singleProject)?$singleProject['order_id']:'' }}</span></h1>

			<div class="common-dashtext-wrap">
				<?php $fileType=array();$fileNames=array();  $c=1;?>
				@foreach($singleProject['files'] as $file)
					<?php 
					if(!in_array($file['title'],$fileType)){
						$fileType[] = $file['title'];
					}
					$fileNames[]=$file['name']
					?>
					<div class="doc-info">
						<div class="doc-img">
							<img src="{{ $url[0].'/customer/img/'.$file['type'] }}" alt="{{ $file['title'] }}" title="{{ $file['title'] }}" />
						</div>
						<div class="doc-text">
							<p>{{ $file['name'] }}</p>
							<h6>{{ $file['words'] }} word count</h6>
						</div>
						@if(sizeof($singleProject['files'])==$c)
							<div class="doc-price">
								<h5>Price: ${{$singleProject['finalPrice'] }}</h5>
							</div>
						@endif
					</div>
					<?php  $c++; ?>
				@endforeach

				<div class="project-details">
					<h2>Project Details</h2>
					<p><span>Purpose:</span> {{ ($singleProject)?$singleProject['languagePurpose']:'' }}</p>
					<p><span>Delivery date:</span> N/A</p>
					<p><span>File type:</span> {{ implode(',',$fileType) }}</p>
					<p><span>File names:</span> <span class="files_content"><?php echo implode(','."<br/>",$fileNames); ?></span></p>
				</div>
				<div class="common-table project-details">
					<table>
						<thead>
							<tr>
								<th>Translate From</th>
								<th>Translate To</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							@foreach($singleProject['languages'] as $language)
								<tr>
									<td>{{ $language['source'] }}</td>
									<td>{{ $language['destination']  }}</td>
									<td>
										@if($language['status']=='pending')
											<img src="{{ asset('/customer/img/pending-icon.png') }}" alt="pending-icon" title="pending-icon">
											{{ ucfirst($language['status'])  }} <span>( The order is received but the translation is not yet placed with a translator.)</span>
										@elseif($language['status']=='translated')
											<span class="translated"><i class="fa fa-check-circle-o" aria-hidden="true"></i> {{ ucfirst($language['status'])  }}</span>
										@else
											<span class="translating"><i class="fa fa-spinner" aria-hidden="true"></i> {{ ucfirst($language['status'])  }}</span>
										@endif
									 </td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div> <!-- common-dashtext-wrap -->

		</div> <!-- dashboard-content -->


	</div><!-- dashboard-content-wrap -->
	@endsection