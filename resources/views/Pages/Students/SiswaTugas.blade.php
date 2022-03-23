@extends('Pages.Layout.Boostrap')
@foreach ($tugas as $t)
    @section('title', "Tugas Mata Pelajaran $Mapel $t->week")
@endforeach
@section('content')
    <div class="container mb-5">
        <div class="row header-row">
            @foreach ($tugas as $t)
                <h2 class="text-center fw-bold">
                    Tugas Mata Pelajaran {{ $Mapel }} {{ $t->week }}
                </h2>
            @endforeach
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
                        <div class="table-responsive">
                            <a href="{{ route('mapel') }}" class="btn btn-warning btn-sm text-white mb-4">Kembali</a>
                            <table class="table table-hover table-striped text-center" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="col-1">No</th>
                                        <th class="col-2">Week</th>
                                        <th class="col-2">Deadline</th>
                                        <th class="col-2">Dibuat Tanggal</th>
                                        <th class="col-3">Aksi</th>
                                    </tr>
                                </thead>

                                @php
                                    $no = 1;
                                @endphp

                                @foreach ($tugas as $t)
                                    <tbody>
                                        <tr>
                                            <td class="col-1">{{ $no++ }}</td>
                                            <td class="col-2">{{ $t->week }}</td>
                                            <td class="col-2">{{ date('d F Y H:i', strtotime($t->deadline)) }} WIB</td>
                                            <td class="col-2">{{ date('d F Y H:i', strtotime($t->created_at)) }}</td>
                                            <td class="col-3">
                                                <a href="/siswa/lihat/tugas-mata-pelajaran-{{ str_replace(' ', '-', $t->mapel) }}/{{ $t->week }}" class="btn btn-warning btn-sm text-white">
                                                    <i class="fa-solid fa-eye"></i> Lihat Tugas
                                                </a>
                                                <a href="/siswa/pengumpulan-tugas/tugas-mata-pelajaran-{{ str_replace(' ', '-', $t->mapel) }}/{{ $t->week }}" class="btn btn-success btn-sm text-white">
                                                    <i class="fa-solid fa-book-open"></i> Pengumpulan Tugas
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
