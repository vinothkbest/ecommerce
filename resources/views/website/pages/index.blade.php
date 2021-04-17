@extends('website.templates.main')
@section('contents')
<section class="banner-carousel">
    @include('website.templates.nav-bar')
    <div
        id="demo"
        class="carousel slide in-ban-car"
        data-ride="carousel"
        data-interval="3000">
        <ul class="carousel-indicators">
        @foreach($sliders as $key => $slider)
            @if($loop->first)
                <li data-target="#demo" data-slide-to="{{ $key }}" class="active"></li>
            @else
                <li data-target="#demo" data-slide-to="{{ $key }}"></li>
            @endif
        @endforeach
        </ul>
        <div class="carousel-inner">
        @foreach($sliders as $slider)
            @if($loop->first)
                <div class="carousel-item carousel-back-img active" style="background-image:url({{ $slider->path ?? ''}})">
                    <div class="carousel-caption d-flex justify-content-around">
                        <div class="lft-ban">
                            <h3>{{ $slider->title ?? '' }}</h3>
                            <a class="vw-coll" href="{{ url('category/'.$slider->category->slug ?? '') }}">{{ $slider->highligted_text ?? '' }}</a>
                            <p>{{ $slider->category->category_name ?? '' }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="carousel-item carousel-back-img" style="background-image:url({{ $slider->path ?? ''}})">
                    <div class="carousel-caption d-flex justify-content-around">
                        <div class="lft-ban">
                            <h3>{{ $slider->title ?? '' }}</h3>
                            <a class="vw-coll" href="{{ url('category/'.$slider->category->slug ?? '') }}">{{ $slider->highligted_text?? '' }}</a>
                            <p>{{ $slider->category->category_name ?? '' }}</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        </div>
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="fas fa-chevron-left"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="fas fa-chevron-right"></span>
        </a>
    </div>
</section>
<section>
    <div class="container95">
        <div class="tit-prod">
            <h3 class="tit-h3">Our Products</h3>
        </div>
        <div
            id="product"
            class="carousel slide in-ban-car"
            data-ride="carousel"
            data-interval="3000">
            <div class="carousel-inner">
            @foreach($products->chunk(10) as $product_10_chunks)
            @if($loop->first)
                <div class="carousel-item active">
                @foreach($product_10_chunks->chunk(5) as $product_5_chunks)
                    <div class="row">
                    @foreach($product_5_chunks as $product)
                        <div class="col-6 col-sm-4 col-md-3 list-prod-ind p-1">
                            <div class="prod-box">
                                <div class="prod-img">
                                    <div class="top-prod d-flex">
                                        <p id="stock{{ $product->id }}" class="{{ ($product->singleVariant->availablity_status)? 'in-stock' : 'out-stock'}}">{{ ($product->singleVariant->availablity_status)? "in Stock" : "out of Stock"}}
                                        </p>
                                    </div>
                                    <a href="{{ route('product.detail', [$product->slug]) }}">
                                        <img class="m-auto d-block p-3 w-100" src="{{ $product->productCoverImage->path ?? ''}}" alt="Product Cover">
                                        <img class="det-icon" src="{{ asset('web/img/details.png') }}" alt="">
                                    </a>
                                </div>
                                <div class="prod-cont">
                                    <h4>{{ $product->product_name ?? '' }}</h4>
                                    <h5><span id="rupee{{$product->id}}"><strike style="color:#ab0010">₹</strike></span><strike class="mr-2" id="actualupdate{{ $product->id }}">{{ $product->singleVariant->actual_price ?? '' }}</strike>
                                    <span>₹</span><span id="sellingupdate{{ $product->id }}">{{ $product->singleVariant->selling_price ?? '' }}</span></h5>
                                </div>
                                <form action="{{ route('user.cart.add') }}" id="" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                                    <input type="hidden" name="type" value="new-item">
                                    <div class="btm-prod">
                                        <select name="variant_id" id="variant-select{{ $product->id }}" onChange="changeVariant({{ $product->id }})">
                                            @foreach($product->productVariants as $variant)
                                                <option value="{{$variant->id }}"
                                                        data-actual-price="{{ $variant->actual_price }}"
                                                        data-selling-price="{{ $variant->selling_price }}"
                                                        data-availability="{{ $variant->availablity_status }}">{{ $variant->variant_name . ' ' . $variant->unit->unit_name }}</option>
                                            @endforeach
                                        </select>
                                    @guest
                                        <a href="{{ route('user.form', ['login']) }}">
                                            <button type="button"
                                                    id="log-btn{{ $product->id }}"
                                                    class="{{ ($product->singleVariant->availablity_status)? 'in-stock-btn' : 'out-stock-btn'}}">
                                                            <img width="26" src="{{ asset('web/img/cart.png') }}" alt="">
                                            </button>
                                        </a>
                                    @endguest
                                    @auth
                                        <button type="submit"
                                                id="stock-btn{{ $product->id }}"
                                                class="{{ ($product->singleVariant->availablity_status)? 'in-stock-btn' : 'out-stock-btn'}}">
                                                        <img width="26" src="{{ asset('web/img/cart.png') }}" alt="">
                                        </button>
                                    @endauth
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @endforeach
                </div>
            @else
                <div class="carousel-item active">
                @foreach($product_20_chunks->chunk(5) as $product_5_chunks)
                    <div class="row">
                    @foreach($product_5_chunks as $product)
                        <div class="col-6 col-sm-4 col-md-3 list-prod-ind p-1">
                            <div class="prod-box">
                                <div class="prod-img">
                                    <div class="top-prod d-flex">
                                        <p id="stock{{ $product->id }}" class="{{ ($product->singleVariant->availablity_status)? 'in-stock' : 'out-stock'}}">{{ ($product->singleVariant->availablity_status)? "in Stock" : "out of Stock"}}</p>
                                    </div>
                                    <a href="">
                                        <img class="m-auto d-block p-3 w-100" src="{{ $product->productCoverImage->path ?? ''}}" alt="Product Cover">
                                        <img class="det-icon" src="{{ asset('web/img/details.png') }}" alt="">
                                    </a>
                                </div>
                                <div class="prod-cont">
                                    <h4>{{ $product->product_name ?? '' }}</h4>
                                    <h5><span id="rupee{{$product->id}}"><strike style="color:#ab0010">₹</strike></span><strike class="mr-2" id="actualupdate{{ $product->id }}">{{ $product->singleVariant->actual_price ?? '' }}</strike>
                                    <span>₹</span><span id="sellingupdate{{ $product->id }}">{{ $product->singleVariant->selling_price ?? '' }}</span></h5>
                                </div>
                                <form action="{{ route('user.cart.add') }}" id="" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                                    <input type="hidden" name="type" value="new-item">
                                    <div class="btm-prod">
                                        <select name="variant_id" id="variant-select{{ $product->id }}" onChange="changeVariant({{ $product->id }})">
                                            @foreach($product->productVariants as $variant)
                                                <option value="{{$variant->id}}"
                                                    data-actual-price="{{ $variant->actual_price }}"
                                                    data-selling-price="{{ $variant->selling_price }}"
                                                    data-availability="{{ $variant->availablity_status }}">{{ $variant->variant_name . ' ' . $variant->unit->unit_name }}</option>
                                            @endforeach
                                        </select>
                                    @guest
                                        <a href="{{ route('user.form', ['login']) }}">
                                            <button type="button"
                                                    id="log-btn{{ $product->id }}"
                                                    class="{{ ($product->singleVariant->availablity_status)? 'in-stock-btn' : 'out-stock-btn'}}">
                                                            <img width="26" src="{{ asset('web/img/cart.png') }}" alt="">
                                            </button>
                                        </a>
                                    @endguest
                                    @auth
                                        <button type="submit"
                                                id="stock-btn{{ $product->id }}"
                                                class="{{ ($product->singleVariant->availablity_status)? 'in-stock-btn' : 'out-stock-btn'}}">
                                                        <img width="26" src="{{ asset('web/img/cart.png') }}" alt="">
                                        </button>
                                    @endauth
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @endforeach
                </div>
            @endif    
            @endforeach 
            </div>
            @if(count($products) > 10)
                <div class="prod-arow-vw">
                    <div class="vw-pdt d-inline-block">
                        <a href="#">more product</a>
                    </div>
                    <div class="prod-arow">
                        <a class="carousel-control-prev" href="#product" data-slide="prev">
                            <span class="fas fa-chevron-left"></span>
                        </a>
                        <a class="carousel-control-next" href="#product" data-slide="next">
                            <span class="fas fa-chevron-right"></span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
</section>
<section class="mt-3 mb-3">
@foreach($menus->chunk(3) as $menu_chunk)
<div class="row mt-3">
    @foreach($menu_chunk as $category)
        <div class="col-12 col-md-4 p-2">
            <div class="prod-cat-ind">
                <img src="{{ ($category->image) ? $category->image_path :  asset('web/img/ad1.jpg') }}" width="100%" alt=""/>
                <div class="prod-vw-ind">
                    <a href="{{ url($category->slug) }}">
                        <h3>{{ $category->category_name }}</h3>
                        <p>View Products</p></a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endforeach
</section>
<section class="viz-img pt-3 pb-3">
<div class="container90">
    <div class="row">
        <div class="col-md-6 hidden-xs ">
            <img class="bc-viz" src="{{ asset('web/img/bac1.jpg') }}" width="80%" alt=""/>
        </div>
        <div class="col-md-6 tl-rit-viz">
            <div class="rit-viz1">
                <div class="rit-viz">
                    <div class="icon-viz">
                        <h4>Online Booking</h4>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint nostrum
                            ratione dolorem. Eligendi possimus dicta magnam maxime consectetur, blanditiis
                            vero.</p>
                    </div>
                </div>
                <div class="rit-viz">
                    <div class="icon-viz">
                        <h4>Cash On Delivery</h4>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint nostrum
                            ratione dolorem. Eligendi possimus dicta magnam maxime consectetur, blanditiis
                            vero.</p>
                    </div>
                </div>
                <div class="rit-viz">
                    <div class="icon-viz">
                        <h4>Customer Support</h4>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint nostrum
                            ratione dolorem. Eligendi possimus dicta magnam maxime consectetur, blanditiis
                            vero.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
@section("after_js")
    <script>
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
            //onchange
            jQuery(".in-stock").css({background: "#202433"})
            jQuery(".out-stock").css({background: "#ab0010"})
            jQuery(".in-stock-btn").fadeIn(500)
            jQuery(".out-stock-btn").fadeOut(500)


        }
        //onload
        jQuery(".in-stock").css({background: "#202433"})
        jQuery(".out-stock").css({background: "#ab0010"})
        jQuery(".in-stock-btn").fadeIn(500)
        jQuery(".out-stock-btn").fadeOut(500)


    </script>
@endsection