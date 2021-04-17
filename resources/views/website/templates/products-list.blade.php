@foreach($products as $key => $product)
    <div class="col-6 col-md-4 list-prod-page p-1">
        <div class="prod-box">
            <div class="prod-img">
                <div class="top-prod d-flex">
                    <p id="stock{{ $product->id }}" class="{{ ($product->singleVariant->availablity_status)? 'in-stock' : 'out-stock'}}">{{ ($product->singleVariant->availablity_status)? "in Stock" : "out of Stock"}}
                    </p>
                </div>
                <a href="{{ route('product.detail', [$product->slug]) }}">
                    <img class=" p-3 w-100" src="{{ $product->productCoverImage->path ?? ''}}" alt="">
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

<div class="pagination mt-3 mb-3 w-100 d-flex justify-content-end pr-2">
    {{ $products->links() }}          
</div>

<script>
   jQuery(".in-stock").css({background: "#202433"})
   jQuery(".out-stock").css({background: "#ab0010"})
   jQuery(".in-stock-btn").show()
   jQuery(".out-stock-btn").hide()
</script>
