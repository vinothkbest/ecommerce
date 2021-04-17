@extends('website.templates.main')
@section('contents')
<section class="other-banner">
    @include('website.templates.nav-bar')
    <div class="in-ban-oth">
        <h4>Wish list</h4>
        <ul class="d-flex justify-content-end mt-4" style="text-transform: capitalize;">
            <li class="pr-1">
                <a href="{{ url('/') }}">Home
                </a>
                /
            </li>
            <li>
                <span>Wish lists
                </span>
            </li>
        </ul>
    </div>
</section>
<section class="mt-4">
    <div class="container95">
        <div class="col-12 p-0">
        @foreach($wisliststs->chunk(3) as $wislistst_chunks)
            <div class="row">
            @foreach($wislistst_chunks as $wislistst)
                <div class="wish-list-page col-6 col-md-4">
                    <a href="detail-page.php" class="prod-box">
                        <div class="prod-img">
                            <div class="top-prod">
                                @php
                                $offer = intval(($wislistst->variant->discount_price ?? '')/($wislistst->variant->actual_price ?? '') *100); 
                                @endphp
                                @if($offer != 0)
                                    <p>{{$offer}}% off</p>
                                @endif
                            </div>
                            <div class="img-prod-bx">
                                <img class="m-auto d-block p-3 w-100" src="{{ $wislistst->product->productCoverImage->path ?? '' }}" alt="">
                            </div>
                            <div class="car-wish-vw">
                                <button style="padding: 6px 11px 3px;"><i class="fas fa-times"></i></button>
                                <button style="padding: 4px 10px 7px;"><img src="{{ asset('web/img/cart.png') }}" alt=""></button>
                                <button style="padding: 4px 8px 7px"><img style="width:21px" src="{{ asset('web/img/details.png') }}" alt=""></button>
                            </div>
                        </div>
                        <div class="prod-cont">
                            <h4>{{ $wislistst->product->product_name ?? '' }}</h4>
                        </div>
                        <div class="prod-btm">
                            <h5>
                                <span>₹</span>{{ $wislistst->variant->actual_price ?? '' }}</h5>
                            <p>In Stock</p>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
        @endforeach
        </div>
    </div>
</section>
@endsection


{{-- <form action="{{ route('user.cart.add') }}" id="" method="post">
    @csrf
    <input type="hidden" name="product_id" value="{{ $wislistst->product->id ?? '' }}">
    <input type="hidden" name="type" value="new-item">
    <div class="btm-prod">
        <select name="variant_id" id="variant-select{{ $wislistst->id }}" onChange="changeVariant({{ $wislistst->id }})">
                <option value="{{$wislistst->variant->id }}"
                        data-actual-price="{{ $wislistst->variant->actual_price }}"
                        data-selling-price="{{ $wislistst->variant->selling_price }}"
                        data-availability="{{ $wislistst->variant->availablity_status }}">{{ $wislistst->variant->variant_name . ' ' . $wislistst->variant->unit->unit_name }}</option>
        </select>
        @auth
        <button type="submit"
                id="stock-btn{{ $wislistst->id }}"
                class="{{ ($wislistst->product->singleVariant->availablity_status)? 'in-stock-btn' : 'out-stock-btn'}}">
                        <img width="26" src="{{ asset('web/img/cart.png') }}" alt="">
        </button>
        @endauth
    </div>
</form> --}}