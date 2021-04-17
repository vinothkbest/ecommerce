@extends('admin.layouts.main')

@section('css_before')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection

@section('js_after')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@section('content')

<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Product View
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.products.index') }}">Product List
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">{{ $product->product_name ?? ''}}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="block block-rounded">
                        <table class="table table-borderless voting-amt">
                            <thead>
                                <tr class="block-header-default">
                                    <th colspan="3" class="block-title">Product info</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 40%;">Category</td>
                                    <td>: </td>
                                    <td>{{ $product->categories[0]->category_name ?? ''}}</td>
                                    
                                </tr>
                                @if(isset($product->categories[1]))
                                <tr>
                                    <td style="width: 40%;">Sub Category</td>
                                    <td>: </td>
                                    <td>{{ $product->categories[1]->category_name ?? ''}}</td>
                                    
                                </tr>
                                @endif
                                @if(isset($product->categories[2]))
                                <tr>
                                    <td style="width: 40%;">Last Sub Category</td>
                                    <td>: </td>
                                    <td>{{ $product->categories[2]->category_name ?? ''}}</td>
                                    
                                </tr>
                                @endif
                                <tr>
                                    <td style="width: 40%;">Brand</td>
                                    <td>: </td>
                                    <td>{{ $product->brand->brand_name ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">GST Tax</td>
                                    <td>: </td>
                                    <td>
                                        {{ $product->gst_tax ?? '' }} %
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Description</td>
                                    <td>: </td>
                                    <td>
                                        {!! $product->description ?? '' !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Detailed Description</td>
                                    <td>: </td>
                                    <td>{!! $product->detailed_description ?? '' !!}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Feature Images</td>
                                    <td>: </td>
                                    <td>
                                        <div id="carouselExampleIndicators"
                                             class="carousel slide"
                                             data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    @foreach($product->productMedia as $key => $product_image)
                                                            @if($key == 0)
                                                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="active"></li>
                                                            @else
                                                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"></li>
                                                            @endif
                                                    @endforeach
                                                </ol>
                                                <div class="carousel-inner">
                                                    @foreach($product->productMedia as $key => $product_image)
                                                        @if($key == 0)
                                                            <div class="carousel-item active">
                                                                <img class="d-block" src="{{ $product_image->path ?? ''}}" alt="Product Features" width="400px" height="250px">
                                                            </div>
                                                        @else
                                                            <div class="carousel-item">
                                                                <img class="d-block" src="{{ $product_image->path ?? ''}}" alt="Product Features" width="400px" height="250px">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-borderless voting-amt ">
                            <thead>
                                <tr class="block-header-default">
                                    <th colspan="3" class="block-title">Product variants</th>
                                </tr>
                            </thead>
                        </table>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                  <th scope="col">S.No</th>
                                  <th scope="col">Variant name</th>
                                  <th scope="col">Actual price</th>
                                  <th scope="col">Discount</th>
                                  <th scope="col">In Stock</th>
                                  <th scope="col">Availability Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product->productVariants as $variant)
                                <tr>
                                      <th scope="row">{{ $loop->iteration }}</th>
                                      <td>{{ $variant->variant_name  . " " . $variant->unit->unit_name ?? ''}}</td>
                                      <td>{{ $variant->actual_price ?? '' }}</td>
                                      <td>{{ $variant->discount_price ?? '' }}</td>
                                      <td>{{ $variant->available_quantity_count ?? '' }}</td>
                                      <td>{{ $variant->availablity_status ?? '' }}</td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>

                        <table class="table table-borderless voting-amt">
                            <thead>
                                <tr class="block-header-default">
                                    <th colspan="3" class="block-title">SEO details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 40%;">Title</td>
                                    <td>: </td>
                                    <td>{{ $product->productSeo->title ?? ''}}</td>
                                    
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Image</td>
                                    <td>: </td>
                                    <td><img src="{{ url($product->productSeo->image_path ?? '') }}" alt="nuts" style="width: 30%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Description</td>
                                    <td>: </td>
                                    <td>
                                        {!! $product->productSeo->description ?? '' !!}
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- END Billing Address -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection