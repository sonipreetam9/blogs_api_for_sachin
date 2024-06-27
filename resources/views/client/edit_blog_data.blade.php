@extends('client.layouts.header')
@section('content')
@php
$decode_data=base64_decode($blogData->bdata);
@endphp
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">


    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Dashboard</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group input-group-outline">
                        <label class="form-label">Type here...</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center mx-3">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>


                    <li class="nav-item d-flex align-items-center">
                        <a href="" class="nav-link text-body font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none"> @if (Auth::guard('client')->check())
                                {{ Auth::guard('client')->user()->name }}
                                @endif</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">


        <div class="row mb-4 mt-4">
            <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6><i class="material-icons me-2 ">edit</i> Edit Blog Data</h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="card-body">
                            <div class="container">
                                <form role="form" class="text-start col-md-12"
                                    action="{{ route('client.edit.blog.extra.data.post') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <style>
                                        .error {
                                            color: red;
                                            font-size: 14px;
                                        }
                                    </style>

                                    <div class="row">
                                        <input type="hidden" name="blog_id" value="{{ $blog_id }}">
                                        <input type="hidden" name="id" value="{{ $blogData->id }}">
                                        <div class="col-md-12">
                                            <label for="heading">Heading</label>
                                            <div class="input-group input-group-outline my-3 col-md-3">
                                                <input type="text" class="form-control" name="heading" required
                                                    value="{{ old('title',$blogData->heading) }}" placeholder="Heading"
                                                    autofocus id="heading">
                                            </div>
                                            @if ($errors->has('heading'))
                                            <p class=" p-0 m-0">
                                                <li class="error">{{ $errors->first('heading') }}</li>
                                            </p>
                                            @endif

                                        </div>
                                        <div class="col-md-12">
                                            <label for="data">Data</label>
                                            <div class="input-group input-group-outline my-3 col-md-3">
                                                <textarea class="form-control" id="summernote" rows="40" name="data"
                                                    required placeholder="Seo Description"
                                                    id="seo">{!! old('data',$decode_data) !!}</textarea>
                                            </div>
                                            @if ($errors->has('data'))
                                            <p class=" p-0 m-0">
                                                <li class="error">{{ $errors->first('data') }}</li>
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn bg-gradient-primary w-50 my-4 mb-2">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <button id="successfully" class="btn bg-gradient-success toast-btn d-none" type="button"
            data-target="successToast"></button>
        <div class="position-fixed bottom-1 end-1 z-index-2">

            <div class="toast fade p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="successToast"
                aria-atomic="true">
                <div class="toast-header border-0">
                    <i class="material-icons text-success me-2">
                        added
                    </i>
                    <span class="me-auto text-gradient text-success font-weight-bold">Success</span>
                    <small class="text-body">Added</small>
                    <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
                </div>
                <hr class="horizontal dark m-0">
                <div class="toast-body">
                    @if (session('success'))
                    {{ session('success') }}
                    @endif

                </div>
            </div>
        </div>
        <button id="successfullydeleted" class="btn bg-gradient-danger toast-btn d-none" type="button"
            data-target="dangerToast"></button>
        <div class="position-fixed bottom-1 end-1 z-index-2">

            <div class="toast fade p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="dangerToast"
                aria-atomic="true">
                <div class="toast-header border-0">
                    <i class="material-icons text-danger me-2">
                        delete
                    </i>
                    <span class="me-auto text-gradient text-danger font-weight-bold">Success</span>
                    <small class="text-body">Deleted</small>
                    <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
                </div>
                <hr class="horizontal dark m-0">
                <div class="toast-body">
                    @if (session('success-deleted'))
                    {{ session('success-deleted') }}
                    @endif

                </div>
            </div>
        </div>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
        <!-- Summernote JS -->
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
        <script>
            $('#summernote').summernote({
        tabsize: 3,
        height: 400,
     });
        </script>
        @endsection
