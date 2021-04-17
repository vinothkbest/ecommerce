@extends('admin.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('/js/plugins/dropzone/dist/min/dropzone.min.css') }}">
@endsection

@section('js_after')
<script src="{{ asset("/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") }}"></script>
<script src="{{ asset("/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js") }}"></script>
<script src="{{ asset("/js/plugins/dropzone/dropzone.min.js") }}"></script>
<script src="{{ asset("/js/plugins/flatpickr/flatpickr.min.js") }}"></script>

<!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider plugins) -->
<script>
    jQuery(function () {
        One.helpers(['flatpickr', 'datepicker']);
    });
    function updateMinValue(date){
        var start_date=new Date(date);
        var end_date=new Date(start_date.setDate(start_date.getDate()+1));

        //let df=end_date.toLocaleDateString().split('/').reverse().join('-')+' '+end_date.toLocaleTimeString().slice(0,5);
        //alert()
        jQuery('#end_date_id').attr('data-min-date',flatpickr.formatDate(new Date(end_date), "Y-m-d h:i"))
        const fp = flatpickr("#end_date_id", {});
        fb.redraw();
    }
</script>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Edit Events</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.events.index') }}">Events</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-content block-content-full vendors-frm">
            <form action="{{ route('admin.events.update',[$event->id]) }}" method="POST">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6 form-group product-add">
                        <label>Subscription Type</label>
                        <select class="product-create" name="subscription_id">
                            @foreach ($subscriptions as $subscription)
                            <option value="{{ $subscription->id }}" @selected()>{{ $subscription->id }} -
                                {{ $subscription->name}}
                            </option>
                            @endforeach
                        </select>

                        @error('subscription_id')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('subscription_id') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group product-add">
                        <label>Event Name</label>
                        <input type="text" class="add-admin-frm" name="name"
                            value="{{ old('name')?old('name'):$event->name }}">

                        @error('name')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('name') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 form-group">
                        <label>Start Date & Time</label>
                        <input onchange="updateMinValue(this.value)" type="text"
                            class="js-flatpickr form-control bg-white" id="start_date_id"
                            value="{{ old('start_date')?old('start_date'):$event->start_date }}" name="start_date"
                            data-enable-time="true" placeholder="Select Start Date & Time"
                            data-min-date="{{date("Y-m-d H:i", strtotime('+10 day')) }}">

                        @error('start_date')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('start_date') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3 form-group">
                        <label>End Date & Time</label>
                        <input type="text" class="js-flatpickr form-control bg-white" id="end_date_id"
                            value="{{ old('end_date')?old('end_date'):$event->end_date }}" name="end_date"
                            data-enable-time="true" placeholder="Select End Date & Time">
                        @error('end_date')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('end_date') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Status</label>
                        <select class="add-admin-frm add-admin-frms" name="status">
                            <option @selector((old('status')?old('status'):$event->status),'1') value="1">Active
                            </option>
                            <option @selector((old('status')?old('status'):$event->status),'0') value="0">Disabled
                            </option>
                        </select>
                        @error('status')
                        <div class="text-danger animated fadeIn">
                            {{ $errors->first('status') }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="example-textarea-input">Event Description</label>
                        <textarea class="add-admin-frm" id="example-textarea-input" name="description" rows="4"
                            placeholder="Write The detail about your event">{{ old('description')?old('description'):$event->description }}</textarea>

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
