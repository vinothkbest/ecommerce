@extends('admin.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
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
            <h1 class="flex-sm-fill h3 my-2">Add Sub Category</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.blog_subcategories.index') }}">Blog Sub Category
                            List</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-content block-content-full vendors-frm">
            <form action="{{ route('admin.blog_subcategories.index') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sub Category Name</label>
                            <input type="text" class="add-admin-frm" name="category-name">
                        </div>
                        <div class="form-group">
                            <label>SEO Title</label>
                            <input type="text" class="add-admin-frm" name="title">
                        </div>
                        <div class="form-group">
                            <label>SEO Keyword</label>
                            <input type="text" class="add-admin-frm" name="keyword">
                        </div>
                        <div class="form-group">
                            <label>SEO Description</label>
                            <textarea name="description" rows="4" class="add-admin-frm"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="type" class="add-admin-frm">
                                <option>Select Status</option>
                                <option value="active">Active</option>
                                <option value="disable">Disable</option>
                            </select>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="category-save">
                                <button type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

@section('js_after')
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>

<script src="{{ asset('js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js')}}"></script>
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/pages/be_forms_wizard.min.js')}}"></script>
<script src="{{ asset('js/ntc.js') }}"></script>
@endsection