@extends('admin.layouts.main')

@section('css_before')
<link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
<script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    jQuery(function () {
        One.helpers(['select2']);
    });
</script>
@endsection

@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Edit Brand</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.brands.index') }}">Brands</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">{{ $brand->brand_name ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-content block-content-full vendors-frm">
            <form method="POST" action="{{ route('admin.brands.update',[$brand->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="add-admin-frm" name="name"
                                value="{{ old('name')?old('name'):$brand->brand_name }}" required>
                            @error('name')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('name') }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="add-admin-frm" accept="image/*">
                            @error('image')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('image') }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="d-block" for="categories">Select Categories</label>
                            <select class="js-select2 form-control" id="categories" name="categories[]"
                                style="width: 100%;" data-placeholder="Choose Category.." multiple>
                                @php $old_menus = []; @endphp
                                @foreach($brand->categories as $key => $brand_category)
                                    <option value="{{ $brand_category->id }}" selected>{{ $brand_category->category_name }}</option>
                                    {{ array_push($old_menus, $brand_category->id)}}
                                @endforeach
                                @foreach ($menus as $menu)
                                    @if(!in_array($menu->id, $old_menus))
                                        <option value="{{ $menu->id }}">{{ $menu->category_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('categories')
                            <div class="text-danger animated fadeIn">
                                {{ $errors->first('categories') }}</div>
                            @enderror
                        </div>
                        <div class="category-save">
                            <button type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@endsection
