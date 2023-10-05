@extends('layouts.app')
@section('title', 'email')
@section('content')
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Verifikasi alamat email Anda</div>
            <div class="card-body">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        Tautan verifikasi baru telah dikirim ke alamat email Anda.
                    </div>
                @endif
                Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.
                Jika Anda tidak menerima email,
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">klik di sini untuk meminta yang
                        lain
                    </button>.
                </form>
            </div>
        </div>
    </div>
@endsection
