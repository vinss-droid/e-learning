@extends('Pages.Layout.Boostrap')
@section('title', "Pengumpulan Tugas Mata Pelajaran $Mapel $week")
@section('content')
    <div class="container mb-5">
        <div class="row header-row">
            <h2 class="text-center fw-bold">
                Pengumpulan Tugas Mata Pelajaran {{ $Mapel }} {{ $week }}
            </h2>
        </div>
        {{-- <div class="row mt-5">
            <div class="col-sm-12 col-md-12 col-lg-4">
                <input type="search" name="" id="searchMapel" class="form-control" placeholder="Cari mata pelajaran..">
            </div>
        </div> --}}
        <div class="row row-mp-items justify-content-center mb-3 mt-5">
            <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="card shadow">
                    <div class="card-body">
                        <a href="/siswa/tugas-mata-pelajaran-{{ str_replace(' ', '-', $Mapel) }}" class="btn btn-warning btn-sm mb-3 text-white shadow">Kembali</a>
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-md-12 col-lg-10">
                                <div class="card shadow mb-4">
                                    <div class="card-body mb-3">
                                        @if ($cekP > 0)
                                            @foreach ($Ptugas as $p)
                                                <h4 class="text-center text-success fw-bold pt-3">
                                                    Anda Sudah Mengumpulkan Tugas <br>
                                                    Pada Tanggal {{ date('d F Y', strtotime($p->created_at)) }} <br>
                                                    Pukul {{ date('H:i:s', strtotime($p->created_at)) }} WIB
                                                </h4>
                                            @endforeach
                                        @else
                                            @foreach ($tugas as $t)
                                                @if ($dateNow <= $t->deadline)
                                                    <span class="text-danger text-center d-block fw-bold">Catatan: Tugas yang sudah disimpan tidak dapat diubah !</span> <br>
                                                    <form action="/siswa/pengumpulan-tugas/tugas-mata-pelajaran-{{ str_replace(' ', '-', $Mapel) }}/{{ $week }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="mb-4">
                                                            <label for="file" class="form-label">File Tugas</label>
                                                            <input type="file" name="file" id="file" class="form-control @error('file')
                                                                is-invalid
                                                            @enderror " accept=".pdf,.docx">
        
                                                            @error('file')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
        
                                                        </div>
                                                        <div class="d-grid">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                @else
                                                    <span class="text-danger text-center d-block fw-bold">Pengumpulan tugas ditutup karna sudah melewati deadline yang ditentukan.</span> <br>
                                                    <form action="/siswa/pengumpulan-tugas/tugas-mata-pelajaran-{{ str_replace(' ', '-', $Mapel) }}/{{ $week }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="mb-4">
                                                            <label for="file" class="form-label">File Tugas</label>
                                                            <input type="file" name="file" id="file" class="form-control @error('file')
                                                                is-invalid
                                                            @enderror " accept=".pdf,.docx" disabled>
        
                                                            @error('file')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
        
                                                        </div>
                                                        <div class="d-grid">
                                                            <button type="submit" class="btn btn-primary">Simpan</button disabled>
                                                        </div>
                                                    </form>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
