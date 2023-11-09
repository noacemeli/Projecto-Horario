@extends('layouts.app')
@section('content')
<h1 class="text-center">Archivos de Empleados</h1>

<div class="py-4 d-flex col-lg-9 gap-5 w-100">

    <div class="d-flex col-lg-2">
        @include('layouts._partials.nav')
    </div>

    <div class="col-lg-8 d-flex gap-5 flex-wrap">

        @foreach ($archivos as $archivo)
        <a href="{{asset(Storage::url($archivo->ruta))}}" class=" card text-decoration-none text-success d-flex flex-column align-items-center text-start" style="width: 15rem;">
            <img src="{{asset('assets/img/doc.png')}}" class="card-img-top w-25" alt="doc">
            <div class="card-body d-flex justify-center m-auto text-center w-100">
                <p class="card-text w-100 text-center" >{{$archivo->nombre}}</p>
            </div>
        </a>
        @endforeach
    </div>

</div>


@endsection
