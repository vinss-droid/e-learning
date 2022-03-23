@extends('Pages.Layout.Boostrap')
@section('title', "Tugas Mata Pelajaran $Mapel $week")
@section('content')
    <div class="container mb-5">
        <div class="row header-row">
            <h2 class="text-center fw-bold">
                Tugas Mata Pelajaran {{ $Mapel }} {{ $week }}
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
                        <a href="/siswa/tugas-mata-pelajaran-{{ str_replace(' ', '-', $Mapel) }}" class="btn btn-warning btn-sm mb-3 text-white shadow">Kembali</a>
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="card shadow">
                                    @foreach ($tugas as $t)
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="mt-2">
                                                    <div class="row justify-content-between">
                                                        <div class="col-sm-12 col-md-12 col-lg-4">
                                                            <span class="text-muted fw-bold">Tugas {{ $t->week }}</span>
                                                        </div>
                                                    </div>
                                                    <h3 class="text-center fw-bold mt-2">{{ $t->judul }}</h2>
                                                    <div class="mt-4">
                                                        <p class="text-justify">{{ $t->deskripsi }}</p>
                                                    </div>
                                                    <div class="mt-4" align="right">
                                                        <span class="text-danger"><strong>Deadline : {{ date('d F Y H:i', strtotime($t->deadline)) }} WIB</strong></span>
                                                    </div>
                                                    <div class="mt-2">
                                                        <h5 class="fw-bold">
                                                            Tugas :
                                                        </h5>
                                                        <h6>{{ $t->tugas }}</h6>
                                                    </div>
                                                    <div class="row justify-content-center mb-4">
                                                        <div class="col-sm-12 col-md-12 col-lg-4">
                                                            @if ($t->link != NULL)
                                                                <div class="mt-4">
                                                                    <h5 class="fw-bold text-center">
                                                                        Link Materi :
                                                                    </h5>
                                                                    <center>
                                                                        <a href="{{ $t->link }}" class="btn btn-info btn-sm text-decoration-none btn-block shadow" target="_BLANK"><i class="fa-solid fa-up-right-from-square"></i> Lihat Materi</a>
                                                                    </center>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-sm-12 col-md-12 col-lg-4">
                                                            @if ($t->file != NULL)
                                                                <div class="mt-4">
                                                                    <h5 class="fw-bold text-center">File Materi & Tugas :</h5>
                                                                    <center>
                                                                        <a href="/siswa/download/tugas-mata-pelajaran-{{ $t->mapel }}/{{ $week }}" class="btn btn-success btn-sm btn-block shadow"><i class="fa-solid fa-download"></i> Unduh File</a>
                                                                    </center>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @php
                                                            $Now = date('d-m-Y H:i');
                                                        @endphp
                                                        <div class="col-sm-12 col-md-12 col-lg-4">
                                                            @if ($t->link_meet != NULL)
                                                                @if ($Now > $t->deadline)
                                                                    <div class="mt-4">
                                                                        <h5 class="fw-bold text-center">Link Meeting :</h5>
                                                                        <center>
                                                                            <a href="{{ $t->link_meet }}" class="btn btn-primary btn-sm btn-block disabled shadow" target="_BLANK"><i class="fa-solid fa-up-right-from-square"></i> Join Meet</a>
                                                                        </center>
                                                                    </div>
                                                                @else
                                                                    <div class="mt-4">
                                                                        <h5 class="fw-bold text-center">Link Meeting :</h5>
                                                                        <center>
                                                                            <a href="{{ $t->link_meet }}" class="btn btn-primary btn-sm btn-block shadow" target="_BLANK"><i class="fa-solid fa-up-right-from-square"></i> Join Meet</a>
                                                                        </center>
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="mt-5">
                                                        <div align="left" class="d-inline">
                                                            <span class="text-muted">Dibuat Tanggal <strong>{{ date('d F Y H:i', strtotime($t->created_at)) }}</strong> </span>
                                                        </div>
                                                        <div align="right" class="d-inline" style="margin-left: 28%;">
                                                            <span class="text-muted">Diubah Tanggal <strong>{{ date('d F Y H:i', strtotime($t->updated_at)) }}</strong> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
