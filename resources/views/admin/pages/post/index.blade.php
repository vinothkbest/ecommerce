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
            <h1 class="flex-sm-fill h3 my-2">Post List</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">Post</li>
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
                <div class="block-header add-btn">
                    <a href="{{ route('admin.posts.create') }}"><i class="fas fa-plus"></i>Add Post</a>
                </div>
            </div>
        </div>
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th style="width: 5%;" class="text-center">S.No</th>
                        <th>Post Name</th>
                        <th>Post Image</th>
                        <th>Posted By</th>
                        <th>Status</th>
                        <th>View</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @php 
                            $words = explode(" ", $post->title ?? '');
                            if(count($words) > 4)
                                $title = implode(' ', array_slice($words, 0, 4)) . " ...";
                            else
                                $title = implode(' ', $words);
                        @endphp
                        <td>{{ $title }}</td>
                        <td><img src="{{ $post->image_path ?? ''}}" width="50px" height="45px"></td>
                        <td>{{ $post->postedBy->name }}</td>
                        {{-- <td>{{ date('d-m-Y h:i:s A', strtotime($post->created_at ?? '')) }}</td> --}}
                        <td>
                            @if($post->status)
                                <a href="{{ route('admin.posts.status', [$post->id]) }}" class="badge badge-success">Active</a>
                            @else
                                <a href="{{ route('admin.posts.status', [$post->id]) }}" class="badge badge-danger">Disable</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.posts.show',[$post->id])}}" class="badge badge-success"><i class="fas fa-eye"></i></a>
                        </td>
                        <td>
                            <a href="{{route('admin.posts.edit',[$post->id])}}" class="badge badge-info"><i class="fas fa-edit"></i></a>
                            <a href="{{route('admin.posts.delete',[$post->id])}}" class="badge badge-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
</div>
<script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

@if(session('success'))

    <script>
        Swal.fire({
          title: "{{session('success')}}",
          icon: 'success',
        })
    </script>

@endif
{{ request()->session()->forget('success') }}
@endsection