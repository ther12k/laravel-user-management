@extends('layouts.base')

@section('content')
<div class="container mx-auto p-5">
    @if (Auth::check())     
        <livewire:update-profile />
    @else
    
    @endif
</div>
@endsection