@extends('admin.layouts.main')
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
                        <a class="link-fx" href="{{ route('admin.orders.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Orders</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>OrderId</th>
                        <th>Ordered Price (₹)</th>
                        @if($type != "cancel")
                            <th>TrackId</th>
                            <th>Cancel Request</th>
                        @else
                            <th>Cancelled on</th>
                            <th>Refund Approval</th>
                        @endif
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->user ?? ''}}</td>
                        <td>{{ $order->order_id }}</td>
                        <td>{{intval($order->transaction->ordered_price ?? '')}}</td>
                        @if($type != "cancel")
                        <td><p id="parcelid">
                            {{ ($order->parcel_id)? $order->parcel_id : "To Assign"}}
                            </p>
                        </td>
                        <td>
                            @if($order->is_cancelled)
                                <a href="{{ route("admin.orders.cancel", [$order]) }}"
                                   class="badge badge-danger">Approve</a>
                            @else
                                <a class="badge badge-success">Approved</a>
                            @endif
                        </td>
                        @else
                            <td>{{ $order->cancelled_date }}</td>
                            <td>
                                @if($order->transaction->is_refunded == 0)
                                    <a href="{{ route('admin.orders.refund', [$order]) }}" class="badge badge-danger">Approve</a>
                                @else
                                    <a class="badge badge-success">Approved</a>
                                @endif
                            </td>
                        @endif
                        <td><a href="{{ route(($type != "cancel")? "admin.orders.show" : "admin.cancelled.orders.details", [$order]) }}" class="badge badge-success"><i
                                    class="fas fa-eye"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>     
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
<script>
    if(document.getElementById("parcelid").innerText == "To Assign"){
        document.getElementById("parcelid").setAttribute("class", "text-danger")
    }
</script>
@endsection