@extends('admin.layouts.header')
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
                            <span class="d-sm-inline d-none">Admin</span>
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
                                <h6><i class="material-icons text-sm me-2">edit</i> Edit Page</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="card-body">
                            <h2 class="text-center">{{ $page->website_page_name }}</h2>
                            <div class="container">
                                <form role="form" class="text-start col-md-12 mt-4"
                                    action="{{ route('admin.edit.website.page.content.post', ['pageId' => $page->id]) }}"
                                    method="POST">
                                    @csrf

                                    <style>
                                        .error {
                                            color: red;
                                            font-size: 14px;
                                        }
                                    </style>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="pagename">Page Name</label>
                                            <div class="input-group input-group-outline my-1 ">
                                                <input type="text" class="form-control" name="page_name" required value="{{ $page->website_page_name }}
                                                " placeholder="Page Name" autofocus id="pagename">
                                            </div>
                                            @if ($errors->has('page_name'))
                                            <p class=" p-0 m-0">
                                                <li class="error">{{ $errors->first('page_name') }}</li>
                                            </p>
                                            @endif

                                        </div>
                                        <div class="col-md-12">
                                            <label for="meta_title">Meta Title</label>
                                            <div class="input-group input-group-outline my-1 ">
                                                <input type="text" class="form-control" name="meta_title" required
                                                    value="{{ $content->meta_title }}" placeholder="Meta Title"
                                                    id="meta_title">
                                            </div>
                                            @if ($errors->has('meta_title'))
                                            <p class=" p-0 m-0">
                                                <li class="error">{{ $errors->first('meta_title') }}</li>
                                            </p>
                                            @endif

                                        </div>
                                        <div class="col-md-12">
                                            <label for="meta_discription">Meta Discription</label>
                                            <div class="input-group input-group-outline my-1 ">
                                                <textarea cols="30" rows="10" type="text" class="form-control"
                                                    name="meta_discription" required placeholder="Meta Keywords"
                                                    id="meta_keywords">{{ $content->meta_discription }}</textarea>
                                            </div>
                                            @if ($errors->has('meta_discription'))
                                            <p class=" p-0 m-0">
                                                <li class="error">{{ $errors->first('meta_discription') }}</li>
                                            </p>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <label for="meta_discription">Meta Keywords</label>
                                            <div class="input-group input-group-outline my-1 ">
                                                <textarea rows="10" cols="30" type="text" class="form-control"
                                                    name="meta_keywords" required placeholder="Meta Keywords"
                                                    id="meta_keywords">{{ $content->meta_keywords }}</textarea>
                                            </div>
                                            @if ($errors->has('meta_keywords'))
                                            <p class=" p-0 m-0">
                                                <li class="error">{{ $errors->first('meta_keywords') }}</li>
                                            </p>
                                            @endif
                                        </div>
                                        {{-- <div class="col-md-12">
                                            <div class="form-check form-switch ps-0">
                                                <input class="form-check-input ms-auto" type="checkbox"
                                                    id="flexSwitchCheckDefault" name="status" @if ($page->status==1)
                                                checked
                                                @endif >
                                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                                    for="flexSwitchCheckDefault">Update Status</label>
                                            </div>
                                        </div> --}}
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
                        update
                    </i>
                    <span class="me-auto text-gradient text-success font-weight-bold">Updated</span>
                    <small class="text-body">Updated</small>
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
