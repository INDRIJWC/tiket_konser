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
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Report</li>
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
            @if(Session::has('success'))
            <div class="col-md-12">
                <div class="alert alert-success">
                    <p style="color: white;">{{ Session::get('success') }}</p>
                    @php
                    Session::forget('success');
                    @endphp
                </div>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <p style="color: white;">{{ Session::get('error') }}</p>
                    @php
                    Session::forget('error');
                    @endphp
                </div>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12 mb-lg-0 mb-4 mt-4">
                <div class="card shadow bg-white z-index-2">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Data Pemesan Tiket</h6>
                        <div class="row mt-4">
                            <div class="col-8">
                            </div>
                            <div class="col-12">

                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0" id='orderTable'>
                                    <thead>
                                        <tr>
                                            <th>No Tiket</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="{{ url('/editOrder') }}" class="pt-3">
                        @csrf
                        <div class="modal-header">
                            Info Pemesan
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Nama</label>
                                        <input class="form-control" id="nameacc" name="nama" type="text" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Alamat</label>
                                            <input class="form-control" type="text" name="alamat" id="depacc" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nomor Tiket</label>
                                            <input class="form-control" type="text" name="id" id="idacc" readonly >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </form>
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
@section('footer')

<script type="text/javascript">
    $(document).on("click", ".open-AddAccountDialog", function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var dep = $(this).data('dep');
        $(".modal-body #idacc").val(id);
        $(".modal-body #nameacc").val(name);
        $(".modal-body #depacc").val(dep);
        $(".modal-body #posacc").val(pos);
    });
</script>

<script>
    $body = $("body");
    $(document).on({
        ajaxStart: function() {
            $body.addClass("loading");
        },
        ajaxStop: function() {
            $body.removeClass("loading");
        }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        fetchRecordsb();
    });


    function fetchRecordsb(id) {
        var requestUrl = "{{url('pemesan/data')}}";

        $('#orderTable').DataTable({
            scrollY: 500,
            scrollX: true,
            scrollCollapse: true,
            paging: true,

            "bLengthChange": false,
            "bFilter": true,
            "bInfo": true,
            "bAutoWidth": false,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                method: "GET",
                url: requestUrl,
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'address'
                },
                {
                    data: 'checkin',
                    "render": function(data) {
                        if (data == 1) {
                            return 'Sudah';
                        } else {
                            return 'Belum';
                        };


                    }
                },
                {
                    data: null,
                    "render": function(data, type, row, meta) {
                        utf = btoa(row.id);

                        return '<div class="d-flex"><a class="open-AddAccountDialog icon icon-shape icon-sm bg-gradient-info shadow text-center btn-icon-only btn-rounded btn-sm icon-move-right my-auto" data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript:;" data-id="' + row.id + '" data-name="' + row.nama + '" data-dep="' + row.address + '"><i class="ni ni-bold-right" aria-hidden="true"></i></a></div>' +
                            '<div class="d-flex"><a href="{{url("order/delete")}}/' + utf + '" class="icon icon-shape icon-sm bg-gradient-danger shadow text-center btn-icon-only btn-rounded btn-sm icon-move-right my-auto"><i class="fa fa-trash" aria-hidden="true"></i></a></div>';

                    }
                }

            ]
        });

    }
</script>
@endsection