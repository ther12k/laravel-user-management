@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-md-12">
            <div class="card">
                
            @if (Auth::check())
                <div class="card-header">
                    <div class="col-md-4">
                        {{ __('Daftar Permohonan') }}
                    </div>
                    <div class="col-md-8">
                        <button class="btn btn-primary float-right" >Add</button>
                    </div>
                </div>
                <div class="card-body">
                            
                    <livewire:nppbkcs-datatables
                    searchable="nama_pemilik, email_pemilik"
                />
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            @else
            </div>

        </div>
    </div>
</div>
@endif
@endsection
