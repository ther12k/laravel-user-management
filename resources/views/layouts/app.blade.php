@extends('layouts.base')

@section('body')
<x-header-dark/>
<div class="md:flex flex-col md:flex-row md:min-h-screen w-full" id="content">
    
    @yield('content')
    
    @isset($slot)
        {{ $slot }}
    @endisset
</div>
@endsection
