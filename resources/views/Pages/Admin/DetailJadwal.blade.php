@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', "Mapel Kelas $Kelas ")
@section('content')

<h1 class="h3 mb-2 text-gray-800 text-center">Daftar Mapel Kelas {{ $Kelas }}</h1>

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
        Mapel kelas berhasil di hapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('Verorr'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Mapel kelas sudah ada!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Mapel Kelas {{ $Kelas }}</h6>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <a href="{{ route('jadwal') }}" class="btn btn-warning btn-sm d-inline">Kembali</a>
            <form action="/admin/tambah-mapel-kelas-{{ str_replace(' ', '-', $Kelas) }}" method="post" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm">
                    Tambah Mapel
                </button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="col-1">No</th>
                        <th class="col-3">Mata Pelajaran</th>
                        <th class="col-2">Guru Mapel</th>
                        <th class="col-2">Produktif</th>
                        <th class="col-2">Action</th>
                    </tr>
                </thead>

                @php
                    $no = 1;
                @endphp
                
                @foreach ($jadwal as $j)
                    
                <tbody>
                    <tr>
                        <td class="col-1 text-center">{{ $no++ }}</td>
                        <td class="col-3">{{ $j->mapel }}</td>
                        <td class="col-2">{{ $j->name }}</td>
                        <td class="col-2">
                            @if ($j->produktif == 0)
                                {{ 'TIDAK' }}
                            @else
                                {{ 'YA' }}
                            @endif
                        </td>
                        <td class="col-2">
                            <center>
                                <form action="/admin/delete-mapel-kelas-{{ str_replace(' ', '-', $j->kelas) }}/{{ $j->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i> Hapus
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