@extends('website.templates.main')
@section('contents')
    <section class="other-banner">
        @include('website.templates.nav-bar')
        <div class="in-ban-oth">
            <h4>Shipping Details</h4>
            <ul class="d-flex justify-content-end mt-4" style="text-transform: capitalize;">
                <li class="pr-1">
                    <a href="{{ '/' }}">Home
                    </a>
                    /
                </li>
                <li>
                    <span>Shipping Details
                    </span>
                </li>
            </ul>
        </div>
    </section>
    <div class="row">
        <section class="col-12 col-sm-6 col-md-8 col-lg-8">
            <div class="profile-page p-0">
                <div class="prof-box col-12 det-enq-form">
                        <div class="row">
                            <div class="col-12 pl-0">
                                <div class="input-group">
                                    <label for="User Name">User Name</label>
                                    <h5>{{ Auth::user()->name ?? '' }}</h5>
                                    
                                </div>
                                <div class="input-group">
                                    <label for="User Name">E-Mail</label>
                                    <h5>{{ Auth::user()->email ?? '' }}</h5>
                                </div>
                                <div class="input-group">
                                    <label for="User Name">Mobile No</label>
                                    <h5>{{ Auth::user()->mobile ?? '' }}</h5>
                                </div>
                                
                            @if($shipping_address)    
                                <h4>Shipping Address</h4>
                                <div class="input-group">
                                    <label for="User Name">Flot/Door. No</label>
                                    <h5>{{ $shipping_address->door_number ?? '' }}</h5>
                                </div>
                                <div class="input-group">
                                    <label for="User Name">Street</label>
                                    <h5>{{ $shipping_address->street ?? '' }}</h5>
                                </div>
                                <div class="input-group">
                                    <label for="User Name">Area</label>
                                    <h5>{{ $shipping_address->area ?? '' }}</h5>
                                </div>
                                <div class="input-group">
                                    <label for="User Name">City</label>
                                    <h5>{{ $shipping_address->city ?? '' }}</h5>
                                </div>
                                <div class="input-group">
                                    <label for="User Name">State</label>
                                    <h5>{{ $shipping_address->state ?? '' }}</h5>
                                </div>
                                <div class="input-group">
                                    <label for="User Name">Country</label>
                                    <h5>{{ $shipping_address->country ?? '' }}</h5>
                                </div>
                            </div>

                            <div class="col-md-12 pl-0">
                                <a href="{{ route('user.profile') }}">
                                    <button class="submit-btn" type="button">Do you change shipping address?</button>
                                </a>
                            </div>
                        @else
                            <a href="{{ route('user.profile') }}">
                                <button class="submit-btn" type="button">Please add address</button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section class="col-12 col-sm-6 col-md-4 col-lg-4">
            <div class=" order-summery">
                <h4>Order Summery</h4>
                <div class="smry-in-bord d-flex justify-content-between">
                    <p>Product Cost (₹)</p>
                    <p>{{ (isset($_GET['variant'])) ? $shipping_summary->actual_price : $shipping_summary->sum("actual_price")}}</p>
                </div>
                <div class="smry-in-bord d-flex justify-content-between">
                    <p>{{ (isset($_GET['variant'])) ? "Product Name" : "Total Items"}}</p>
                    <p>{{ (isset($_GET['variant'])) ? $shipping_summary->product_name : $shipping_summary->sum('items') }}</p>
                </div>
                <div class="smry-in-bord d-flex justify-content-between">
                    <p>Total Discount (₹)</p>
                    <p>{{ (isset($_GET['variant'])) ?  $shipping_summary->discount_price : $shipping_summary->sum('discount_price') }}</p>
                </div>
                <div class="smry-in-bord d-flex justify-content-between">
                    <p>Our Cost (₹)</p>
                    <p>{{ (isset($_GET['variant'])) ? $shipping_summary->selling_price : $shipping_summary->sum('selling_price') }}</p>
                </div>
                <div class="smry-in-bord d-flex justify-content-between">
                    <p>Shipping Charge(₹)</p>
                    <p>Free</p>
                </div>
                <div class="smry-in-bord d-flex justify-content-between">
                    <p>Tax ({{ (isset($_GET['variant'])) ? $shipping_summary->gst_tax : $shipping_summary->sum('gst_tax') }} %)</p>
                    <p>{{ (isset($_GET['variant'])) ? $shipping_summary->amount_after_tax : $shipping_summary->sum('amount_after_tax') }}</p>
                </div>
                <div class="smry-over-all d-flex justify-content-between">
                    <p>Overall Amount (₹)</p>
                    <p>{{ (isset($_GET['variant'])) ? intval($shipping_summary->amount_after_tax) : intval($shipping_summary->sum('amount_after_tax')) }}</p>
                </div>
            </div>
            @if($shipping_address)
                <form action="{{ route('user.order.pay') }}" method="post">
                    @csrf
                    <input type="hidden" name="variant" value="{{ (isset($_GET['variant'])) ? $_GET['variant'] : ''}}">
                    <button class="chck-btn" type="submit">Order Now</button>      
                </form>
            @endif
        </section>
    </div>
@endsection