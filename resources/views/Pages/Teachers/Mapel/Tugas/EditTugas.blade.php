@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', "Edit Tugas Mapel $Mapel ")
@section('content')

<h1 class="h3 mb-2 text-secondary text-center">Edit Tugas Mapel {{ $Mapel }}</h1>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-12 col-md-12 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Tugas Mapel {{ $Mapel }}</h6>
                </div>
                <div class="card-body">
                    <a href="/guru/mata-pelajaran/lihat/{{ $grade }}/tugas-mata-pelajaran-{{ str_replace(' ', '-', $Mapel) }}/{{ $tugas->week }}" class="btn btn-warning btn-sm mb-4">
                        Kembali
                    </a>
                    
                    <form action="/guru/mata-pelajaran/update/{{ $grade }}/tugas-mata-pelajaran-{{ str_replace(' ', '-', $Mapel) }}/{{ $tugas->week }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <span class="">Week Tugas <span class="text-danger">(Contoh: W-1)</span> </span>
                                    <input type="text" class="form-control mt-3 @error('week')
                                        is-invalid
                                    @enderror " placeholder="Masukkan Week Tugas" autofocus value="{{ $tugas->week }}" name="week">
        
                                    @error('week')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        
                                </div>
                            </div>
                            
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <span class="">Deadline Tugas </span>
                                    <input type="datetime-local" class="form-control mt-3 @error('deadline')
                                        is-invalid
                                    @enderror " placeholder="Masukkan Deadline Tugas" autofocus name="deadline" id="deadline" value="{{ date('Y-m-d\TH:i:s', strtotime($tugas->deadline)) }}">
        
                                    @error('deadline')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        
                                </div>
                            </div>
                            
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <span class="">Judul Tugas</span>
                                    <input type="text" class="form-control mt-3 @error('judul')
                                    is-invalid
                                @enderror" placeholder="Masukkan Judul Tugas" value="{{ $tugas->judul }}" name="judul" value="{{ old('judul') }}">
        
                                    @error('judul')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <span class="">Deskripsi Tugas</span>
                                    <textarea name="deskripsi" cols="20" rows="5" class="form-control @error('deskripsi')
                                        is-invalid
                                    @enderror " placeholder="Masukkan Deskripsi Tugas">{{ $tugas->deskripsi }}</textarea>
        
                                    @error('deskripsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <span class="">Tugas</span>
                                    <input type="text" class="form-control mt-3 @error('tugas')
                                        is-invalid
                                    @enderror" placeholder="Masukkan Tugas" name="tugas" value="{{ $tugas->tugas }}">

                                    @error('tugas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <span >Link Materi <span class="text-danger">(optional)</span></span>
                                    <input type="url" name="link" class="form-control mt-3 @error('link')
                                    is-invalid
                                @enderror" placeholder="Masukkan Link Tugas" value="{{ $tugas->link }}">

                                    @error('link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            
                            {{-- <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <span >File Tugas <span class="text-danger">(optional)</span></span>
                                    <input type="file" name="file" class="form-control mt-3 @error('file')
                                    is-invalid
                                @enderror" placeholder="Masukkan File Tugas" accept=".pdf, .docx" value="{{ $tugas->file }}">

                                    @error('file')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div> --}}

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <span >Link Meeting <span class="text-danger">(optional)</span></span>
                                    <input type="url" name="meet" class="form-control mt-3 @error('meet')
                                    is-invalid
                                @enderror" placeholder="Masukkan Link Meeting" value="{{ $tugas->link_meet }}">

                                    @error('meet')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            
                        </div>
            
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary mt-3 btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('#kelas').select2({
                theme: "bootstrap-5",
                width: 'resolve'
            });
        });
    </script>
@endsection