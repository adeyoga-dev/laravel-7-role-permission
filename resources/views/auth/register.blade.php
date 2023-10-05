@extends('layouts.app')
@section('title', 'Daftar')
@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Daftar</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="text-md-right">Nama</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="nik" class="text-md-right">NIK</label>
                                    <input id="nik" type="number"
                                        class="form-control @error('nik') is-invalid @enderror" name="nik"
                                        value="{{ old('nik') }}" required autofocus>
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="text-md-right">Alamat E-mail</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="text-md-right">Kata Sandi</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password-confirm" class="text-md-right">Konfirmasi Kata Sandi</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Daftar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
