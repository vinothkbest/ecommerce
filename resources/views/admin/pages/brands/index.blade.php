@extends('admin.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
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
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Brands List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Brands</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="block-header add-btn">
                    <a href="{{ route('admin.brands.create') }}"><i class="fas fa-plus"></i>Add Brand</a>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th style="width: 5%;" class="text-center" style="width: 80px;">S.No</th>
                        <th style="width: 20%;">Name</th>
                        <th style="width: 20%;">Categories</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Image</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $brand)
                    <tr>
                        <td style="text-align: center;">{{$loop->index+1}}</td>
                        <td>{{$brand->brand_name}}</td>
                        <td>
                            @foreach ($brand->categories as $category)
                                @if($loop->last)
                                    {{ $category->category_name ?? '' }}
                                @else
                                    {{ $category->category_name ?? '' }},
                                @endif
                                
                            @endforeach
                        </td>
                        <td><img src="{{ asset('/images/brands/'.$brand->brand_image) }}" alt="" style="width: 20%;"></td>
                        <td>
                            @if($brand->status)
                            <a href="{{route('admin.brands.status',[$brand->id])}}" class="badge badge-success">Active</a>
                            @else
                            <a href="{{route('admin.brands.status',[$brand->id])}}" class="badge badge-danger">Disable</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.brands.edit',[$brand->id])}}" class="badge badge-primary"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('admin.brands.delete', [$brand->id]) }}" class="badge badge-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    
                    @empty
                    <td colspan="6" class="text-center">
                        <h3>No records found</h3>
                    </td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@endsection