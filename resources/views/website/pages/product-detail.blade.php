@extends('website.templates.main')
@section('contents')
<section class="other-banner">
    @include('website.templates.nav-bar')
    <div class="in-ban-oth">
        <h4>{{ $product->product_name ?? '' }}</h4>
        <ul class="d-flex justify-content-end mt-4" style="text-transform: capitalize;">
            <li class="pr-1"><a href="{{ url('/') }}">Home</a>/</li>
            @foreach($product->categories as $category)
                <li><a href="{{ url("category/".$category->slug ?? '')}}">{{ $category->category_name ?? '' }}</a>/</li>
            @endforeach
            <li><span>{{ $product->product_name ?? '' }}</span></li>
        </ul>
    </div>
</section>
<section class="prod-det">
    <div class="container95">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="prod-det-lf">
                    <div class="tab-content text-center" id="myTabContent">
                    @if(count($product->productMedia) > 0)
                        @foreach($product->productMedia as $product_image)
                            @if($loop->first)
                                <div class="tab-pane fade show active" id="profile{{ $product_image->id ?? '' }}" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="img-magnifier-container">
                                        <img id="myimage" src="{{ $product_image->path ?? '' }}">
                                    </div>
                                </div>
                            @else
                                <div class="tab-pane fade" id="profile{{ $product_image->id ?? '' }}" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="img-magnifier-container">
                                        <img id="myimage1" src="{{ $product_image->path ?? '' }}">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @if(count($product->productMedia) > 0)
                        @foreach($product->productMedia as $product_image)
                            @if($loop->first)
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#profile{{ $product_image->id ?? '' }}" role="tab"
                                        aria-controls="home" aria-selected="true"><img src="{{ $product_image->path ?? '' }}"></a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab"
                                       data-toggle="tab"
                                       href="#profile{{ $product_image->id ?? '' }}" role="tab"
                                        aria-controls="profile" aria-selected="false"><img src="{{ $product_image->path ?? '' }}"></a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                    </ul>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="rt-det-pag">
                    <h4>{{ $product->product_name ?? '' }}</h4>
                    <h5><strike id="rupee{{$product->id}}">₹</strike>
                        <strike id="strikeupdate{{ $product->id }}">{{ $product->singleVariant->actual_price ?? '' }}</strike>
                        ₹<span id="sellingupdate{{ $product->id }}">{{ $product->singleVariant->selling_price ?? '' }}</span>
                        <label style="font-weight: normal; font-size: 15px" class="ml-2" id="save{{ $product->id }}">save ₹</label>
                        <span style="font-weight: normal; font-size: 15px" id="saveupdate{{ $product->id }}">{{ $product->singleVariant->actual_price - $product->singleVariant->selling_price ?? '' }}</span>
                    </h5>
                    <form action="{{ route('user.cart.add') }}" id="" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                        <input type="hidden" name="type" value="new-item">
                        <div class="color-select d-flex">
                            <label for="">Qty</label>
                            <select name="variant_id" id="variant-select{{ $product->id }}" onChange="changeVariant({{ $product->id }})">
                                @foreach($product->productVariants as $variant)
                                    <option value="{{$variant->id }}"
                                            data-selling-price="{{ $variant->selling_price }}"
                                            data-actual-price="{{ $variant->actual_price }}"
                                            data-save-price="{{ $variant->actual_price - $variant->selling_price}}">{{ $variant->variant_name . ' ' . $variant->unit->unit_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <p>
                            {{ $product->description ?? '' }}
                        </p>
                        <div class="car-wish-vw2">
                            @guest
                                <a href="{{ route('user.form', ['login']) }}">
                                    <button style="padding: 6px 9px 8px;" type="button">
                                        <img src="{{ asset('web/img/cart.png') }}"
                                             alt="add to cart"
                                             title="Add to Cart"/></button>
                                </a>
                            @endguest
                            @auth
                                <button style="padding: 6px 9px 8px;"
                                        id="stock-btn{{ $product->id }}"
                                        class="{{ ($product->singleVariant->availablity_status)? 'in-stock-btn' : 'out-stock-btn'}}" type="submit">
                                    <img src="{{ asset('web/img/cart.png') }}" alt=""></button>
                            <a href="{{ url('user/shipping-summary')}}?product={{ $product->id }}&variant={{ $product->singleVariant->id }}"
                            class="{{ ($product->singleVariant->availablity_status)? 'in-stock-btn' : 'out-stock-btn'}}" id="buy-now">
                                <button class="det-buy-now" type="button"
                                    style="padding:6px 12px 4px;">Buy Now</button>
                            </a>
                            @endauth
                            <button style="padding: 6px 12px 8px" title="" type="button">
                                <i class="fab fa-whatsapp"></i>
                            </button>
                        </div>
                    </form>
                    <!-- <button class="det-buy-now">Buy Now</button> -->
                </div>
            </div>
        </div>
    </div>
</section>
<section class="det-rev border-bottom-0">
    <div class="container95">
        <div class="row">
            <div class="col-lg-12">
                <div class="rating-rew mt-3">
                    {!! $product->detailed_description ?? '' !!}
                </div>
            </div>
        </div>
    </div>
</section>
@if(count($more_products) > 1)
<section>
    <div class="container95 mb-2">
        <div class="tit-prod">
            <h3 class="tit-h3">Other Products</h3>
        </div>
        <div class="owl-carousel owl-them">
        @foreach($more_products->take(5) as $more_product)
        @if($more_product->id !== $product->id)
            <div class="item">
                <div class="prod-box">
                    <div class="prod-img">
                        <div class="top-prod">
                            <p id="stock{{ $more_product->id }}" class="{{ ($more_product->singleVariant->availablity_status)? 'in-stock' : 'out-stock'}}">{{ ($more_product->singleVariant->availablity_status)? "in Stock" : "out of Stock"}}
                            </p>
                        </div>
                        <a href="{{ url('products/'. $more_product->slug) }}">
                            <img class="m-auto d-block p-3 w-100" src="{{ $more_product->productMedia[0]->path ?? '' }}" alt="">
                            <img class="det-icon" src="{{ asset('web/img/details.png') }}" alt="">
                        </a>
                    </div>
                    <div class="prod-cont">
                        <h4>{{ $more_product->product_name ?? ''}}</h4>
                        <h5><span id="rupee{{$more_product->id}}"><strike style="color:#ab0010">₹</strike></span><strike class="mr-2" id="actualupdate{{ $more_product->id }}">{{ $more_product->singleVariant->actual_price ?? '' }}</strike>
                                    <span>₹</span><span id="sellingupdate{{ $more_product->id }}">{{ $more_product->singleVariant->selling_price ?? '' }}</span></h5>
                    </div>
                    <div class="btm-prod">
                    <form action="{{ route('user.cart.add') }}" id="" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $more_product->id ?? '' }}">
                        <input type="hidden" name="type" value="new-item">
                        <select name="variant_id" id="variant-select{{ $more_product->id }}" onChange="changeMoreVariant({{ $more_product->id }})">
                            @foreach($more_product->productVariants as $variant)
                                <option value="{{$variant->id}}"
                                    data-actual-price="{{ $variant->actual_price }}"
                                    data-selling-price="{{ $variant->selling_price }}"
                                    data-availability="{{ $variant->availablity_status }}">{{ $variant->variant_name . ' ' . $variant->unit->unit_name }}</option>
                            @endforeach
                        </select>
                        @guest
                            <a href="{{ route('user.form', ['login']) }}">
                                <button type="button"
                                        id="log-btn{{ $more_product->id }}"
                                        class="{{ ($more_product->singleVariant->availablity_status)? 'in-stock-btn' : 'out-stock-btn'}}">
                                                <img width="26" src="{{ asset('web/img/cart.png') }}" alt="">
                                </button>
                            </a>
                        @endguest
                        @auth
                            <button type="submit"
                                    id="stock-btn{{ $more_product->id }}"
                                    class="{{ ($more_product->singleVariant->availablity_status)? 'in-stock-btn' : 'out-stock-btn'}}">
                                            <img width="26" src="{{ asset('web/img/cart.png') }}" alt="">
                            </button>
                        @endauth
                    </div>
                </div>
            </div>
        @endif
        @endforeach
        </div>
        @if(count($more_products) > 5)
            <div class="vw-pdt mt-3 mb-5">
                <a href="#">more product</a>
            </div>
        @endif
        </div>
    </div>
