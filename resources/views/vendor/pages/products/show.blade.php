@extends('vendor.layouts.main')

@section('css_before')
<link rel="stylesheet" href="{{ asset('/js/plugins/slick-carousel/slick.css') }}">
<link rel="stylesheet" href="{{ asset('/js/plugins/slick-carousel/slick-theme.css') }}">
@endsection

@section('js_after')
<script src="{{ asset('/js/plugins/slick-carousel/slick.min.js') }}"></script>
<script>
    jQuery(function () { One.helpers('slick'); });
</script>
@endsection

@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Product Details <small class="font-size-base font-w400 text-muted">{{ $product->name }}</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('vendor.dashboard') }}">Dashboard</li></a>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('vendor.products.index') }}">Products</li></a>
                    <li class="breadcrumb-item">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-content">
            <div class="row">
                <div class="col-md-4">
                    <div class="block block-rounded">
                        <div class="js-slider slick-dotted-inner slick-dotted-white" data-dots="true"
                            data-autoplay="true" data-autoplay-speed="1000" style="width: 320px;height: 320px">
                            @foreach ($product->productMedia as $media)
                            @if(explode('/', $media->type)[0]=='image')
                            <div>
                                <img class="img-fluid rounded" src="{{ $media->path }}" alt=""
                                    style="width: 320px;height: 320px">
                            </div>
                            @else
                            <div>
                                <video class="img-fluid" controls style="width: 320px;height: 320px">
                                    <source src="{{ $media->path }}" type="{{ $media->type }}">
                                    Your browser does not support HTML video.
                                </video>
                            </div>
                            @endif

                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="block-content product-title">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-alt push">
                                @foreach ($product->parents_path->reverse() as $path)
                                @if($loop->last)
                                <li class="breadcrumb-item active" aria-current="page">{{ $path["name"]}}</li>
                                @else
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0)">{{ $path["name"] }}</a>
                                </li>
                                @endif
                                @endforeach
                            </ol>
                        </nav>
                    </div>
                    <div class="product-decription">
                        <h3>{{ $product->brand->name }}</h3>
                        <p>{{ $product->name }}</p>
                        <div class="price-det">
                            <p><span class="pd-price"><strong>Rs. {{ $product->fixed_price }}</strong></span><span
                                    class="pd-mrp"><s>Rs.
                                        {{ $product->actual_price }}</s></span> <span
                                    class="pd-discount">({{ $product->discount }}% OFF)</span></p>
                            <p class="selling-price">inclusive of all taxes</p>
                        </div>
                        <div class="product-offer">
                            <div class="offer-title">
                                <b>Best Price: <span class="offer-price">Rs. {{ $product->fixed_price }}</span></b>
                                <ul>
                                    @foreach ($product->highlight as $item)
                                    <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product-desc">
                        <h3>Product Descrioption</h3>
                        <p style="white-space: pre-line">{{ $product->description }}</h3>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="product-desc">
                        <h3>Specifications</h3>
                        <div class="table-container">
                            @foreach ($product->specification as $item)
                            <div class="index-row">
                                <div class="index-key">{{ $item['title'] }}</div>
                                <div class="index-value">{{ $item['content'] }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
