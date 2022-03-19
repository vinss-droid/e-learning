@extends('errors.layouts.Errors')
@section('title-error', '404 Not Found')
@section('content')
    <div class="container">
        <div class="row justify-content-center row-404 align-items-center">
           <div class="col-md-8">
               <center>
                   <div class="
                    animate__animated animate__bounce animate__slow animate__infinite
                   ">
                        <img src="{{ asset('svg/404.svg') }}" alt="404" width="80%" class="img-404">
                   </div>
               </center>
               <h1 class="text-center fw-bold text-404">Page Not Found <i class="far fa-frown-open"></i></h1>
               <center>
                    <a href="/" class="btn btn-error-home" data-bs-toggle="tooltip" data-bs-placement="right" title="Kembali Ke Halaman Utama"><i class="fas fa-home"></i> Back To Home</a>
               </center>
           </div>
        </div>
    </div>
@endsection
