@extends('admin.layouts.main')

@section('css_before')
@endsection

@section('js_after')

@endsection

@section('content')

<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Post View
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.posts.index') }}">Post List
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">{{ $post->title ?? ''}}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content">
    <div class="block block-rounded">
        <div class="block-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="block block-rounded">
                        <table class="table table-borderless voting-amt">
                            <thead>
                                <tr class="block-header-default">
                                    <th colspan="3" class="block-title">Post Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 40%;">Category</td>
                                    <td>: </td>
                                    <td>{{ $post->categories[0]->category_name ?? ''}}</td>
                                    
                                </tr>
                                @if(isset($post->categories[1]))
                                <tr>
                                    <td style="width: 40%;">Sub Category</td>
                                    <td>: </td>
                                    <td>{{ $post->categories[1]->category_name ?? ''}}</td>
                                    
                                </tr>
                                @endif
                                @if(isset($post->categories[2]))
                                <tr>
                                    <td style="width: 40%;">Last Sub Category</td>
                                    <td>: </td>
                                    <td>{{ $post->categories[2]->category_name ?? ''}}</td>
                                    
                                </tr>
                                @endif
                                <tr>
                                    <td style="width: 40%;">Image</td>
                                    <td>: </td>
                                    <td><img src="{{ url($post->image_path ?? '') }}" alt="nuts" style="width: 30%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Tags</td>
                                    <td>: </td>
                                    
                                    <td>
                                        @foreach($post->tags as $key=>$post_tag)
                                                @if(count($post->tags)-1 == $key)
                                                {{$post_tag->title ?? ''}}
                                                @else
                                                {{$post_tag->title ?? ''}},
                                                @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Description</td>
                                    <td>: </td>
                                    <td>
                                        {!! $post->description ?? '' !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Posted By</td>
                                    <td>: </td>
                                    <td>{{ $post->postedBy->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Created at</td>
                                    <td>: </td>
                                    <td>{{ date('d-m-Y h:i A', strtotime($post->created_at ?? '')) }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-borderless voting-amt">
                            <thead>
                                <tr class="block-header-default">
                                    <th colspan="3" class="block-title">SEO Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 40%;">Title</td>
                                    <td>: </td>
                                    <td>{{ $post->postSeo->title ?? ''}}</td>
                                    
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Image</td>
                                    <td>: </td>
                                    <td><img src="{{ url($post->postSeo->image_path ?? '') }}" alt="nuts" style="width: 30%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Description</td>
                                    <td>: </td>
                                    <td>
                                        {!! $post->postSeo->description ?? '' !!}
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- END Billing Address -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection