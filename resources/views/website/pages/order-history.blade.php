@extends('website.templates.main')
@section('contents')
<section class="other-banner">
    @include('website.templates.nav-bar')
    <div class="in-ban-oth">
        <h4>Order History</h4>
        <ul class="d-flex justify-content-end mt-4" style="text-transform: capitalize;">
            <li class="pr-1">
                <a href="{{ url('/') }}">Home
                </a>
                /
            </li>
            <li>
                <span>Order History
                </span>
            </li>
        </ul>
    </div>
</section>
<section class="mt-4">
    <div class="container95">
        <div class="row row-sparse">
            <div class="cart-table-container">
                <table class="table table-cart">
                    <thead>
                        <tr>
                            <th class="product-col text-left">Product</th>
                            <th class="qty-col">Order Date</th>
                            <th class="qty-col">Delivered/Canceled</th>
                            <th class="text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="product-action-row">
                            <td colspan="5">
                                <div class="float-left">
                                    <h2 class="product-title">
                                        <div>
                                            <h4>Walnut</h4>
                                            <p>Id: 32547856987</p>
                                        </h2>
                                    </div>
                                    <div class="float-right mt-2">
                                        <!-- <a href="#" title="Edit product" class="btn-edit"> <span
                                        class="sr-only">Edit</span> <i class="fas fa-pencil-alt"></i> </a> -->
                                        <a href="#" title="Remove product" class="btn-remove icon-cancel">
                                            <span class="sr-only">Remove</span>
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="product-row">
                            <td class="product-col">
                                <figure class="product-image-container">
                                    <a href="#" class="product-image">
                                        <img src="img/img1.png" alt="product">
                                       <p>₹958(500g)</p>
                                    </a>
                                </figure>
                            </td>
                            <td class="rate1">25-11-2020</td>
                            <td class="rate1">26-11-2020</td>

                            <!-- <td class="rate2 text-success">Delivered</td> -->
                            <td class="rate2 text-danger">Canceled</td>
                        </tr>
                        <tr class="product-action-row">
                            <td colspan="5">
                                <div class="float-left">
                                    <h2 class="product-title">
                                        <div>
                                            <h4>Running Sneakers</h4>
                                            <p>Id: 32547856987</p>
                                        </h2>
                                    </div>
                                    <div class="float-right mt-2">
                                        <!-- <a href="#" title="Edit product" class="btn-edit"> <span
                                        class="sr-only">Edit</span> <i class="fas fa-pencil-alt"></i> </a> -->
                                        <a href="#" title="Remove product" class="btn-remove icon-cancel">
                                            <span class="sr-only">Remove</span>
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="product-row">
                            <td class="product-col">
                                <figure class="product-image-container">
                                    <a href="#" class="product-image">
                                        <img src="img/banner-btm.png" alt="product">
                                            <p>₹508(500g)</p>
                                    </a>
                                </figure>
                            </td>
                            <td class="rate1">25-11-2020</td>
                            <td class="rate1">26-11-2020</td>

                            <td class="rate2 text-success">Delivered</td>
                            <!-- <td class="rate2 text-danger">Canceled</td> -->
                        </tr>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>
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
@endsection