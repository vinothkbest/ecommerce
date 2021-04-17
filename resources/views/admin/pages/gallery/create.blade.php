@extends('admin.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .hide-scrollbar {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }

    .testimonial-group>.row {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    .testimonial-group .category-list {
        display: flex;
        overflow-x: auto;
    }

    .testimonial-group>.row>.col-4 {
        display: inline-block !important;

    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff !important;
        background-color: #f9cf1c;
    }

    .inactive {
        color: dimgray !important;
    }
</style>
@endsection


@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Create Gallery</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.galleries.index') }}">Gallery</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-content block-content-full vendors-frm">
            <form action="{{ route('admin.galleries.index') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="name" class="add-admin-frm" placeholder="Enter Title">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Type</label>
                            <select name="type" class="add-admin-frm">
                                <option>Select Type</option>
                                <option value="top">Image</option>
                                <option value="mid">Video</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="add-admin-frm">
                            @error('image')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('image') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="add-admin-frm add-admin-frms" name="status">
                                <option @selector(old('status'),'1') value="1">Active</option>
                                <option @selector(old('status'),'0') value="0">Disabled</option>
                            </select>
                            @error('status')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('status') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="category-save">
                            <button type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
@section('js_after')
<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endsection