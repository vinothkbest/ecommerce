@extends('website.templates.main')
@section('contents')
<section class="other-banner">
    @include('website.templates.nav-bar')
    <div class="in-ban-oth">
        <h4>Contact US</h4>
        <ul class="d-flex justify-content-end mt-4" style="text-transform: capitalize;">
            <li class="pr-1">
                <a href="{{ url('/') }}">Home
                </a>
                /
            </li>
            <li>
                <span>Contact US
                </span>
            </li>
        </ul>
    </div>
</section>
<section class="tl-cont">
    <div class="col-md-12 mt-2">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7776.210006897626!2d80.13022212165093!3d12.965132268795541!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a525fb62f40e5bf%3A0x1fda2c0fc972648b!2sNagalkeni%2C%20Chromepet%2C%20Chennai%2C%20Tamil%20Nadu!5e0!3m2!1sen!2sin!4v1605942288392!5m2!1sen!2sin"
            width="100%"
            height="450"
            frameborder="0"
            style="border:0;"
            allowfullscreen=""
            aria-hidden="false"
            tabindex="0"></iframe>
    </div>
</section>
<section class="sup-port">
    <div class="row">
        <div class="col-md-6">
            <div class="loc-cont">
                <h4 class="tit-h3-cont">Phone</h4>
                <p class="cont-add">
                    <i class="fas fa-phone-alt"></i>
                    <a href="tel:+919003777933">+91 90037 77933</a><br>
                    <a href="tel:+919345381289">+91 93453 81289</a>
                </p>
            </div>
            <div class="loc-cont">
                <h4 class="tit-h3-cont">Email</h4>
                <p class="cont-add">
                    <i class="fas fa-envelope-open-text"></i>
                   <span class="mt-1">hidelineshoes@gmail.com</span>
                </p>
            </div>
            <div class="loc-cont">
                <h4 class="tit-h3-cont">LOCATION</h4>
                <p class="cont-add">
                    <i class="fas fa-envelope-open-text"></i>
                    Hideland Shoes,<br/>#82(Old.No. 114/2),
                    <br/>
                    Anna Salai, Nagalkeni,
                    <br/>
                    Chrompet, Chennai -600 044,
                    <br/>Tamilnadu,India
                </p>
    </div>
</div>
<div class="col-md-6">
    <form class="cnt-form">
        <h4 class="title-h2-cart mb-0 mt-3">Get in Touch</h4>
        <div class="row">
            <div class="col-md-6 pl-0">
                <div class="input-group">
                    <span class="icon">
                        <i class="far fa-user"></i>
                    </span>
                    <input type="text" class="contact-enq" placeholder="Name">
                </div>
            </div>
            <div class="col-md-6 pl-0">
                <div class="input-group">
                    <span class="icon">
                        <i class="far fa-envelope-open"></i>
                    </span>
                    <input type="text" class="contact-enq" placeholder="Email">
                </div>
            </div>
            <div class="col-md-6 pl-0">
                <div class="input-group">
                    <span class="icon">
                        <i class="fas fa-mobile-alt"></i>
                    </span>
                    <input type="number" class="contact-enq" placeholder="Mobile Number">
                </div>
            </div>
            <div class="col-md-6 pl-0">
                <div class="input-group">
                    <span class="icon">
                        <i class="fab fa-buffer"></i>
                    </span>
                    <select class="contact-enq">
                        <option>Select Category</option>
                        <option value="bridal jewellery">
                            Casuals</option>
                        <option value="Fashion jewellery">
                            Formals</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12 pl-0">
                <div class="input-group textarea">
                    <span class="icon">
                        <i class="fas fa-pencil-alt"></i>
                    </span>
                    <textarea class="contact-enq" placeholder="Enter Messages" rows="7"></textarea>
                </div>
            </div>
            <div class="col-md-12 pl-0">
                <button class="vw-mr" type="submit">Submit</button>
            </div>
        </div>
    </form>
</div>
</div>
</section>
@endsection