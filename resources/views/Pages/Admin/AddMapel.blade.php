@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', 'Tambah Mata Pelajaran')
@section('content')

<h1 class="h3 mb-2 text-secondary text-center">Tambah Mata Pelajaran</h1>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-12 col-md-12 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Mata Pelajaran</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin-mapel') }}" class="btn btn-warning btn-sm mb-4">Kembali</a>
                    <form action="{{ route('saveMapel') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <span class="">Nama Guru</span>
                                    <select name="guru" id="guru" class="form-control @error('guru')
                                        is-invalid
                                    @enderror">
                                        <option value="" selected>--- Pilih Guru Mapel ---</option>
                                            @foreach ($guru as $gu)
                                                <option value="{{ $gu->id }}">{{ $gu->name }}</option>
                                            @endforeach
                                    </select>
        
                                    @error('guru')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        
                                </div>
                    
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <span class="">Mata Pelajaran</span>
                                    <input type="text" name="mapel" class="form-control @error('mapel')
                                        is-invalid
                                    @enderror" placeholder="Masukkan Nama Mata Pelajaran" value="{{ old('mapel') }}">
        
                                    @error('mapel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <span class="">Tingkatan</span>
                                    <select name="grade" id="grade" class="custom-select @error('grade')
                                        is-invalid
                                    @enderror">
                                        <option value="" selected>--- Pilih Tingkatan ---</option>
                                            @foreach ($grade as $g)
                                                <option value="{{ $g->id }}">{{ $g->grade }}</option>
                                            @endforeach
                                    </select>
        
                                    @error('grade')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <span>Mapel Produktif ?</span>
                                    <select name="produktif" class="custom-select @error('produktif')
                                        is-invalid
                                    @enderror">
                                        <option value="" selected>--- Pilih Jawaban ---</option>
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>

                                    @error('produktif')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <span class="mb-4">Gambar Mata Pelajaran</span>
                                    <input type="file" name="img" class="form-control @error('img')
                                        is-invalid
                                    @enderror" accept=".png, .jpg, .jpeg">

                                    @error('img')
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
            $('#guru').select2({
                theme: "bootstrap-5",
                width: 'resolve'
            });
        });
    </script>
@endsection