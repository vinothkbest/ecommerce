@extends('website.templates.main')
@section('contents')
<section class="other-banner">
    @include('website.templates.nav-bar')
    <div class="in-ban-oth">
        <h4>Cancellation & Refund Policy</h4>
        <ul class="d-flex justify-content-end mt-4" style="text-transform: capitalize;">
            <li class="pr-1">
                <a href="{{ url('/') }}">Home
                </a>
                /
            </li>
            <li>
                <span>Cancellation & Refund
                </span>
            </li>
        </ul>
    </div>
</section>
<section>
    <div class="container90  mt-3">
        <h4 class="tit-h3-cont1">Cancellation Policy
        </h4>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>For Cancellations please contact us via contact us link.</p>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>Any request for cancellation to be made within 2 hours
            from the time of order confirmation.</p>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>Once the order is cancelled, we will initiate the
            refund within the next 24 hours.</p>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>Once dispatched the order cannot be cancelled.</p>
        <h4 class="tit-h3-cont1">What are the available refund options?
        </h4>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>If KAPA FOODS INDIA is unable to deliver your order,
            then complete refund will be made. We shall not be liable for any other charges,
            loss of profits, emotional stress or any other liability, etc caused due to
            non-delivery.</p>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>We do not take responsibility, if the delivery is
            delayed or not delivered by the vendors because of the bad weather or any other
            unexpected circumstances. If the order is not delivered, we refund 100% of your
            money.
        </p>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>If the mode of refund is by Credit/Debit Card or Net
            Banking, the refunds will be issued to the original mode of payment used at the
            time of purchase, please allow 12 to 18 working days for the credit to appear in
            your account, it is the bank's policy that delays the refund timing and we have
            no control over this.
        </p>
    </div>
</section>
@endsection