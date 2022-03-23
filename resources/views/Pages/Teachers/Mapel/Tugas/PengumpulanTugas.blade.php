@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', "Guru - Pengumpualan Tugas Mata Pelajaran $Mapel $week")
@section('content')

<h1 class="h3 mb-2 text-gray-800 text-center">Pengumpualan Tugas Mata Pelajaran {{ $Mapel }} {{ $week }}</h1>

@if (session('berhasil'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Tugas Mata Pelajaran {{ $Mapel }} berhasil di tambahkan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('edit'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Data kelas berhasil di edit
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('hapus'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Data Mata Pelajaran berhasil di hapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengumpualan Tugas Mata Pelajaran {{ $Mapel }} {{ $week }}</h6>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <a href="/guru/mata-pelajaran/{{ $grade }}/tugas-mata-pelajaran-{{ str_replace(' ', '-', $Mapel) }}" class="btn btn-warning btn-sm">
                Kembali
            </a>
        </div>
        
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($kelas as $k)
                    @if ($k->kelas == '')
                        <h3 class="text-center font-weight-bold">Data kelas tidak ada</h3>
                    @else
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <a href="/guru/mata-pelajaran/pengumpulan-tugas/{{ $grade }}/tugas-mata-pelajaran-{{ str_replace(' ', '-', $Mapel) }}/{{ $week }}/{{ str_replace(' ', '-', $k->kelas) }}" class="text-decoration-none">
                                <div class="card shadow-lg bg-primary">
                                    <div class="card-body">
                                        <h5 class="text-center text-white font-weight-bold pt-1">{{ $k->kelas }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

    </div>
</div>

@endsection