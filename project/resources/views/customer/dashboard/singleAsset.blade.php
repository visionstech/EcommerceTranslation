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
      <h1>{{ ucfirst($type) }}</h1>

      <div class="common-dashtext-wrap">
        <div class="doc-info glossy-info">
        <?php
            $filetype=explode('.', $asset->file_name);
            $getExtensionGet=$filetype[sizeof($filetype)-1];
            switch($getExtensionGet){
              case 'ppt':
                $imageLogo='power-point.png';
                break;
              case 'pptx':
                $imageLogo='power-point.png';
                break;
              case 'doc':
                $imageLogo='word.png';
              break;
              case 'docx':
                $imageLogo='word.png';
              break;
              case 'xls':
                $imageLogo='excel.png';
              break;
              case 'xlsm':
                $imageLogo='excel.png';
              break;
              case 'xlsx':
                $imageLogo='excel.png';
              break;
              case 'rtf':
                $imageLogo='rich-text-format.png';
              break;
              case 'odt':
                $imageLogo='open-office.png';
              break;
              case 'txt':
                $imageLogo='plain-text.png';
              break;
              case 'pdf':
                $imageLogo='acrobat.png';
              break;
              default:
                $imageLogo='acrobat.png';
              break;
          }
          ?>
          <div class="doc-img">
            <img src="{{ $dataUrl }}/customer/img/{{ $imageLogo }}" alt="{{ $getExtensionGet }}" title="{{ $getExtensionGet }}" class="imageLogo">
          </div>
          <div class="doc-text">
            <p>{{ $asset->file_name }}</p>
          </div>
        </div>
        <div class="project-details">
          <h2>Upload Details</h2>
          <?php 
          $uploadDate=strtotime($asset->created_at);
          $uploadDate=date('M d Y',$uploadDate);

          $modifyDate=strtotime($asset->updated_at);
          $modifyDate=date('M d Y',$modifyDate);
          ?>
          <p><span>Upload date:</span> {{ $uploadDate }}</p>
          <p><span>Last used date:</span> N/A </p>
          <p><span>Modification date:</span> {{ $modifyDate }}</p>
          <p class="fileNames"><span>File names:</span> {{ $asset->file_name }}</p>
        </div>
        <div class="project-details">
          <h2>Upload Details</h2>
          <p><span>Order No:</span> #{{ $asset->order_id }}</p>
          <p><span>Files Used on:</span> N/A </p>
        </div>
        <div class="glossy-note">
          <h2>Notes</h2>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
        </div>
          <div class='progress' id="progress_div">
              <div class='bar' id='bar1'></div>
              <div class='percent' id='percent1'>0%</div>
            </div>
            <br/>
        <div class="dash-btn-wrap glossy-btns">
          <!--<a href="#" class="btn-ctrl">Update</a>-->           
            <input type="hidden" name="_token" id='token' value="{{ csrf_token() }}">
            <input type="hidden" name="asset_id" id='asset_id' value="{{ $asset->id }}">
            <input type="hidden" name="asset_type" id='asset_type' value="{{ $type }}">            
            <div class="upload-files btn-ctrl">
                <div class="upload-files-btn">
                  <span type="button" class="fileinput-button">
                      <span class="">Update</span>
                      <input name="file" class="file" type="file" />       
                    </span>                      
                </div>
            </div> <!-- upload-file -->

          <a href="#" class="btn-ctrl btn-gray"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
        </div>
      </div> <!-- common-dashtext-wrap -->

    </div> <!-- dashboard-content -->


  </div><!-- dashboard-content-wrap -->
    </div> <!-- dashboard-content -->

    <!-- Error Popup --> 
      <div class="over-lay invalidFiles">
              <div class="unsupported-popup">
                <h1>Unsupported file format <span class="close-icon"><i class="fa fa-times popup-close" aria-hidden="true"></i></span></h1>
                <table class="error-table">
                  <tbody id='error-tbody'>
                  </tbody>
                </table>
                <p>File listed above have not been uploaded, because it is in a format that we do not support.</p>
                <div class="popup-close-btn">
                  <input type="submit" name="" value="Close" class="popup-close" />
                </div>
              </div> <!-- unsupported-popup -->
            </div> <!-- over-lay --> 
@endsection