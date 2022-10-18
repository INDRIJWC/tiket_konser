@extends('dashboard/master')

  @section('content')
  <div class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-white opacity-5" href="javascript:;">Dashboard</a></li>
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

    $(document).ready(function(){
      fetchRecords();        
    });

    function fetchRecords(){
      $.ajax({
        url: 'recentrequest',
        type: 'get',
        dataType: 'json',
        success: function(response){
          var len = 0;
          $('#salesTable').empty();
          if(response['data'] != null){
            len = response['data'].length;
          }

          if(len > 0){
            for(var i=0; i<len; i++){
              var username = response['data'][i].nama;
              var name = response['data'][i].judul;
              var start = response['data'][i].dateStart;
              var end = response['data'][i].dateEnd;
              var status = response['data'][i].status;
              if (status == "0") {
                var tr_str = "<li class='list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg'>"+
                  "<div class='d-flex align-items-center'>"+
                    "<div class='icon icon-shape icon-sm me-3 bg-gradient-warning shadow text-center'>"+
                      "<i class='fa fa-clock text-white opacity-10'></i>"+
                    "</div>"+
                    "<div class='d-flex flex-column'>"+
                      "<h6 class='mb-1 text-dark text-sm'>"+name+"</h6>"+
                      "<span class='text-xs'>"+username+", <span class='font-weight-bold'>Waiting for approval</span></span>"+
                    "</div>"+
                  "</div>"+
                  "<div class='d-flex'>"+
                    ""+
                  "</div>"+
                "</li>";
                $("#salesTable").append(tr_str);
              }else if(status == "1"){
                var tr_str = "<li class='list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg'>"+
                  "<div class='d-flex align-items-center'>"+
                    "<div class='icon icon-shape icon-sm me-3 bg-gradient-success shadow text-center'>"+
                      "<i class='fa fa-check text-white opacity-10'></i>"+
                    "</div>"+
                    "<div class='d-flex flex-column'>"+
                      "<h6 class='mb-0 text-dark text-sm'>"+name+"</h6>"+
                      "<span class='text-xs'>"+username+"</span>"+
                      "<span class='text-xs'><span class='font-weight-bold'>Start from "+start+" to "+end+"</span></span>"+
                    "</div>"+
                  "</div>"+
                  "<div class='d-flex'>"+
                    ""+
                  "</div>"+
                "</li>";
                $("#salesTable").append(tr_str);
              }else if(status == "2"){
                var tr_str = "<li class='list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg'>"+
                  "<div class='d-flex align-items-center'>"+
                    "<div class='icon icon-shape icon-sm me-3 bg-gradient-danger shadow text-center'>"+
                      "<i class='fa fa-times text-white opacity-10'></i>"+
                    "</div>"+
                    "<div class='d-flex flex-column'>"+
                      "<h6 class='mb-1 text-dark text-sm'>"+name+"</h6>"+
                      "<span class='text-xs'>"+username+", <span class='font-weight-bold'>Rejected</span></span>"+
                    "</div>"+
                  "</div>"+
                  "<div class='d-flex'>"+
                    ""+
                  "</div>"+
                "</li>";
                $("#salesTable").append(tr_str);
              }else if(status == "3"){
                var tr_str = "<li class='list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg'>"+
                  "<div class='d-flex align-items-center'>"+
                    "<div class='icon icon-shape icon-sm me-3 bg-gradient-warning shadow text-center'>"+
                      "<i class='fa fa-trash-alt text-white opacity-10'></i>"+
                    "</div>"+
                    "<div class='d-flex flex-column'>"+
                      "<h6 class='mb-1 text-dark text-sm'>"+name+"</h6>"+
                      "<span class='text-xs'>canceled by "+username+", <span class='font-weight-bold'></span></span>"+
                    "</div>"+
                  "</div>"+
                  "<div class='d-flex'>"+
                    ""+
                  "</div>"+
                "</li>";
                $("#salesTable").append(tr_str);
              }
            }
          }else{
            var tr_str = "<li class='list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg'>"+
                  "<div class='d-flex align-items-center'>"+
                    "<div class='d-flex flex-column'>"+
                      "<center><span class='text-xs'>No Record Found<span class='font-weight-bold'></span></span></center>"+
                    "</div>"+
                  "</div>"+
                "</li>";
                $("#salesTable").append(tr_str);
           }
         }
       });
     }
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
            var requestUrl = "{{url('onleave')}}/"+this.value+"/"+department;


            var table = $('#employeTable').DataTable();
            table.ajax.url( requestUrl ).load();
        });
    }

    $(document).ready(function(){
      var department= $( "#select option:selected" ).val();
      var radios = document.getElementsByName('preiodRadio');
      var valRadio = "";

      for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
          valRadio = radios[i].value;
          break;
        }
      }

      fetchRecordsb(valRadio, department);
    });

    function myFunctionSelect() {
      var radios = document.getElementsByName('preiodRadio');
      var valRadio = "";

      for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
          valRadio = radios[i].value;
          break;
        }
      }

      var department= $( "#select option:selected" ).val();
      var requestUrl = "{{url('onleave')}}/"+valRadio+"/"+department;


      var table = $('#employeTable').DataTable();
      table.ajax.url( requestUrl ).load();
    }


    function fetchRecordsb(id, ket){
      var requestUrl = "{{url('onleave')}}/"+id+"/"+ket;

      $('#employeTable').DataTable({
        scrollY:        500,
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        
        "bLengthChange": false,
        "bFilter": false,
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
            { data: 'judul' },
            { data: 'dateStart' },
            
         ]
      });
      
     }
    </script>
  @endsection