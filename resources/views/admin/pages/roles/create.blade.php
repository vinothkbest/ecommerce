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
				'permission[]': {
					required: true,
				},

			},
			messages: {
				'name': 'Please enter a role name',
				'permission[]':'Please select atleast one permission'
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
                Create Role
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.roles.index') }}">Roles</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Create</li>
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
            <form class="js-validation" method="post" action="{{route('admin.roles.store')}}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Role Name</label>
                            <input type="text" name="name" placeholder=" Enter Role name" class="form-control" required>
                            @if($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                    </div>
                </div>
                <br>
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
                                            value="{{ $permission->id }}">
                                        {{$permission->operation}}
                                    </label>
                                    <br>
                                    @endforeach
                                </div>
                            </div>
                            @php($i++)
                            @endforeach
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <br>
                </div>

            </form>
        </div>
    </div>
    <!-- END Your Block -->
</div>
<!-- END Page Content -->
@endsection
