@extends('Pages.Layout.Dashboard.Dashboard')
@section('title', 'Edit Kelas')
@section('content')

<h1 class="h3 mb-2 text-secondary text-center">Edit Kelas</h1>

@foreach ($kelas as $k)

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-12 col-md-12 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Kelas</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('kelas') }}" class="btn btn-warning btn-sm mb-4">Kembali</a>
                    <form action="/admin/update-kelas/{{ $k->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <span class="">Kelas</span>
                                    <input type="text" class="form-control mt-3 @error('kelas')
                                        is-invalid
                                    @enderror " placeholder="Masukkan Nama Kelas" aria-label="Username" aria-describedby="basic-addon1" autofocus name="kelas" value="{{ $k->kelas }}">
        
                                    @error('kelas')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
        
                                </div>
                    
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="mb-3">
                                    <span class="">Wali Kelas</span>
                                    {{-- <br> --}}
                                    <select name="walas" id="walas" class="form-control @error('walas')
                                        is-invalid
                                    @enderror">

                                        {{-- <option value="{{ $k->id_walas }}" selected>{{ $k->name }}</option> --}}

                                        @foreach ($walas as $w)
                                    
                                        <option value="{{ $w->id }}"
                                            @if ($w->id == $k->id_walas)
                                                selected
                                            @endif    
                                        >{{ $w->name }}
                                        </option>

                                        @endforeach

                                    </select>

                                    @error('walas')

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

@endforeach

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#walas').select2({
                theme: "bootstrap-5",
                width: 'resolve'
            });
        });
    </script>
@endsection