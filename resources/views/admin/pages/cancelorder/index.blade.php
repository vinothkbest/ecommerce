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
            <h1 class="flex-sm-fill h3 my-2">Cancel Orders List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Cancel Order List</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">S.No</th>
                        <th>Canceled Date</th>
                        <th style="width: 20%;" class="d-none d-sm-table-cell">Order ID</th>
                        <th style="width: 20%;" class="d-none d-sm-table-cell">Total</th>
                        <th style="width: 20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td>01/03/2021</td>
                        <td>Kapa0203</td>
                        <td>Rs.500/-</td>
                        <td>
                            <a href="{{ route('admin.cancelorders.show',[1]) }}" class="badge badge-success"><i
                                    class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    {{-- @foreach($products as $product)
                    <tr>
                        <td class="text-center font-size-sm">{{ $loop->index+1 }}</td>
                    <td class="font-w600 font-size-sm">
                        {{ $product->parents_path[0]["name"]}}
                    </td>
                    <td class="d-none d-sm-table-cell font-size-sm">
                        {{ $product->brand->name}}
                    </td>
                    <td>YRPC{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @if($product->status)
                        <a href="{{ route('admin.products.status',[$product->id]) }}"><span
                                class="badge badge-success">Active</span></a>
                        @else
                        <a href="{{ route('admin.products.status',[$product->id]) }}"><span
                                class="badge badge-secondary">Disabled</span></a>
                        @endif
                    </td>
                    <td class="status-center">
                        <a href="{{ route('admin.products.show',[$product->id]) }}"><i
                                class="icon-view fas fa-eye"></i></a>
                        <a href="{{ route('admin.products.edit',[$product->id]) }}"><i
                                class="icon-edit far fa-edit"></i></a>
                    </td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@endsection