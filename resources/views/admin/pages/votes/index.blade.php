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
            <h1 class="flex-sm-fill h3 my-2">Vote List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Vote</li>
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
                        <th class="text-center" style="width: 80px;">S.No</th>
                        <th>Selected Video</th>
                        <th>User Name</th>
                        <th>Mobile Number</th>
                        <th>Video Title</th>
                        <th>Total Votings</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([
                    [
                    "product_id"=>1,
                    "username"=>"John",
                    "mobile_number"=>"+91 9876543210",
                    "video_title"=>"Common Man",
                    "total_votings"=>"1000000",
                    ]
                    ] as $deal)
                    <tr>
                        <td class="text-center font-size-sm">{{ $loop->index+1 }}</td>
                        <td class="font-w600 font-size-sm">Drama{{ $deal["product_id"] }}</td>
                        <td class="font-w600 font-size-sm">{{ $deal["username"] }}</td>
                        <td class="font-w600 font-size-sm">{{ $deal["mobile_number"] }}</td>
                        <td class="font-w600 font-size-sm">{{ $deal["video_title"] }}</td>
                        <td class="font-w600 font-size-sm">{{ $deal["total_votings"] }}</td>
                        <td class="status-center">
                            <a href="" data-toggle="modal" data-target="#exampleModal" class="badge badge-warning"><i
                                    class="fas fa-play-circle"></i></a>
                            <a href="{{route('admin.votings.show',[1])}}" class="badge badge-success"><i
                                    class="fas fa-eye"></i></a>
                            <a href="#" class="badge badge-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
@endsection
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Video title : Comman Man</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <video width="100%" height="300" controls>
                    <source src="movie.mp4" type="video/mp4">
                </video>
            </div>

        </div>
    </div>
</div>