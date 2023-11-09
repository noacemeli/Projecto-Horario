@extends('layouts.app')

@section('content')
<h1 class="text-center">Panel de control del Usuario</h1>

<div class="py-4 d-flex col-lg-9 gap-5 w-100">

    <div class="d-flex col-lg-2">
        @include('layouts._partials.nav')
    </div>

    <div class="col-lg-8 ">

        <div class="card">
            <div class="card-header">{{ __('Solicitud') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('hacer.solicitud') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Título') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="start" class="col-md-4 col-form-label text-md-end">{{ __('Fecha de inicio') }}</label>

                        <div class="col-md-6">
                            <input id="start" type="date" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}" required autocomplete="start">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="end" class="col-md-4 col-form-label text-md-end">{{ __('Fecha final') }}</label>

                        <div class="col-md-6">
                            <input id="end" type="date" class="form-control @error('end') is-invalid @enderror" name="end" required autocomplete="new-end">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Enviar') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


@endsection


