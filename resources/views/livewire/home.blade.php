@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12″>
            <div class="card">
                <div class="card-header">Laravel Livewire </div>                
                <div class="card-body">                                   
                    @livewire('search-pagination')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection