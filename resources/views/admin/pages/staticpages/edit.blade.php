@extends('admin.layouts.main')
@section('css_before')
@endsection

@section('js_after')
<script src="{{ asset('/js/plugins/ckeditor/ckeditor.js')}}"></script>

<!-- Page JS Helpers (CKEditor 5 plugins) -->
<script>
    jQuery(function () {
        One.helpers(['ckeditor'])
        CKEDITOR.instances["js-ckeditor"].setData(`{!! $staticPage->contents !!}`);
});

</script>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Static Pages Edit</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</li></a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.staticpages.index') }}">StaticPages</li></a>
                    </li>
                    <li class="breadcrumb-item">{{ $staticPage->title }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="block-content block-content-full vendors-frm">
            <form action="{{ route('admin.staticpages.update',[$staticPage->id]) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group col-6">
                            <label>Title</label>
                            <input type="text" name="title" class="add-admin-frm" id="title"
                                value="{{$staticPage->title}}" readonly>
                        </div>
                        <div class="form-group">
                            <textarea id="js-ckeditor" name="content">{{  $staticPage->content  }}</textarea>
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
