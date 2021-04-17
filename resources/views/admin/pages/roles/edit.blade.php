@extends('admin.layouts.main')
@section('js_after')
<!-- Page JS Plugins -->


<!-- Page JS Code -->
<script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
{{-- <script src="{{ asset('js/pages/be_forms_validation.js')}}"></script> --}}
<script>
    jQuery(document).ready(function () {
		One.helpers('validation');
		jQuery('.js-validation').validate({
			ignore: [],
			rules: {
				'name': {
					required: true,
				},
				'username': {
					required: true,
					minlength: 8
				},

				'password': {
					required: true,
					minlength: 5
				},
				'password_confirmation': {
					required: true,
					equalTo: '#password'
				},

			},
			messages: {
				'name': 'Please enter a name',
				'username': {
					required: 'Please provide a username',
					minlength: 'Username must be at least 8 characters long'
				},
				'password': {
					required: 'Please provide a username',
					minlength: 'Username must be at least 8 characters long'
				},
				'password_confirmation': {
					required: 'Please provide a password',
					minlength: 'Your password must be at least 5 characters long',
					equalTo: 'Please enter the same password as above'
				}
			}
		});
		jQuery(function () {
			jQuery('.parent-role').change(function () {
				var row = jQuery(this).data('row');
				if (jQuery(this).is(':checked')) {
					jQuery('.subrole' + row).prop('checked', true);
				}
				else {
					jQuery('.subrole' + row).prop('checked', false);
				}
			})
		})
	});

</script>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Edit Role
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.roles.index') }}">Roles</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Your Block -->
    <div class="block block-rounded">

        <div class="block-content">
            <form class="js-validation" action="{{route('admin.roles.update',[$role->id])}}" method="post">
                {{ csrf_field() }}
                @method('put')
                <div class="col-xs-12 col-sm-12 col-md-6">

                    <div class="form-group">
                        <strong>Name:</strong>

                        <input type="text" class="form-control" name="name" value="{{$role->name}}">
                    </div>
                    @if($errors->has('name'))
                    <div class="text-danger">
                        {{'*'.$errors->first('name')}}
                    </div>
                    @endif
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">

                        <strong>Permission:</strong>
                        <br /> <br />
                        @php($i=1)
                        <div class="row">

                            @foreach($modules as $module)

                            <div class="col-md-4" style="margin-bottom:30px;">
                                <label>
                                    <input type="checkbox" class="parent-role" data-row="{{$i}}">

                                    <strong>{{$module->name}}</strong>

                                </label><br>
                                <div style="padding-left:10px;">
                                    @foreach($module->permissions as $permission)
                                    <label style="font-weight:normal">
                                        <input class="subrole{{$i}}" type="checkbox" name="permission[]"
                                            {{in_array($permission->id,$rolePermissions)?'checked':''}}
                                            value="{{ $permission->id }}">

                                        {{$permission->operation}}
                                    </label>
                                    <br>
                                    @endforeach


                                </div>

                            </div>
                            @php($i++)
                            @endforeach
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Your Block -->
</div>
<!-- END Page Content -->
@endsection
