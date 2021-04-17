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
            <h1 class="flex-sm-fill h3 my-2 page-title"></h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.tags.index') }}">Tag List
                        </a>
                    </li>
                    <li class="breadcrumb-item page-name" aria-current="page"></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-content block-content-full vendors-frm">
            <form enctype="multipart/form-data" method="post" id="tag_form">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tag Name</label>
                            <input type="text" class="add-admin-frm"
                                   name="tag-title" autocomplete="off" required id="tag_title">
                        </div>
                        <div class="form-group">
                            <label>SEO Title</label>
                            <input type="text" class="add-admin-frm"
                                   name="seo-title" autocomplete="off" required id="seo_title">
                        </div>
                        <div class="form-group">
                            <label>SEO Keyword</label>
                            <input type="text" class="add-admin-frm"
                                   name="keyword" autocomplete="off" required id="keyword">
                        </div>
                        <div class="form-group">
                            <label>SEO Description</label>
                            <textarea name="description" rows="4"
                                      class="add-admin-frm" autocomplete="off" required id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="add-admin-frm"
                                accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        {{-- <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="add-admin-frm">
                                <option value="1" selected>Active</option>
                                <option value="0">Disable</option>
                            </select>
                        </div> --}}

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
@if($formswap == 'add')
    <script>
        jQuery('.page-name').text("Add");
        jQuery('.page-title').text("Add Tag");
        jQuery('#tag_form').attr("action", "{{ route('admin.tags.store') }}");
        
    </script>
@else
    <script>
        jQuery('.page-name').text(`{{ $tag->title ?? ''}}`);
        jQuery('.page-title').text("Edit Tag");
        jQuery('#tag_form').attr("action", "{{ route('admin.tags.update', [$tag->id]) }}");
        jQuery('#tag_form').append('@method("put")');
        jQuery('#tag_title').val("{{ $tag->title }}");
        jQuery('#seo_title').val("{{ $tag->tagSeo->title }}");
        jQuery('#keyword').val("{{ $tag->tagSeo->keyword }}");
        jQuery('#description').text("{{ $tag->tagSeo->description }}");
    </script>
@endif
@endsection