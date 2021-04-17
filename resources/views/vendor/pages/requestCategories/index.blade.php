@extends('vendor.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('css/themes/owl.carousel.css') }}">
@endsection

@section('js_after')
<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
<script src="{{ asset('js/pages/owl.carousel.js') }}"></script>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Request Categories List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">RequestCategories</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="row">
            <div class="col-12">
                <div class="block-header add-btn float-right">
                    <a href="{{ route('vendor.categories.create') }}"><i class="fas fa-plus"></i>Request Category</a>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full pd-enq">
                <thead>
                    <tr>
                        <th style="width: 5%;" class="text-center">S.No</th>
                        <th style="width: 15%;">Vendor Name</th>
                        <th style="width: 20%;">Requested Name</th>
                        <th style="width: 50%;">Reason</th>
                        <th style="width: 10%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requestCategories as $requestCategory)
                    <tr>
                        <td class="text-center font-size-sm">{{ $loop->index +1}}</td>
                        <td class="font-w600 font-size-sm">
                            {{ Auth::guard('vendor')->user()->name }}
                        </td>
                        <td>{{ $requestCategory->name }}</td>
                        <td>{{ $requestCategory->description}}</td>
                        <td class="status-center">
                            @if($requestCategory->status==0)
                            <span class="badge badge-danger">Rejected</span>
                            @elseif($requestCategory->status==1)
                            <span class="badge badge-secondary">Approved</span>
                            @else
                            <span class="badge badge-warning">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@endsection
