<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="KapaFoods">
        <meta name="author" content="NinosITSolution">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('web/img/logo.png')}}">
        <link rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('web/css/owl.carousel.min.css') }}"> 
        <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('web/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('web/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('web/css/animate.css') }}">

        <title>Kapa Foods</title>

    </head>
    <body>
    {{-- Start Content --}}
        @yield('contents')
    {{-- End Content --}}

    {{-- Start Footer --}}
    <footer class="mt-4">
        <div class="container90">
            <div class="row">
                <div class="col-6 col-md-4 col-lg">
                    <h4 class="quic-loc">Quick Link</h4>
                    <ul class="qck-lnk-btm">
                        <li>
                            <a href="{{ url('/') }}">
                                <i class="fas fa-chevron-right"></i>Home</a>
                        </li>
                        <li>
                            <a href="{{ url('about') }}">
                                <i class="fas fa-chevron-right"></i>About Us</a>
                        </li>
                        <li>
                            <a href="{{ route('product.list', [$menus[0]->slug ?? '']) }}">
                                <i class="fas fa-chevron-right"></i>Categories</a>
                        </li>
                        <li>
                            <a href="{{ url('contact') }}">
                                <i class="fas fa-chevron-right"></i>Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col-6 col-md-4 col-lg">
                    <h4 class="quic-loc">My Account</h4>
                    <ul class="qck-lnk-btm">
                        @auth
                            <li>
                                <a href="{{ route('user.profile') }}">
                                    <i class="fas fa-chevron-right"></i>Account</a>
                            </li>
                            <li>
                                <a href="{{ route('user.cart.itmes') }}">
                                    <i class="fas fa-chevron-right"></i>My Cart</a>
                            </li>
                            <li>
                                <a href="order-history.php">
                                    <i class="fas fa-chevron-right"></i>Order History</a>
                            </li>
                            <li>
                                <a href="{{ route('user.shipping.detail') }}">
                                    <i class="fas fa-chevron-right"></i>Shipping Details</a>
                            </li>
                        @endauth
                        @guest
                            <li>
                                <a href="{{ route('user.form', ['login']) }}">
                                    <i class="fas fa-chevron-right"></i>Account</a>
                            </li>
                        @endguest
                    </ul>
                </div>
                <div class="col-6 col-md-4 col-lg">
                    <h4 class="quic-loc">Policy & Terms</h4>
                    <ul class="qck-lnk-btm">
                        <li>
                            <a href="{{ url('cancellation-policy') }}">
                                <i class="fas fa-chevron-right"></i>Refund Policy</a>
                        </li>
                        <li>
                            <a href="{{ url('privacy-policy') }}">
                                <i class="fas fa-chevron-right"></i>Privacy Policy</a>
                        </li>
                        <li>
                            <a href="{{ url('shipping-policy') }}">
                                <i class="fas fa-chevron-right"></i>Shipping Policy</a>
                        </li>
                        <li>
                            <a href="{{ url('terms-conditions') }}">
                                <i class="fas fa-chevron-right"></i>Terms & Conditions</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-6 col-lg">
                    <div class="logo-add">
                        <img src="{{ asset('web/img/logo.png') }}" alt="" />
                        <p>© {{ date('Y') }} All Rights Reserved by kapafoods. Design by
                            <span>Ninos It Solution</span>
                        </p>
                        <li class="fb-twr">
                            <a href="#">
                                <img src="{{ asset('web/img/fb.png') }}" alt="" /></a>
                        </li>
                        <li class="fb-twr">
                            <a href="#">
                                <img src="{{ asset('web/img/twr.png') }}" alt="" /></a>
                        </li>
                        <li class="insta">
                            <a href="#">
                                <img src="{{ asset('web/img/insta.png') }}" alt="" /></a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </footer>
{{-- End Footer --}}

<script src="{{ asset('web/js/jquery.js') }}"></script>
<script src="{{ asset('web/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('web/js/owl.carousel.min.js') }}"></script>
<script>
    $('.owl-them').owlCarousel({
        loop: false,
        margin: 8,
        nav: false,
        autoplay: false,
        autoplayTimeout: 6000,
        responsive: {
            0: {
                items: 1
            },
            410: {
                items: 2
            },
            678: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    });
</script>
<script>
    $(document).ready(function() {
        $(".ser-btn").click(function() {
            $(".ser-box").addClass("show-ser");
        });
    });


    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
  }
  var $subMenu = $(this).next('.dropdown-menu');
  $subMenu.toggleClass('show');


  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass('show');
  });
  
  return false;
});
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@if(session('error'))

    <script>
        Swal.fire({
          title: "{{session('error')}}",
          icon: 'error',
        })
    </script>
@endif
@if(session('success'))

    <script>
        Swal.fire({
          title: "{{session('success')}}",
          icon: 'success',
        })
    </script>
@endif
@yield("after_js")
</body>
</html>