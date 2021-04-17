@extends('admin.layouts.main')

@section('js_after')
<script>
    jQuery(function () { One.helpers(['table-tools-checkable', 'table-tools-sections']); });
</script>
@endsection

@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Order Details</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</li></a>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.orders.index') }}">Orders</li></a>
                    <li class="breadcrumb-item">{{ $order->order_id }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-content">
            <div class="row">
                <div class="col-12">
                    <div class="block block-rounded">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card-header">
                                        <b>Tracking ID (From Courier)</b>
                                    </div>
                                    <div class="card-body">
                                    @if(!$order->parcel_id)
                                        <form action="{{ route("admin.orders.update", [$order]) }}" method="post">
                                            @csrf
                                            @method("put")
                                            <input type="text" name="parcel"
                                                   placeholder="Please Enter POD No."
                                                   class="form-control">
                                            <br>
                                            <button type="submit"
                                                   class="w-100 btn btn-success">Assign</button>
                                        </form>
                                    @else
                                        <p style="font-size:14px;">{{ $order->parcel_id }}</p>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card-header">
                                        <b>Shipping Addess</b>
                                    </div>
                                    <div class="card-body">
                                        <li type="none" style="font-size:14px;">Customer Name: {{ $order->user ?? '' }},</li>
                                        <li type="none" style="font-size:14px;">{{ $order->shipping_address["door_number"]}}  {{ $order->shipping_address["area"] }},</li>
                                        <li type="none" style="font-size:14px;">{{ $order->shipping_address["city"]}},  {{ $order->shipping_address["state"]}},</li>
                                        <li type="none" style="font-size:14px;">{{ $order->shipping_address["country"] ." " . $order->shipping_address["pin_code"] }}</li>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <b>Order Summary (#{{ $order->order_id }})</b>
                                        <span><li type="none" style="font-size:14px;">Ordered Date: {{ $order->ordered_date }}</li></span>
                                        <a href="{{ route("admin.orders.invoice", [$order]) }}">
                                            <p>Invoice <i class="text-success fa fa-download"></i></p>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="font-size:12px;">Product</th>
                                                <th style="font-size:12px;">Qty</th>
                                                <th style="font-size:12px;">Selling Price (₹)</th>
                                                <th style="font-size:12px;">Item</th>
                                                <th style="font-size:12px;">Price (₹)</th>
                                                <th style="font-size:12px;">Tax (%)</th>
                                                <th style="font-size:12px;">Total Price (₹)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @foreach($order->order_summary as $summary)
                                                <tr>
                                                    <td style="font-size:14px;">{{ $summary["product_name"] }}</td>
                                                    <td style="font-size:14px;">{{ $summary["weight"] }}</td>
                                                    <td style="font-size:14px;">{{ $summary["selling_price"]/$summary["items"] }}</td>
                                                    <td style="font-size:14px;">{{ $summary["items"] }}</td>
                                                    <td style="font-size:14px;">{{ $summary["selling_price"] }}</td>
                                                    <td style="font-size:14px;">{{ $summary["gst_tax"] }}</td>
                                                    <td style="font-size:14px;">{{ intval($summary["amount_after_tax"]) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <b>Transaction (#{{ $order->transaction->txn_id }})</b>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="font-size:12px;">Mobile</th>
                                                <th style="font-size:12px;">Email</th>
                                                <th style="font-size:12px;">Pay mode</th>
                                                <th style="font-size:12px;">Bank Ref. No.</th>
                                                <th style="font-size:12px;">Paid Amount (₹)</th>
                                                <th style="font-size:12px;">Pay Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="font-size:14px;">{{ $order->transaction->mobile }}</td>
                                                <td style="font-size:14px;">{{ $order->transaction->email }}</td>
                                                <td style="font-size:14px;">{{ $order->transaction->pay_mode }}</td>
                                                <td style="font-size:14px;">{{ $order->transaction->bank_ref_num }}</td>
                                                <td style="font-size:14px;">{{ intval($order->transaction->ordered_price) }}</td>
                                                <td style="font-size:14px;">{{ $order->transaction->pay_status }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
