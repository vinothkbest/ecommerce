@extends('website.templates.main')
@section('contents')
@include('website.templates.nav-bar')
  <div class="hero">
    <div class="hero-inner text-center">
      <div class="bg-white overflow-hidden">
        <div class="content content-full">
          <div class="py-4 mt-4 mb-4">
            <!-- Error Header -->
            <h1 class="display-1 font-w600 text-danger">404</h1>
            <h2 class="h4 font-w400 text-danger mb-2">we are unable to find the page you were looking for ...</h2>
            <!-- END Error Header -->
          </div>
        </div>
      </div>
      <div class="content content-full">
        <a href="{{ url('/') }}" class="link-fx  text-danger">
          Go Home >
        </a>
      </div>
    </div>
  </div>
@endsection