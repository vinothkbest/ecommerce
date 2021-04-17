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
            <h1 class="flex-sm-fill h3 my-2">Edit Product</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.products.index') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">{{ $product->product_name }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-content block-content-full vendors-frm">
            <form method="post" action="{{ route('admin.products.update', [$product]) }}"  enctype="multipart/form-data">
                @csrf
                @method("put")
                <div class="row">
                    <div class="col-md-12 card">
                          <div class="card-header bg-success text-white font-weight-bold">
                                Product Info
                          </div>
                          <div class="card-body">
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category_id" class="add-admin-frm" id="category_id" required>
                                                <option selected value="{{ $product->categories[0]->id ?? ''}}">{{ $product->categories[0]->category_name ?? ''}}</option>
                                                @foreach($categories as $category)
                                                    @if($product->categories[0]->id != $category->id)
                                                        <option value={{$category->id}}>{{$category->category_name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sub Category</label>
                                            <select name="sub_category_id" class="add-admin-frm" id="sub_category">
                                                <option selected value="{{ isset($product->categories[1]->id) ? $product->categories[1]->id : ''}}">{{ isset($product->categories[1]->category_name) ? $product->categories[1]->category_name : 'No Category'}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Child Sub Category</label>
                                            <select name="child_sub_category_id" class="add-admin-frm" id="child_sub_category">
                                                <option value="{{ isset($product->categories[2]->id) ? $product->categories[2]->id : ''}}">{{ isset($product->categories[2]->category_name) ? $product->categories[2]->category_name : 'No Category'}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select name="brand" class="add-admin-frm" id="brand_id" required>
                                                <option value="{{ $product->brand->id ?? ''}}">{{ $product->brand->brand_name ?? ''}}</option>
                                                @foreach($brands as $brand)
                                                @if($brand->id != $product->brand->id)
                                                    <option value={{$brand->id}}>{{$brand->brand_name}}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Product</label>
                                            <input type="text" name="product_name"
                                                   class="add-admin-frm" value="{{ $product->product_name ?? '' }}"
                                                   required>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label>GST Tax (In %)</label>
                                            <input type="text"
                                                   name="gst_tax"
                                                   class="add-admin-frm"
                                                   value="{{ $product->gst_tax ?? '' }}"
                                                   pattern="[0-9]+([\.,][0-9]+)?" step="0.01"
                                                   title="This should be a number with up to 2 decimal places."
                                                   required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="add-admin-frm" name="product_description" rows="5" required>{{ $product->description ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Detailed Description</label>
                                            {{-- <div id="js-ckeditor5-classic"></div> --}}
                                            <textarea type="text" class="form-control" id="content"
                                          name="detailed_description" placeholder="Content">{{ $product->detailed_description }}</textarea>
                                          <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
                                          <script>
                                              CKEDITOR.replace( 'content' );
                                          </script>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="image-div">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Feature Images</label>
                                            <input type="file" name="images[]"
                                                   class="add-admin-frm"
                                                   onchange="imagePreview(this)"
                                                   id="upload-image"
                                                   multiple>
                                            @error('image')
                                            <div class="text-danger animated fadeIn">
                                                {{ $errors->first('image') }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="old-image-preview">
                                        @foreach($product->productMedia as $productMedia)
                                        <img src="{{ $productMedia->path ?? ''}}" alt="Product Features" width="80px" height="80px">
                                        @endforeach
                                    </div> 
                                </div>    
                          </div>

                    </div>
                    
                    <div class="card mt-3">
                          <div class="card-header bg-success text-white font-weight-bold">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Product varients</label>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" class="btn-sm btn-dark" id="add_product_variant"><i
                                            class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                          </div>
                          <div class="card-body">
                                <div id="more_variants">
                                    @foreach($product->productVariants as $key => $variant)
                                        <div class="row rows-class" id="row_number_{{ $key }}">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>variant</label>
                                                    <input type="text" class="add-admin-frm" name="variants['{{ $key }}'][variant_name]" required
                                                    value="{{ $variant->variant_name }}">
                                                <input type="hidden" class="add-admin-frm" name="variants['{{ $key }}'][product_variant_id]" required
                                                    value="{{ $variant->id }}" id="remove-variants{{$key}}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Unit</label>
                                                    <select class="add-admin-frm add-admin-frms" name="variants['{{ $key }}'][unit_id]">
                                                        <option value="{{$variant->unit->id}}" selected>{{$variant->unit->unit_name}}</option>
                                                        @foreach($units as $unit)
                                                            @if($variant->unit->id !== $unit->id)
                                                            <option value={{$unit->id}}>{{$unit->slug}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Available Count</label>
                                                    <input type="text" class="add-admin-frm" name="variants['{{ $key }}'][availability_count]" required value="{{$variant->available_quantity_count ?? ''}}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Actual Price</label>
                                                    <input type="text" class="add-admin-frm" name="variants['{{ $key }}'][actual_price]" required
                                                    value="{{$variant->actual_price ?? ''}}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Discount</label>
                                                    <input type="text" class="add-admin-frm" name="variants['{{ $key }}'][discount_price]" required
                                                    value="{{$variant->discount_price ?? ''}}">
                                                </div>
                                            </div>
                                            @if(!$loop->first)
                                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                                <button type="button" id="add_product_variant" class="btn-sm btn-danger" onclick="deleterow({{ $key }})"><i
                                                 class="fas fa-minus"></i></button>
                                             </div>
                                            @endif
                                        </div>
                                    @endforeach
                                    {{-- To delete Varients --}}
                                    <div id="remove-variant-div"> 
                                        
                                    </div>
                                    
                                </div>
                          </div>
                    </div>
                    <div class="card col-md-12 mt-3">
                          <div class="card-header bg-success text-white font-weight-bold">
                                Product seo contents
                          </div>
                          <div class="card-body col-md-12">
                                <div class="col-md-12 row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>SEO Title</label>
                                            <input type="text" class="add-admin-frm"
                                                   name="seo-title" autocomplete="off" required id="seo_title"
                                                   value="{{ $product->productSeo->title ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>SEO Keyword</label>
                                            <input type="text" class="add-admin-frm"
                                                   name="keyword" autocomplete="off" required id="keyword"
                                                   value="{{ $product->productSeo->keyword ?? ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>SEO Description</label>
                                            <textarea name="description" rows="4"
                                                      class="add-admin-frm" autocomplete="off" required id="description">{!! $product->productSeo->description ?? ''!!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>SEO Image</label>
                                            <input type="file" name="seo-image" class="add-admin-frm"
                                                accept="image/x-png,image/gif,image/jpeg">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 text-center">
                                    <div class="category-save">
                                        <button type="submit">Submit</button>
                                    </div>
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
<script src="{{asset('js/plugins/ckeditor5-classic/build/ckeditor.js')}}"></script>

        <!-- Page JS Helpers (CKEditor 5 plugins) -->
        <script>jQuery(function () {
                                    One.helpers(['ckeditor5']);
                                });</script>
<script>
    let index = "{{ count($product->productVariants ?? '') }}";
    jQuery('#add_product_variant').click(function(){ 
        jQuery('#more_variants').append(`<div class="row rows-class" id="row_number_${index}">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>variant</label>
                                    <input type="text" class="add-admin-frm" name="variants[${index}][variant_name]" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Unit</label>
                                    <select class="add-admin-frm add-admin-frms" name="variants[${index}][unit_id]">
                                        @foreach($units as $unit)
                                            <option value={{$unit->id}}>{{$unit->slug}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Available Count</label>
                                    <input type="text" class="add-admin-frm" name="variants[${index}][availability_count]" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Actual Price</label>
                                    <input type="text" class="add-admin-frm" name="variants[${index}][actual_price]" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Discount</label>
                                    <input type="text" class="add-admin-frm" name="variants[${index}][discount_price]" required>
                                </div>
                            </div>
                            <div class="col-md-1 d-flex justify-content-center align-items-center">
                                <button type="button" id="add_product_variant" class="btn-sm btn-danger" onclick="deleterow(${index})"><i
                                 class="fas fa-minus"></i></button>
                             </div>
                        </div>    
                        `);
                        
                        index++;
        
    });

    function deleterow(index)
    {
        
        let row_number=jQuery('#row_number_'+index);
        let variant_id = jQuery('#remove-variants' + index).val();
        
        if(variant_id){
            
        jQuery('#remove-variant-div').append(`<input type="hidden" name="remove_variants[]" value="${parseInt(variant_id)}">`)
        }

        row_number.remove();
        
    }
</script>
<script>
    const category_data = {!! json_encode($categories)!!};
    //console.log(category_data);
    jQuery('#category_id').on('change',function(){
        let categoryid=$('#category_id :selected').val();
        let clickedIndex = category_data.findIndex(data=>data.id==categoryid); //  
        console.log(clickedIndex);
        let clickedObj=category_data[clickedIndex];
        let subCat=clickedObj.data;
        let htmlStr=`<option value="0">--- Select Category ---</option>`;
        if(subCat.length==0){
            htmlStr=`<option value="0">No Category</option>`;
        }else{
            htmlStr =htmlStr+ subCat.map(element=>{
                 return `<option value="${element.id}">${element.label}</option>`;
            }).join('/n');
        }
       jQuery('#sub_category').html(htmlStr);
        console.log(htmlStr);
    });

    function updateFixedPrice() {
        var actual_price = jQuery('#actual_price').val(),
            discount = jQuery('#discount').val(),
            fixed_price = jQuery('#fixed_price');
        if (actual_price && discount)
            fixed_price.val((actual_price - (actual_price * (discount / 100))).toFixed(2));
        else
            fixed_price.val('');
    }

    jQuery('#sub_category, #category_id').on('change',function(){
    //get category and subcategory selected values
    let categoryid=$('#category_id :selected').val();
    let subcategory_id=jQuery('#sub_category').val();
    
    //get index of selected category and subcategory.
    let category_Index = category_data.findIndex(data=>data.id==categoryid);
    let subcategory_index=category_data[category_Index].data.findIndex(data=>data.id==subcategory_id)
    
    let selected_subcategory=category_data[category_Index].data[subcategory_index]||{}; 
    
    console.log(categoryid,subcategory_id,category_Index,subcategory_index,selected_subcategory);//to check the data
        let child_subcategory=selected_subcategory.data||[];
        let dropdown_html_string=`<option value="0">--- Select Category ---</option>`;
        if(child_subcategory.length == 0){
            dropdown_html_string=`<option value="0">No Category</option>`;
        }
        dropdown_html_string =dropdown_html_string+ child_subcategory.map(element=>{
             return `<option value="${element.id}">${element.label}</option>`;
        }).join('/n');
        jQuery('#child_sub_category').html(dropdown_html_string);
        console.log(dropdown_html_string);
    });
 
</script>
<script>
    function imagePreview(images){
        
        var image_div = jQuery("#image-div");
        jQuery("#old-image-preview").remove()
        jQuery("#image-preview").remove()
        var preview = '<div class="col-md-12" id="image-preview"></div>'
        image_div.append(preview);
        jQuery.each(images.files, function(index, image){

            var reader = new FileReader();
            reader.onload = function(){
                var image = new Image();
                image.height = 100;
                image.width = 100;
                image.src = this.result;
                jQuery("img").addClass("animated slideInRight mr-2 old-image")
                jQuery("#image-preview").append(image);
            }
            reader.readAsDataURL(image);
        });
    }
</script>
@endsection