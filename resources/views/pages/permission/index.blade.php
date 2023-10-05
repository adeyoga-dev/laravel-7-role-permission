@extends('layouts.app')
@section('title', 'Manajemen Permission')
<!-- Custom Styles -->
@push('custom-script')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush
@section('content')
    <!-- tabel view permission -->
    @include('pages.permission.view.table')
    <!-- modal add, view dan edit perkmission -->
    @include('pages.permission.modal.add')
    {{-- @include("pages.role.modal.edit") --}}
@endsection
<!-- Custom Scrpits -->
@push('custom-script')
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
@endpush
