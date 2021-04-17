@extends('website.templates.main')
@section('contents')
    <section class="other-banner">
        @include('website.templates.nav-bar')
        <div class="in-ban-oth">
            <h4>{{$category->category_name}}</h4>
            <ul class="d-flex justify-content-end mt-4" style="text-transform: capitalize;">
                <li class="pr-1">
                    <a href="{{ url('/') }}">Home
                    </a>
                    /
                </li>
                @if(isset($category->parentCategories->parentCategories))
                    <li>
                        <a href="{{ $category->parentCategories->parentCategories->slug}}">
                            <span>
                                {{ $category->parentCategories->parentCategories->category_name}}
                            </span>
                        </a>/
                    </li>
                @endif
                
                @if(isset($category->parentCategories))
                    <li>
                        <a href="{{ $category->parentCategories->slug }}">
                            <span>
                                {{ $category->parentCategories->category_name}}
                            </span>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ $category->slug }}">
                            <span>
                                {{ $category->category_name}}
                            </span>
                        </a>
                    </li>    
                @endif
            </ul>
        </div>
    </section>
    <div class="row">
        {{-- End Filters --}}
        <aside class="col-lg-3">
            <div class="sidebar-shop order-lg-first mobile-sidebar" style="height: 721px">
                <div class="pin-wrapper">
                    <div class="sidebar-wrapper">
                        <div class="widget">
                            @if(isset($category->parentCategories->parentCategories))
                                <h3 class="widget-title">
                                    <a  data-toggle="collapse"
                                        href="#cate{{$category->parentCategories->parentCategories->id}}"
                                        role="button"
                                        aria-expanded="true"
                                        aria-controls="widget-body-2"
                                        class="">Category</a>
                                </h3>
                                <div class="collapse show" id="cate{{$category->parentCategories->parentCategories->id}}" style="">
                                    <div class="lst-ck">
                                        <label class="label-box">{{ $category->parentCategories->parentCategories->category_name ?? '' }}
                                            <input type="checkbox" name=category{{$category->parentCategories->parentCategories->id}} checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            @endif
                            @if(isset($category->parentCategories) && isset($category->parentCategories->parentCategories))
                                <h3 class="widget-title">
                                    <a  data-toggle="collapse"
                                        href="#cate{{$category->parentCategories->id}}"
                                        role="button"
                                        aria-expanded="true"
                                        aria-controls="widget-body-2"
                                        class="">Sub Category</a>
                                </h3>
                                <div class="collapse show" id="cate{{$category->parentCategories->id}}" style="">
                                    <div class="lst-ck">
                                        <label class="label-box">{{ $category->parentCategories->category_name ?? '' }}
                                            <input type="checkbox" name=category{{$category->parentCategories->id}} checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            @elseif(isset($category->parentCategories) && !isset($category->parentCategories->parentCategories))
                                <h3 class="widget-title">
                                    <a  data-toggle="collapse"
                                        href="#cate{{$category->parentCategories->id}}"
                                        role="button"
                                        aria-expanded="true"
                                        aria-controls="widget-body-2"
                                        class="">Category</a>
                                </h3>
                                <div class="collapse show" id="cate{{$category->parentCategories->id}}" style="">
                                    <div class="lst-ck">
                                        <label class="label-box">{{ $category->parentCategories->category_name ?? '' }}
                                            <input type="checkbox" name=category{{$category->parentCategories->id}} checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>  
                            @endif
                            @if(isset($category->parentCategories) && isset($category->parentCategories->parentCategories))
                                <h3 class="widget-title">
                                    <a  data-toggle="collapse"
                                        href="#cate{{$category->id}}"
                                        role="button"
                                        aria-expanded="true"
                                        aria-controls="widget-body-2"
                                        class="">Last Category</a>
                                </h3>
                                <div class="collapse show" id="cate{{$category->id}}" style="">
                                    <div class="lst-ck">
                                        <label class="label-box">{{ $category->category_name ?? '' }}
                                            <input type="checkbox" name=category{{$category->id}} checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            @elseif(isset($category->parentCategories) && !isset($category->parentCategories->parentCategories))
                                <h3 class="widget-title">
                                    <a  data-toggle="collapse"
                                        href="#cate{{$category->id}}"
                                        role="button"
                                        aria-expanded="true"
                                        aria-controls="widget-body-2"
                                        class="">Sub Category</a>
                                </h3>
                                <div class="collapse show" id="cate{{$category->id}}" style="">
                                    <div class="lst-ck">
                                        <label class="label-box">{{ $category->category_name ?? '' }}
                                            <input type="checkbox" name=category{{$category->id}} checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            @else
                                <h3 class="widget-title">
                                    <a  data-toggle="collapse"
                                        href="#cate{{$category->id}}"
                                        role="button"
                                        aria-expanded="true"
                                        aria-controls="widget-body-2"
                                        class="">Category</a>
                                </h3>
                                <div class="collapse show" id="cate{{$category->id}}" style="">
                                    <div class="lst-ck">
                                        <label class="label-box">{{ $category->category_name ?? '' }}
                                            <input type="checkbox" name=category{{$category->id}} checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="widget">
                            <h3 class="widget-title">
                                <a  data-toggle="collapse"
                                    href="#unit"
                                    role="button"
                                    aria-expanded="true"
                                    aria-controls="widget-body-2"
                                    class="">By Weight</a>
                            </h3>
                            @php
                                $variants = [];
                                $actual_price= [];
                                $brands = [];
                            @endphp
                            <div class="collapse show overflow-auto" id="unit">
                                @foreach($category->products as $product)
                                    @foreach($product->productVariants as $key=>$variant)
                                        @if(!in_array(intval($variant->variant_name), $variants))
                                            <div class="lst-ck p-0 border-0">
                                                    <label class="label-box">{{intval($variant->variant_name) . " " .  $variant->unit_name}}
                                                        <input type="checkbox"
                                                               class="filter-variants"
                                                               value="{{ $variant->variant_name }}"
                                                               onClick="productFilter()">
                                                        <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        @php
                                        array_push($variants, intval($variant->variant_name));
                                        @endphp
                                        @endif

                                        @if(!in_array($variant->actual_price, $actual_price))
                                              @php
                                                array_push($actual_price, intval($variant->actual_price));
                                              @endphp
                                        @endif
                                        @endforeach

                                        @if(!in_array($product->brand->brand_name, $brands))
                                              @php
                                                array_push($brands, $product->brand->brand_name);
                                              @endphp
                                        @endif
                                @endforeach
                                @php
                                sort($actual_price);
                                $price_ranges = array_chunk($actual_price, 3);
                                @endphp
                            </div>
                        </div>
                        @if(count($brands) >= 2)
                            <div class="widget">
                                <h3 class="widget-title">
                                    <a  data-toggle="collapse"
                                        href="#brand"
                                        role="button"
                                        aria-expanded="true"
                                        aria-controls="widget-body-2"
                                        class="">By Brand</a>
                                </h3>
                                <div class="collapse show overflow-auto" id="brand">
                                    @foreach($brands as $key=>$brand)
                                        <div class="lst-ck p-0 border-0">
                                                <label class="label-box">{{ $brand}}
                                                    <input type="checkbox"
                                                           class="filter-brands" value="{{ $brand }}"
                                                           onClick="productFilter()">
                                                    <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if(count($price_ranges) >= 2)
                            <div class="widget">
                                <h3 class="widget-title">
                                    <a
                                        data-toggle="collapse"
                                        href="#Prize"
                                        role="button"
                                        aria-expanded="true"
                                        aria-controls="widget-body-4">By Prize</a>
                                </h3>
                                <div class="collapse show overflow-auto" id="Prize">
                                    <div class="lst-ck">
                                        @foreach ($price_ranges as $key => $prices)
                                            @if( $prices[count($prices)-1] != $prices[0])
                                                <label class="label-box">₹{{ $prices[0] }} - {{ $prices[count($prices)-1] }}
                                                    <input type="checkbox" class="filter-price"
                                                            value="{{ $prices[0]. " " .$prices[count($prices)-1] }}"
                                                            onClick="productFilter()">
                                                    <span class="checkmark"></span>
                                                </label>
                                            @else
                                                <label class="label-box">above ₹{{ $prices[0] }}
                                                    <input type="checkbox" class="filter-price"
                                                            value="{{ $prices[0]. " " .$prices[count($prices)-1] }}"
                                                            onClick="productFilter()">
                                                    <span class="checkmark"></span>
                                                </label>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </aside>
        {{-- End Filters --}}
        {{-- Filtered Products --}}
        <aside class="col-lg-9 mt-3 p-0 prod-list">
            @csrf
            <div class="row" id="category-products">
                {{-- <button><img width="26" src="img/wish" alt=""></button> --}}
            </div>
            
        </aside>
        {{-- End Filtered Products --}}
    </div>
