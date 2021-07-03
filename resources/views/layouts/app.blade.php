@extends('layouts.base')

@section('body')
<x-header-dark/>
{{-- <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        Header
    </div>
</header> --}}
<div class="md:flex flex-col md:flex-row md:min-h-screen w-full" id="content">
    @yield('content')
    
    @isset($slot)
        {{ $slot }}
    @endisset
</div>
@endsection
