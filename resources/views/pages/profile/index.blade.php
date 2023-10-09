@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    <!-- tabel view profile -->
    @include('pages.profile.view.profile')
    <!-- modal edit password, dan edit email -->
    @include('pages.profile.modal.edit-password')
    @include('pages.profile.modal.edit-email')


    {{-- @include("pages.role.modal.edit") --}}
@endsection