@endsection
@section("after_js")
    <script>
        var product_ids = [];
        const products =  @json($category->products);
        jQuery(document).ready(function(){
            
           products.forEach( (product) => {
                product_ids.push(parseInt(product.id));
                
           });
            let list ={
                products: product_ids,
            }
            jQuery.ajax({
                type:"POST",
                url: "{{ url('products') }}",
                data: list,
                async:false,
                headers: {
                          'X-CSRF-TOKEN': jQuery('input[name="_token"]').val() 
                        },
                success: function (response){
                        jQuery("#category-products").html(response);
                },
            });
            jQuery(".page-item").map(function(index, element){
                if(jQuery(element).attr("class") == "page-item active"){
                    let active = jQuery(element.innerHTML).text()
                    jQuery(element).attr('onClick', `pagination(event,${active })`);
                }
                else if (jQuery(element).attr("class") == "page-item") {
                        let item = jQuery(element.innerHTML).attr("href").split("=")[1];
                        jQuery(element).attr('onClick', `pagination(event,${item})`);
                }
            })
            if(jQuery("li").hasClass('page-item') && jQuery(jQuery(".page-item").last().attr("class") != "page-item active")){
                const last_item = parseInt(jQuery(jQuery(".page-item").last()[0].innerHTML).attr("href").split("=")[1])

                jQuery(".page-item").last().attr('onClick', `pagination(event,${last_item})`)
            }
           

        });
        
        function changeVariant(product){
            let actual_price = jQuery(`#variant-select${product}`).find('option:selected').data('actualPrice')
            let selling_price = jQuery(`#variant-select${product}`).find('option:selected').data('sellingPrice')
            let availablity_status = parseInt(jQuery(`#variant-select${product}`).find('option:selected').data('availability'))

            if(actual_price == selling_price){
                jQuery(`#actualupdate${product}`).fadeOut(500);
                jQuery(`#rupee${product}`).fadeOut(500);
                jQuery(`#sellingupdate${product}`).text(selling_price);
            }
            else{
                jQuery(`#rupee${product}`).fadeIn(500);
                jQuery(`#actualupdate${product}`).fadeIn(500);
                jQuery(`#actualupdate${product}`).text(actual_price);
                jQuery(`#sellingupdate${product}`).text(selling_price);    
            }
            var stock_text = (availablity_status) ? "in Stock" : "out of Stock"
            var stock_calss = (availablity_status) ? "in-stock" : "out-stock"
            var stock_calss_btn = (availablity_status) ? "in-stock-btn" : "out-stock-btn"
            jQuery(`#stock${product}`).text(stock_text)
            jQuery(`#stock${product}`).attr("class", stock_calss)
            jQuery(`#log-btn${product}`).attr("class", stock_calss_btn)
            jQuery(`#stock-btn${product}`).attr("class", stock_calss_btn)

            jQuery(".in-stock").css({background: "#202433"})
            jQuery(".out-stock").css({background: "#ab0010"})
            jQuery(".in-stock-btn").fadeIn(500)
            jQuery(".out-stock-btn").fadeOut(500)
        }
    
        const url = "{{ url('product-filter') }}";
        
        //product filtering 
        var filteredVariants = '', filteredMin = '', filteredMax = '',  filteredBrands = '';

        function productFilter(){
            let variants = jQuery('.filter-variants').filter(':checked');
            let prices = jQuery('.filter-price').filter(':checked');
            let brands = jQuery('.filter-brands').filter(':checked');
            let filter_variants = [], filter_brands = [], filter_price_range = []; 
            var filter_price_min = '' , filter_price_max = '';
            variants.map(function(){
                filter_variants.push(this.value);
            });
            prices.map(function(){
                filter_price_range.push(this.value);
                filter_price_min = this.value.split(" ")[0];
                filter_price_max = this.value.split(" ")[1];
            });
            brands.map(function(){
                filter_brands.push(this.value);
            });

            if(filter_price_range.length > 1){

                filter_price_min = filter_price_range[0].split(" ")[0];
                filter_price_max = filter_price_range[filter_price_range.length-1].split(" ")[1];
            }

            let filterData = {
                variants: filter_variants,
                price_min: filter_price_min,
                price_max: filter_price_max,
                brands: filter_brands,
                products : product_ids,
            };
            filteredVariants = filter_variants
            filteredMin = filter_price_min
            filteredMax = filter_price_max
            filteredBrands = filter_brands
            jQuery.ajax({
                type:"POST",
                url: url,
                data: filterData,
                async:false,
                headers: {
                          'X-CSRF-TOKEN': jQuery('input[name="_token"]').val() 
                        },
                success: function (response){
                   jQuery("#category-products").html(response);

                   jQuery(".page-item").map(function(index, element){
                        if(jQuery(element).attr("class") == "page-item active"){
                            let active = jQuery(element.innerHTML).text()
                            jQuery(element).attr('onClick', `pagination(event,${active })`);
                        }
                        else if (jQuery(element).attr("class") == "page-item") {
                                let item = jQuery(element.innerHTML).attr("href").split("=")[1];
                                jQuery(element).attr('onClick', `pagination(event,${item})`);
                        }
                    })
                    if(jQuery("li").hasClass('page-item') && jQuery(jQuery(".page-item").last().attr("class") != "page-item active")){
                        const last_item = parseInt(jQuery(jQuery(".page-item").last()[0].innerHTML).attr("href").split("=")[1])

                        jQuery(".page-item").last().attr('onClick', `pagination(event,${last_item})`)
                    }
                }
            });
        }

        function pagination(event, clickedPage){
            event.preventDefault()
            
            let filteredData = {
                variants: filteredVariants,
                price_min: filteredMin,
                price_max: filteredMax,
                brands: filteredBrands,
                products : product_ids,
                page: clickedPage,
            };
            jQuery.ajax({
                type:"POST",
                url: url,
                data: filteredData,
                async:false,
                headers: {
                          'X-CSRF-TOKEN': jQuery('input[name="_token"]').val() 
                        },
                success: function (response){
                   jQuery("#category-products").html(response);
                    
                   jQuery(".page-item").map(function(index, element){
                    if(jQuery(element).attr("class") == "page-item active"){
                        let active = jQuery(element.innerHTML).text()
                        jQuery(element).attr('onClick', `pagination(event,${active })`);
                        }
                        else if (jQuery(element).attr("class") == "page-item") {
                                let item = jQuery(element.innerHTML).attr("href").split("=")[1];
                                jQuery(element).attr('onClick', `pagination(event,${item})`);
                        }
                    })
                    if(jQuery("li").hasClass('page-item') && jQuery(jQuery(".page-item").last().attr("class") != "page-item active")){
                        const last_item = parseInt(jQuery(jQuery(".page-item").last()[0].innerHTML).attr("href").split("=")[1])

                        jQuery(".page-item").last().attr('onClick', `pagination(event,${last_item})`)
                    }
                }
            });
        }

    </script>
@endsection