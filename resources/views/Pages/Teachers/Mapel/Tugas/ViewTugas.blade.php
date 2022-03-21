@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', "Guru - Lihat Tugas Mata Pelajaran $Mapel")
@section('content')

<h1 class="h3 mb-2 text-gray-800 text-center">Tugas Mata Pelajaran {{ $Mapel }}</h1>

@if (session('berhasil'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Tugas Mata Pelajaran {{ $Mapel }} berhasil di tambahkan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('edit'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Data Tugas berhasil di edit
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('hapus'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Data kelas berhasil di hapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tugas Mata Pelajaran {{ $Mapel }}</h6>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <div class="row justify-content-center mt-4">
                <div class="col-sm-12 col-lg-10">
                    <div class="mb-3">
                        <a href="/guru/mata-pelajaran/{{ $grade }}/tugas-mata-pelajaran-{{ str_replace(' ','-', $Mapel) }}" class="btn btn-warning btn-sm shadow">
                            Kembali
                        </a>
                        @foreach ($tugas as $t)
                            <a href="/guru/mata-pelajaran/edit/{{ $grade }}/tugas-mata-pelajaran-{{ str_replace(' ','-', $Mapel) }}/{{ $t->week }}" class="btn btn-primary btn-sm shadow">
                                Edit Tugas
                            </a>
                            <form action="/guru/mata-pelajaran/delete/{{ $grade }}/tugas-mata-pelajaran-{{ str_replace(' ','-', $Mapel) }}/{{ $t->week }}" class="d-inline" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm shadow">
                                    Hapus Tugas
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-10">
                    <div class="card shadow">
                        @foreach ($tugas as $t)
                            <div class="card-body">
                                <div class="container">
                                    <div class="mt-2">
                                        <div class="row justify-content-between">
                                            <div class="col-sm-12 col-md-12 col-lg-4">
                                                <span class="text-muted font-weight-bold">Tugas {{ $t->week }}</span>
                                            </div>
                                        </div>
                                        <h3 class="text-center font-weight-bold mt-2">{{ $t->judul }}</h2>
                                        <div class="mt-4">
                                            <p class="text-justify">{{ $t->deskripsi }}</p>
                                        </div>
                                        <div class="mt-4" align="right">
                                            <span class="text-danger"><strong>Deadline : {{ date('d F Y H:i', strtotime($t->deadline)) }}WIB</strong></span>
                                        </div>
                                        <div class="mt-2">
                                            <h5 class="font-weight-bold">
                                                Tugas :
                                            </h5>
                                            <h6>{{ $t->tugas }}</h6>
                                        </div>
                                        <div class="row justify-content-center mb-4">
                                            <div class="col-sm-12 col-md-12 col-lg-4">
                                                @if ($t->link != NULL)
                                                    <div class="mt-4">
                                                        <h5 class="font-weight-bold text-center">
                                                            Link Materi :
                                                        </h5>
                                                        <a href="{{ $t->link }}" class="btn btn-info btn-sm text-decoration-none btn-block shadow" target="_BLANK"><i class="fa-solid fa-up-right-from-square"></i> Lihat Materi</a>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-4">
                                                @if ($t->file != NULL)
                                                    <div class="mt-4">
                                                        <h5 class="font-weight-bold text-center">File Materi & Tugas :</h5>
                                                        <a href="/guru/mata-pelajaran/download/{{ $grade }}/file-tugas-mata-pelajaran-{{ str_replace(' ','-', $Mapel) }}/{{ $t->week }}" class="btn btn-success btn-sm btn-block shadow"><i class="fa-solid fa-download"></i> Unduh File</a>
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
                                                            <h5 class="font-weight-bold text-center">Link Meeting :</h5>
                                                            <a href="{{ $t->link_meet }}" class="btn btn-primary btn-sm btn-block disabled shadow" target="_BLANK"><i class="fa-solid fa-up-right-from-square"></i> Join Meet</a>
                                                        </div>
                                                    @else
                                                        <div class="mt-4">
                                                            <h5 class="font-weight-bold text-center">Link Meeting :</h5>
                                                            <a href="{{ $t->link_meet }}" class="btn btn-primary btn-sm btn-block shadow" target="_BLANK"><i class="fa-solid fa-up-right-from-square"></i> Join Meet</a>
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

@endsection