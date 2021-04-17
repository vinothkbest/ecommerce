@extends('admin.layouts.main')
@section('css_before')
<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
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
            <h1 class="flex-sm-fill h3 my-2">Unit List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Unit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block block-rounded">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="block-header add-btn" style="cursor: pointer;"
                     data-toggle="modal"  
                     data-target="#unitModal">
                    <a style="color:white"><i class="fas fa-plus"></i>Add Unit</a>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th style="width: 5%;" class="text-center">S.No</th>
                        <th>Unit Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $unit)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $unit->unit_name ?? ''}}</td>
                        <td>
                            <a style="cursor: pointer;"
                                 data-toggle="modal"  
                                 data-target="#unitModal{{ $unit->id }}"
                                 class="badge badge-info"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>

                    {{-- Edit Unit --}}

                    <div class="modal fade" id="unitModal{{ $unit->id }}" tabindex="-1" role="dialog" aria-labelledby="unitModalTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="height:300px;">
                                <form enctype="multipart/form-data" method="post"
                                    id="unit_form" action="{{ route('admin.units.update', [$unit->id]) }}">
                                      @csrf
                                      @method('put')
                                      <div class="unit-modal-header modal-header">
                                            <h5 class="modal-title" id="categoryModalTitle">Edit Unit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true" class="modal-close">&times;</span>
                                            </button>
                                      </div>
                                      <div class="modal-body">
                                            <div class="form-group">
                                                <label>Unit</label>
                                                <input type="text" class="add-admin-frm form-control"
                                                       name="unit" autocomplete="off"
                                                       value="{{ $unit->unit_name }}" 
                                                       required>
                                            </div>
                                      </div>
                                      <div class="modal-footer text-center">
                                                <button type="submit" class="btn btn-success">Update</button>
                                      </div>
                                </form>
                            </div>
                      </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->

    {{-- Add Unit --}}

    <div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="unitModalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="height:300px;">
                <form enctype="multipart/form-data" method="post"
                    id="unit_form" action="{{ route('admin.units.store') }}">
                                @csrf
                      <div class="unit-modal-header modal-header">
                            <h5 class="modal-title" id="categoryModalTitle">Add Unit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="modal-close">&times;</span>
                            </button>
                      </div>
                      <div class="modal-body">
                            <div class="form-group">
                                <label>Unit</label>
                                <input type="text" class="add-admin-frm form-control"
                                       name="unit" autocomplete="off" required id="unit_title">
                            </div>
                      </div>
                      <div class="modal-footer text-center">
                                <button type="submit" class="btn btn-success">Create</button>
                      </div>
                </form>
            </div>
      </div>
    </div>
</div>
<style>
        .unit-modal-header{
            background: #a30d03;
        }
        .modal-title,.modal-close{
            color:white;
        }
</style>
<script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@if(session('success'))

    <script>
        Swal.fire({
          title: "{{session('success')}}",
          icon: 'success',
        })
    </script>
@endif
@if(session('error'))
    <script>
        Swal.fire({
          title: "{{session('error')}}",
          icon: 'error',
        })
    </script>

@endif

@endsection