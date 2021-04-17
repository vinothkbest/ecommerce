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
            <h1 class="flex-sm-fill h3 my-2 page-title"></h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.banners.index') }}">Banners</a>
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
            <form action="" enctype="multipart/form-data" id="banner_form" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="add-admin-frm category-select" required>
                                <option disabled selected>--- Select Category ---</option>
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="add-admin-frm"
                                    placeholder="Enter Banner Title" id="title" required>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Highlight text</label>
                            <input type="text" name="highligted_text" class="add-admin-frm" placeholder="Enter Highligted Text" id="text" required>
                        </div>
                    </div>
                    <div class="col-md-8 banner-image">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="add-admin-frm"
                                   accept="image/*" id="image" onChange="imageValid(this)">
                        </div>
                    </div>
                    <div class="col-md-8 text-center">
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
@if($formswap == 'add')
    <script>
        jQuery('.page-name').text("Add");
        jQuery('.page-title').text("Add Banner");
        jQuery('#banner_form').attr("action", "{{ route('admin.banners.store') }}");
        jQuery("#image").attr("required", true);
        
    </script>
@else
    <script>
        jQuery('.page-name').text(`{{ $banner->title ?? ''}}`);
        jQuery('.page-title').text("Edit Banner");
        jQuery('#banner_form').attr("action", "{{ route('admin.banners.update', [$banner->id]) }}");
        jQuery('#banner_form').append('@method("put")');
        jQuery('#title').val("{{ $banner->title }}");
        jQuery('#text').val("{{ $banner->highligted_text }}");
        jQuery("#image").attr("required", false);
        
        const  categories = `<option value="{{ $banner->category_id }}" selected>{{ $banner->category->category_name }}</option>
                            @foreach($menus as $menu)
                                @if($banner->category_id != $menu->id)
                                    <option value="{{ $menu->id }}">{{ $menu->category_name }}</option>
                                @endif
                            @endforeach`;

        jQuery('.category-select').html(categories);
        
    </script>
@endif
<script>
    function imageValid(files){
        if (files.files[0]) {
                var image = new Image();
                image.onload = function () {
                  if(this.width == 1920 && this.height == 870){
                        jQuery("#img_error").remove();

                     }
                  else{
                        jQuery("#img_error").remove();
                        jQuery(".banner-image").append(`<span style="font-size:13.5px" id="img_error" class="text-danger">Recommended image resolution 1920x870 pixels</span>`);
                  }
                };
                
                image.src = window.URL.createObjectURL(files.files[0]);
            }
    }
</script>
@endsection