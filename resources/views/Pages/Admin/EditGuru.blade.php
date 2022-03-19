@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', 'Edit Guru')
@section('content')

<h1 class="h3 mb-2 text-secondary text-center">Edit Data Guru <strong>{{ ucwords($guru->name) }}</strong></h1>

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-12 col-md-12 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Pengguna</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('guru') }}" class="btn btn-warning btn-sm mb-4">
                        Kembali
                    </a>
                    <form action="/admin/update-guru/{{ $guru->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="mb-3">
                                    <span class="">Nama</span>
                                    <input type="text" class="form-control mt-3 @error('name')
                                        is-invalid
                                    @enderror " placeholder="Masukkan Nama Pengguna" aria-label="Username" aria-describedby="basic-addon1" autofocus value="{{ $guru->name }}" name="name">
        
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
                                @enderror" placeholder="Masukkan Email Pengguna" aria-label="Username" aria-describedby="basic-addon1" value="{{ $guru->email }}" name="email">
        
                                    @error('email')
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