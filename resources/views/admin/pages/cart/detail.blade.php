@extends('admin.layouts.main')

@section('css_before')
@endsection

@section('js_after')

@endsection

@section('content')

<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Cart View
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</li></a>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.carts.index') }}">{{ $cart->product_name ?? '' }}</li>
                    </a>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="block block-rounded">
                        <table class="table table-borderless voting-amt">
                            <thead>
                                <tr class="block-header-default">
                                    <th colspan="3" class="block-title">Cart Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 40%;">User</td>
                                    <td>: </td>
                                    <td>{{ $cart->user->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Product</td>
                                    <td>: </td>
                                    <td>{{ $cart->product_name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Image</td>
                                    <td>: </td>
                                    <td><img src="{{ $cart->product->productCoverImage->path ?? ''}}" alt="nuts" style="width: 35%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Items</td>
                                    <td>: </td>
                                    <td>{{ $cart->items ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Stock</td>
                                    <td>: </td>
                                    @if($cart->product->singleVariant->availablity_status)
                                        <td>In Stock</td>
                                    @else
                                        <td>Out of Stock</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Quantity</td>
                                    <td>: </td>
                                    <td>{{ $cart->weight ?? ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="block block-rounded">
                        <table class="table table-borderless voting-amt">
                            <thead>
                                <tr class="block-header-default">
                                    <th colspan="3" class="block-title">Price Summary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 40%;">Actual Price (₹)</td>
                                    <td>: </td>
                                    <td>{{ ($cart->actual_price ?? '')}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Discount (₹)</td>
                                    <td>: </td>
                                    <td>{{ ($cart->discount_price ?? '')}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Selling Price (₹)</td>
                                    <td>: </td>
                                    <td>{{ ($cart->selling_price ?? '')}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Tax (%)</td>
                                    <td>: </td>
                                    <td>{{ ($cart->gst_tax ?? '')}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Total Price</td>
                                    <td>: </td>
                                    <td>{{ ($cart->amount_after_tax ?? '') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection