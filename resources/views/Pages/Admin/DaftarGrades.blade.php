@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', 'Daftar Tingkatan')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Daftar Tingkatan</h1>

@if (session('berhasil'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Data Tingkatan berhasil di tambahkan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('edit'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Data Tingkatan berhasil di edit
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('hapus'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Data Tingkatan berhasil di hapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Tingkatan</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('addGrades') }}" class="btn btn-primary btn-sm mb-4">
            Tambah Data
        </a>
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="col-1">No</th>
                        <th class="col-3">Tingkatan</th>
                        <th class="col-3">Action</th>
                    </tr>
                </thead>

                @php
                    $no = 1;
                @endphp
                
                @foreach ($grade as $g)
                    
                <tbody>
                    <tr>
                        <td class="col-1 text-center">{{ $no++ }}</td>
                        <td class="col-3">{{ $g->grade }}</td>
                        <td class="col-3">
                            <center>
                                <a href="/admin/edit-daftar-tingkatan/{{ Crypt::encrypt($g->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                                <form action="/admin/delete-daftar-tingkatan/{{ Crypt::encrypt($g->id) }}" method="POST" class="d-inline">
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