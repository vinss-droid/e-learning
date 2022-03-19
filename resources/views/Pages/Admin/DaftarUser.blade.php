@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', 'Daftar User')
@section('content')

<h1 class="h3 mb-2 text-gray-800">Daftar Pengguna</h1>

@if (session('berhasil'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Pengguna berhasil di tambahkan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('edit'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Data pengguna berhasil di edit
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif (session('hapus'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Pengguna berhasil di hapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna</h6>
    </div>
    <div class="card-body">
        <a href="{{ route('addUser') }}" class="btn btn-primary btn-sm mb-4">
            Tambah Data
        </a>
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="col-1">No</th>
                        <th class="col-3">Nama</th>
                        <th class="col-2">Email</th>
                        <th class="col-1">Tingkatan</th>
                        <th class="col-1">Kelas</th>
                        <th class="col-1">Level</th>
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
                
                @foreach ($user as $u)
                    
                <tbody>
                    <tr>
                        <td class="col-1 text-center">{{ $no++ }}</td>
                        <td class="col-3">{{ ucwords($u->name) }}</td>
                        <td class="col-2">{{ $u->email }}</td>
                        <td class="col-1">
                            @if ($u->grade == NULL)
                                
                            @endif
                            {{ strtoupper($u->grade) }}
                        </td>
                        <td class="col-1">
                            {{ $u->kelas }}
                        </td>
                        <td class="col-1">{{ ucwords($u->level) }}</td>
                        <td class="col-3">
                            <center>
                                <a href="/admin/edit-user/{{ $u->id }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                                <form action="/admin/delete-user/{{ $u->id }}" method="POST" class="d-inline">
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