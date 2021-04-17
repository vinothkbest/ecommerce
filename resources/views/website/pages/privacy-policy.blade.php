@extends('website.templates.main')
@section('contents')
<section class="other-banner">
    @include('website.templates.nav-bar')
    <div class="in-ban-oth">
        <h4>Privacy Policy</h4>
        <ul class="d-flex justify-content-end mt-4" style="text-transform: capitalize;">
            <li class="pr-1">
                <a href="{{ url('/') }}">Home
                </a>
                /
            </li>
            <li>
                <span>Privacy Policy
                </span>
            </li>
        </ul>
    </div>
</section>
<section>
    <div class="container90  mt-3">
        <h4 class="tit-h3-cont1">Policy</h4>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>
            All personal information that you have registered at KAPA FOODS INDIA will be
            protected and will not be shared externally. We take your privacy seriously and
            rest assured do not want your personal information to be shared publicly.
        </p>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>
            The necessary information to complete your order is only shared with the
            associated courier partners that will be delivering your ordered items</p>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>
            KAPA FOODS INDIA does not store your credit / debit card or online bank account
            information. We do not handle the payment gateway data or store it as it is
            entered by you directly and is 100% secure.
        </p>
        <h4 class="tit-h3-cont1">Links</h4>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>
            You may find links which may lead to external websites. We hold no
            responsibility or control over the terms of use of the external website.</p>
        <p class="cont-add text-justify mb-3">
            <i class="fas fa-fan"></i>Therefore, we expect our users to be aware of the
            privacy policies of each respective website which they enter into from our
            website as our privacy policy applies only to the content and service provided
            on our platform.
        </p>
    </div>
</section>
@endsection