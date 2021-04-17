@extends('admin.layouts.main')

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Dashboard</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">App</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Dashboard</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->
<!-- Page Content -->
<div class="content">
    <div class="row row-deck">
        @php
        $cards=[
        [
        "title"=>"Registered Users",
        "count"=>$users_count,
        "icon"=>"fa fa-users",
        "route"=>"users",
        "permission"=>"user-list"
        ],
        // [
        // "title"=>"Category",
        // "count"=>$vendors_count,
        // "icon"=>"fas fa-list-alt",
        // "route"=>"vendors",
        // "permission"=>"vendor-list"
        // ],
        [
        "title"=>"Products",
        "count"=>$category_count,
        "icon"=>"fab fa-nutritionix",
        "route"=>"categories",
        "permission"=>"category-list"
        ],
        [
        "title"=>"Customer",
        "count"=>$brand_count ?? '',
        "icon"=>"fas fa-user-friends",
        "route"=>"brands",
        "permission"=>"brand-list"
        ],
        [
        "title"=>"Orders",
        "count"=>$products_count  ?? '',
        "icon"=>"fas fa-shopping-cart",
        "route"=>"products",
        "permission"=>"product-list"
        ],
        [
        "title"=>"Cancel Orders",
        "count"=>$orders_count ?? '',
        "icon"=>"fas fa-cart-plus",
        "route"=>"orders",
        "permission"=>"order-list"
        ],
        ]
        @endphp
        @foreach ($cards as $card)
        <div class="col-sm-6 col-xl-3">
            <div class="block block-rounded d-flex flex-column">
                <div
                    class="block-content block-content-full flex-grow-1 d-flex justify-content-between align-items-center">
                    <dl class="mb-0">
                        <dt class="font-size-h2 font-w700">{{ $card['count'] }}</dt>
                        <dd class="text-muted mb-0">Total {{ $card["title"] }}</dd>
                    </dl>
                    <div class="item item-rounded bg-body">
                        <i class="{{ $card['icon'] }} font-size-h3 text-primary"></i>
                    </div>
                </div>
                @can($card['permission'])
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-sm">
                    <a class="font-w500 d-flex align-items-center" href="{{ route('admin.'.$card['route'].'.index') }}">
                        View all {{ $card["title"] }}
                        <i class="fa fa-arrow-alt-circle-right ml-1 opacity-25 font-size-base"></i>
                    </a>
                </div>
                @endcan
            </div>
            <!-- END New Customers -->
        </div>
        @endforeach
    </div>
</div>
<!-- END Page Content -->
@endsection