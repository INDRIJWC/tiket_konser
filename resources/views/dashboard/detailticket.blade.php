@extends('dashboard/master')
@section('header')
<style type="text/css">
    .dataTables_wrapper {
        font-family: tahoma;
        font-size: 13px;
        clear: both;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #009496 !important;
        color: white !important;
        border-radius: 4px;
        border: 1px solid #009496 !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:active {
        background-color: #009496 !important;
        color: white;
    }

    .page-link {
        color: #000 !important;
        background-color: #fff !important;
        border: 1px solid #dee2e6 !important;
    }
</style>
@endsection
@section('content')
<div class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="text-white opacity-5" href="javascript:;">Dashboard</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Checkin</li>
                </ol>
            </nav>
            <div class="collapse navbar-collapse me-md-0 me-sm-4 mt-sm-0 mt-2" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                </div>
                <ul class="navbar-nav justify-content-end">

                    <li class="nav-item d-xl-none ps-3 pe-0 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item d-flex align-items-center"> &nbsp &nbsp
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">

        <div class="row">
            <div class="col-lg-12 mb-lg-0 mb-4 mt-4">
                <div class="card shadow bg-white z-index-2">
                    <div class="card-header ">
                        <h6 class="text-capitalize">Checkin Form</h6>

                    </div>
                    <div class="card-body p-3">
                        <div class="card-body px-0 pb-2">
                            
                            <table class="table table-bordered">
                                <tr>
                                    <td>No Tiket</td>
                                    <td>Nama</td>
                                    <td>Alamat</td>
                                    <td>Status</td>
                                </tr>
                                <tr>
                                    <td>{{$ticket->id}}</td>
                                    <td>{{$ticket->name}}</td>
                                    <td>{{$ticket->address}}</td>
                                    <td>
                                        @if($ticket->checkin == 0)
                                            Belum
                                        @else
                                            Sudah
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection