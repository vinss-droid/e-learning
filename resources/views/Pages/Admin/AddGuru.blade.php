@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', 'Tambah Guru')
@section('content')

<h1 class="h3 mb-2 text-secondary text-center">Tambah Guru</h1>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-12 col-md-12 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Guru</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('guru') }}" class="btn btn-warning btn-sm mb-4">Kembali</a>
                    <form action="{{ route('saveGuru') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <span class="">Nama</span>
                                    <input type="text" class="form-control mt-3 @error('name')
                                        is-invalid
                                    @enderror " placeholder="Masukkan Nama Guru" aria-label="Username" aria-describedby="basic-addon1" autofocus value="{{ old('name') }}" name="name">
        
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        
                                </div>
                    
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <span class="">Email</span>
                                    <input type="text" class="form-control mt-3 @error('email')
                                    is-invalid
                                @enderror" placeholder="Masukkan Email Guru" aria-label="Username" aria-describedby="basic-addon1" value="{{ old('email') }}" name="email">
        
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <span class="">Tingkatan</span>
                                    <select name="grade" class="custom-select mt-3 @error('grade')
                                    is-invalid
                                @enderror">
                                        {{-- <option value="" selected>--- Pilih Tingkatan ---</option> --}}
                                        @foreach ($grade as $g)
                                            @if ($g->grade == 'guru')
                                                <option value="{{ $g->id }}" selected>{{ $g->grade }}</option>
                                            @elseif ($g->grade == 'Guru')
                                                <option value="{{ $g->id }}" selected>{{ $g->grade }}</option>
                                            @elseif ($g->grade == 'GURU')
                                                <option value="{{ $g->id }}" selected>{{ $g->grade }}</option>
                                            @else

                                            @endif
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
                                    <span class="mb-4">Kelas</span>
                                    <br><br>
                                    <select class="form-control @error('kelas')
                                        is-invalid
                                    @enderror" name="kelas" id="kelas" required>
                                        {{-- <option value="" selected>--- Pilih Kelas ---</option> --}}
                                        
                                        @foreach ($kelas as $k)
                                            @if ($k->kelas == 'guru')
                                                <option value="{{ $k->id }}" selected>{{ $k->kelas }}</option>
                                            @elseif ($k->kelas == 'Guru')
                                                <option value="{{ $k->id }}" selected>{{ $k->kelas }}</option>
                                            @elseif ($k->kelas == 'GURU')
                                                <option value="{{ $k->id }}" selected>{{ $k->kelas }}</option>
                                            @else

                                            @endif
                                        @endforeach
                                        
                                    </select>

                                    @error('kelas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <span>Password</span>
                                    <input type="password" name="password" class="form-control mt-3 @error('password')
                                    is-invalid
                                @enderror" placeholder="Masukkan Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <span>Konfirmasi Password</span>
                                    <input type="password" name="password_confirmation" class="form-control mt-3" placeholder="Masukkan Konfirmasi Password">
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