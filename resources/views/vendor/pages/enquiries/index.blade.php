@extends('vendor.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('css/themes/owl.carousel.css') }}">
@endsection

@section('js_after')
<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
<script src="{{ asset('js/pages/owl.carousel.js') }}"></script>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Enquiries List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Enquiries</li>
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
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full pd-enq">
                <thead>
                    <tr>
                        <th class="text-center">S.No</th>
                        <th>From</th>
                        <th>To</th>
                        <th style="width: 15%;">Product</th>
                        <th style="width: 25%;">Message</th>
                        <th style="width: 10%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($enquiries as $enquiry)
                    <tr>
                        <td class="text-center font-size-sm">{{ $loop->index+1 }}</td>
                        <td class="font-w600 font-size-sm">
                            {{ $enquiry->user->email }}
                        </td>
                        <td class="font-w600 font-size-sm">
                            {{ $enquiry->product->vendor->email }}
                        </td>
                        <td>{{ $enquiry->product->name }}</td>
                        <td>{{ $enquiry->description}}</td>
                        <td class="status-center">
                            @if($enquiry->status==2)
                            <a href="{{ route('vendor.enquiries.status',[$enquiry->id]) }}">
                                <span class="badge badge-success">Readed</span>
                            </a>
                            @elseif($enquiry->status==1)
                            <a href="{{ route('vendor.enquiries.status',[$enquiry->id]) }}">
                                <span class="badge badge-primary">Pending</span>
                            </a>
                            @else
                            <a href="{{ route('vendor.enquiries.status',[$enquiry->id]) }}">
                                <span class="badge badge-secondary">Disabled</span>
                            </a>
                            @endif
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
