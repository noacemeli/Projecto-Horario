@extends('layouts.app')


@section('content')
<h1 class="text-center">Panel de control del Administrador</h1>
<div class="py-4 d-flex col-lg-9 gap-2 w-100">
    <div class="d-flex flex-column h-5 col-lg-2">
        @include('layouts._partials.nav')
    </div>

    <div class="col-lg-8" style="height: 25rem;">
        <h2 class="text-center">Mapa de Fichajes Hoy</h2>

        <div class="container d-flex flex-column gap-3 align-items-center">
            <div id="map">

            </div>

        </div>
    </div>
</div>
@section('scripts')
    <script>
        let nombreUsuario="{{Auth::user()->name}}";
    </script>
    <script src="{{asset('assets/js/insertMap.js')}}"></script>

@endsection
@endsection
