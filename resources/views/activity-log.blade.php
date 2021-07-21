@extends('layouts.app')

@section('content')

    <div class="container mx-auto p-5">
        {{-- <h1 class="text-4xl mt-32 text-center tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
            Daftar
        </h1> --}}
        @if (Auth::check())     
            {{-- <livewire:datatable
                model="App\Models\ActivityLog"
                with="user"
                include="user.name|User,log_name,description,created_at,updated_at,properties"
                exclude="subject_type, causer_type, subject_id"
                > --}}
                <livewire:activity-log />
        @else
        
        @endif
    </div>

@endsection