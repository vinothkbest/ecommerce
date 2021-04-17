@extends('admin.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
@endsection

@section('js_after')
<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Create Vendor</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.vendors.index') }}">Vendors</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Create</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-content block-content-full vendors-frm">
            <form method="POST" action="{{ route('admin.vendors.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="add-admin-frm" value="{{ old('name') }}" name="name">
                            @error('name')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="number" class="add-admin-frm" value="{{ old('mobile_number') }}"
                                name="mobile_number" min='0'>
                            @error('mobile_number')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('mobile_number') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="number" class="add-admin-frm" value="{{ old('contact_number') }}"
                                name="contact_number" min='0'>
                            @error('contact_number')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('contact_number') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" class="add-admin-frm" value="{{ old('email') }}" name="email">
                            @error('email')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('email') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Shop Name</label>
                            <input type="text" class="add-admin-frm" value="{{ old('shop_name') }}" name="shop_name">
                            @error('shop_name')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('shop_name') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>GST Number</label>
                            <input maxlength="15" minlength="15" type="text" class="add-admin-frm"
                                value="{{ old('gst_number') }}" name="gst_number">
                            @error('gst_number')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('gst_number') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address</label>
                            <textArea maxlength="100" type="text" class="add-admin-frm" name="address" rows="3"
                                style="resize: none;">{{ old('address') }}</textArea>
                            @error('address')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('address') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="add-admin-frm add-admin-frms" name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Disabled</option>
                            </select>
                            @error('status')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('status') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Password</label>
                        <input type="password" class="add-admin-frm" name="password" id="password"
                            autocomplete="new-password">
                        @error('password')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('password') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Confirm Password</label>
                        <input type="Password" class="add-admin-frm" name="password_confirmation"
                            id="password_confirmation">
                        @error('password_confirmation')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('password_confirmation') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Profile Image</label>
                            <input type="file" name="profile_image" class="add-admin-frm"
                                accept="image/x-png,image/gif,image/jpeg">
                            @error('profile_image')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('profile_image') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>GST Document</label>
                            <input type="file" name="gst_document" class="add-admin-frm"
                                accept="image/x-png,image/gif,image/jpeg">
                            @error('gst_document')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('gst_document') }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="save-btn">
                            <button type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@endsection
