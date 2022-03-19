@extends('Pages.Layout.Boostrap')
@section('title', 'Mata Pelajaran')
@section('content')
    <div class="container">
        <div class="row header-row">
            <h2 class="text-center fw-bold">
                Daftar Mata Pelajaran
            </h2>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12 col-md-12 col-lg-4">
                <input type="search" name="" id="searchMapel" class="form-control" placeholder="Cari mata pelajaran..">
            </div>
        </div>
        <div class="row row-mp-items justify-content-center mb-3 mt-5">
            <div class="col-md-3">
                <div class="card shadow mpl-hm"
                    data-aos="fade-down"
                    data-aos-delay="50"
                >
                    <div class="card-header">
                        <img src="{{ asset('icon/svg/inggris.svg') }}" alt="" width="100%">
                    </div>
                    <div class="card-body">
                        <h4 class="text-center fw-bold">B.Inggris</h4>
                        <div class="d-grid mt-4">
                            <a href="" class="btn btn-mpl">Lihat Pelajaran</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection