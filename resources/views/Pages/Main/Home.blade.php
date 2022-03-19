@extends('Pages.Layout.Boostrap')
@section('title', 'Beranda')
@section('content')


    <div class="effect-wrap">
        <i class="fas fa-plus effect effect-1"></i>
        <i class="fas fa-plus effect effect-2"></i>
    </div>

    <div class="container">
        <div class="row header-row">
            <div class="col-md-5">
                <div
                    data-aos="fade-down"
                    data-aos-offset="50"
                    data-aos-duration="2000"
                >
                    <h1 class="text-dark mb-4 e-learning fw-bold">{{ strtoupper('TELS-Learning') }}</h1>
                    <h5 class="text-dark mt-3 deskripsi">{{ ucwords('Tels-Learning Adalah E-Learning untuk siswa-siswi') }}  <strong>{{ strtoupper('smk telekomunikasi telesandi bekasi.')  }}</strong> </h5>
                    <a href="{{ route('mapel') }}" class="btn btn-primary btn-belajar" id="btn-belajar">Mulai Belajar !</a>
                </div>
            </div>
            <div class="col-md-7" align="right">
                    <div
                        data-aos="zoom-in-down"
                        data-aos-duration="1500"
                    >
                    <div class="animate__animated animate__pulse animate__infinite animate__slow">
                        <img src="{{ asset('svg/E-Learning.svg') }}" alt="E-Learning" width="70%" class="e-learning">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="particle"></div>

    <div class="container">
        <div class="row" id="about">
            <div 
                data-aos="fade-down"
                data-aos-offset="250"
                data-aos-delay="200"
            >
                    <h2 class="text-center fw-bold about">About TELS-Learning</h2>
                    <center>
                        <hr class="hr-about">
                    </center>
            </div>
        </div>
        <div class="row about-content">
            <div class="col-md-6 justify-content-center">
                <div
                    data-aos="zoom-in"
                    data-aos-offset="380"
                >
                    <img src="{{ asset('svg/About.svg') }}" alt="About" width="80%">
                </div>
            </div>
            <div class="col-md-6">
                <div 
                    data-aos="fade-left"
                    data-aos-offset="300"
                    data-aos-duration="1500"
                >
                    <p class="text-justify about-deskripsi">Tels-Learning Adalah E-Learning <strong>SMK TELEKOMUNIKASI TELESANDI BEKASI.</strong> Tels-Learning ini di buat untuk mempermudah Siswa-Siswi <strong>SMK TELEKOMUNIKASI TELESANDI BEKASI</strong> dalam Pembelajaran Jarak Jauh Pada saat masa Pandemi Covid-19 ini, dan juga menjadaikan Tels-Learning ini sebagai media pembelajaran online di dalam perkembangan Teknologi pada saat ini. </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-mapel">
        <div class="container">
            <div class="row row-mapel" id="mapel"
                data-aos="fade-down"
            >
                <div>
                    <h2 class="text-center fw-bold mapel">Mata Pelajaran</h2>
                    <center>
                        <hr class="hr-mapel">
                    </center>
                </div>
            </div>
            <div class="lht-sm" align="right"
                data-aos="fade-up-left"
            >
                <a href="{{ route('mapel') }}" class="btn btn-outline-primary text-decoration-none lht ms-auto">Lihat Semua</a>
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
                <div class="col-md-3">
                    <div class="card shadow mpl-hm"
                        data-aos="fade-down"
                        data-aos-delay="70"
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
                <div class="col-md-3">
                    <div class="card shadow mpl-hm"
                        data-aos="fade-down"
                        data-aos-delay="90"
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
                <div class="col-md-3">
                    <div class="card shadow mpl-hm"
                        data-aos="fade-down"
                        data-aos-delay="110"
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
                <div class="col-md-3 mt-4">
                    <div class="card shadow mpl-hm"
                        data-aos="fade-down"
                        data-aos-delay="130"
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
                <div class="col-md-3 mt-4">
                    <div class="card shadow mpl-hm"
                        data-aos="fade-down"
                        data-aos-delay="150"
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
    </div>

@endsection