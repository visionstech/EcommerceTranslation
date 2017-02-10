@extends('backend.app')
@section('title')
	User Roles
@endsection
@section('content')
    <section class="content-header">
      <h1>
        Manage Roles
        <small>Admin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active"><a href="{{ url('/role') }}">Roles Overview</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
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
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><a href="{{ url('/role/add-role') }}">Add Role</a></h3>
                </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->role }}</td>
                                    <td>{{ $role->created_at }}</td>
                                    <td>{{ $role->status }}</td>
                                   <td>
                                    <?php if($role->status != 'Deactive'){ ?>
                                          <a class="btn btn-primary actionAnchor" data-target=".bs-example-modal-dm" data-toggle="modal" href="javascript:void(0);" data-did="{{ encrypt($role->id) }}" data-status="Deactive" data-statusDiv="Deactive">Deactive</a>
                                    <?php }else{ ?>
                                    <a class="btn btn-primary actionAnchor" data-target=".bs-example-modal-dm" data-toggle="modal" href="javascript:void(0);" data-did="{{ encrypt($role->id) }}" data-status="Active" data-statusDiv="Active">Active</a>
                                    <?php } ?>
                                    <a class="btn btn-primary actionedit" href="{{ url('/role/add-role/'.encrypt($role->id)) }}">Edit</a>
                                   </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                     </div>
                </div>
                
            </div>
        </div>
    </section>
<!-- Popup Model For Delete action -->

<div class="modal fade bs-example-modal-dm" aria-hidden="true" role="dialog" tabindex="-1" style="display: none;">   <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2"><span class="statusDiv"></span> Role</h4>
            </div>
            <div class="modal-body">
                <h4></h4>
                <p>Are you sure you want to <span class="statusDiv"></span> this role ? </p>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="RoleId" class="RoleId" />
                <input type="hidden" name="status" class="status" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary delete_confirm"><span class="statusDiv"></span></button>
            </div>
        </div>
    </div>
</div>
<!-- End Popup Model -->
@endsection
@section('js')
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $("#example1").dataTable();
        var baseUrl='<?php echo URL::to('/'); ?>';
        $('.actionAnchor').click(function(){
            var RoleId=$(this).attr('data-did');
            var status=$(this).attr('data-status');
            var statusDiv=$(this).attr('data-statusDiv');
            $('.status').val(status);
            $('.statusDiv').html(statusDiv);
            $('.RoleId').val(RoleId);
        });
        
        $('.delete_confirm').click(function(){
            var RoleId=$('.RoleId').val();
            var Status=$('.status').val();
            window.location.href=baseUrl+'/role/delete-role/'+RoleId+'/'+Status;
        });        
    });
</script>
@endsection
 

