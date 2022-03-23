@extends('Pages.Layout.Boostrap')
@section('title', 'Mata Pelajaran')
@section('content')
    <div class="container">
        <div class="row header-row">
            <h2 class="text-center fw-bold">
                Daftar Mata Pelajaran
            </h2>
        </div>
        {{-- <div class="row mt-5">
            <div class="col-sm-12 col-md-12 col-lg-4">
                <input type="search" name="" id="searchMapel" class="form-control" placeholder="Cari mata pelajaran..">
            </div>
        </div> --}}
        <div class="row row-mp-items justify-content-center mb-3 mt-5">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-2 py-3">
                                {{-- <div class="container"> --}}
                                    <a type="button" class="text-decoration-none fw-bold" style="width: 100%;">
                                        <div class="card" id="CNproduktif">
                                            <div class="card-body">
                                                <h5 class="text-center pt-2">Non Produktif</h5>
                                            </div>
                                        </div>
                                    </a> <br> <br>

                                    <a type="button" class="text-decoration-none fw-bold" style="width: 100%;">
                                        <div class="card shadow" id="Cproduktif">
                                            <div class="card-body">
                                                <h5 class="text-center pt-2">Produktif</h5>
                                            </div>
                                        </div>
                                    </a>
                                {{-- </div> --}}
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-10" id="Nproduktif">
                                @foreach ($NonProduktif as $p)
                                    <div class="col-md-3">
                                        <div class="card shadow mpl-hm"
                                            data-aos="fade-down"
                                            data-aos-delay="50"
                                        >
                                            <div class="card-header">
                                                <img src="{{ asset('gambar_mapel/') . '/' . $p->img }}" alt="{{ $p->mapel }}" width="100%">
                                            </div>
                                            <div class="card-body">
                                                <h4 class="text-center fw-bold">{{ $p->mapel }}</h4>
                                                <div class="d-grid mt-4">
                                                    <a href="/siswa/tugas-mata-pelajaran-{{ str_replace(' ', '-', $p->mapel) }}" class="btn btn-mpl">Lihat Pelajaran</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="col-sm-12 col-md-12 col-lg-10 d-none" id="produktif">
                                @foreach ($Produktif as $p)
                                    @if ($CProduktif <= 0)
                                        <h3 class="text-center fw-bold">TIDAK ADA MATA PELAJARAN PRODUKTIF</h3>
                                    @else
                                        <div class="col-md-3">
                                            <div class="card shadow mpl-hm"
                                                data-aos="fade-down"
                                                data-aos-delay="50"
                                            >
                                                <div class="card-header">
                                                    <img src="{{ asset('gambar_mapel/') . '/' . $p->img }}" alt="{{ $p->mapel }}" width="100%">
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="text-center fw-bold">{{ $p->mapel }}</h4>
                                                    <div class="d-grid mt-4">
                                                        <a href="/siswa/tugas-mata-pelajaran-{{ str_replace(' ', '-', $p->mapel) }}" class="btn btn-mpl">Lihat Pelajaran</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#CNproduktif').click(function (e) { 
                e.preventDefault();
                $(this).removeClass('shadow');
                $('#Cproduktif').addClass('shadow');
                $('#Nproduktif').removeClass('d-none');
                $('#produktif').addClass('d-none');
            });
            
            $('#Cproduktif').click(function (e) { 
                e.preventDefault();
                $(this).removeClass('shadow');
                $('#Nproduktif').addClass('d-none');
                $('#CNproduktif').addClass('shadow');
                $('#produktif').removeClass('d-none');
            });

        });
    </script>
@endsection
