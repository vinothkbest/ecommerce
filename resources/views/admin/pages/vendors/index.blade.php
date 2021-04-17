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
            <h1 class="flex-sm-fill h3 my-2">Vendors List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Vendors</li>
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
                    <a href="{{ route('admin.vendors.create') }}"><i class="fas fa-plus"></i>Add Vendor</a>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">S.No</th>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 20%;">Email</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Mobile Number</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Shop Name</th>
                        <th style="width: 15%;">GST Status</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vendors as $vendor)
                    <tr>
                        <td class="text-center font-size-sm">{{ $loop->index+1 }}</td>
                        <td class="font-w600 font-size-sm">
                            <a href="be_pages_generic_blank.html">{{ $vendor->name }}</a>
                        </td>
                        <td class="text-center font-size-sm">{{ $vendor->email }}</td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            <em class="text-muted">{{ $vendor->mobile_number }}</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="text-muted font-size-sm">{{ $vendor->shop_name }}</em>
                        </td>
                        <td class="status-center">
                            @if($vendor->gst_verified_at)
                            <a href="{{ route('admin.vendors.verify',[$vendor->id]) }}"><img
                                    src="{{ asset('images/gst-verified.png') }}" alt="gst-verified"
                                    style="width: 30%;"></a>
                            @else
                            <a href="{{ route('admin.vendors.verify',[$vendor->id]) }}"><img
                                    src="{{ asset('images/gst-un-verified.png') }}" alt="gst-verified"
                                    style="width: 30%;"></a>
                            @endif
                        </td>
                        <td>
                            @if($vendor->status)
                            <a href="{{ route('admin.vendors.status',[$vendor->id]) }}"><span
                                    class="badge badge-success">Active</span></a>
                            @else
                            <a href="{{ route('admin.vendors.status',[$vendor->id]) }}"><span
                                    class="badge badge-secondary">Disabled</span></a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.vendors.edit',[$vendor->id]) }}"><i
                                    class="icon-edit far fa-edit"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No records found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@endsection