</section>
@endif
@endsection
@section("after_js")
    <script>
        function changeVariant(product){
            let actual_price = jQuery(`#variant-select${product}`).find('option:selected').data('actualPrice')
            let selling_price = jQuery(`#variant-select${product}`).find('option:selected').data('sellingPrice')
            let availablity_status = parseInt(jQuery(`#variant-select${product}`).find('option:selected').data('availability'))
            let save = jQuery(`#variant-select${product}`).find('option:selected').data('savePrice');
            let variant = jQuery(`#variant-select${product}`).find('option:selected').val();
            if(actual_price == selling_price){
                jQuery(`#strikeupdate${product}`).hide();
                jQuery(`#saveupdate${product}`).hide();
                jQuery(`#save${product}, #rupee${product}`).hide();
                jQuery(`#sellingupdate${product}`).text(selling_price);
                
            }
            else{
                jQuery(`#strikeupdate${product}`).show();
                jQuery(`#saveupdate${product}`).show();
                jQuery(`#save${product}, #rupee${product}`).show();
                jQuery(`#strikeupdate${product}`).text(actual_price);
                jQuery(`#sellingupdate${product}`).text(selling_price);
                jQuery(`#saveupdate${product}`).text(save);

            }
            var stock_text = (availablity_status) ? "in Stock" : "out of Stock"
            var stock_calss = (availablity_status) ? "in-stock" : "out-stock"
            var stock_calss_btn = (availablity_status) ? "in-stock-btn" : "out-stock-btn"
            jQuery(`#stock${product}`).text(stock_text)
            jQuery(`#stock${product}`).attr("class", stock_calss)
            jQuery(`#log-btn${product}`).attr("class", stock_calss_btn)
            jQuery(`#stock-btn${product}`).attr("class", stock_calss_btn)
            //onload
            jQuery(".in-stock").css({background: "#202433"})
            jQuery(".out-stock").css({background: "#ab0010"})
            jQuery(".in-stock-btn").fadeIn(500)
            jQuery(".out-stock-btn").fadeOut(500)
            const url = `{{ url('user/shipping-summary')}}?product=${product}&variant=${variant}`;

            jQuery("#buy-now").attr('href', url);
        }
        function changeMoreVariant(product){
            let actual_price = jQuery(`#variant-select${product}`).find('option:selected').data('actualPrice')
            let selling_price = jQuery(`#variant-select${product}`).find('option:selected').data('sellingPrice')
            let availablity_status = parseInt(jQuery(`#variant-select${product}`).find('option:selected').data('availability'))
            if(actual_price == selling_price){
                jQuery(`#actualupdate${product}`).hide();
                jQuery(`#rupee${product}`).hide();
                jQuery(`#sellingupdate${product}`).text(selling_price);
            }
            else{
                jQuery(`#rupee${product}`).show();
                jQuery(`#actualupdate${product}`).show();
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
            //onload
            jQuery(".in-stock").css({background: "#202433"})
            jQuery(".out-stock").css({background: "#ab0010"})
            jQuery(".in-stock-btn").fadeIn(500)
            jQuery(".out-stock-btn").fadeOut(500)
        }

        //onload
        jQuery(".in-stock").css({background: "#202433"})
        jQuery(".out-stock").css({background: "#ab0010"})
        jQuery(".in-stock-btn").show()
        jQuery(".out-stock-btn").hide()
    </script>
@endsection