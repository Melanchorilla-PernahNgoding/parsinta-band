@extends('layouts.base')
@section('baseStyles')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">
@endsection

@section('baseScripts')
    <!-- Scripts -->
    <script src="{{ asset('js/backend.js') }}"></script>
    @stack('scripts')
@endsection


@section('body')
<div class="container-fluid">
<div class="container-fluid py-3">
        <div class="row">
            <div class="col-md-3">
                <x-sidebar></x-sidebar>
            </div>
            <div class="col-md-9">
                @include('alert')

                @yield('content')
            </div>
        </div>
    </div>
</div>
@endsection