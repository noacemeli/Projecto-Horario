@extends('layouts.app')

@section('content')
<h1 class="text-center">Panel de control del Administrador</h1>

<div class="py-4 d-flex col-lg-9 gap-5 w-100">

    <div class="d-flex col-lg-2">
        @include('layouts._partials.nav')
    </div>

    <div class="col-lg-8 d-flex gap-5">

            <div class="card w-25 p-0">
                <h5 class="card-header">Mis Documentos</h5>
                <img src="{{asset('assets/img/carpeta.png')}}" alt="carpeta" class="card-image-top">
                <div class="card-body">
                    <a href="{{route('misDocs')}}" class="btn btn-success">Ver Docs</a>
                </div>
            </div>
            @if (Auth::user()->rol==='admin')
            <div class="card w-25 p-0">
                <h5 class="card-header">Docs de Empleados</h5>
                <img src="{{asset('assets/img/carpeta.png')}}" alt="carpeta" class="card-image-top">
                <div class="card-body">
                    <a href="{{route('empleados')}}" class="btn btn-success">Ver Docs</a>
                </div>
            </div>
            @else
            <div class="card w-25 p-0">
                <h5 class="card-header">Docs del Administrador</h5>
                <img src="{{asset('assets/img/carpeta.png')}}" alt="carpeta" class="card-image-top">
                <div class="card-body">
                    <a href="{{route('adminDocs')}}" class="btn btn-success">Ver Docs</a>
                </div>
            </div>

            @endif


    </div>

</div>


@endsection
