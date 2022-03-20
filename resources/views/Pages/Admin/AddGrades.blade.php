@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', 'Tambah Tingkatan')
@section('content')

<h1 class="h3 mb-2 text-secondary text-center">Tambah Tingkatan</h1>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-12 col-md-12 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Tingkatan</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('grades') }}" class="btn btn-warning btn-sm mb-4">Kembali</a>
                    <form action="{{ route('saveGrades') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <span class="">Tingkatan</span>
                                    <input type="text" class="form-control mt-3 @error('grades')
                                        is-invalid
                                    @enderror " placeholder="Masukkan Tingkatan" autofocus value="{{ old('grades') }}" name="grades">
        
                                    @error('grades')
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