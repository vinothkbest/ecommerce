@extends('admin.layouts.main')

@section('css_before')
@endsection

@section('js_after')

@endsection

@section('content')

<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                User Details
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.users.index') }}">Users
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">User Details</li>
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
                            @if(isset($addresses[0]))
                                <div class="card">
                                      <div class="card-header bg-primary text-white font-weight-bold">
                                            Shipping Address
                                      </div>
                                      <div class="card-body">
                                        <p class="card-text">{{ $addresses[0]->door_number ?? '' }}, {{ $addresses[0]->street ?? '' }}</p>
                                        <p class="card-text">{{ $addresses[0]->area ?? '' }}, {{ $addresses[0]->city ?? '' }}</p>
                                        <p class="card-text">{{ $addresses[0]->state ?? '' }}, {{ $addresses[0]->pin_code ?? '' }}</p>
                                      </div>
                                </div>
                            @endif
                            @foreach($addresses->chunk(3) as $address_parts)
                                <div class="row mt-3">
                                @foreach($address_parts as $address)
                                    @if($loop->iteration >= 2)
                                         <div class="col-lg-6 col-md-6">
                                                <div class="card">
                                                      <div class="card-header">
                                                            Address-{{ $loop->iteration-1 }}
                                                      </div>
                                                      <div class="card-body">
                                                        <p class="card-text">{{ $address->door_number ?? '' }}, {{ $address->street ?? '' }}</p>
                                                        <p class="card-text">{{ $address->area ?? '' }}, {{ $address->city ?? '' }}</p>
                                                        <p class="card-text">{{ $address->state ?? '' }}, {{ $address->pin_code ?? '' }}</p>
                                                      </div>
                                                </div>         
                                         </div>
                                    @endif
                                @endforeach
                                </div>
                            @endforeach
                    </div>
                    <!-- END Billing Address -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection