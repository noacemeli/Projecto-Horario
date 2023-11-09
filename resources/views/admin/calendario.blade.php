@extends('layouts.app')

@section('content')
<h1 class="text-center">Panel de control del Administrador</h1>

<div class="py-4 d-flex col-lg-9 gap-5 w-100">

    <div class="d-flex col-lg-2">
        @include('layouts._partials.nav')
    </div>

    <div class="col-lg-8 " id="calendar" style="max-height: 30.5rem;">



    </div>

</div>


@endsection

