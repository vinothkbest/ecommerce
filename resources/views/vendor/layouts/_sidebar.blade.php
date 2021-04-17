<nav id="sidebar" style="background-color: #272e38" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header bg-white-5">
        <!-- Logo -->
        <a class="font-w600 text-dual" href="{{ route('vendor.dashboard') }}">
            <span class="smini-visible">
                <img class="rounded-circle" src="{{ asset('assets/icon.png') }}" alt="Header Avatar"
                    style="width: 21px;">
            </span>
            <span class="smini-hide font-size-h5 tracking-wider">
                Yellow<span class="font-w400">Rider</span>
            </span>
            <small class="font-size-sm">Vendor</small>
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
                ["icon"=>"fas fa-tachometer-alt","route"=>'dashboard',"name"=>"Dashboard"],

                ["title"=>"My Account","icon"=>"far fa-list-alt","route"=>'categories',"name"=>"Request Categories"],
                ["icon"=>"fas fa-list-alt","route"=>'products',"name"=>"Products"],
                ["icon"=>"fas fa-envelope","route"=>'enquiries',"name"=>"Enquiries"],
                ["icon"=>"fas fa-shopping-cart","route"=>'orders',"name"=>"Orders"],
                ["icon"=>"fas fa-money-bill-wave","route"=>'transactions',"name"=>"Transactions"],
                ]
                @endphp

                @foreach($menus as $menu)
                @isset($menu["title"])
                <li class="nav-main-heading pl-2">{{ $menu["title"] }}</li>
                @endisset
                <li class="nav-main-item">
                    <a class="nav-main-link{{ request()->is('vendor/'.$menu['route'].'*') ? ' active' : '' }}"
                        href="{{ url('vendor/'.$menu['route']) }}">
                        <div style="width:25px"><i class="{{ $menu['icon'] }}"></i></div>
                        <span class="nav-main-link-name">{{ $menu['name'] }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
