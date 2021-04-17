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
            <h1 class="flex-sm-fill h3 my-2">Create Subscription</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item"><a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item"><a class="link-fx"
                            href="{{ route('admin.subscriptions.index') }}">Subscriptions</a></li>
                    <li class="breadcrumb-item" aria-current="page">
                        Create
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-content block-content-full vendors-frm">
            <form action="{{ route('admin.subscriptions.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 form-group product-add">
                        <label>Subscription Type</label>
                        <select class="product-create" name="type">
                            <option value="basic" @selector(old('type'),'basic')>Basic</option>
                            <option value="event" @selector(old('type'),'event')>Event</option>
                        </select>
                        @error('type')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('type') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Subscription Name</label>
                        <input type="text" class="add-admin-frm" value="{{ old('name') }}" name="name"
                            placeholder="Enter Name">

                        @error('name')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('name') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Validity<small>(days)</small></label>
                        <input type="number" class="add-admin-frm" value="{{ old('validity') }}" name="validity"
                            placeholder="Enter Validity">
                        @error('validity')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('validity') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Amount</label>
                        <input type="number" class="add-admin-frm" value="{{ old('amount') }}" name="amount"
                            placeholder="Enter Amount">
                        @error('amount')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('amount') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Image Count</label>
                        <input type="number" class="add-admin-frm" value="{{ old('image_count') }}" name="image_count"
                            placeholder="ex: 100">
                        @error('image_count')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('image_count') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Status</label>
                        <select class="add-admin-frm add-admin-frms" name="status">
                            <option @selector(old('status'),'1') value="1">Active</option>
                            <option @selector(old('status'),'0') value="0">Disabled</option>
                        </select>
                        @error('status')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('status') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="example-textarea-input">Description</label>
                        <textarea class="add-admin-frm" style="resize: none" id="example-textarea-input"
                            name="description" rows="5"
                            placeholder="Enter detail of this subscription..">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('description') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 text-center category-save">
                        <button type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@endsection
