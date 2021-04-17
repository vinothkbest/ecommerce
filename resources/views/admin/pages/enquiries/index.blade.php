@extends('admin.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('css/themes/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('/js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/js/plugins/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{ asset('js/plugins/select2/js/select2.full.min.js')}}"></script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
<script src="{{ asset('js/pages/owl.carousel.js') }}"></script>
<script>
    jQuery(function () {
    One.helpers(['flatpickr', 'select2']);
});
</script>
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
        {{-- <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="block-header add-btn">
                    <a href="{{ route('admin.enquiries.create') }}"><i class="fas fa-plus"></i>Add Enquiry</a>
    </div>
</div>
</div> --}}
<div class="block-content block-content-full">

    <x-dynamic-table :data="$enquiries" :model="$model">
        <form id="filter" class="form-inline " action="{{route('admin.enquiries.index')}}" method="GET">
            <input type="text" style="width: 150px" value="{{request()->f_date}}"
                class="js-flatpickr form-control bg-white  mr-sm-2" name="f_date" placeholder="Date From">
            &nbsp;&nbsp;
            <input type="text" style="width: 150px" value="{{request()->t_date}}"
                class="js-flatpickr form-control bg-white  mr-sm-2 " " name=" t_date" placeholder="Date To">

            <select class="js-select2 form-control  mb-2 mr-sm-1 mb-sm-0" name="vendor_id" style="width: 200px;"
                data-placeholder="Select Status...">
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach ($vendors as $vendor)
                <option @selector(request()->vendor_id,$vendor->id) value="{{ $vendor->id }}">{{ $vendor->shop_name }}
                </option>
                @endforeach

            </select>
            &nbsp;&nbsp;
            <input type="hidden" name="rows" value="{{$enquiries->perPage()}}">
            <input type="hidden" name="search" value="{{request()->search}}">

            <a href="{{route('admin.enquiries.index')}}" class="btn btn-square btn-secondary  mr-sm-2"><i
                    class="si si-reload"></i>
                Clear</a>
            <button type="submit" class="btn btn-square  btn-success  mr-sm-2"><i class="fa fa-filter"></i>
                Filter</button>
            <button type="submit" class="btn btn-square btn-primary  mr-sm-2" name="export" value="Export"><i
                    class="fa fa-file-export"></i> Export</button>
        </form>
    </x-dynamic-table>
</div>
</div>
<!-- END Dynamic Table Full -->
</div>
@endsection