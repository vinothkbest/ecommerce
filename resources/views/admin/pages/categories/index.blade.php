@extends('admin.layouts.main')
@section('css_before')

<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    /*sds*/
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
            <h1 class="flex-sm-fill h3 my-2">Categories List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Categories</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-content block-content-full testimonial-group">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div id="categoryComponent_div" class="category-list">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-category" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark py-2">
                            <h3 class="block-title" id="cat_header_title">Add Category</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm vendors-frm">
                            <form action="{{ route('admin.categories.store') }}" id="cat_form" method="POST"
                                enctype="multipart/form-data" class="valid_cat_form">
                                @csrf
                                <div class="row">
                                    <input name="parent_id" id="cat_parent_id" hidden>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <input type="text" class="add-admin-frm" name="name" id="cat_name" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6 category-image">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" class="add-admin-frm"
                                                accept="image/x-png,image/gif,image/jpeg"
                                                onChange="imageValid(this)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select id="cat_status" class="add-admin-frm add-admin-frms" name="status">
                                                <option value="1" selected="">Active</option>
                                                <option value="0">Disabled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="save-btn">
                                            <button id="cat_save" type="submit" class="mb-3">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-sub-category" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="block block-rounded block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark py-2">
                            <h3 class="block-title" id="sub_cat_header_title">Add Subcategory</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content font-size-sm vendors-frm">
                            <form id="sub_cat_form" action="{{ route('admin.categories.store') }}" method="POST"
                                enctype="multipart/form-data" class="valid_sub_cat_form">
                                @csrf
                                <input name="parent_id" id="sub_cat_parent_id" hidden>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="block-content product-title">
                                            <nav aria-label="breadcrumb">
                                                <ol class="breadcrumb breadcrumb-alt push py-3" id="breadcrumb">
                                                </ol>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Subcategory Name</label>
                                            <input type="text" id="sub_cat_name"
                                                   class="add-admin-frm"
                                                   name="name" required autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6 category-image">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="image" class="add-admin-frm"
                                                accept="image/x-png,image/gif,image/jpeg"
                                                onChange="imageValid(this)"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="add-admin-frm add-admin-frms" name="status"
                                                id="sub_cat_status">
                                                <option value="1" selected="">Active</option>
                                                <option value="0">Disabled</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="save-btn">
                                            <button type="submit" class="mb-3">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js_after')
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
<script>
    const category_data={!! json_encode($cat_menus) !!};
    console.log(category_data);
    
    var active_ids = [], active_menu=[];

    function renderRow(data, current_cursor) {
        let html= `
        <div class="category-rows block block-rounded js-ecom-div-nav d-none d-xl-block col-4 p-0 border-left" >
            <div class="block-header block-header-default p-3">
                <h3 class="block-title">
                    <i class="fa fa-fw fa-boxes text-muted mr-1"></i> ${data.label}
                </h3>
            </div>
            <div class="block-content hide-scrollbar" style="max-height: 280px; overflow-y: scroll">
                <ul class="nav nav-pills flex-column push">
                    ${renderColumns(data, current_cursor)}
                </ul>
            </div>
        </div>`;
        return html;
    }
    function renderColumns(data, current_cursor) {
        let type=current_cursor==0?'openCategoryModal':'openSubCategoryModal'
        let edit_type=current_cursor==0?'openEditCategoryModal':'openEditSubCategoryModal'
        var final_html=`
        <li class="nav-item mb-1 d-flex justify-content-start align-items-center">
            <a class="nav-link w-100" href='javascript:${type}(`+JSON.stringify(data)+`)'>
                <div class="text-muted font-sm">
                    <i class="fa fa-plus px-1"></i>
                    <span>Add items</span>
                </div>
            </a>
        </li>
        `;
        final_html += data.data.map(function (ele, ind) {

           return(`<li class="nav-item mb-1 d-flex justify-content-start align-items-center" >
                <div onclick='javascript:prepareList(`+JSON.stringify(ele)+`,${current_cursor})' class="nav-link w-100 ${ele.status=='0'?'inactive':''}" id='menu-${ele.id}'>
                    <div class="d-flex justify-content-between align-items-center">
                        <div style="width:80%">
                            <i class="far fa-folder px-1"></i>
                            ${ele.label}
                        </div>
                        <div>
                            <span onclick='event.stopPropagation();${edit_type}(`+JSON.stringify(ele)+`,${current_cursor})'>
                                <i class="far fa-edit px-1 "></i>
                            </span>
                            <i class="fa fa-angle-right px-1"></i>
                        </div>
                    </div>
                </div>
            </li>`);
        }).join('\n');
        return final_html;
    }
    function prepareList(obj, clicked_ind = 0) {
        var ui_count = $("#categoryComponent_div").children().length; //3
        var need_loop_count = ui_count - (clicked_ind + 1); //0+1
        for (let i = 0; i < need_loop_count; i++) {
            $('.category-rows').last().remove();
            let id=active_ids.pop();
            jQuery(`#menu-${id}`).removeClass(' active');
            active_menu.pop();
        }
        active_ids.push(obj.id);
        active_menu.push(obj.label);
        console.log(active_menu);
        active_ids.forEach(ele=>{
            jQuery(`#menu-${ele}`).addClass(' active');
        })
        if(!obj?.data){
            obj.data=[];
        }
        expandList(obj, clicked_ind + 1)

    }
    function expandList(data, ind) {
        let htmlString = renderRow(data, ind);
        jQuery('#categoryComponent_div').append(htmlString);
        jQuery('#categoryComponent_div').animate({scrollLeft:'+=1500'},500);
    }

    expandList({
        id: 0,
        label: "Categories",
        data: category_data
    }, 0);
    var cat_parent_id=jQuery('#cat_parent_id');
    var sub_cat_parent_id=jQuery('#sub_cat_parent_id');

    var cat_name=jQuery('#cat_name');
    var sub_cat_name=jQuery('#sub_cat_name');

    var cat_status=jQuery('#cat_status');
    var sub_cat_status=jQuery('#sub_cat_status');

    var cat_form=jQuery('#cat_form');
    var sub_cat_form=jQuery('#sub_cat_form');

    var cat_header_title=jQuery('#cat_header_title');
    var sub_cat_header_title=jQuery('#sub_cat_header_title');

    var breadcrumb=jQuery('#breadcrumb');

    function openCategoryModal(data=false){
        jQuery('#cat_header_title').html('Add Category');
        cat_form.attr('action', "{{ route('admin.categories.store') }}");
        if(jQuery('[name="_method"]')){
            jQuery('[name="_method"]').remove();
        }
        jQuery('#modal-category').modal('show');
    }
    function openEditCategoryModal(data={}){
        jQuery('#cat_header_title').html('Edit Category');
        cat_parent_id.val(null);
        cat_name.val(data.label)
        cat_status.val(data.status.toString())
        cat_form.attr('action', "{{ url('admin/categories') }}/"+data.id);
        cat_form.append('@method("put")')
        jQuery('#modal-category').modal('show');
    }

    function openSubCategoryModal(data={}){
        console.log(data);
        jQuery('#sub_cat_header_title').html('Add SubCategory');
        sub_cat_form.attr('action', "{{ route('admin.categories.store') }}");
        if(jQuery('[name="_method"]')){
            jQuery('[name="_method"]').remove();
        }
        sub_cat_parent_id.val(data.id)
        jQuery('#modal-sub-category').modal('show');
        renderBreadCrumb(data);
    }
    function openEditSubCategoryModal(data={}){
        jQuery('#sub_cat_header_title').html('Edit SubCategory');
        sub_cat_parent_id.val(data.parent_id)
        sub_cat_name.val(data.label)
        sub_cat_status.val(data.status.toString())
        sub_cat_form.attr('action', "{{ url('admin/categories') }}/"+data.id);
        sub_cat_form.append('@method("put")')
        jQuery('#modal-sub-category').modal('show');
        renderBreadCrumb(data);
    }
    function renderBreadCrumb(data) {
        var breadcrumbMenu=[];
        var extraction_obj_id = data.id, found = false;
        function loop(dataArr) {
            for (var i = 0; i < dataArr.length; i++) {
                if (dataArr[i].id != extraction_obj_id) {
                    if (Array.isArray(dataArr[i]?.data) && dataArr[i].data.length != 0) {
                        loop(dataArr[i].data)
                        if (found) {
                        breadcrumbMenu.push(dataArr[i].label);
                            break;
                        };
                    }
                } else {
                    breadcrumbMenu.push(dataArr[i].label);
                    found = true;
                    break;
                }
            }
        }
        loop(category_data)
        breadcrumb.html(breadcrumbMenu.reverse().map((ele,ind)=>{
            return `
            <li class="breadcrumb-item ${breadcrumbMenu.length-1==ind?' active':''}">${ele}</li>
            `
        }).join('\n'));
    }
</script>
<script>
function imageValid(files){
    if (files.files[0]) {
            var image = new Image();
            image.onload = function () {
              if(this.width == 640 && this.height == 620){
                    jQuery("#cat_img_error").remove();

                 }
              else{
                    jQuery("#cat_img_error").remove();
                    jQuery(".category-image").append(`<span style="font-size:13.5px" id="cat_img_error" class="text-danger">Recommended image resolution 640x620 pixels</span>`);
              }
            };
            
            image.src = window.URL.createObjectURL(files.files[0]);
        }
}
</script>
@endsection