@extends('website.templates.main')
@section('contents')
<section class="other-banner">
    @include('website.templates.nav-bar')
    <div class="in-ban-oth">
        <h4>About Us</h4>
        <ul class="d-flex justify-content-end mt-4" style="text-transform: capitalize;">
            <li class="pr-1">
                <a href="{{ url('/') }}">Home
                </a>
                /
            </li>
            <li>
                <span>About Us
                </span>
            </li>
        </ul>
    </div>
</section>
<section class="wl-ab">
    <div class="container90">
        <div class="lft-abt-con">
            <h3 class="tit-h3 text-center">Welcome to Kapa</h3>
            <p>The team at
                <span>KAPA FOODS INDIA</span>
                is solely focused on bringing food which is real and from nature available to
                everyone. We have taken up this rather ambitious project of moving every Indian
                household to the real food from nature which our ancestors consumed for
                thousands of years.
            </p>
        </div>
        <div class="row">
            <div class="col-lg-6 rt-abt-img">
                <img src="img/about.png" alt="">
            </div>
            <div class="col-lg-6">
                <div class="icon-block">
                    <div class="icon-one">
                        <span class="fas fa-cog"></span>
                    </div>
                    <p>With health food shops being the preferred destination to satisfy your unique
                        gesture of gifting your family with good health,
                        <span>KAPA FOODS INDIA</span>
                        has always been keen to provide its customers with an exceptional variety of its
                        irresistible, nutritious and healthy choice of fresh health food gift products.</p>
                </div>
                <div class="icon-block">
                    <div class="icon-one">
                        <span class="fas fa-clock"></span>
                    </div>
                    <p>With many generations of experience in business, we strive to continuously
                        raise our benchmark by providing products of the highest quality and taste. In
                        order to cater to our internet shoppers, we have started this e-commerce portal,
                        through which customers can buy all their favourite products and get it
                        delivered to their home.
                    </p>
                </div>
                <div class="icon-block">
                    <div class="icon-one">
                        <span class="fab fa-centos"></span>
                    </div>
                    <p>
                        <span>KAPA FOODS INDIA</span>
                        has been started with an aim of eliminating unhealthy snacks from our diet and
                        replacing them with Healthy and also delicious Dried fruits and Nuts. We believe
                        that sourcing and using local products will reduce the impact on our planet and
                        is a more sustainable way of life. Let's together movetowards a Happier
                        Healthier future starting today!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection