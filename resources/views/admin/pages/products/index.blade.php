@extends('admin.layouts.main')
@section('css_before')
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">

@endsection

@section('js_after')
<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Products List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Products</li>
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
                    <a href="{{ route('admin.products.create') }}"><i class="fas fa-plus"></i>Add Product</a>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th style="width: 5%;" class="text-center" style="width: 80px;">S.No</th>
                        <th style="width: 25%;">Categories</th>
                        <th style="width: 20%;" class="d-none d-sm-table-cell">Product Name</th>
                        <th style="width: 5%;">Image</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 30%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb breadcrumb-alt push">
                                    @foreach ($product->categories as $category)
                                        @if($loop->last)
                                            <li class="breadcrumb-item text-primary">
                                                {{ $category->category_name ?? '' }}
                                            </li>
                                        @else
                                            <li class="breadcrumb-item">
                                                {{ $category->category_name ?? '' }}
                                            </li>
                                        @endif
                                    @endforeach
                                </ol>
                            </nav>
                        </td>
                        <td>{{$product->product_name}}</td>
                        <td style="width: 20%;">
                            <img src="{{ $product->productMedia[0]->path ?? '' }}" alt="nuts" style="width: 40%;">
                        </td>
                        
                        <td>@if($product->status)
                                <a href="{{ route('admin.products.status',[$product->id]) }}" class="badge badge-success">Active</a>
                            @else
                                <a href="{{ route('admin.products.status',[$product->id]) }}" class="badge badge-danger">Disable</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.show',[$product]) }}" class="badge badge-success"><i
                                    class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.products.edit', [$product]) }}" class="badge badge-info"><i
                                    class="fas fa-edit"></i></a>
                            <a href="{{ route('admin.products.delete', [$product]) }}" class="badge badge-danger"><i class="fas fa-trash-alt"></i></a>
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