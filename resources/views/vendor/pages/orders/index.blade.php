@extends('vendor.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('js_after')
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
            <h1 class="flex-sm-fill h3 my-2">Orders List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('vendor.orders.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Orders</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="block-header">
                    <h3 class="block-title">Order History</h3>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full pd-enq">
                <thead>
                    <tr>
                        <th class="text-center">S.No</th>
                        <th>Order Code</th>
                        <th>Customer Name</th>
                        <th>Company Name</th>
                        <th>Placed Date</th>
                        <th style="width: 10%;">Status</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td class="text-center font-size-sm">{{ $loop->index+1 }}</td>
                        <td class="font-w600 font-size-sm">
                            YROC{{ $order->id }}
                        </td>
                        <td class="font-w600 font-size-sm">
                            {{ $order->user->name }}
                        </td>
                        <td class="font-w600 font-size-sm">
                            {{ $order->user->shop_name }}
                        </td>
                        <td>{{ date('M d, Y', strtotime($order->created_at)) }}</td>
                        <td class="status-center">
                            @if($order->status==2)
                            <a href="{{ route('vendor.enquiries.status',[$order->id]) }}">
                                <span class="badge badge-success">Delivered</span>
                            </a>
                            @elseif($order->status==1)
                            <a href="{{ route('vendor.enquiries.status',[$order->id]) }}">
                                <span class="badge badge-primary">Pending</span>
                            </a>
                            @else
                            <a href="{{ route('vendor.enquiries.status',[$order->id]) }}">
                                <span class="badge badge-secondary">Disabled</span>
                            </a>
                            @endif
                        </td>
                        <td class="status-center">
                            <a href="{{ route('vendor.orders.show',[$order->id]) }}"><i
                                    class="icon-view fas fa-eye"></i></a>
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
