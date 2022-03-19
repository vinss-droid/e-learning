@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', 'Daftar Kelas')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Daftar Jadwal Kelas</h1>

@if (session('berhasil'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Kelas berhasil di tambahkan
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
        Data kelas berhasil di hapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Jadwal Kelas</h6>
    </div>
    <div class="card-body">
        {{-- <a href="{{ route('addKelas') }}" class="btn btn-primary btn-sm mb-4">
            Tambah Data
        </a> --}}
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="col-1">No</th>
                        <th class="col-3">Kelas</th>
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
                        <td class="col-3">{{ $k->kelas }}</td>
                        <td class="col-3">
                            <center>
                                <form action="/admin/jadwal-kelas/detail-jadwal-{{ str_replace(' ', '-', $k->kelas) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-eye"></i> Lihat Jadwal
                                    </button>
                                </form>
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