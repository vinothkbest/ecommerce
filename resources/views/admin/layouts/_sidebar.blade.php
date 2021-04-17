<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header bg-white-5">
        <!-- Logo -->
        <a class="font-w600 text-dual" href="{{ route('admin.dashboard') }}">
            <span class="smini-visible">
                <img src="{{ asset('assets/logo.png') }}" alt="Header Avatar" style="width: 25px;">
            </span>
            <span class="smini-hide font-size-h5 tracking-wider">
                Kapa Foods
            </span>
            <br><small
                class="smini-hide tracking-wider text-sm font-w500">{{ auth()->user()->roles->implode('name') }}</small>
        </a>
        <!-- END Logo -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div id="scroll-bar-id" class="js-sidebar-scroll">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                @php
                $menus=[
                ["icon"=>"fas
                fa-tachometer-alt","route"=>'dashboard',"name"=>"Dashboard"],
                ["title"=>"USER MANAGEMENT","permissions"=>["role-list","admin-list","vendor-list","user-list"],
                "icon"=>"fas fa-user-tag","route"=>'roles',"name"=>"Roles"],
                ["icon"=>"fas fa-user-tie","route"=>'admins',"name"=>"Admins"],
                ["icon"=>"fas fa-users","route"=>'users',"name"=>"Users"],

                ["title"=>"PRODUCT MANAGEMENT","permissions"=>[
                "category-list",
                "brand-list",
                "product-list",
                "order-list",
                "cancelorder-list",
                "cart-list",
                ],
                "icon"=>"far fa-list-alt","route"=>'categories',"name"=>"Categories","permission"=>"category-list"],
                ["icon"=>"fab fa-nutritionix","route"=>'brands',"name"=>"Brands","permission"=>"brand-list"],
                ["icon"=>"fa fa-balance-scale","route"=>'units',"name"=>"Units","permission"=>"unit-list"],
                ["icon"=>"fas fa-list-alt","route"=>'products',"name"=>"Products","permission"=>"product-list"],
                ["icon"=>"fas fa-shopping-basket","route"=>'carts',"name"=>"Cart","permission"=>"cart-list"],
                ["icon"=>"fas fa-cart-arrow-down","route"=>'orders',"name"=>"Orders","permission"=>"order-list"],
                ["icon"=>"fas fa-ban","route"=>'cancelorders',"name"=>"Cancel
                Orders","permission"=>"cancelorder-list"],

                ["title"=>"BLOGS","permissions"=>[
                "blog-list",
                "category-list",
                "subcategory-list",
                "tag-list",
                ],"icon"=>"fas fa-tags","route"=>'tags',"name"=>"Tag List"],
                
                ["icon"=>"fas fa-address-card","route"=>'posts',"name"=>"Post List"],


                ["title"=>"OTHERS","permissions"=>[
                "galleries-list",
                "banner-list",
                "deal-list",
                "subscription-list",
                "transaction-list",
                ],
                "icon"=>"far fa-images","route"=>'banners',"name"=>"Banners"],
                // ["icon"=>"fas
                // fa-money-check","route"=>'filmsubmiteds',"name"=>"Film Submited"],
                // ["icon"=>"fas fa-ticket-alt","route"=>'votings',"name"=>"Voting"],
                // ["icon"=>"fas fa-ticket-alt","route"=>'sponsors',"name"=>"Sponsors"],
                ["icon"=>"far
                fa-file-alt","route"=>'staticpages',"name"=>"StaticPages"],

                ]
                @endphp

                @foreach($menus as $menu)
                @isset($menu["title"])
                <li class="nav-main-heading pl-2">{{ $menu["title"] }}</li>
                @endisset
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('admin/'.$menu['route'].'*') ? ' active' : '' }}"
                        href="{{ url('admin/'.$menu['route']) }}">
                        <div style="width:25px"><i class="{{ $menu['icon'] }}"></i></div>
                        <span class="nav-main-link-name">{{ $menu['name'] }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>