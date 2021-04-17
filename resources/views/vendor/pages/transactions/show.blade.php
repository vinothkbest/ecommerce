@extends('vendor.layouts.main')

@section('css_before')
@endsection

@section('js_after')

@endsection

@section('content')
@php
$menu=[];
$menu[]=$transaction->status=='1'?1:0;
$menu[]=$transaction->transaction_status=="success"?$menu[0]:0;
$menu[]=$menu[1];
$menu[]=$transaction->expiry_date->lte(now())?$menu[2]:0;
@endphp
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Transaction Details
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('vendor.dashboard') }}">Dashboard</li></a>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('vendor.transactions.index') }}">Subscripers/Transactions</li>
                    </a>
                    <li class="breadcrumb-item">YRTC{{ $transaction->id }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-content">
            <div class="row">
                <div class="col-6 col-lg-3">
                    <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                        <div class="block-content block-content-full">
                            <div class="item item-circle {{ $menu[0]==1?'bg-success':'bg-danger' }}-light mx-auto">
                                <i class="fa fa-check {{ $menu[0]==1?'text-success':'text-danger' }}"></i>
                            </div>
                        </div>
                        <div class="block-content py-2 bg-body-light">
                            <p class="font-w600 font-size-sm {{ $menu[0]==1?'text-success':'text-danger' }} mb-0">
                                YRTC{{ $transaction->id }}
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                        <div class="block-content block-content-full">
                            <div class="item item-circle {{ $menu[1]==1?'bg-success':'bg-danger' }}-light mx-auto">
                                <i class="fa fa-check {{ $menu[1]==1?'text-success':'text-danger' }}"></i>
                            </div>
                        </div>
                        <div class="block-content py-2 bg-body-light">
                            <p class="font-w600 font-size-sm {{ $menu[1]==1?'text-success':'text-danger' }} mb-0">
                                Payment {{ $transaction->transaction_status }}
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                        <div class="block-content block-content-full">
                            <div
                                class="item item-circle {{ $menu[2]==1?($menu[3]==1?'bg-success':'bg-warning'):'bg-danger' }}-light mx-auto">
                                <i
                                    class="fa fa-sync {{ $menu[2]==1?($menu[3]==1?'text-success':'fa-spin text-warning'):'text-danger' }}"></i>
                            </div>
                        </div>
                        <div class="block-content py-2 bg-body-light">
                            <p
                                class="font-w600 font-size-sm {{ $menu[2]==1?($menu[3]==1?'text-success':'text-warning'):'text-danger' }} mb-0">
                                {{ $menu[2]==1?($menu[3]==1?'Completed':'Active'):'Pending'}}
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                        <div class="block-content block-content-full">
                            <div class="item item-circle {{ $menu[3]==1?'bg-danger':'bg-body' }}-light mx-auto">
                                <i class="fa fa-times {{ $menu[3]==1?'text-danger':'text-muted' }}"></i>
                            </div>
                        </div>
                        <div class="block-content py-2 bg-body-light">
                            <p class="font-w600 font-size-sm {{ $menu[3]==1?'text-danger':'text-muted' }} mb-0">
                                Expired
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="block block-rounded">
                        <table class="table table-borderless">
                            <thead>
                                <tr class="block-header-default">
                                    <th colspan="2" class="block-title">Basic Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 40%;">Vendor Name</td>
                                    <td>: {{ $transaction->vendor->name}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Subscription Name</td>
                                    <td>: {{ $transaction->subscription->name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Total Credits</td>
                                    <td>: {{ $transaction->total_image_count }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">UsedCredits</td>
                                    <td>: {{ $transaction->balance_image_count }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Balance Credits</td>
                                    <td>: {{ $transaction->total_image_count-$transaction->balance_image_count }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Expiry Date</td>
                                    <td>: {{ $transaction->expiry_date->format('M d, Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- END Billing Address -->
                </div>
                <div class="col-6">
                    <div class="block block-rounded">
                        <table class="table table-borderless">
                            <thead>
                                <tr class="block-header-default">
                                    <th colspan="2" class="block-title">Purchase Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 40%;">Transaction ID</td>
                                    <td>: {{ $transaction->transaction_id}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Amount</td>
                                    <td>: {{ $transaction->amount }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Purchase Date</td>
                                    <td>: {{ $transaction->purchase_date->format('M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Transaction Status</td>
                                    <td>: {{ $transaction->transaction_status }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Transaction Created On</td>
                                    <td>: {{ $transaction->created_at->format('M d, Y') }}</td>
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
