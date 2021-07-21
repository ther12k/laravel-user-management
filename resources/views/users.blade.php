@extends('layouts.app')

@section('content')

    <div class="container mx-auto p-5" id="content">
        <div class="relative">
            <livewire:users sort="created_at|desc" searchable="name, email"/>
            <button onclick='Livewire.emit("openModal", "user-modal",@json(["id"=>null,"action"=>"add"]))'
                class="space-x-2 top-0 right-0 p-2 flex text-white hover:bg-indigo-700 bg-indigo-500 hover:text-indigo-100 rounded absolute" >
                {{-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg> --}}
                <x-heroicon-o-user-add class="w-6 h-6"/>
                <span class="">Tambah</span>
            </button>
        </div>
    </div>

@endsection