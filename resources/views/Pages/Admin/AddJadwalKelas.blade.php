@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', "Tambah Mapel Kelas $Kelas")
@section('content')

<h1 class="h3 mb-2 text-secondary text-center">Tambah Mapel Kelas {{ $Kelas }}</h1>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-12 col-md-12 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Mapel Kelas {{ $Kelas }}</h6>
                </div>
                <div class="card-body">

                    <form action="/admin/mapel-kelas/daftar-mapel-{{ str_replace(' ', '-', $Kelas) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm mb-4">Kembali</button>
                    </form>

                    @if (session('Verorr'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Mata pelajaran kelas sudah ada.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    @endif

                    <form action="/admin/save-mapel-kelas-{{ str_replace(' ', '-', $Kelas) }}" method="POST">
                        @csrf
                        
                        <div class="row">

                            {{-- <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <span class="">Tingkatan</span>
                                    <br>
                                    <select name="grade" id="grade" class="form-control @error('grade')
                                        is-invalid
                                    @enderror" required>

                                        <option value="" selected>---- Pilih Tingkatan</option>

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
                            </div> --}}
                            
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <span class="">Mata Pelajaran</span>
                                    {{-- <br> --}}
                                    <select name="mapel" id="mapel" class="form-control @error('mapel')
                                        is-invalid
                                    @enderror" required>

                                        <option value="" selected>---- Pilih Mata Pelajaran</option>

                                        @foreach ($mapel as $m)
                                            <option value="{{ $m->id }}">{{ $m->mapel }}</option>
                                        @endforeach

                                    </select>

                                    @error('mapel')

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
            $('#grade').select2({
                theme: "bootstrap-5",
                width: 'resolve',
                placeholder: "---- Pilih Tingkatan ----"
            });
            $('#mapel').select2({
                theme: "bootstrap-5",
                width: 'resolve',
                placeholder: "---- Pilih Mata Pelajaran ----"
            });
        });
    </script>
@endsection