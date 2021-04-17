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
                Film Submited
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.dashboard') }}">Dashboard</li></a>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('admin.filmsubmiteds.index') }}">Filmsubmiteds</li>
                    </a>
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
                                    <th colspan="3" class="block-title">Basic Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 40%;">Name</td>
                                    <td>: </td>
                                    <td>John </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Mobile Number</td>
                                    <td>: </td>
                                    <td>+91 9876543210</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">E-mail ID</td>
                                    <td>: </td>
                                    <td>info@screenfoucs.com</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">DOB</td>
                                    <td>: </td>
                                    <td>20/05/1994</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Country</td>
                                    <td>: </td>
                                    <td>India</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Address</td>
                                    <td>: </td>
                                    <td>No:67 ABC Avenue, 5th Street, Chennai-97.</td>
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
<div class="content">
    <div class="block block-rounded">
        <div class="block-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="block block-rounded">
                        <table class="table table-borderless voting-amt">
                            <thead>
                                <tr class="block-header-default">
                                    <th colspan="3" class="block-title">Film Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 40%;">Director Category</td>
                                    <td>: </td>
                                    <td>Director </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Film Submission Category</td>
                                    <td>: </td>
                                    <td>Direction</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Film Title</td>
                                    <td>: </td>
                                    <td>Comman Man</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Film Language</td>
                                    <td>: </td>
                                    <td>Tamil</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Year Of Production</td>
                                    <td>: </td>
                                    <td>20/02/2021</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Role in Film</td>
                                    <td>: </td>
                                    <td>Drama</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Film Genre</td>
                                    <td>: </td>
                                    <td>Romance</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Film One Line</td>
                                    <td>: </td>
                                    <td>Film One Line</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Film Summary</td>
                                    <td>: </td>
                                    <td>Summary</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Production Company</td>
                                    <td>: </td>
                                    <td>Kanish Production</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Producer</td>
                                    <td>: </td>
                                    <td>Kanish</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Director</td>
                                    <td>: </td>
                                    <td>John Rolph</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Cinematographer</td>
                                    <td>: </td>
                                    <td>P.R Loganathan</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Editor</td>
                                    <td>: </td>
                                    <td>Karthick Selvaraj</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Music Director</td>
                                    <td>: </td>
                                    <td>Yuvan</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Lead Actor</td>
                                    <td>: </td>
                                    <td>Rubesh</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Lead Actress</td>
                                    <td>: </td>
                                    <td>Pranitha</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Supporting Actor</td>
                                    <td>: </td>
                                    <td>P.R Loganathan</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Story & Screenplay</td>
                                    <td>: </td>
                                    <td>Kanish</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Upload Main Banner</td>
                                    <td>: </td>
                                    <td>
                                        <img src="{{ asset('image/banner2.jpg') }}" alt="main-banner"
                                            style="width: 30%;">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Upload Thumbnail</td>
                                    <td>: </td>
                                    <td>
                                        <img src="{{ asset('image/thumbnail-img.jpg') }}" alt="thumbnail"
                                            style="width: 10%;">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Upload Your Film</td>
                                    <td>: </td>
                                    <td>
                                        <video width="100%" height="300" controls>
                                            <source src="movie.mp4" type="video/mp4">
                                        </video>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 40%;">Upload Signed Terms & Conditions</td>
                                    <td>: </td>
                                    <td><img src="{{ asset('image/adobe-pdf.png') }}" alt="Terms-conditions"
                                            style="width: 10%;">
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