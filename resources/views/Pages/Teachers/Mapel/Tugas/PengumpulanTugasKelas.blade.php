@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', "Guru - Pengumpualan Tugas Mata Pelajaran $Mapel $week ")
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
            <a href="/guru/mata-pelajaran/pengumpulan-tugas/{{ $grade }}/tugas-mata-pelajaran-{{ str_replace(' ','-', $Mapel) }}/{{ $week }}" class="btn btn-warning btn-sm">
                Kembali
            </a>
            <a href="/guru/mata-pelajaran/report-tugas/{{ $grade }}/tugas-mata-pelajaran-{{ str_replace(' ','-', $Mapel) }}/{{ $week }}/{{ str_replace(' ', '-', $Kelas) }}" class="btn btn-success btn-sm">Download Laporan Kelas Excel</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="col-1">No</th>
                        <th class="col-2">Week Tugas</th>
                        <th class="col-2">Nama Siswa</th>
                        <th class="col-2">Dikumpulkan Tanggal</th>
                        <th class="col-3">Action</th>
                    </tr>
                </thead>

                @php
                    $no = 1;
                @endphp
                
                @foreach ($kelas as $k)
                    
                <tbody>
                    <tr>
                        <td class="col-1 text-center">{{ $no++ }}</td>
                        <td class="col-2">{{ $k->week }}</td>
                        <td class="col-2">{{ $k->name }}</td>
                        <td class="col-2">
                            {{ date('d F Y H:i:s', strtotime($k->created_at)) }}
                        </td>
                        <td class="col-3">
                            <center>
                                <a href="/guru/mata-pelajaran/download-tugas/{{ $grade }}/tugas-mata-pelajaran-{{ str_replace(' ', '-', $Mapel) }}/{{ $week }}/{{ str_replace(' ', '-', $Kelas) }}/{{ $k->id_siswa }}" class="btn btn-success btn-sm">
                                    <i class="fa-solid fa-download"></i> Download Tugas
                                </a>
                            </center>
                        </td>
                    </tr>
                </tbody>

                @endforeach

            </table>
        </div>
    </div>
</div>

@endsection