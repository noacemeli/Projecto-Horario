@extends('layouts.app')

@section('content')
<h1 class="text-center">Archivos de Empleados</h1>

<div class="py-4 d-flex col-lg-9 gap-5 w-100">

    <div class="d-flex col-lg-2">
        @include('layouts._partials.nav')
    </div>

    <div class="col-lg-8 d-flex gap-5">

        @foreach ($empleados as $empleado)
        <div class="card w-25 p-0">
            <h5 class="card-header">{{$empleado->name}}</h5>
            <img src="{{asset('assets/img/carpeta.png')}}" alt="carpeta" class="card-image-top">
            <div class="card-body">
                <a href="{{route('verDocsEmpleados', $empleado->id)}}" class="btn btn-success">Ver Docs</a>
            </div>
        </div>
        @endforeach
    </div>

</div>


@endsection
