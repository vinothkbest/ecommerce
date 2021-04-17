@extends('admin.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css')}}">
@endsection

@section('js_after')
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>
<script>
    jQuery(document).ready(function(){
         One.helpers(['validation','flatpickr']);
         jQuery('.js-validation').validate({
            ignore: [],
            rules: {

                // 'title': {
                //     required: true,
                // },
                'link': {
                    required: true,
                },
                'image': {
                    required: true,
                    accept: "image/*",
                },

            },
            messages: {
                // 'title':'Please enter a title',
                'link':'Please enter a link',
                'image': {
                    required: 'Please select an image',
                }
            }
        });

        jQuery('[name="product"]').keyup(function(){
            jQuery('#product-list').show();
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var product=jQuery(this).val();
           // if(product!=''){
                jQuery.ajax({
                    url:'{{ route("admin.deals.search") }}',
                    type:'post',
                    data:{product:product},
                    success:function(response){
                    var product_list='';
                    if(response?.status){
                        response.data.forEach(product => {
                            product_list+=`<li data-product="${product.id}" data-productname="${product.name}">${product.name}</li>`
                        });
                    }
                    jQuery('#product-list').html(product_list)
                    },error:function(error){
                    }
                })
            //}
        });

        jQuery(document).on('click','#product-list li',function(){
            var product=jQuery(this).data('product')
            jQuery.ajax({
                    url:'{{ route("admin.deals.search-detail") }}',
                    type:'post',
                    data:{id:product},
                    success:function(content){
                        jQuery('#product-price-detail').html(content)
                    },error:function(error){
                    }
                })
            jQuery('#product-list').hide();
        })
        function updateFixedPrice() {

        }
        jQuery(document).on('keyup','#deal_discount',function(e){
            // if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //    return false;
            // }
            var actual_price = jQuery('#actual_price').val(),
            discount = jQuery('#deal_discount').val(),
            fixed_price = jQuery('#deal_fixed_price');
            if(discount>=100){
                jQuery('#deal_discount').val('');
                fixed_price.val('');
                alert('Discount must within 100')
                return false;
            }
            if (actual_price && discount)
                fixed_price.val((actual_price - (actual_price * (discount / 100))).toFixed(2));
            else
            fixed_price.val('');
        })
    });

</script>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Create Deal</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.deals.index') }}">Deals</a>
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
            @if($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{$error}}
            </div>
            @endforeach
            @endif
            <form class="js-validation" action="{{route('admin.deals.store')}}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="block block-rounded">

                    <div class="block-content block-content-full">
                        <!-- Regular -->
                        <div class="row items-push ">

                            <div class="col-md-12 vendors-frm testimonial-group">
                                {{-- <div class="form-group">
                                    <label for="val-role">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control">
                                </div> --}}
                                <div class="form-group product-add">
                                    <label for="val-role">Product <span class="text-danger">*</span></label>
                                    <input type="text" name="product" class="form-control product-create"
                                        placeholder="Search using product code or name">
                                    <div id="product-list-container">
                                        <ul id="product-list">

                                        </ul>
                                    </div>
                                </div>
                                <div id="product-price-detail">

                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group product-add">
                                            <label for="val-role">Deal Start Date and Time <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="js-flatpickr form-control bg-white product-create"
                                                name="start_datetime" data-enable-time="true" data-time_24hr="true">
                                            <div id="product-list-container">
                                                <ul id="product-list">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group product-add">
                                            <label for="val-role">Deal End Date and Time <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="js-flatpickr form-control bg-white product-create"
                                                name="end_datetime" data-enable-time="true" data-time_24hr="true">
                                            <div id="product-list-container">
                                                <ul id="product-list">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="text-right">
                                    <button type="submit" class="btn btn-alt-primary">Submit</button>
                                </div>

                            </div>
                        </div>
                        <!-- END Regular -->


                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@endsection
