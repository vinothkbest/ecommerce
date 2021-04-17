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

<!-- Page JS Code -->
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Roles List
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Roles</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">


    <!-- Dynamic Table Full -->
    <div class="block block-rounded">

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="block-header add-btn">
                    <a href="{{ route('admin.roles.create') }}"><i class="fas fa-plus"></i>Add Role</a>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/tables_datatables.js -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Roles</th>
                            <th>Status</th>

                            <th style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php ($i = 1)
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ ucwords($role->name) }}</td>
                            <td>
                                @if($role->status)
                                <a href="{{route('admin.roles.status',[$role->id])}}" class="btn btn-alt-success"><i
                                        class="fa fa-check"></i></a>
                                @else
                                <a href="{{route('admin.roles.status',[$role->id])}}" class="btn btn-alt-danger"><i
                                        class="fa fa-times"></i></a>
                                @endif

                            </td>
                            <td>
                                <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="btn  btn-sm btn-warning"><i
                                        class="fa fa-fw fa-pencil-alt"></i></a>

                            </td>
                        </tr>
                        @php ($i++)
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Dynamic Table Full -->


</div>
<!-- END Page Content -->
@endsection
