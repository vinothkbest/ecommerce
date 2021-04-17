@extends('admin.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
<link rel="stylesheet" href="{{ asset('js/plugins/fileuploader/font/font-fileuploader.css') }}" media="all">
<link rel="stylesheet" href="{{ asset('js/plugins/fileuploader/jquery.fileuploader.min.css') }}">
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
            <h1 class="flex-sm-fill h3 my-2">Requests List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.categories.index') }}">Categories</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Request</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-content block-content-full vendors-frm">
            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full pd-enq">
                    <thead>
                        <tr>
                            <th style="width: 5%;" class="text-center">S.No</th>
                            <th style="width: 10%;">Vendor Name</th>
                            <th style="width: 15%;">Requested Name</th>
                            <th style="width: 50%;">Reason</th>
                            <th style="width: 15%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requestCategories as $requestCategory)
                        <tr>
                            <td class="text-center font-size-sm">{{ $loop->index+1 }}</td>
                            <td class="font-w600 font-size-sm">
                                {{ $requestCategory->vendor->name }}
                            </td>
                            <td>{{ $requestCategory->name }}</td>
                            <td>{{ $requestCategory->description}}</td>
                            <td class="text-center">
                                @if($requestCategory->status==0)
                                <span class="badge badge-danger">Rejected</span>
                                @elseif($requestCategory->status==1)
                                <span class="badge badge-secondary">Approved</span>
                                @else
                                <button class="btn btn-primary" onclick="openCategoryModal('{{ $requestCategory}}')">
                                    <li class="fas fa-check"></li>
                                </button>
                                <a href="{{ route('admin.categories.reject',[$requestCategory->id]) }}"
                                    class="btn btn-danger">
                                    <i class="si si-close"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="modal-sub-category" tabindex="-1" role="dialog"
                aria-labelledby="modal-block-fadein" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="block block-rounded block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark py-2">
                                <h3 class="block-title" id="sub_cat_header_title">Add Subcategory</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal"
                                        aria-label="Close">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content font-size-sm vendors-frm">
                                <form action="{{ route('admin.categories.approve') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input name="parent_id" id="sub_cat_parent_id" hidden>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group product-add">
                                                <label>Category</label>
                                                <div onclick="hideValidation('category_id')" data-toggle="modal"
                                                    data-target="#modal-select-category"
                                                    class="d-flex w-100 border rounded font-w400 product-create text-black"
                                                    style="background-color: #dddddd">
                                                    <span class="text-sm text-muted" id="breadcrumb"></span>
                                                    <span id="category_name">Select Category</span>
                                                </div>
                                                <span class="text text-danger font-size-sm" id="category_id_err"></span>
                                                <input type="text" id="category_id" name="parent_id" hidden>
                                                <input type="text" id="request_id" name="request_id" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Subcategory Name</label>
                                                <input type="text" id="sub_cat_name" class="add-admin-frm" value=""
                                                    name="name">
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
            <div class="modal fade" id="modal-select-category" tabindex="-1" role="dialog"
                aria-labelledby="modal-block-fadein" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="block block-rounded block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark py-3">
                                <h3 class="block-title" id="cat_header_title">Select Category</h3>
                                <div class="block-options">
                                    <button id="close-select-modal" type="button" class="btn-block-option"
                                        data-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content font-size-sm vendors-frm testimonial-group pt-0 pb-3">
                                <div class="row">
                                    <div id="categoryComponent_div" class="category-list">

                                    </div>
                                </div>
                            </div>
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
<script src="{{ asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>

<script src="{{ asset('js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js')}}"></script>
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/pages/be_forms_wizard.min.js')}}"></script>
<script src="{{ asset('js/plugins/fileuploader/jquery.fileuploader.min.js') }}"></script>
<script src="{{ asset('js/ntc.js') }}"></script>

<script>
    const category_data = {!! json_encode($categories) !!};
                var active_ids = [],
                    active_menu = [],
                    available_size = [],
                    available_color = [],
                    variants = [],
                    variant_checked = [];

                function renderRow(data, current_cursor) {
                    let html = `
                        <div class="category-rows block block-rounded js-ecom-div-nav d-none d-xl-block col-3 p-0 border-left" >
                            <div class="block-header block-header-default p-3">
                                <h3 class="block-title">
                                    <i class="fa fa-fw fa-boxes text-muted mr-1"></i> ${ data.label }
                                </h3>
                            </div>
                            <div class="block-content hide-scrollbar" style="min-height: 280px;max-height: 280px; overflow-y: scroll">
                                <ul class="nav nav-pills flex-column push">
                                    ${ renderColumns(data, current_cursor) }
                                </ul>
                            </div>
                        </div>`;
                    return html;
                }

                function renderColumns(dataObj, current_cursor) {
                    let type = current_cursor == 0 ? 'openCategoryModal' : 'openSubCategoryModal'
                    let edit_type = current_cursor == 0 ? 'openEditCategoryModal' : 'openEditSubCategoryModal'
                    var final_html;
                    var {
                        data = []
                    } = dataObj
                    if (data.length == 0) {
                        final_html = `
                            <li class="nav-item mb-1 d-flex justify-content-start align-items-center">
                                <div onclick='selectCategory(` + JSON.stringify(dataObj) + `,${ current_cursor })'
                                    class="nav-link w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div style="width:80%">
                                            <i class="far fa-select px-1"></i>
                                           Select
                                        </div>
                                        <div>
                                            <i class="fa fa-tick px-1"></i>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            `;
                    } else {
                        final_html = data.map(function (ele, ind) {
                            return (`
                                <li class="nav-item mb-1 d-flex justify-content-start align-items-center" >
                                    <div onclick='javascript:prepareList(` + JSON.stringify(ele) + `,${ current_cursor })' class="nav-link w-100 ${ ele.status == '0' ? 'inactive' : '' }" id='menu-${ ele.id }'>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div style="width:80%">
                                                <i class="far fa-folder px-1"></i>
                                                ${ ele.label }
                                            </div>
                                            <div>
                                                <i class="fa fa-angle-right px-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                </li>`)
                        }).join('\n');
                    }
                    return final_html;
                }

                function prepareList(obj, clicked_ind = 0) {
                    var ui_count = $("#categoryComponent_div").children().length;
                    var need_loop_count = ui_count - (clicked_ind + 1);

                    for (let i = 0; i < need_loop_count; i++) {
                        $('.category-rows').last().remove();
                        let id = active_ids.pop();
                        jQuery(`#menu-${ id }`).removeClass(' active');
                        active_menu.pop();
                    }
                    active_ids.push(obj.id);
                    active_menu.push(obj.label);
                    active_ids.forEach(ele => {
                        jQuery(`#menu-${ ele }`).addClass(' active');
                    })
                    if (!obj?.data) {
                        obj.data = [];
                    }
                    expandList(obj, clicked_ind + 1)

                }

                function expandList(data, ind) {
                    let htmlString = renderRow(data, ind);
                    jQuery('#categoryComponent_div').append(htmlString);
                    //console.log(htmlString);
                    jQuery('#categoryComponent_div').animate({
                        scrollLeft: '+=1500'
                    }, 500);
                }

                function selectCategory(data, ind) {
                    let breadcrumb = active_menu.map((ele, index) => {
                        return index == active_menu.length - 1 ? '' : ele + ' > ';
                    }).join('');
                    jQuery('#breadcrumb').html(breadcrumb);
                    jQuery('#category_id').val(data.id);
                    jQuery('#category_name').html(data.label);
                    //jQuery('#close-select-modal').click()
                    jQuery('#modal-select-category').modal('hide');

                }

                expandList({
                    id: 0,
                    label: "Categories",
                    data: category_data
                }, 0);
                function openCategoryModal(data) {
                    data=JSON.parse(data);
                    jQuery('#sub_cat_name').val(data.name)
                    jQuery('#request_id').val(data.id)
                    jQuery('#modal-sub-category').modal('show');
                }
                function hideValidation(id){
                    jQuery('#'+id+'_err').html("").hide();
                }
</script>
@endsection
