@extends('layouts.app')
@section('title','Beranda')
@section('content')
<div class="card">
    <div class="card-header">Beranda</div>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        Kamu sudah masuk!
    </div>
</div>
@endsection
