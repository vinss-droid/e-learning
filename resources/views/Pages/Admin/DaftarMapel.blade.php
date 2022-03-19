@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', 'Daftar Mata Pelajaran')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Daftar Mata Pelajaran</h1>

@if (session('berhasil'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Mata Pelajaran berhasil di tambahkan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('edit'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Data Mata Pelajaran pengguna berhasil di edit
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
        <h6 class="m-0 font-weight-bold text-primary">Daftar Mata Pelajaran</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('addMapel') }}" class="btn btn-primary btn-sm mb-4">
            Tambah Data
        </a>
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="col-1">No</th>
                        <th class="col-2">Guru Mapel</th>
                        <th class="col-1">Tingkatan</th>
                        <th class="col-3">Mata Pelajaran</th>
                        <th class="col-2">Produktif</th>
                        <th class="col-3">Action</th>
                    </tr>
                </thead>

                {{-- <tfoot>
                    <th class="col-1">No</th>
                    <th class="col-3">Nama</th>
                    <th class="col-3">Email</th>
                    <th class="col-1">Kelas</th>
                    <th class="col-1">Level</th>
                    <th class="col-2">Action</th>
                </tfoot> --}}

                @php
                    $no = 1;

                    // DB::table('users')
                    // ->rightJoin('')

                @endphp
                
                @foreach ($mapel as $m)
                    
                <tbody>
                    <tr>
                        <td class="col-1 text-center">{{ $no++ }}</td>
                        <td class="col-2">{{ $m->name }}</td>
                        <td class="col-1">{{ $m->grade }}</td>
                        <td class="col-3">
                            {{ $m->mapel }}
                        </td>
                        <td class="col-2">
                            @if ($m->produktif == 0)
                                Non-Produktif
                            @else
                                Produktif
                            @endif
                        </td>
                        <td class="col-3">
                            <center>
                                <a href="/admin/edit-mapel/{{ $m->id }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                                <form action="/admin/delete-mapel/{{ $m->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
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