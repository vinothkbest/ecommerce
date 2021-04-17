@extends('website.templates.main')
@section('contents')
<section class="other-banner">
    @include('website.templates.nav-bar')
    <div class="in-ban-oth">
        <h4>My Order</h4>
        <ul class="d-flex justify-content-end mt-4" style="text-transform: capitalize;">
            <li class="pr-1">
                <a href="{{ url('/') }}">Home
                </a>
                /
            </li>
            <li>
                <span>My Order
                </span>
            </li>
        </ul>
    </div>
</section>
<section class="mt-4">
    <div class="container95">
        <div class="row row-sparse">
            <div class="col-md-4">
                <div class="card">
                      <div class="card-header card-title">
                            <p>Delivery Track</p>
                      </div>
                      <div class="card-body">
                            <section class="root">
                                <figure>
                                    <img src="https://image.flaticon.com/icons/svg/970/970514.svg" alt="">
                                    <figcaption>
                                      <h5>OrderID</h5>
                                      <h6># A61452B</h6>
                                    </figcaption>
                                </figure>
                                <div class="order-track">
                                    <div class="order-track-step">
                                        <div class="order-track-status">
                                            <span class="order-track-status-dot"></span>
                                            <span class="order-track-status-line"></span>
                                        </div>
                                        <div class="order-track-text">
                                            <p class="order-track-text-stat">Order confirmation</p>
                                            <span class="order-track-text-sub"></span>
                                        </div>
                                    </div>
                                    <div class="order-track-step">
                                        <div class="order-track-status">
                                            <span class="order-track-status-dot"></span>
                                            <span class="order-track-status-line"></span>
                                        </div>
                                        <div class="order-track-text">
                                            <p class="order-track-text-stat">Picked up your order</p>
                                            <span class="order-track-text-sub"></span>
                                        </div>
                                    </div>
                                    <div class="order-track-step">
                                        <div class="order-track-status">
                                            <span class="order-track-status-dot"></span>
                                            <span class="order-track-status-line"></span>
                                        </div>
                                        <div class="order-track-text">
                                            <p class="order-track-text-stat">Shipped your order</p>
                                            <span class="order-track-text-sub"></span>
                                        </div>
                                    </div>
                                    <div class="order-track-step">
                                        <div class="order-track-status">
                                            <span class="order-track-status-dot"></span>
                                            <span class="order-track-status-line"></span>
                                        </div>
                                        <div class="order-track-text">
                                            <p class="order-track-text-stat">Order delivered</p>
                                            <span class="order-track-text-sub"></span>
                                        </div>
                                    </div>
                                </div>
                            </section>
                      </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                      <div class="card-header card-title">
                            <p>Order Detail</p>
                      </div>
                      <div class="card-body">
                            <section class="root">
                                
                            </section>
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
figure {
  display: flex;
}
figure img {
  width: 100px;
  height: 100px;
  border-radius: 15%;
  border: 1.5px solid #f05a00;
  margin-right: 1.5rem;
  padding:1rem;
}
figure figcaption {
  display: flex;
  flex-direction: column;
  justify-content: space-evenly;
}
figure figcaption h4 {
  font-size: 14px;
  font-weight: 200;
}
figure figcaption h6 {
  font-size: 14px;
  font-weight: 200;
}
figure figcaption h2 {
  font-size: 14px;
  font-weight: 200;
}
.card-title{
     background:#ab0010;color: white;
}
.order-track {
  margin-top: 2rem;
  padding: 0 1rem;
  border-top: 1px dashed #2c3e50;
  padding-top: 2.5rem;
  display: flex;
  flex-direction: column;
}
.order-track-step {
  display: flex;
  height: 7rem;
}
.order-track-step:last-child {
  overflow: hidden;
  height: 4rem;
}
.order-track-step:last-child .order-track-status span:last-of-type {
  display: none;
}
.order-track-status {
  margin-right: 1.5rem;
  position: relative;
}
.order-track-status-dot {
  display: block;
  width: 2.2rem;
  height: 2.2rem;
  border-radius: 50%;
  background: #f05a00;
}
.order-track-status-line {
  display: block;
  margin: 0 auto;
  width: 2px;
  height: 7rem;
  background: #f05a00;
}
.order-track-text-stat {
  font-size: 14px;
  font-weight: 200;
  margin-bottom: 3px;
}
.order-track-text-sub {
  font-size: 14px;
  font-weight: 200;
}

.order-track {
  transition: all .3s height 0.3s;
  transform-origin: top center;
}
</style>
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