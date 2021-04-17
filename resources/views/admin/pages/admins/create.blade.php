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
<script src="{{ asset('js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Create Admin</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.admins.index') }}">Admins</a>
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
            <form class="js-validation" action="{{ route('admin.admins.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Name</label>
                        <input type="text" class="add-admin-frm" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('name') }}</div>
                        @enderror
                    </div>
                    {{-- <div class="col-md-4 form-group">
                        <label>Username</label>
                        <input type="text" class="add-admin-frm" name="username" id="username"
                            value="{{ old('username') }}">
                        @error('username')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('username') }}</div>
                        @enderror
                    </div> --}}
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input type="email" class="add-admin-frm" name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('email') }}</div>
                        @enderror
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
                    <div class="col-md-6 form-group">
                        <label>Role</label>
                        <select class="add-admin-frm add-admin-frms" name="roles[]">
                            <option selected disabled>Select Role</option>
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selector((old('roles')?old('roles')[0]:''),strval($role->
                                id))>{{ $role->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('roles')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('roles') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Status</label>
                        <select class="add-admin-frm add-admin-frms" name="status">
                            <option @selector(old('status'),'1') value="1">Active</option>
                            <option @selector(old('status'),'0') value="0">Disabled</option>
                        </select>
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
