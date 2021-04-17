@extends('admin.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('js_after')
<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>

<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script>
    jQuery(document).ready(function(){
         One.helpers('validation');
         jQuery('.js-validation').validate({
            ignore: [],
            rules: {
                'name': {
                    required: true,
                },
                'email': {
                    required: true,
                    email:true
                },
                'role':{
                    required: true,
                }
            },
            messages: {
                'name':'Please enter Role name',
                'email':'Admins email required',
                'role':'Please select role of this admin'
            }
        });

        @if($errors->has('invalid_credential'))
            One.helpers('notify', {align: 'center',type: 'danger', message: '{{$errors->first("invalid_credential")}}'});
        @endif
    });

</script>

<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
<!-- Page JS Code -->
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Admins List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Admins</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="block-header add-btn">
                    <a href="{{ route('admin.admins.create') }}"><i class="fas fa-plus"></i>Add Admin</a>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">S.No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Role</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                    <tr>
                        <td class="text-center font-size-sm">{{ $loop->index+1 }}</td>
                        <td class="text-center font-size-sm">{{ $admin->name }}</td>
                        <td class="font-w600 font-size-sm">
                            <a href="be_pages_generic_blank.html">{{ $admin->name }}</a>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            {{ explode('@',$admin->email)[0] }}<em
                                class="text-muted">{{ '@'.explode('@',$admin->email)[1] }}</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted font-size-sm">{{ $admin->roles->implode('name') }}</em>
                        </td>
                        <td>
                            @if($admin->status)
                            <a href="{{ route('admin.admins.status',[$admin->id]) }}"><span
                                    class="badge badge-success">Active</span></a>
                            @else
                            <a href="{{ route('admin.admins.status',[$admin->id]) }}"><span
                                    class="badge badge-secondary">Disabled</span></a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.admins.edit',[$admin->id]) }}"><i
                                    class="icon-edit far fa-edit"></i></a>
                        </td>
                    </tr>
                    @empty
                    <td colspan="6" class="text-center">
                        <h3>No records found</h3>
                    </td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@endsection
