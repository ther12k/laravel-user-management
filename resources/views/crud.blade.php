<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @livewireStyles
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>  
     --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/wizard.css') }}" rel="stylesheet" id="bootstrap-css">
</head>
<body>
{{-- 
  @include('layouts.app-link') --}}

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xs-12 col-md-12">
      <div class="card">
        <div class="card-header">
          DATA PERMOHONAN NPPBKC
        </div>
        <div class="card-body">
          <livewire:nppbkc-wizard />
        </div>
      </div>
      </div>
    </div>    
  </div>
</body>
 
@livewireScripts
  
</html>