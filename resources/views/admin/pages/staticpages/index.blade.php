@extends('admin.layouts.main')
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
            <h1 class="flex-sm-fill h3 my-2">Static Pages List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Static Pages</li>
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
            <table class="table table-bordered table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">ID</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Contents</th>
                        <th style="width: 15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page_types)
                    @foreach ($page_types as $type)
                    <tr>
                        @if($loop->iteration==1)
                        <td rowspan="2" class="text-center font-size-sm">{{ $loop->parent->iteration }}</td>
                        <td rowspan="2" class="font-w600 font-size-sm text-capitalize bg-body-light">
                            {{ $type->type }}
                        </td>
                        @endif

                        <td class="font-w600 font-size-sm text-capitalize">
                            {{ $type->title }}
                        </td>
                        <td>
                            @if(!empty($type->contents))
                            @if(strlen($type->contents) > 60)
                            {{ Str::substr($type->contents, 0, 60) . '...' }}
                            @else
                            {{ html_entity_decode($type->contents) }}
                            @endif
                            @endif
                        </td>

                        <td class="status-center">
                            <a href="{{ route('admin.staticpages.show',[$type->id]) }}"><i
                                    class="icon-view fas fa-eye"></i></a>
                            <a href="{{ route('admin.staticpages.edit',[$type->id]) }}"><i
                                    class="icon-edit far fa-edit"></i></a>
                        </td>
                    </tr>


                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@endsection
