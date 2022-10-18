@extends('layout')

<style>
  @import url('https://fonts.googleapis.com/css?family=Oswald');
* {
    margin: 0;
    padding: 0;
    border: 0;
    box-sizing: border-box
}

body {
    background-color: #dadde6;
    font-family: arial
}

.fl-left {
    float: left
}

.fl-right {
    float: right
}

h1 {
    text-transform: uppercase;
    font-weight: 900;
    border-left: 10px solid #fec500;
    padding-left: 10px;
    margin-bottom: 30px
}

.row {
    overflow: hidden
}

.card {
    display: table-row;
    width: 100%;
    background-color: #fff;
    color: #989898;
    margin-bottom: 10px;
    font-family: 'Oswald', sans-serif;
    text-transform: uppercase;
    border-radius: 4px;
    position: relative
}



.date {
    display: table-cell;
    width: 100%;
    position: relative;
    text-align: center;
}

.date:before,


.date:after {
    top: auto;
    bottom: -15px
}

.date time {
    display: block;
    position: absolute;
    top: 100%;
    left: 100%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%)
}

.date time span {
    display: block
}

.date time span:first-child {
    color: #2b2b2b;
    font-weight: 600;
    font-size: 250%
}

.date time span:last-child {
    text-transform: uppercase;
    font-weight: 600;
    margin-top: -10px
}

.card-cont {
    display: table-cell;
    width: 100%;
    font-size: 85%;
    padding: 10px 10px 30px 50px
}

.card-cont h3 {
    color: #3C3C3C;
    font-size: 130%
}

.row:last-child .card:last-of-type .card-cont h3 {
    text-decoration: line-through
}

.card-cont>div {
    display: table-row
}

.card-cont .even-date i,
.card-cont .even-info i,
.card-cont .even-date time,
.card-cont .even-info p {
    display: table-cell
}

.card-cont .even-date i,
.card-cont .even-info i {
    padding: 5% 5% 0 0
}

.card-cont .even-info p {
    padding: 30px 50px 0 0
}

.card-cont .even-date time span {
    display: block
}

.card-cont a {
    display: block;
    text-decoration: none;
    width: 100px;
    height: 30px;
    background-color: #D8DDE0;
    color: #fff;
    text-align: center;
    line-height: 30px;
    border-radius: 2px;
    position: absolute;
    right: 10px;
    bottom: 10px
}

.row:last-child .card:first-child .card-cont a {
    background-color: #037FDD
}

.row:last-child .card:last-child .card-cont a {
    background-color: #F8504C
}

@media screen and (max-width: 860px) {
    .card {
        display: block;
        float: none;
        width: 100%;
        margin-bottom: 10px
    }
    .card+.card {
        margin-left: 0
    }
    .card-cont .even-date,
    .card-cont .even-info {
        font-size: 75%
    }
}
</style>
@section('content')
<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.html">
              Konser nih ye
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">  
              </ul>
              <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                  <a href="{{url('login')}}" class="btn btn-sm mb-0 me-1 btn-primary">
                    <i class="fas fa-key opacity-9 text-white me-1"></i>
                    Sign In
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            
            <div class="col-xl-4 col-lg-5 col-md-7 mt-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <!--Alert-->
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
                <!--End Alert-->
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Tiket</h4>
                  <p class="mb-0">Ini tiket kamu dong ...</p>
                </div>
                <div class="card-body">
                <article class="card fl-left">
                  <section class="date">
                    <time datetime="23th feb">
                      <span>28</span><span>Dec</span>
                    </time>
                  </section>
                  <section class="card-cont">
                    <small>dj Butterfly</small>
                    <h3>live in bandung</h3>
                    <div class="even-date">
                    <i class="fa fa-calendar"></i>
                    <time>
                      <span> | wednesday 28 december 2022</span>
                      <span> | 08:55pm to 12:00 am</span>
                    </time>
                    </div>
                    <div class="even-info">
                      <i class="fa fa-ticket"></i> 
                      <p> 
                        | No. ticket : {{$id}}
                      </p>
                    </div>
                    <div class="even-info">
                      <i class="fa fa-user"></i> 
                      <p> 
                        | {{$name}}
                      </p>
                    </div>
                    <a href="#">tickets</a>
                  </section>
                </article>
                </div>
                
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative h-100  border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style='background-image: url("{{asset("assets/img/banner.jpg")}}"); background-size: cover; margin: 10px;'>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection