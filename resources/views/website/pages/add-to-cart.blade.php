@extends('website.templates.main')
@section('contents')
    <section class="other-banner">
        @include('website.templates.nav-bar')
        <div class="in-ban-oth">
            <h4>Add To Cart</h4>
            <ul class="d-flex justify-content-end mt-4" style="text-transform: capitalize;">
                <li class="pr-1">
                    <a href="{{ url('/') }}">Home</a>/
                </li>
                <li><span>Add To Cart</span>
                </li>
            </ul>
        </div>
    </section>
    <section class="mt-4">
        <div class="container95">
            <div class="row row-sparse">
                <div class="cart-table-container">
                    <form action="{{ route('user.cart.add') }}" method="post">
                        @csrf
                        <table class="table table-cart">
                            <thead>
                                <tr>
                                    <th class="product-col text-left">Product</th>
                                    <th class="price-col">Quantity</th>
                                    <th class="price-col">Price</th>
                                    <th class="qty-col">Items</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $key => $cart)
                                    <tr class="product-action-row cart-{{ $cart->id }}">
                                        <td colspan="5">
                                            <div class="float-left">
                                                <h2 class="product-title">
                                                    <a>{{ $cart->product->product_name ?? ''}}</a>
                                                </h2>
                                            </div>
                                            <div class="float-right mt-2">
                                                <a title="Remove product" class="btn-remove icon-cancel"
                                                   onClick="removeCart({{ $cart->id }})">
                                                    <span class="sr-only">Remove</span>
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="product-row cart-{{ $cart->id }}">
                                        <td class="product-col">
                                            <figure class="product-image-container">
                                                <a href="#" class="product-image">
                                                    <img src="{{ $cart->product->productCoverImage->path ?? ''}}" alt="product">
                                                </a>
                                            </figure>
                                        </td>
                                        <td class="rate1">
                                            <input type="hidden" name="cart_ids[{{ $key }}]" value="{{ $cart->id ?? '' }}">
                                            <input type="hidden" name="type" value="update-items">
                                            <select name="variant_ids[{{ $key }}]" id="variant-select{{ $cart->id }}"
                                                    onChange="variantChange({{ $cart->id }})">
                                                    <option value="{{$cart->variant->id }}"
                                                            data-selling-price="{{ $cart->variant->selling_price }}" selected>{{ $cart->variant->variant_name . ' ' . $cart->variant->unit->unit_name }}
                                                    </option>
                                                    @foreach($cart->product->productVariants as $variant)
                                                        @if($variant->id != $cart->variant->id)
                                                            <option value="{{$variant->id }}"
                                                                    data-selling-price="{{ $variant->selling_price }}">{{ $variant->variant_name . ' ' . $variant->unit->unit_name }}</option>
                                                        @endif
                                                    @endforeach
                                            </select>
                                        </td>
                                        <td class="rate1">
                                            ₹<span id="priceupdate{{ $cart->id }}">{{ $cart->variant->selling_price ?? ''}}</span>
                                        </td>
                                        <td class="quan-td">
                                            <div class="quantity">
                                                <a class="quantity_minus" id="quantity_minus{{ $cart->id ?? '' }}" onClick="itemRemove({{ $cart->id }})">
                                                    <span>-</span></a>
                                                <input name="items[{{ $key }}]" type="text" id="quantity_input{{ $cart->id ?? '' }}" class="quantity_input"
                                                    value="{{ $cart->items ?? '' }}">
                                                <a class="quantity_plus" id="quantity_plus{{ $cart->id ?? '' }}" onClick="itemAdd({{ $cart->id }})">
                                                    <span>+</span></a>
                                            </div>
                                        </td>
                                        <td class="rate2">
                                            ₹<span id="subtotalupdate{{ $cart->id }}"
                                                   class="sub-total">
                                                   {{ $cart->variant->selling_price * $cart->items}}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="clearfix mt-4">
                                        <div class="float-left">
                                            <button type="submit"
                                                    class="chk-btn">Chekout</button>
                                        </div>
                                        
                                    </td>
                                    <td class="">
                                        <div class="float-left me-2">
                                            <p>
                                                <b>Number of items<span id="totalitems" class="ml-3">
                                                    
                                                </span></b>
                                            </p>
                                        </div>
                                        <!-- End .float-right -->
                                    </td>
                                    <td class="">
                                        <div class="float-right">
                                            <p>
                                                <b> Total ₹<span id="totalupdate">
                                                    
                                                </span></b>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <style>
        .quantity_minus, .quantity_plus{
            cursor: pointer;
        }
    </style>
@endsection
@section("after_js")
<script>
    function variantChange(cart){
        let selling_price = jQuery(`#variant-select${cart}`).find('option:selected').data('sellingPrice');
        jQuery(`#priceupdate${cart}`).text(selling_price);
        let sub_total = jQuery(`#priceupdate${cart}`).text() * parseInt(jQuery(`#quantity_input${cart}`).val());
        jQuery(`#subtotalupdate${cart}`).text(sub_total);
        total();                                   
    }
    function itemRemove(cart){
        if(parseInt(jQuery(`#quantity_input${cart}`).val())>1){
            jQuery(`#quantity_input${cart}`).val(parseInt(jQuery(`#quantity_input${cart}`).val())-1);
            let sub_total = jQuery(`#priceupdate${cart}`).text() * parseInt(jQuery(`#quantity_input${cart}`).val());
            jQuery(`#subtotalupdate${cart}`).text(sub_total);
        }
        total();
    }
    function itemAdd(cart){
        jQuery(`#quantity_input${cart}`).val(parseInt(jQuery(`#quantity_input${cart}`).val())+1);
        let sub_total = jQuery(`#priceupdate${cart}`).text() * parseInt(jQuery(`#quantity_input${cart}`).val());
        jQuery(`#subtotalupdate${cart}`).text(sub_total);

        total();
    }
    jQuery(document).ready(function(){
        total();
    });
    async function removeCart(cart_id){
        const url = "{{ url('user/cart-items-remove') }}/"+cart_id;
        await fetch(url)
                .then((response) => {return response.json()})
                .then((response) => {
                    if(response.status){
                        Swal.fire({
                          title: response.message,
                          icon: 'success',
                        })
                    }
                });
        
        jQuery(".cart-"+cart_id).remove();
        total();
    }
    function total(){
        var total = [], items = [];
        jQuery(".sub-total").map(function(){
            total.push(parseFloat(this.innerText));
        });
        jQuery(".quantity_input").map(function(){
            items.push(parseInt(this.value));
        });
        total_items = items.reduce(function(first, next){
            return sum =  first+next;
        },0);
        total_selling_price = total.reduce(function(first, next){
            return sum =  first+next;
        },0);

        jQuery(`#totalupdate`).text(total_selling_price);
        jQuery(`#totalitems`).text(total_items);
    }
    
</script>  
@endsection