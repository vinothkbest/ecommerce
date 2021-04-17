@extends('website.templates.main')
@section('contents')
<section class="other-banner">
    @include('website.templates.nav-bar')
    <div class="in-ban-oth">
        <h4>Shipping Policy</h4>
        <ul class="d-flex justify-content-end mt-4" style="text-transform: capitalize;">
            <li class="pr-1">
                <a href="{{ url('/') }}">Home
                </a>
                /
            </li>
            <li>
                <span>Shipping Policy
                </span>
            </li>
        </ul>
    </div>
</section>
<section>
    <div class="container90  mt-3">
        <h4 class="tit-h3-cont1">SHIPPING AND DELIVERY POLICY
        </h4>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>Once we receive your order, it will be processed and
            ready to be shipped as early as possible. However, depending on the delivery
            location your orders can take about 3-8 working days from the date of ordering
            to reach you.
        </p>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>Delivery time is also subjective to delays arising out
            of bad weather conditions, strikes or any other unexpected delay from our
            courier and travel partners.
        </p>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>Your shipping cost are subject to the cost of the
            purchase being made, promotional offers, the destination address and the type of
            shipping being chosen.
        </p>
        <div class="policy">
            <div class="sidebar-wrapper">
                <div class="widget">
                    <h3 class="widget-title">
                        <a
                            data-toggle="collapse"
                            href="#cate"
                            role="button"
                            aria-expanded="true"
                            aria-controls="widget-body-2"
                            class="">What happens if there are no one at delivery address during delivery?
                        </a>
                    </h3>
                    <div class="collapse show" id="cate" style="">
                        <p>If there is no one available at the shipping address (to accept the delivery
                            of your order) at the time of delivery, the order will not be considered late.
                            Hence in such cases, no refunds, cancellations, liability can be made.
                        </p>
                    </div>
                </div>
                <div class="widget">
                    <h3 class="widget-title">
                        <a
                            data-toggle="collapse"
                            href="#siz"
                            role="button"
                            aria-expanded="true"
                            aria-controls="widget-body-4">What is the estimated delivery time?
                        </a>
                    </h3>
                    <div class="collapse" id="siz">
                        <p>The estimated delivery time may differ depending on when and how you buy the
                            product in KAPA FOODS INDIA. Delivery for the metropolitan cities will be 1-4
                            business days. The delivery for other regional areas will be 2 - 5 business
                            days. A business day does not include Saturdays and Sundays.</p>
                    </div>
                </div>
                <div class="widget">
                    <h3 class="widget-title">
                        <a
                            data-toggle="collapse"
                            href="#Prize"
                            role="button"
                            aria-expanded="true"
                            aria-controls="widget-body-4">How will the delivery be done? </a>
                    </h3>
                    <div class="collapse " id="Prize">
                        <div class="lst-ck">
                            <p>We process all deliveries through reputed logistics partners. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection