@extends('vendor.layouts.main')
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
            <h1 class="flex-sm-fill h3 my-2">Create Product</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('vendor.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('vendor.products.index') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-content block-content-full vendors-frm">
            <div class="js-wizard-simple block block">
                <!-- Step Tabs -->
                <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                    <li class="nav-item">
                        <a id="tab_1" class="nav-link active" href="#wizard-simple2-step1" data-toggle="tab">Product
                            Info</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab_2" class="nav-link" href="#wizard-simple2-step2" data-toggle="tab">Product
                            Details</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab_3" class="nav-link" href="#wizard-simple2-step3" data-toggle="tab">Product
                            Media</a>
                    </li>
                </ul>
                <form id="product-form" enctype="multipart/form-data" method="POST">
                    <div class="block-content block-content-sm tab-content px-md-5">
                        <div class="tab-pane active" id="wizard-simple2-step1" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
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
                                        <input type="text" id="category_id" name="category_id" hidden>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group product-add">
                                        <label>Brand</label>
                                        <select class="product-create" name="brand_id"
                                            onfocus="hideValidation(this.name)">
                                            @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}"
                                                @selector((old('brand')?old('brand'):''),$brand->
                                                id)>
                                                {{ $brand->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <span class="text text-danger font-size-sm" id="brand_id_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group product-add">
                                        <label>Product Name </label>
                                        <input value="" onfocus="hideValidation(this.name)" type="text" name="name"
                                            class="product-create" placeholder="Enter product name">
                                        <span class="text text-danger font-size-sm" id="name_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group product-add">
                                        <label>Product Price </label>
                                        <input value="" onfocus="hideValidation(this.name)" onkeyup="updateFixedPrice()"
                                            type="number" min="0" name="actual_price" id="actual_price"
                                            class="product-create" placeholder="Enter product price">
                                        <span class="text text-danger font-size-sm" id="actual_price_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group product-add">
                                        <label>Discount (%)</label>
                                        <input value="" onfocus="hideValidation(this.name)" onkeyup="updateFixedPrice()"
                                            type="number" min="0" max="100" maxlength="3" name="discount" id="discount"
                                            class="product-create" placeholder="Enter discount in percentage">
                                        <span class="text text-danger font-size-sm" id="discount_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group product-add">
                                        <label>Fixed Price</label>
                                        <input value="" onfocus="hideValidation(this.name)" type="number"
                                            name="fixed_price" id="fixed_price" class="product-create"
                                            placeholder="Enter product price">
                                        <span class="text text-danger font-size-sm" id="fixed_price_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 block block-rounded block-link-shadow">
                                    <div
                                        class="form-group product-add d-flex justify-content-between align-items-center block-header block-header-default p-2">
                                        <label>Available Sizes</label>
                                        <button onclick="openModal('#size-selector')" type="button"
                                            class="btn btn-primary" data-toggle="modal"
                                            data-target="#modal-select-variant">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                    </div>
                                    <div class="block-content">
                                        <span class="text text-danger font-size-sm" id="available_size_err"></span>
                                        <div class="row" id="size-container">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 block block-rounded block-link-shadow">
                                    <div
                                        class="form-group product-add d-flex justify-content-between align-items-center block-header block-header-default p-2">
                                        <label>Available Colors</label>
                                        <button onclick="openModal('#color-selector')" type="button"
                                            class="btn btn-primary" data-toggle="modal"
                                            data-target="#modal-select-variant">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                    </div>
                                    <div class="block-content">
                                        <span class="text text-danger font-size-sm" id="available_color_err"></span>
                                        <div class="row" id='color-container'>

                                        </div>
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="block block-rounded">
                                        <div class="block-header">
                                            <h3 class="block-title">Variants</h3>
                                            <div class="block-options">
                                                <div class="block-options-item ">
                                                    {{-- <button type="button" data-toggle="modal"
                                                        data-target="#modal-select-variant" class="btn btn-primary">
                                                        <li class="fa fa-edit"></li> Edit
                                                    </button> --}}
                                                    <code id='total-variants'>Total Variants - 0</code>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="block-content pl-5">
                                            <table id="main-table"
                                                class="table table-sm table-vcenter table-hover table-bordered js-table-checkable">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 70px;">
                                                            <div class="custom-control custom-checkbox d-inline-block">
                                                                <input onclick="checkAll(this)" type="checkbox"
                                                                    class="custom-control-input" id="check-all"
                                                                    name="check-all" checked="true">
                                                                <label class="custom-control-label"
                                                                    for="check-all"></label>
                                                            </div>
                                                        </th>
                                                        <th class="text-center" style="width: 50px;">S.No</th>
                                                        <th class="text-center">Size</th>
                                                        <th class="text-center">Color</th>
                                                        <th class="text-center d-sm-table-cell">Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="variant-container">
                                                </tbody>
                                                <tfoot>
                                                    <tr class="bg-light">
                                                        <th colspan="4"
                                                            class="text-right font-size-h6 border border-right">
                                                            Total
                                                            Quantity</th>
                                                        <th class="text-center font-size-h4" id="total-quantity">0</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <span class="text text-danger font-size-sm" id="variant_err"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="wizard-simple2-step2" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12 block block-rounded block-link-shadow">
                                    <div
                                        class="form-group product-add d-flex justify-content-between align-items-center block-header block-header-default p-2">
                                        <label>Highlights <span class="text text-danger font-size-sm"
                                                id="highlight_err"></span></label>
                                        <button onclick="addHighlights()" type="button" class="btn btn-primary">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                    </div>
                                    <div class="block-content">
                                        <div class="form-group product-add" id='highlight-container'>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 block block-rounded block-link-shadow">
                                    <div
                                        class="form-group product-add d-flex justify-content-between align-items-center block-header block-header-default p-2">
                                        <label>Specifications <span class="text text-danger font-size-sm"
                                                id="specification_err"></span></label>
                                        <button onclick="addSpecifications()" type="button" class="btn btn-primary">
                                            <li class="fa fa-plus"></li>
                                        </button>
                                    </div>
                                    <div class="block-content">
                                        <div class="form-group product-add" id='specification-container'>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group product-add">
                                        <label>Product Description <span class="text text-danger font-size-sm"
                                                id="description_err"></span></label>
                                        <div id="description-container">
                                            <textarea style="resize: none;" rows="10"
                                                onfocus="hideValidation(this.name)" class="mx-3 product-create"
                                                name="description"></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="wizard-simple2-step3" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group product-add">
                                        <label>Select Media <span class="text text-danger font-size-sm"
                                                id="media_err"></span></label>
                                        <div>
                                            <x-image-picker type="media" />
                                        </div>
                                        <span class="text-warning">
                                            <i class="fa fa-exclamation-circle"></i>
                                            Click the image for the crop. Please crop before submitting
                                        </span>
                                        <br />
                                        <span class="text-warning">
                                            <i class="fa fa-exclamation-circle"></i>
                                            Image must with Aspect Ratio 1:1
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full block-content-full bg-body-light rounded-bottom">
                        <div class="row">
                            <div class="col-6">
                                <button id="prev-btn" type="button" class="btn btn-alt-primary disabled"
                                    data-wizard="prev">
                                    <i class="fa fa-angle-left mr-1"></i> Previous
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-alt-primary" data-wizard="next">
                                    Next <i class="fa fa-angle-right ml-1"></i>
                                </button>
                                <button onclick="validateProductForm()" type="button" class="btn btn-primary d-none"
                                    data-wizard="finish">
                                    <i class="fa fa-check mr-1"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-select-category" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark py-3">
                        <h3 class="block-title" id="cat_header_title">Select Category</h3>
                        <div class="block-options">
                            <button id="close-select-modal" type="button" class="btn-block-option" data-dismiss="modal"
                                aria-label="Close">
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
    <div class="modal fade" id="modal-select-variant" tabindex="-1" role="dialog" aria-labelledby="modal-block-fadein"
        aria-hidden="true">
        <div class="modal-dialog modal modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="block block-rounded block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark py-3">
                        <h3 class="block-title" id="cat_header_title">Add Product</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-fw fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content font-size-sm vendors-frm testimonial-group p-3">
                        <div class="form-group product-add" id="size-selector">
                            <label>Product Size</label>
                            <input type="text" name="product_size" id="product_size" class="product-create"
                                placeholder="Enter Product Size" style="text-transform:uppercase">
                        </div>
                        <div class="form-group product-add" id="color-selector">
                            <label>Select Color</label>
                            <br>
                            <div class="row">
                                <div class="col-2">
                                    <input onchange="colorCodeChanged(this.value)" type="color" name="color_code"
                                        id="color_code" class="color-picker border rounded">
                                </div>
                                <div class="col-10">
                                    <input type="text" name="color_name" id="color_name" value="Black"
                                        class="product-create" placeholder="The name will be retrieved automatically">
                                </div>
                            </div>
                        </div>
                        <video id="video_element" style="width: 0px;height: 0px;"></video>
                        <div class="d-flex push">
                            <button onclick="addOptions()" class="btn btn-primary m-auto">Add</button>
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
<script src="{{ asset('js/ntc.js') }}"></script>

<script>
    const category_data = {!! json_encode($categories)!!};
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

    function updateFixedPrice() {
        var actual_price = jQuery('#actual_price').val(),
            discount = jQuery('#discount').val(),
            fixed_price = jQuery('#fixed_price');
        if (actual_price && discount)
            fixed_price.val(actual_price - (actual_price * (discount / 100)));
    }

    function colorCodeChanged(code) {
        var n_match = ntc.name(code);
        n_rgb = n_match[0]; // RGB value of closest match
        n_name = n_match[1]; // Text string: Color name
        n_exactmatch = n_match[2]; // True if exact color match
        jQuery('#color_name').val(n_match[1])
    }

    function openModal(type) {
        jQuery('#size-selector').hide();
        jQuery('#color-selector').hide()
        jQuery(type).show();
        hideValidation('available_' + type.split('-')[0].replace('#', ''))
        jQuery('#modal-select-variant').modal('show')
    }
    function addOptions() {
        var product_size = jQuery('#product_size');
        var color_code = jQuery('#color_code')[0];
        var color_name = jQuery('#color_name');
        let size = product_size.val().toUpperCase();
        let code = color_code.value;
        let name = color_name.val();

        if (size != '') {
            if (available_size.includes(size)) {
                alert("already size added")
                return;
            }
            available_size.push(size)
            let html = `
                        <div class="color-box-tl m-2 bg-primary text-white" id="size_element_${ size }">
                            <p class="px-2 font-w700">${ size }</p>
                            <a onclick="removeSize('${ size }')" class="close px-2" style="cursor: pointer">
                                <span class="text-white" aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        `;
            jQuery('#size-container').append(html)
            product_size.val('');
            product_size.focus();
            if (available_color.length != 0) {
                getVariantsWithColor(size)
            }
        } else {
            if (available_color.findIndex(ele => ele.code == code) >= 0) {
                alert("already color added")
                return;
            }
            available_color.push({
                code,
                name
            })
            let html = `
                <div class="color-box-tl m-2" id="color_element_${ code.replace('#', '') }">
                    <div class="input-group-append">
                        <p class="input-group-text m-0">
                            <i class="box-fill" style="background-color:${ code };"></i>
                        </p>
                    </div>
                    <p class="px-3">${ name }</p>
                    <a onclick="removeColor('${ code }')" class="close m-auto px-2" style="cursor: pointer">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>`;
            jQuery('#color-container').append(html)
            color_code.value = '#000000';
            color_name.val('Black')
            if (available_size.length != 0) {
                getVariantsWithSize({
                    code,
                    name
                })
            }
        }
    }

    function getVariantsWithSize(data = {}) {
        let tempArr = available_size.map((ele, ind) => {
            let id = ele + ind + (new Date).getTime();
            variant_checked.push(id);
            return {
                id: id,
                size: ele,
                color: {
                    code: data.code,
                    name: data.name
                },
                quantity: 5000,
                checked: true
            }
        });
        variants.push(...tempArr)
        updateTable();
    }

    function getVariantsWithColor(data = '') {
        let tempArr = available_color.map((ele, ind) => {
            let id = data + ind + (new Date).getTime();
            variant_checked.push(id);
            return {
                id: id,
                size: data,
                color: {
                    code: ele.code,
                    name: ele.name
                },
                quantity: 5000,
                checked: true
            }
        });
        variants.push(...tempArr)
        updateTable();
    }

    function updateTable() {
        var variant_container = jQuery('#variant-container');
        // var child_length = variant_container.children('tr').length;
        // console.log(child_length);
        let html = variants.sort((a, b) => a.size < b.size ? -1 : a.size > b.size ? 1 : 0).map((ele, ind) => {
            return `
                <tr id="row-${ ele.id }">
                    <td class="text-center">
                        <div class="custom-control custom-checkbox d-inline-block">
                            <input onclick="updateVariantCheck(this,'${ ele.id }')" id="checkbox-${ ele.id }" type="checkbox" class="custom-control-input"  checked=${ ele.checked ? true : false }>
                            <label class="custom-control-label" for="checkbox-${ ele.id }"></label>
                        </div>
                    </td>
                    <td class="text-center" scope="row">${ ind + 1 }</td>
                    <td class="text-center font-w600">${ ele.size }</td>
                    <td>
                        <span class="rounded-circle"
                            style="width: 20px;height:20px;background-color:${ ele.color.code };display: inline-block"></span>
                        <span style="vertical-align: super;">${ ele.color.name }</span>
                    </td>
                    <td class="text-center product-add" style="width: 40%">
                        <input type="number" onblur="updateVariantQuanity(this,'${ ele.id }')" id="quantity-${ ele.id }" value="${ ele.quantity }" class="product-create quantity-table w-75">
                    </td>
                </tr>
                `;
        }).join('\n');
        variant_container.html(html);
        jQuery('#total-variants').html('Total Variants - ' + variants.length);
        updateQuantity()
    }

    function removeSize(size) {
        available_size.splice(available_size.indexOf(size), 1);
        variants = variants.filter(ele => ele.size != size);
        jQuery('#size_element_' + size).remove();
        updateTable();
    }

    function removeColor(code) {
        available_color.splice(available_color.findIndex(ele => ele.code == code), 1);
        variants = variants.filter(ele => ele.color.code != code);
        jQuery('#color_element_' + code.replace('#', '')).remove();
        updateTable();
    }

    function updateQuantity() {
        var sum = 0;
        variants.forEach(ele => ele.checked ? sum += parseInt(ele.quantity) : null)
        jQuery('#total-quantity').html(sum)
    }

    function updateVariantQuanity(event, id) {
        variants[variants.findIndex(ele => ele.id == id)].quantity = event.value;
        updateQuantity();
    }

    function updateVariantCheck(event, id) {
        let checked = document.getElementById('checkbox-' + id).checked,
            row = jQuery('#row-' + id),
            input = jQuery('#quantity-' + id);
        variants[variants.findIndex(ele => ele.id == id)].checked = checked;
        if (checked) {
            row.removeClass('table-disabled')
            input.prop('disabled', false);
        } else {
            row.addClass('table-disabled')
            input.prop('disabled', true);
        }
        updateQuantity()
        hideValidation('variant')
    }
    jQuery("#product_size").keypress(function (event) {
        if (event.keyCode === 13) {
            addOptions();
        } else {
            var regex = new RegExp("^[a-zA-Z0-9]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
    });

    function checkAll(event) {
        variants = variants.map(ele => {
            let row = jQuery('#row-' + ele.id),
                input = jQuery('#quantity-' + ele.id),
                checkbox = jQuery('#checkbox-' + ele.id);
            if (event.checked) {
                row.removeClass('table-disabled')
                input.prop('disabled', false);
                checkbox.prop('checked', event.checked);
            } else {
                row.addClass('table-disabled')
                input.prop('disabled', true);
                checkbox.prop('checked', event.checked);
            }
            return {
                ...ele,
                checked: event.checked
            }
        });
        //jQuery('input:checkbox').not(event).prop('checked', event.checked);
        updateQuantity()
    }

    var highlight = 1;
    function addHighlights() {
        if (highlight > 5) {
            showValidation('highlight', "Maximum number of highlight added");
            return;
        }
        var element = jQuery('#highlight-container'), loc_validation = true;
        jQuery('input[name="highlight[]"]').each(function () {
            if (loc_validation && jQuery(this).val() == '') {
                let msg = 'The Highlight #' + jQuery(this).attr('data-index') + ' looks like empty.please enter some highlights'
                showValidation('highlight', msg);
                loc_validation = false
                return;
            }
        });
        if (loc_validation) {
            let html = `
            <div class="row">
                <div class="col-1 p-0 d-flex justify-content-center align-items-center">
                    <label>#${ highlight }</label>
                </div>
                <div class="col-11">
                    <input id='highlight-${ highlight }' data-index="${ highlight }" onfocus="hideValidation('highlight')" type="text" name="highlight[]" class="product-create m-2"
                    placeholder="Enter Highlight">
                </div>
            </div>
            `
            element.append(html)
            jQuery(`#highlight-${ highlight }`).focus();
            highlight++;
        }
    }
    var specification = 1;
    function addSpecifications() {
        if (specification > 10) {
            showValidation('specification', "Maximum number of specification added");
            return;
        }
        var element = jQuery('#specification-container'), loc_validation = true;
        jQuery('input[name="specification[]"]').each(function () {
            if (loc_validation && jQuery(this).val() == '') {
                let msg = 'The specification #' + jQuery(this).attr('data-index') + ' looks like empty.please enter some specifications'
                showValidation('specification', msg);
                loc_validation = false
                return;
            }
        });
        jQuery('input[name="specification-title[]"]').each(function () {
            if (loc_validation && jQuery(this).val() == '') {
                let msg = 'The specification title #' + jQuery(this).attr('data-index') + ' looks like empty.please enter some specification title'
                showValidation('specification', msg);
                loc_validation = false
                return;
            }
        });
        if (loc_validation) {
            let html = `
            <div class="row">
                <div class="col-1 p-0 d-flex justify-content-center align-items-center">
                    <label>#${ specification }</label>
                </div>
                <div class="col-3 p-0">
                    <input id='specification-title-${ specification }' data-index="${ specification }" onfocus="hideValidation('specification')" type="text" name="specification-title[]" class="product-create m-2"
                    placeholder="Specification title">
                </div>
                <div class="col-8">
                    <input id='specification-${ specification }' data-index="${ specification }" onfocus="hideValidation('specification')"
                        type="text" name="specification[]" class="product-create m-2"
                        placeholder="Enter specification content">
                </div>
            </div>
            `
            element.append(html)
            jQuery(`#specification-title-${ specification }`).focus();
            specification++;
        }
    }

    function validateProductForm() {
        var validation_error = [], hide_validation_error = [];
        jQuery("form#product-form :input").each(function () {
            var input = jQuery(this);
            //console.log(input.attr('name'));
            let val = input.val();
            if (input.attr('name') == 'category_id') {
                if (val == '') {
                    validation_error.push({ id: input.attr('name'), message: 'Please select Category' })
                } else hide_validation_error.push(input.attr('name'))
            } else if (input.attr('name') == 'brand_id') {
                if (val == '') {
                    validation_error.push({ id: input.attr('name'), message: 'Please select Brand' })
                } else hide_validation_error.push(input.attr('name'))
            } else if (input.attr('name') == 'name') {
                if (val == '') {
                    validation_error.push({ id: input.attr('name'), message: 'Please enter your Name' })
                } else hide_validation_error.push(input.attr('name'))
            } else if (input.attr('name') == 'actual_price') {
                if (val == '') {
                    validation_error.push({ id: input.attr('name'), message: 'Please mention Actual Price' })
                } else hide_validation_error.push(input.attr('name'))
            } else if (input.attr('name') == 'discount') {
                if (val == '') {
                    validation_error.push({ id: input.attr('name'), message: 'Please enter discount in precentage' })
                } else if (parseInt(val) < 0 || parseInt(val) > 100) {
                    validation_error.push({ id: input.attr('name'), message: 'Please enter discount amount within (0% to 100%)' })
                } else hide_validation_error.push(input.attr('name'))
            } else if (input.attr('name') == 'fixed_price') {
                if (val == '') {
                    validation_error.push({ id: input.attr('name'), message: 'Please manually set fixed price' })
                } else hide_validation_error.push(input.attr('name'))
            } else if (input.attr('name') == 'description') {
                if (val == '') {
                    validation_error.push({ id: input.attr('name'), message: 'Please enter Your Description' })
                } else if (val.length < 50) {
                    validation_error.push({ id: input.attr('name'), message: 'Please enter Description above 50 characters' })
                } else hide_validation_error.push(input.attr('name'))
            } else {

            }
        });

        if (available_color.length == 0) {
            validation_error.push({ id: 'available_color', message: 'Atleast select one color' })
        }
        else {
            hide_validation_error.push('available_color');
        }

        if (available_size.length == 0) {
            validation_error.push({ id: 'available_size', message: 'Atleast select one size' });
        }
        else {
            hide_validation_error.push('available_size');
        }

        if (available_size.length == 0 && available_color.length == 0) {
            validation_error.push({ id: 'variant', message: 'Please add both size & color for variant genration' });
        } else if (!variants.filter(ele => ele.checked).length >= 1) {
            validation_error.push({ id: 'variant', message: 'Please Check any one variant.Its look like you have no stocks available' });
        }
        else {
            hide_validation_error.push('variant');
        }

        var validation_flag = true   //Validation flag for HighLights


        jQuery('input[name="highlight[]"]').each(function () {
            if (validation_flag && jQuery(this).val() == '') {
                let msg = 'The Highlight #' + jQuery(this).attr('data-index') + ' looks like empty.please enter some highlights'
                validation_error.push({ id: 'highlight', message: msg });
                validation_flag = false
                return;
            }
        });

        if (validation_flag) hide_validation_error.push('highlight');

        validation_flag = true; //Validation flag reset for Specification and that title
        jQuery('input[name="specification-title[]"]').each(function () {
            if (validation_flag && jQuery(this).val() == '') {
                let msg = 'The specification title #' + jQuery(this).attr('data-index') + ' looks like empty.please enter some specification title'
                validation_error.push({ id: 'specification', message: msg });
                validation_flag = false
                return;
            }
        });
        validation_flag && jQuery('input[name="specification[]"]').each(function () {
            if (validation_flag && jQuery(this).val() == '') {
                let msg = 'The specification #' + jQuery(this).attr('data-index') + ' looks like empty.please enter some specifications'
                validation_error.push({ id: 'specification', message: msg });
                validation_flag = false
                return;
            }
        });
        if (validation_flag) hide_validation_error.push('highlight');
        //Media Validation #1 -check selected #2 -is images was cropped
        let media=media_api.getFiles();
        let files=media.filter(ele=>ele.format=="image").map(ele=>ele.editor.crop);validation_flag=true
        if (media.length==0) validation_error.push({id:'media',message:"Please select your product Images & Videos"});
        else{
            files.forEach((ele,ind)=>{
                if (validation_flag && (!ele || ele===undefined)) {
                    let msg = `Image <strong style="color:#e42323">"${media[ind].title}"</strong> looks like not an cropped yet.`;
                    validation_error.push({ id: 'media', message: msg });
                    validation_flag = false
                }
            })
        }
        if (validation_flag) hide_validation_error.push('media');

        validation_error.every(ele => {
            if (!['specification', 'highlight', 'description','media'].includes(ele.id)) {
                jQuery('#tab_1').click();
                return false;
            }else if(['specification', 'highlight', 'description'].includes(ele.id)){
                jQuery('#tab_2').click();
                return false;
            }
        });
        //console.log(validation_error)
        validation_error.forEach(({id,message}) =>showValidation(id,message))
        hide_validation_error.forEach(ele => hideValidation(ele))

        if (validation_error.length == 0 && hide_validation_error.length == 13) {
            sendRequest();
        }
    }
    function hideValidation(id) {
        jQuery('#' + id + '_err').html("").hide();
    }
    function showValidation(id, msg = '') {
        jQuery('#' + id + '_err').html(msg).show();
    }
    function sendRequest() {
        One.loader('show')
        var formData = jQuery("#product-form").serializeArray(),media=media_api.getFiles();
        var data = {};
        var form_data=new FormData();
        formData.forEach(({name,value}) => form_data.append(name, value));
        form_data.delete('highlight[]');
        form_data.delete('specification-title[]');
        form_data.delete('specification[]');
        form_data.delete("fileuploader-list-media");

        let highlight = jQuery("input[name='highlight[]']").map(function () { return $(this).val(); }).get();
        form_data.append('highlight',JSON.stringify(highlight));
        let specification_title = jQuery("input[name='specification-title[]']").map(function () { return $(this).val(); }).get();
        let specification = jQuery("input[name='specification[]']").map(function () { return $(this).val(); }).get();
        var specifications = [];
        for (let i = 0; i < specification.length; i++) {
            specifications.push({
                title: specification_title[i],
                content: specification[i]
            });
        }
        form_data.append('specification',JSON.stringify(specifications));
        form_data.append('available_size',JSON.stringify(available_size));
        form_data.append('available_color',JSON.stringify(available_color));
        form_data.append('variants',JSON.stringify(variants.filter(ele => ele.checked).map(({ size, color, quantity }) => ({ size, color, quantity }))));
        form_data.append('media_crop',JSON.stringify(media.map(ele=>{
            let rotation=ele?.editor?.rotation;
            var crop=ele?.editor?.crop;
            if(rotation!==0 && rotation!==undefined){
                crop.rotation=rotation;
            }
            return crop;
        })));
        media.forEach((ele,ind)=>{
            form_data.append(`media[${ind}]`,ele.file);
        })
        let options = {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            body:form_data
        }
        fetch("{{ route('vendor.products.store') }}", options)
            .then(response => response.json())
            .then(res => {
                One.loader('hide')
                if (res.status) {
                    window.location = '{{ route("vendor.products.index",["status"=>"success","message"=>"Product created successfully"]) }}'
                } else {
                    alert("Oops! Something went wrong")
                }
            })
            .catch(err => {
                alert(err)
            })
    }

    addHighlights()
    addSpecifications()
</script>
@endsection
