@extends('vendor.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/themes/owl.carousel.css') }}">
@endsection

@section('js_after')
<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
<script src="{{ asset('js/pages/owl.carousel.js') }}"></script>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Subscripers/Transactions List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Subscripers/Transactions</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block-content block-content-full">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center">S.No</th>
                        <th>Vendor Name</th>
                        <th>Subscription Name</th>
                        <th>Transcation ID</th>
                        <th>Amount</th>
                        <th>Credit Balance</th>
                        <th>Transcation Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td class="text-center font-size-sm">{{ $loop->index+1 }}</td>
                        <td class="font-w600 font-size-sm">{{ Auth::guard('vendor')->user()->name}}</td>
                        <td>{{ $transaction->subscription->name}}</td>
                        <td>{{ $transaction->transaction_id}}</td>
                        <td>&#8377; {{ $transaction->amount}}</td>
                        <td>{{ $transaction->balance_image_count }}</td>
                        <td>{{ $transaction->expiry_date->gte(now())?'Active':'Expired'}}</td>
                        <td>
                            <a href="{{ route('vendor.transactions.show',[$transaction->id]) }}"><i
                                    class="icon-view fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END Dynamic Table Full -->
</div>
@endsection
