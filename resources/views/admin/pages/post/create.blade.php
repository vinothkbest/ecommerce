@extends('admin.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
<link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/dropzone/dist/min/dropzone.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">
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
                        <a class="link-fx" href="{{ route('admin.posts.index') }}">Post List
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
            <form enctype="multipart/form-data" method="post" id="blog_form">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div id="category-div">
                            <div class="form-group add-category">
                            </div>
                            <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content" style="height:400px;">
                                  <div class="category-modal-header modal-header">
                                    <h5 class="modal-title" id="categoryModalTitle">Edit Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true" class="modal-close">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group" id="edit-category">
                                    
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button"
                                            class="btn btn-warning"
                                            onClick="categoryNav()"
                                            data-dismiss="modal">Update</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="form-group add-tags">
                            <label>Choose Tags</label>
                            <select class="js-select2 add-admin-frm" id="tags" name="tags[]" style="width: 100%;" autocomplete="off" multiple>
                            @if($formswap == 'add')
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" @if(old('tags') && in_array($tag->id,old('tags')))
                                    selected @endif>{{ $tag->title }}</option>
                                @endforeach
                            @else    
                                @php $old_tags = []; @endphp
                                @foreach($post->tags as $key => $post_tag)
                                    <option value="{{ $post_tag->id }}" selected>{{ $post_tag->title }}</option>
                                    {{ array_push($old_tags, $post_tag->id)}}
                                @endforeach
                                @foreach ($tags as $tag)
                                    @if(!in_array($tag->id, $old_tags))
                                        <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                    @endif
                                @endforeach
                            @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Post Name</label>
                            <input type="text" class="add-admin-frm"
                                   name="blog-title" autocomplete="off" required id="blog_title">
                        </div>
                        <div class="form-group">
                          <label>Post Description</label>
                          <textarea type="text" class="form-control form-control-alt form-control-lg" id="blog_content" name="blog-content" placeholder="Content" required></textarea>
                          <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
                          <script>
                              CKEDITOR.replace( 'blog_content' );
                          </script>
                        </div>
                        <div class="form-group">
                            <label>Post Image</label>
                            <input type="file" name="blog-image" class="add-admin-frm"
                                accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <br/>
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
                            <label>SEO Image</label>
                            <input type="file" name="image" class="add-admin-frm"
                                accept="image/x-png,image/gif,image/jpeg">
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
<script>
    var cat_dropdown = "@foreach($menus as $category)";
    cat_dropdown +=  '<option value="{{ $category->id }}">{{ $category->category_name }}</option>';
    cat_dropdown += "@endforeach";

    var category = '<select class="add-admin-frm" id="cat_id" name="category" style="width: 100%;" autocomplete="off" onInput="addSubCategory()"><option value="" selected>----- Select Category -----</option><option value="no">No Category</option>';
    category += cat_dropdown;
    category += '</select>';
</script>
@if($formswap == 'add')
    <script>
        jQuery('.page-name').text("Add");
        jQuery('.page-title').text("Add Post");
        jQuery('#blog_form').attr("action", "{{ route('admin.posts.store') }}");
        jQuery('.add-category').append('<label>Choose Category</label>');
        jQuery('.add-category').append(category);        
    </script>
@else
    <style>
        .cat-nav:nth-last-child(2){
            color: red;
        }
        .cat-nav:last-child{
            margin-top: -10px;
        }
        .button-cat{
            color: white;
            font-weight: bolder;
            outline: none;
        }
        .category-modal-header{
            background: #a30d03;
        }
        .modal-title,.modal-close{
            color:white;
        }
    </style>
    <script>
        jQuery('.page-name').text(`{{ $post->title ?? ''}}`);
        jQuery('.page-title').text("Post Edit");
        jQuery('#blog_form').attr("action", "{{ route('admin.posts.update', [$post->id ?? '']) }}");
        jQuery('#blog_form').append('@method("put")');
        jQuery('#blog_title').val(`{{ $post->title ?? ''}}`);
        jQuery('#blog_content').text(`{!! $post->description ?? '' !!}`);
    
        var nav_cat = '<nav aria-label="breadcrumb"><ol class="breadcrumb breadcrumb-alt dynamic-cat">';
        nav_cat += '@if(count($post->categories)!=0)@foreach($post->categories as $post_category)';
        nav_cat += '<li class="breadcrumb-item cat-nav" aria-current="page">{{ $post_category->category_name ?? ''}}'
        nav_cat += '</li>@endforeach @else'
        nav_cat += '<li class="breadcrumb-item cat-nav" aria-current="page">{{ "No Category" }}</li>@endif'
        nav_cat += '<li class="nav-item" aria-current="page"><button type="button" class="btn-sm btn-success ml-4 button-cat" data-toggle="modal" data-target="#categoryModal">'
        nav_cat += 'edit</button></li>';

        jQuery('.add-category').append('<label>Current category level</label>');
        jQuery('.add-category').append(nav_cat);

        jQuery('#edit-category').append(category);

        jQuery('#seo_title').val(`{!! $post->postSeo->title ?? '' !!}`);
        jQuery('#keyword').val(`{{ $post->postSeo->keyword ?? ''}}`);
        jQuery('#description').html(`{!! $post->postSeo->description ?? '' !!}`);
    </script>
@endif
<script src="{{ asset('js/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('js/plugins/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>

<script>jQuery(function () {
    One.helpers(['flatpickr', 'select2']);
});</script>
<script>

    async function addSubCategory(){

        let cat_id = jQuery("#cat_id").val();

        var url = "{{ url('admin/subcategories/') }}/" + cat_id;

       await fetch(url).then(response => {
            return response.json();
        }).then(res => {

            jQuery('.add-sub-category').remove();
            jQuery('.add-last-category').remove();
            if(res.categories.length != 0){

                var sub_category = '<select class="add-admin-frm" id="sub_cat_id" name="sub_category" style="width: 100%;" autocomplete="off" onInput="addLastCategory()"><option value="no" selected>----- Select Sub Category -----</option><option value="no">No Category</option>';

                jQuery.each(res.categories, function(index, category){
                    
                    var option = '<option value="'+ category.id +'">' +category.category_name + '</option>';
                    sub_category += option;

                });
                sub_category += '</select>';
                var sub_cat_div = '<div class="form-group add-sub-category mt-4"><label>Choose SubCategory</label></div>';
            @if($formswap == 'add')
                jQuery('#category-div').append(sub_cat_div);
            @else
                jQuery('#edit-category').append(sub_cat_div);
            @endif
            jQuery('.add-sub-category').append(sub_category);

            }
        });

    }

    async function addLastCategory(){

        let sub_cat_id = jQuery("#sub_cat_id").val();
        var url = "{{ url('admin/subcategories/') }}/" + sub_cat_id;

       await fetch(url).then(response => {
            return response.json();
        }).then(res => {

            jQuery('.add-last-category').remove();
            if(res.categories.length != 0){
                var sub_category = '<select class="add-admin-frm" id="last_cat_id" name="last_sub_category" style="width: 100%;" autocomplete="off"><option value="no" selected>----- Select Last Category -----</option><option value="no">No Category</option>';

                jQuery.each(res.categories, function(index, category){
                    
                    var option = '<option value="'+ category.id +'">' +category.category_name + '</option>';
                    sub_category += option;

                });
                sub_category += '</select>';
                var sub_cat_div = '<div class="form-group add-last-category mt-4"><label>Choose Last Level Category</label></div>';
                @if($formswap == 'add')
                    jQuery('#category-div').append(sub_cat_div);
                @else
                    jQuery('#edit-category').append(sub_cat_div);
                @endif
                jQuery('.add-last-category').append(sub_category);
            }
        });

    }
    
    function categoryNav(){
        let categories = [];
        let update_category = jQuery('#cat_id option:selected').text();
        let update_sub_category = jQuery('#sub_cat_id option:selected').text();
        
        if(update_category != '' && update_category != '----- Select Category -----'){
            categories.push(update_category)
        }
        else if(update_category == 'No Category' && update_category == '----- Select Category -----'){
            categories.push("No Category")
        }

        if(update_sub_category != '' && update_sub_category != 'No Category' && update_sub_category != '----- Select Sub Category -----'){
            categories.push(update_sub_category)
        }
        let update_last_category = jQuery('#last_cat_id option:selected').text();
        if(update_last_category != '' && update_last_category != 'No Category' && update_last_category != '----- Select Last Category -----'){
            categories.push(update_last_category)   
        }
        var nav_cat = '';
        jQuery.each(categories, function(index, category){
                    
                    nav_cat += '<li class="breadcrumb-item cat-nav" aria-current="page">'
                    nav_cat += category + '</li>'

        });

        nav_cat += '<li class="nav-item" aria-current="page"><button type="button" class="btn-sm btn-success ml-4 button-cat" data-toggle="modal" data-target="#categoryModal">'
        nav_cat += 'edit</button></li>';

        jQuery('.dynamic-cat').html(nav_cat);
    }
</script>
@endsection

