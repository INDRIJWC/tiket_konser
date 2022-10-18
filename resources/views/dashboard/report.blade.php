@extends('dashboard/master')
    @section('header')
  <style type="text/css">
    .dataTables_wrapper {
        font-family: tahoma;
        font-size: 13px;
        clear: both;
    }
    
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: #009496!important;
      color: white!important;
      border-radius: 4px;
      border: 1px solid #009496!important;
    }
     
    .dataTables_wrapper .dataTables_paginate .paginate_button:active {
      background-color: #009496!important;
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
        <div class="col-lg-12 mb-lg-0 mb-4 mt-4">
          <div class="card shadow bg-white z-index-2">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize">Data Pemesan Tiket</h6>
              <div class="row mt-4">
                <div class="col-8">
                </div>
                <div class="col-12">
                  <form name="myForm">
                    <div class="row">
                      <label class="text-sm font-weight-normal">Pilih Status:</label>
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" value="1" type="radio" name="preiodRadio" id="flexRadioDefault1">
                          <label class="form-check-label" for="flexRadioDefault1">
                            Sudah Checkin
                          </label>
                        </div>
                      </div>
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" value="0" type="radio" name="preiodRadio" id="flexRadioDefault2" checked>
                          <label class="form-check-label" for="flexRadioDefault2">
                            Belum Checkin
                          </label>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                  <table class="table align-items-center mb-0" id='orderTable'>
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      </tr>
                    </thead>              
                  </table>
                </div>
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
  @section('footer')

  

  <script>
    
    $body = $("body");

    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }    
    });


    
    </script>
    <script type="text/javascript">

    var rad = document.myForm.preiodRadio;
    var prev = null;
    for (var i = 0; i < rad.length; i++) {
        rad[i].addEventListener('change', function() {
            (prev) ? console.log(prev.value): null;
            if (this !== prev) {
                prev = this;
            }
            var department= $( "#select option:selected" ).val();
            var requestUrl = "{{url('request/data')}}/"+this.value;


            var table = $('#orderTable').DataTable();
            table.ajax.url( requestUrl ).load();
        });
    }

    $(document).ready(function(){
      var radios = document.getElementsByName('preiodRadio');
      var valRadio = "";

      for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
          valRadio = radios[i].value;
          break;
        }
      }
      fetchRecordsb(valRadio);
    });


    function fetchRecordsb(id){
      var requestUrl = "{{url('request/data')}}/"+id;

      $('#orderTable').DataTable({
        scrollY:        500,
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        
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
         columns: [
            { data: 'nama' },
            { data: 'address' },
            { data: 'checkin',
               "render": function(data){
                  if(data == 1){
                    return 'Sudah';
                  }else{
                    return 'Belum';
                  };

                  
               } 
            }
            
         ]
      });
      
     }
    </script>
  @endsection