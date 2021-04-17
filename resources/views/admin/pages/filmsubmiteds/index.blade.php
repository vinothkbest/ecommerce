@extends('admin.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/themes/owl.carousel.css') }}">
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
<script src="{{ asset('js/pages/owl.carousel.js') }}"></script>
@endsection
@section('content')
<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Film List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Filmsubmiteds</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">

        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center">S.No</th>
                        <th>Select Videos</th>
                        <th>User Name</th>
                        <th>Mobile Number</th>
                        <th>Video Title</th>
                        <th>Direction Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <form action="">
                                <div>
                                    <input id="checkbox-1" class="checkbox-custom" name="checkbox-1" type="checkbox"
                                        style="cursor: pointer;">
                                    <label for="checkbox-1" class="checkbox-custom-label"
                                        style="cursor: pointer;">Drama</label>
                                </div>
                            </form>
                        </td>
                        <td>John</td>
                        <td>+91 9876543210</td>
                        <td>ABCD</td>
                        <td>Student</td>
                        <td>
                            <a href="{{route('admin.filmsubmiteds.show',[1])}}" class="badge badge-success"><i
                                    class="fas fa-eye"></i></a>
                            <a href="#" class="badge badge-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            <form action="">
                                <div>
                                    <input id="checkbox-2" class="checkbox-custom" name="checkbox-2" type="checkbox"
                                        style="cursor: pointer;">
                                    <label for="checkbox-2" class="checkbox-custom-label"
                                        style="cursor: pointer;">Romance</label>
                                </div>
                            </form>
                        </td>
                        <td>John</td>
                        <td>+91 9876543210</td>
                        <td>EFGH</td>
                        <td>General</td>
                        <td>
                            <a href="{{route('admin.filmsubmiteds.show',[1])}}" class="badge badge-success"><i
                                    class="fas fa-eye"></i></a>
                            <a href="#" class="badge badge-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                            <form action="">
                                <div>
                                    <input id="checkbox-3" class="checkbox-custom" name="checkbox-3" type="checkbox"
                                        style="cursor: pointer;">
                                    <label for="checkbox-3" class="checkbox-custom-label"
                                        style="cursor: pointer;">Thriller</label>
                                </div>
                            </form>
                        </td>
                        <td>John</td>
                        <td>+91 9876543210</td>
                        <td>IJKL</td>
                        <td>Women</td>
                        <td>
                            <a href="{{route('admin.filmsubmiteds.show',[1])}}" class="badge badge-success"><i
                                    class="fas fa-eye"></i></a>
                            <a href="#" class="badge badge-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@endsection