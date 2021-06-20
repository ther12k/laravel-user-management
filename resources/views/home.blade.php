@extends('layouts.app')

@section('content')

    <div class="container mx-auto p-5">
        {{-- <h1 class="text-4xl mt-32 text-center tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
            Daftar
        </h1> --}}
        @if (Auth::check())     
            <livewire:nppbkcs-datatables
            searchable="nama_pemilik, email_pemilik">
        @else
        
        @endif
    </div>

@endsection