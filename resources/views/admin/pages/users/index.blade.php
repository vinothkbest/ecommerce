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
<script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Users List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="row">
            {{-- <div class="col-sm-12 col-md-12">
                <div class="block-header add-btn">
                    <a href="{{ route('admin.users.create') }}"><i class="fas fa-plus"></i>Add Users</a>
        </div>
    </div> --}}
</div>
<div class="block-content block-content-full">
    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
        <thead>
            <tr>
                <th class="text-center">S.No</th>
                <th>Name</th>
                <th>Mobile</th>
                <th class="d-none d-sm-table-cell">E-mail</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td style="text-align: center;">{{$loop->index+1}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->mobile}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->address}}</td>
                <td>
                    @if($user->status)
                        <a href="{{ route('admin.users.status', [$user]) }}"
                            class="badge badge-success">Active</a>
                    @else
                    <a href="{{ route('admin.users.status', [$user]) }}"
                            class="badge badge-danger">Disabled</a>
                    @endif
                </td>
                <td>
                    @if($user->status)
                        <a href="{{ route('admin.users.show', [$user]) }}" class="badge badge-success"><i class="fas fa-eye"></i></a>
                    @endif
                        <a href="#" class="badge badge-danger"><i class="fas fa-trash-alt"></i></a>

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