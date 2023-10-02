@extends('layouts.app')
@section('title','Beranda')
<!-- Custom Styles -->
@push('custom-script')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush
@section('content')
<!-- tabel view user -->
@include('pages.user.view.table')
<!-- modal view dan edit user -->
@include("pages.user.modal.edit")
@endsection
<!-- Custom Scrpits -->
@push('custom-script')
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
@endpush
