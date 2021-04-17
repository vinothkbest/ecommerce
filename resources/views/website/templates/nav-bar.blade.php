<header>
    <section class="top-head">
        <div class="container95">
            <div class="rt-top ">
                <div class="top-search">
                    <form action="{{ route('search') }}" method="get">
                        <div class="ser-box">
                            <input class="aut-src" placeholder="search your product"
                                   type="text"
                                   name="q"
                                   value="{{ isset($_GET['q'])? $_GET['q'] : '' }}"
                                   onInput="jQuery('.search-btn').attr('type', 'submit')">
                        </div>
                        <button class="ser-btn search-btn" type="button">
                            <img src="{{ asset('web/img/search.png') }}" alt="" />
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="menu-nav" id="navbar_top">
        <a class="navbar-brand logo" href="{{ url('/') }}">
            <img src="{{ asset('web/img/logo.png') }}" alt=""></a>
        <nav class="navbar navbar-expand-md tl-menu">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon">
                    <img src="{{ asset('web/img/nav-bar.png') }}" alt=""></span>
            </button>
            <div class="collapse navbar-collapse min-sc-menu" id="collapsibleNavbar">
                <ul class="navbar-nav nav-ul left-menu-bar" style="text-transform: capitalize;">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Categories
                        </a>
                        <ul class="dropdown-menu dropright" aria-labelledby="navbarDropdownMenuLink">
                            @foreach($menus as $menu)
                                @if(count($menu->subCategory) != 0)
                                    <li class="dropdown-submenu dropright">
                                        <a class="dropdown-item dropdown-toggle" href="{{ route('product.list', [$menu->slug]) }}">{{ $menu->category_name }}</a>
                                        <ul class="dropdown-menu animate__fadeInUp anim-delay">
                                            @foreach($menu->subCategory as $sub_category)
                                                @if(count($sub_category->subCategory) != 0)
                                                    <li class="dropdown-submenu">
                                                    <a class="dropdown-item dropdown-toggle" href="{{ route('product.list', [$sub_category->slug]) }}">{{ $sub_category->category_name }}</a>
                                                    <ul class="dropdown-menu animate__fadeInUp anim-delay">
                                                        @foreach($sub_category->subCategory as $last_category)    
                                                            <li><a class="dropdown-item" href="{{ route('product.list', [$last_category->slug]) }}">{{ $last_category->category_name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                    </li>
                                                @else
                                                    <li><a class="dropdown-item" href="{{ route('product.list', [$sub_category->slug]) }}">{{ $sub_category->category_name }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('product.list', [$menu->slug]) }}">{{ $menu->category_name }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav nav-ul min-hid ml-auto" style="text-transform: capitalize;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset('web/img/login.png') }}" />
                            <span>My Account</span>
                        </a>
                        <div class="dropdown-menu animate__fadeInUp anim-delay" aria-labelledby="dropdownMenuLink">
                            @auth('web')
                                <a class="dropdown-item"
                                    href="{{ route('user.profile') }}">Profile</a>
                                <a class="dropdown-item"
                                    href="{{ url("user/my-order") }}">My Orders</a>
                                <a class="dropdown-item"
                                    href="">Order History</a>
                                <a class="dropdown-item"
                                    href="{{ route('user.logout') }}">Logout</a>
                            @endauth
                            @guest
                                <a class="dropdown-item"
                                    href="{{ route('user.form', ['login']) }}"
                                    id="user-login">Login</a>
                                <a class="dropdown-item"
                                    href="{{ route('user.form', ['register']) }}"
                                    id="user-register">Register</a>
                            @endguest
                        </div>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.cart.itmes') }}">
                            <img src="{{ asset('web/img/cart.png') }}" />
                            <sup class="rounded-circle bg-warning" style="font-size: 15px">{{ $total_itmes }}</sup>
                        </a>
                    </li>
                    @endauth
                </ul>
        </nav>
    </section>
</header>