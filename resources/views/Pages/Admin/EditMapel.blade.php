@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', 'Edit Mata Pelajaran')
@section('content')

@php
    $kelas = DB::table('mapels')
                    ->join('grades', 'mapels.id_grade', '=', 'grades.id')
                    ->select('grade')
                    ->where('mapels.id', $mapel->id)
                    ->limit(1)
                    ->get();
@endphp

@foreach ($kelas as $k)
    <h1 class="h3 mb-2 text-secondary text-center">Edit Mata Pelajaran {{ $mapel->mapel }} <br> Kelas {{ $k->grade }}</h1>
@endforeach

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-12 col-md-12 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Mata Pelajaran</h6>
                </div>
                <div class="card-body">
                    
                    <div class="mb-3">
                        <a href="{{ route('admin-mapel') }}" class="btn btn-warning btn-sm mb-4 d-inline">Kembali</a>

                        <button type="button" class="btn btn-info btn-sm d-inline" data-toggle="modal" data-target="#img">
                            <i class="fa-solid fa-eye"></i> Lihat Gambar Mapel
                        </button>
                    </div>

                    <form action="/admin/update-mapel/{{ $mapel->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <span class="">Nama Guru</span>
                                    <select name="guru" id="guru" class="form-control @error('guru')
                                        is-invalid
                                    @enderror">
                                        <option value="" selected>--- Pilih Guru Mapel ---</option>
                                            @foreach ($guru as $gu)
                                                <option value="{{ $gu->id }}"
                                                    @if ($gu->id == $mapel->id_guru)
                                                        selected
                                                    @endif>{{ $gu->name }}
                                                </option>
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
                                    @enderror" placeholder="Masukkan Nama Mata Pelajaran" value="{{ $mapel->mapel }}">
        
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
                                                <option value="{{ $g->id }}"
                                                    @if ($g->id == $mapel->id_grade)
                                                        selected
                                                    @endif
                                                    >{{ $g->grade }}
                                                </option>
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
                                        {{-- <option value="" selected>--- Pilih Jawaban ---</option> --}}
                                        @if ($mapel->produktif == 0)
                                            <option value="0" selected>TIDAK</option>
                                            <option value="1">YA</option>
                                        @else
                                            <option value="1" selected>YA</option>
                                            <option value="0">TIDAK</option>
                                        @endif
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

<div class="modal fade" id="img" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          @foreach ($kelas as $k)
            <h5 class="modal-title text-center" id="staticBackdropLabel">Gambar Mata Pelajaran {{ $mapel->mapel }} <br> Kelas {{ $k->grade }}</h5>
          @endforeach
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <img src="{{ asset('gambar_mapel') . '/' . $mapel->img }}" alt="{{ $mapel->img }}" class="img-fluid" width="100%">
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="button" class="btn btn-primary" data-dismiss="modal">Oke</button>
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