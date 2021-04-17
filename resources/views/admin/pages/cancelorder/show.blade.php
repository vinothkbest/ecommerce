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
                Cancel Order View
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</li></a>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.cancelorders.index') }}">Cancel Order</li>
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
                                    <th colspan="3" class="block-title">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 40%;">Order ID</td>
                                    <td>: </td>
                                    <td>Kapa0203</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Cancelled Date</td>
                                    <td>: </td>
                                    <td>01/03/2021</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Customer Name</td>
                                    <td>: </td>
                                    <td>John</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Product Name</td>
                                    <td>: </td>
                                    <td>Cashews</td>
                                </tr>

                                <tr>
                                    <td style="width: 40%;">Variant</td>
                                    <td>: </td>
                                    <td>1Kg</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Quantity</td>
                                    <td>: </td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Address</td>
                                    <td>: </td>
                                    <td>No:67 ABC Avenue, 5th Street, Chennai-97.</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Total</td>
                                    <td>: </td>
                                    <td>Rs.1000/-</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- END Billing Address -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection