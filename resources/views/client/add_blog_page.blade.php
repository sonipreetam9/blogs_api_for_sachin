@extends('client.layouts.header')
@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
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
                                <h6><i class="material-icons me-2 ">add_a_photo</i> Add Blog</h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="card-body">
                            <div class="container">
                                <form role="form" class="text-start col-md-12"
                                    action="{{ route('client.add.blog.post') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <style>
                                        .error {
                                            color: red;
                                            font-size: 14px;
                                        }
                                    </style>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <label for="title">Title</label>
                                            <div class="input-group input-group-outline my-3 col-md-3">
                                                <input type="text" class="form-control" name="title" required
                                                    value="{{ old('title') }}" placeholder="Title" autofocus id="title">
                                            </div>
                                            @if ($errors->has('title'))
                                            <p class=" p-0 m-0">
                                                <li class="error">{{ $errors->first('title') }}</li>
                                            </p>
                                            @endif

                                        </div>
                                        <div class="col-md-6">
                                            <label for="url">Url Link</label>
                                            <div class="input-group input-group-outline my-3 col-md-3">
                                                <input type="text" class="form-control" name="url_link" required
                                                    value="{{ old('url_link') }}" placeholder="Url Link" id="url">
                                            </div>
                                            @if ($errors->has('url_link'))
                                            <p class=" p-0 m-0">
                                                <li class="error">{{ $errors->first('url_link') }}</li>
                                            </p>
                                            @endif

                                        </div>
                                        <div class="col-md-6">
                                            <label for="sa">Short About</label>
                                            <div class="input-group input-group-outline my-3 col-md-3">
                                                <textarea  class="form-control" rows="10" name="short_about" required
                                                     placeholder="Short About" id="sa">{{ old('short_about') }}</textarea>
                                            </div>
                                            @if ($errors->has('short_about'))
                                            <p class=" p-0 m-0">
                                                <li class="error">{{ $errors->first('short_about') }}</li>
                                            </p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label for="seot">Seo Title</label>
                                            <div class="input-group input-group-outline my-3 col-md-3">
                                                <textarea  class="form-control" rows="10" name="blog_seo_title" required
                                                     placeholder="Seo Title" id="seot">{{ old('blog_seo_title') }}</textarea >
                                            </div>
                                            @if ($errors->has('blog_seo_title'))
                                            <p class=" p-0 m-0">
                                                <li class="error">{{ $errors->first('blog_seo_title') }}</li>
                                            </p>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="seo">Seo Description</label>
                                            <div class="input-group input-group-outline my-3 col-md-3">
                                                <textarea  class="form-control" rows="5" name="blog_seo_description" required
                                                     placeholder="Seo Description" id="seo">{{ old('blog_seo_description') }}</textarea>
                                            </div>
                                            @if ($errors->has('blog_seo_description'))
                                            <p class=" p-0 m-0">
                                                <li class="error">{{ $errors->first('blog_seo_description') }}</li>
                                            </p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label for="th">Blog Thumbnail</label>
                                            <div class="input-group input-group-outline my-3 col-md-3">
                                                <input type="file"  class="form-control" rows="5" name="file" required
                                                    value="{{ old('file') }}" accept=".jpg,.jpeg,.svg,.webp,.png" id="th"/>
                                            </div>
                                            @if ($errors->has('file'))
                                            <p class=" p-0 m-0">
                                                <li class="error">{{ $errors->first('file') }}</li>
                                            </p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label for="date">Date</label>
                                            <div class="input-group input-group-outline my-3 col-md-3">
                                                <input type="date"  class="form-control" rows="5" name="date" required
                                                    value="{{ old('date') }}" id="date"/>
                                            </div>
                                            @if ($errors->has('date'))
                                            <p class=" p-0 m-0">
                                                <li class="error">{{ $errors->first('date') }}</li>
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

        @endsection

