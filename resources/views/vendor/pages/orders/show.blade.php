@extends('vendor.layouts.main')

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
                        <a class="link-fx" href="{{ route('vendor.dashboard') }}">Dashboard</li></a>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('vendor.orders.index') }}">Orders</li></a>
                    <li class="breadcrumb-item">YROC{{ $order->id }}</li>
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
                        <div class="block-header">
                            <h3 class="block-title">Customer Detail</h3>
                        </div>
                        <div class="block-content">
                            <div class="font-size-h4 mb-1">{{ $order->user->name }}</div>
                            <address class="font-size-sm" style="white-space: pre-line">{{ $order->user->address }}
                                <i class="fa fa-phone"></i> {{ $order->user->mobile_number }}<br>
                                <i class="fa fa-envelope-o"></i> <a
                                    href="javascript:void(0)">{{ $order->user->email }}</a>
                            </address>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="block block-rounded">
                        <div class="block-header">
                            <h3 class="block-title">Products</h3>
                            <div class="block-options">
                                <div class="block-options-item">
                                    <code>Total Products - {{ count($order->products) }}</code>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <table class="js-table-sections table table-hover table-vcenter">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;"></th>
                                        <th>Product Code</th>
                                        <th style="width: 15%;">Product Name</th>
                                        <th style="width: 15%;">Fixed Price</th>
                                        <th style="width: 15%;">Total Quantity</th>
                                        <th style="width: 15%;">Total Price</th>
                                    </tr>
                                </thead>
                                @foreach ($order->products as $product)
                                <tbody class="js-table-sections-header">
                                    <tr>
                                        <td class="text-center">
                                            <i class="fa fa-angle-right text-muted"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="be_pages_generic_profile.html">YRPC{{ $product->product_id }}</a>
                                        </td>
                                        <td>{{ $product->meta['name'] }}</td>
                                        <td>{{ $product->meta['fixed_price'] }}</td>
                                        <td>{{ $product->variants->sum(fn ($a)=>intVal($a->quantity)) }}</td>
                                        <td>{{ $order->total_price }}</td>
                                    </tr>
                                </tbody>
                                <tbody class="font-size-sm">
                                    @forelse ($product->variants as $variant)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td class="text-center">{{ $variant->size }}</td>
                                        <td colspan="2" class="font-w600 font-size-sm">
                                            <span class="rounded-circle"
                                                style="width: 20px;height:20px;background-color:{{ explode('||',$variant->color)[0] }};display: inline-block"></span>
                                            <span
                                                style="vertical-align: super;">{{ explode('||',$variant->color)[1] }}</span>
                                        </td>
                                        <td class="font-w600 font-size-sm">{{ $variant->quantity}}</td>
                                        <td class="font-w600 font-size-sm">
                                            {{ intVal($variant->quantity)*intVal($product->meta['fixed_price'])}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="5">No variants found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
