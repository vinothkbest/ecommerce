@extends('admin.layouts.simple')
@section('js_after')
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script>
    jQuery(document).ready(function(){
         One.helpers('validation');
         jQuery('.js-validation').validate({
            ignore: [],
            rules: {
                'name': {
                    required: true,
                },
                'password': {
                    required: true,
                },
            },
            messages: {
                'name':'Please enter the name',

            }
        });

        @if($errors->has('invalid_credential'))
            One.helpers('notify', {align: 'center',type: 'danger', message: '{{$errors->first("invalid_credential")}}'});
        @endif

    });

</script>
@endsection
@section('content')
<div class="hero-static">
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Sign In Block -->
                <div class="block block-rounded block-themed mb-0 border" style="border-color: #bfbebe !important;">
                    <div class="block-header bg-primary-dark text-center"
                        style="display: flex;justify-content: flex-end;">
                        <img src="{{ asset('web/img/logo.png') }}" width="100px" style="margin: 0 auto" alt="">
                    </div>
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 py-lg-5">
                            <h1 class="h2 mb-1">Login</h1>
                            <form class="js-validation" action="{{ route('admin.login.verify') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="py-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-alt form-control-lg"
                                            id="name" name="name" placeholder="name"
                                            value="{{ old('name') }}">
                                        @error('name')
                                        <div class="text-danger animated fadeIn">
                                            {{ $errors->first('name') }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-alt form-control-lg"
                                            id="password" name="password" placeholder="Password">
                                        @error('password')
                                        <div class="text-danger animated fadeIn">
                                            {{ $errors->first('password') }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="login-remember"
                                                name="login-remember">
                                            <label class="custom-control-label font-w400" for="login-remember">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 col-xl-5">
                                        <button type="submit" class="btn btn-block btn-alt-primary">
                                            <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content content-full font-size-sm text-muted text-center">
        <strong>All Rights Reserved by Kapa Foods Copyright</strong> &copy; <span> at 2021</span>
    </div>
</div>
@endsection