@extends('admin.layouts.header')
@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-1 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-1 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark">Pages</a>
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
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">All Client List </h6>
                        </div>
                    </div>

                    <div class="card-body px-1 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        @if ($clients->isEmpty())
                                        <h6 class="text-uppercase m-4 text-sm">No record found</h6>

                                        @else
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-10">
                                            Serial No.</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Phone</th>

                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Domain</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>


                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Action</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Pages</th>
                                        <!-- Button trigger modal -->


                                        <!-- Modal -->

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=0;
                                    @endphp
                                    @foreach ($clients as $client )

                                    @php
                                    $i++;
                                    @endphp
                                    <div class="modal modal-fullscreen-sm-down fade" id="client-view{{ $client->id }}"
                                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $client->name
                                                        }}
                                                    </h1>
                                                    <button type="button" class="btn-close text-dark"
                                                        data-bs-dismiss="modal" aria-label="Close"><i
                                                            class="material-icons me-2">close</i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body px-1 pb-2">
                                                        <div class="card-body">
                                                            <div class="container">
                                                                <form role="form" class="text-start col-md-12"
                                                                    action="{{ route('admin.add.client.post') }}"
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
                                                                            <label>Name</label>
                                                                            <div
                                                                                class="input-group input-group-outline my-1">
                                                                                <input type="text" class="form-control"
                                                                                    name="name"
                                                                                    value="{{ $client->name }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Email</label>
                                                                            <div
                                                                                class="input-group input-group-outline  my-1">
                                                                                <input type="email" class="form-control"
                                                                                    name="email" readonly
                                                                                    value="{{ $client->email }}">
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Phone</label>

                                                                            <div
                                                                                class="input-group input-group-outline  my-1">
                                                                                <input type="tel" class="form-control"
                                                                                    name="phone" readonly
                                                                                    value="{{ $client->phone }}">
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Package</label>

                                                                            <div
                                                                                class="input-group input-group-outline  my-1">
                                                                                <input type="text" class="form-control"
                                                                                    name="package" readonly
                                                                                    value="{{ $client->package }}">

                                                                            </div>

                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Website Link</label>

                                                                            <div
                                                                                class="input-group input-group-outline   my-1">
                                                                                <input type="text" class="form-control"
                                                                                    name="website_link" readonly
                                                                                    value="{{ $client->website_link }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Domain Name</label>

                                                                            <div
                                                                                class="input-group input-group-outline   my-1">
                                                                                <input type="text" class="form-control"
                                                                                    name="api_link" readonly
                                                                                    value="{{ $client->api_link }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label>Adress</label>

                                                                            <div
                                                                                class="input-group input-group-outline   my-1">
                                                                                <textarea name="address" id="" cols="30"
                                                                                    rows="10" class="form-control"
                                                                                    readonly>{{ $client->address }}</textarea>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-4 py-1">
                                                <div class="d-flex justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $i }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $client->name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $client->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-sm">{{ $client->phone }}</p>
                                        </td>

                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 text-sm">{{ $client->api_link }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span
                                                class="badge badge-sm @if($client->status==1) bg-gradient-success @else bg-gradient-dark @endif">@if($client->status==1)
                                                onilne @else offilne @endif</span>
                                        </td>

                                        <form action="{{ route('adm.delete.client', ['clientId' => $client->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this client record?')">
                                            <td class="align-middle text-center">

                                                @csrf
                                                @method('DELETE')
                                                <!-- This is necessary to specify the DELETE HTTP method -->
                                                <button type="submit"
                                                    class="btn btn-link text-danger text-gradient px-1 mb-0">
                                                    <i class="material-icons text-sm me-2">delete</i>
                                                </button>
                                        </form>

                                        <a href="{{ route('admin.edit.client.get', ['clientId' => $client->id]) }}"
                                            class="btn btn-link text-dark px-1 mb-0"><i
                                                class="material-icons text-sm me-2">edit</i></a>
                                        <a class="btn btn-link text-warning text-gradient px-1 mb-0"
                                            data-bs-toggle="modal" data-bs-target="#client-view{{ $client->id }}"><i
                                                class="material-icons   me-2">visibility</i></a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ route('admin.add.website.page.get',['clientId'=>$client->id]) }}"
                                                class="btn btn-link text-success text-gradient px-3 mb-0">
                                                <i class="material-icons  me-2">add</i><strong>{{ "[".$pageCounts[$client->id]."]" }}</strong>
                                            </a>
                                        </td>
                                    </tr>

                                    @endforeach

                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button id="successfully" class="btn bg-gradient-danger toast-btn d-none" type="button"
            data-target="successToast"></button>
        <div class="position-fixed bottom-1 end-1 z-index-2">

            <div class="toast fade p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="successToast"
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
                    @if (session('success'))
                    {{ session('success') }}
                    @endif

                </div>
            </div>
        </div>

        @endsection
